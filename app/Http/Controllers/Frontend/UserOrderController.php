<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\TypeModal;
use App\Models\CartModal;
use App\Models\User;
use App\Models\UserAddressModal;
use App\Models\Order1Modal;
use App\Models\Order2Modal;
use App\Models\OrderAddressModal;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class UserOrderController extends Controller
{
    private $PHONE_PE_SALT; // Replace with your PhonePe API Key
    private $PHONE_PE_MERCHANT_ID; // Replace with your PhonePe Salt Key
    private $PHONE_PE_URL; // Replace with your PhonePe Salt Key
    public function __construct()
    {
        $this->PHONE_PE_SALT = '4d0c93b5-b222-452f-97bf-8337e42f5591'; // Get API Key from config
        $this->PHONE_PE_MERCHANT_ID = 'M22QX0TIVYNRE'; // Get Salt Key from config
        $this->PHONE_PE_URL = 'https://api.phonepe.com/apis/hermes/'; // Get Salt Key from config
    }
    // ============================= START VIEW CHECKOUT ============================ 
    public function index(Request $req)
    {
        $user_id = Auth::id();
        $user = User::firstOrCreate(['id' => $user_id]);
        $cartItems = CartModal::where(['user_id' => $user_id])->get();
        if (count($cartItems) == 0) {
            return Redirect('/');
        }
        $defaultAddress = UserAddressModal::where('id', $user->default_address_id)->first();
        $userAddressData = UserAddressModal::where('user_id', $user_id)->get();
        $PinCodeServiceable = false;
        if ($defaultAddress) {
            $PinCodeServiceable = $this->checkPinCodeServiceability($defaultAddress->pincode);
        }
        return view('frontend/checkout', compact('cartItems', 'user', 'defaultAddress', 'userAddressData', 'PinCodeServiceable'))->withTitle('Checkout');
    }
    // ============================= END VIEW CHECKOUT ============================ 
    // ============================= START CHECK PIN CODE SERVICEABILITY ============================ 
    public function checkPinCodeServiceability($pincode)
    {
        $apiToken = '26f91c3bde997aedc80c250b71b70b2e0fd279e4'; // Replace with your actual API token
        $url = 'https://track.delhivery.com/c/api/pin-codes/json/';

        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $apiToken,
            'Content-Type' => 'application/json',
        ])->get($url, ['filter_codes' => $pincode,]);

        if ($response->successful()) {
            $data = $response->json();

            // Check if the response contains the serviceability data
            if (isset($data['delivery_codes']) && !empty($data['delivery_codes'])) {
                return true;
            } else {
                return false;
            }
        } else {
            // return response()->json(['error' => 'Failed to fetch data'], 500);
            return false;
        }
    }
    // ============================= END CHECK PIN CODE SERVICEABILITY ============================ 
    // ============================= START GET SHIPPING CHARGES ============================ 
    public function getShippingCharges($payment_type)
    {
        $cart_total = 0;
        $user_id = Auth::id();
        $cartItems = CartModal::where(['user_id' => $user_id])->get();
        foreach ($cartItems as $cart) {
            $cart_total += ($cart->product->selling_price * $cart->quantity);
        }
        $user = User::firstOrCreate(['id' => $user_id]);
        $defaultAddress = UserAddressModal::where('id', $user->default_address_id)->first();
        $d_pin = $defaultAddress->pincode;
        $weight = 200;
        if ($payment_type == 1) {
            $pt = 'COD';
            $cod = $cart_total;
        } else {
            $pt = 'Pre-paid';
            $cod = 0;
        }
        $response = $this->calculateShippingCharges($d_pin, $weight, $pt, $cod, $cart_total);
        return json_encode($response);
    }
    // ============================= END GET SHIPPING CHARGES ============================ 
    // ============================= START CALCULATE SHIPPING CHARGES ============================ 
    public function calculateShippingCharges($d_pin, $weight, $pt, $cod, $cart_total)
    {
        // $apiToken = '213d2fa2e824f912efb21c4dd460f6b70c4ba05a'; // Replace with your actual API token
        $apiToken = '26f91c3bde997aedc80c250b71b70b2e0fd279e4'; // Replace with your actual API token
        $url = 'https://track.delhivery.com/api/kinko/v1/invoice/charges/.json';

        $params = [
            'md' => 'S',
            'ss' => 'Delivered',
            'd_pin' => $d_pin, // Replace with dynamic value if needed
            'o_pin' => '302021', // Replace with dynamic value if needed
            'cgm' => $weight,
            'pt' => $pt,
            'cod' => $cod,
        ];

        $response = Http::withHeaders([
            'Authorization' => 'Token ' . $apiToken,
            'Content-Type' => 'application/json',
        ])->get($url, $params);

        if ($response->successful()) {
            $res = $response->json();
            $decoded = json_decode($response);
            if (!empty($decoded)) {
                $shipping = $decoded[0]->total_amount;
                $new_total = $cart_total + $shipping;
                $res = array('sub_total' => number_format($new_total, 2), 'shipping' => number_format($shipping, 2));
                $respone['status'] = true;
                $respone['message'] = 'Shipping Calculated Successfully!';
                $respone['data'] = $res;
                return $respone;
            } else {
                $respone['status'] = false;
                $respone['message'] = 'Some error occurred';
                $respone['data'] = [];
                return $respone;
            }
        } else {
            $respone['status'] = false;
            $respone['message'] = 'Failed to fetch data';
            $respone['data'] = [];
            return $respone;
        }
    }
    // ============================= END CALCULATE SHIPPING CHARGES ============================ 
    // ============================= START CHECKOUT PROCESS ============================ 
    public function checkout(Request $request)
    {
        $request->validate([
            'payment_mode' => 'required|in:1,2',
        ]);
        $user_id = Auth::id();
        $ip = request()->ip();
        $cartItems = CartModal::where(['user_id' => $user_id])->get();
        $user = User::firstOrCreate(['id' => $user_id]);
        $defaultAddress = UserAddressModal::where('id', $user->default_address_id)->first();
        //---------- ORDER1 Entry -----------
        $order1Upload = new Order1Modal();
        $order1Upload->payment_mode = $request->input('payment_mode');
        $order1Upload->user_id = $user_id;
        $order1Upload->payment_status = 1;
        $order1Upload->order_status = 1;
        $order1Upload->address_id = $defaultAddress->id;
        $order1Upload->ip = $ip;
        $order1Upload->save();
        $cart_total = 0;
        //---------- ORDER2 Entry -----------
        foreach ($cartItems as $cart) {
            $order2Upload = new Order2Modal();
            $order2Upload->main_id = $order1Upload->id;
            $order2Upload->product_id = $cart->product_id;
            $order2Upload->type_id = $cart->type_id;
            $order2Upload->quantity = $cart->quantity;
            $order2Upload->name = $cart->product->name;
            $order2Upload->image = $cart->product->image;
            $order2Upload->price = $cart->product->selling_price;
            $order2Upload->gst_percentage = $cart->product->gst_percentage;
            $order2Upload->ip = $ip;
            $order2Upload->save();
            $cart_total += ($cart->product->selling_price * $cart->quantity);
        }
        $d_pin = $defaultAddress->pincode;
        $weight = 200;
        if ($request->input('payment_mode') == 1) {
            $pt = 'COD';
            $cod = $cart_total;
        } else {
            $pt = 'Pre-paid';
            $cod = 0;
        }
        $response = $this->calculateShippingCharges($d_pin, $weight, $pt, $cod, $cart_total);
        $txn_id = bin2hex(random_bytes(12));
        //---------- ORDER1 Entry -----------
        $order1Update = Order1Modal::where('id', $order1Upload->id)->first();
        $order1Update->total_amount = $cart_total;
        $order1Update->shipping = $response['data']['shipping'];
        $order1Update->final_amount = $response['data']['sub_total'];
        $order1Update->txn_id = $txn_id;
        $order1Update->save();
        //---------- ORDER Address Entry -----------
        $orderAddressUpload = new OrderAddressModal();
        $orderAddressUpload->user_id = $user_id;
        $orderAddressUpload->order_id = $order1Upload->id;
        $orderAddressUpload->first_name = $defaultAddress->first_name;
        $orderAddressUpload->last_name = $defaultAddress->last_name;
        $orderAddressUpload->email = $defaultAddress->email;
        $orderAddressUpload->phone = $defaultAddress->phone;
        $orderAddressUpload->address = $defaultAddress->address;
        $orderAddressUpload->country = $defaultAddress->country;
        $orderAddressUpload->pincode = $defaultAddress->pincode;
        $orderAddressUpload->state = $defaultAddress->state;
        $orderAddressUpload->city = $defaultAddress->city;
        $orderAddressUpload->ip = $request->ip();
        $orderAddressUpload->save();
        if ($request->input('payment_mode') == 2) { // for prepaid orders
            $res = $this->getPhonePeUrl($order1Update, $orderAddressUpload);
            return $res;
        } else {
            //------------ EMPTY CART ---------
            CartModal::where('user_id', $user_id)->delete();
            // Return a response
            return response()->json(['status' => true, 'message' => 'Order placed successfully!', 'order_id' => $order1Upload->id]);
        }
    }
    // ============================= END CHECKOUT PROCESS ============================ 
    public function getPhonePeUrl($order1Update, $orderAddressUpload)
    {
        $url = $this->PHONE_PE_URL . 'pg/v1/pay'; // Sandbox endpoint
        $successUrl = route('verify-phone-pe-payment'); // Route for successful payments

        $payload = [
            "merchantId" => $this->PHONE_PE_MERCHANT_ID, // Get from config
            "merchantTransactionId" => $order1Update->txn_id,
            // "amount" => ($order1Update->final_amount*100),
            "amount" => 100,
            "redirectUrl" => route('verify-phone-pe-payment'), // Route to handle PhonePe response
            "callbackUrl" => route('verify-phone-pe-payment'), // Route for PhonePe callbacks
            "mobileNumber" => $orderAddressUpload->phone,
            "redirectMode" => "POST",
            "paymentInstrument" => [
                "type" => "PAY_PAGE",
            ],
        ];

        $encodedPayload = json_encode($payload);
        $signature = hash('sha256', $encodedPayload . '/pg/v1/pay' . $this->PHONE_PE_SALT) . '###1'; // Salt index set to 1
        $requestJson = [
            'request' => base64_encode($encodedPayload),
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-VERIFY' => $signature,
        ])
            ->post($url, $requestJson);

        if ($response->failed()) {
            return response()->json(['status' => false, 'message' => 'Error creating PhonePe order', 'error' => $response->json()]);
        }

        $responseData = $response->json();

        if ($responseData['code'] === 'PAYMENT_INITIATED') {
            return response()->json([
                'status' => true,
                'message' => 'Success! Redirecting to PhonePe for payment.',
                'data' => $responseData,
                'redirectUrl' => $responseData['data']['instrumentResponse']['redirectInfo']['url'],
            ]);
        } else {
            return response()->json(['status' => false, 'message' => 'PhonePe payment initiation failed', 'error' => $responseData]);
        }
    }
    public function verifyPhonePePayment(Request $request)
    {
        $body = $request->all();
        $url = $this->PHONE_PE_URL; // Sandbox endpoint

        if (isset($body['code']) && $body['code'] === 'PAYMENT_SUCCESS') {
            $url = $url . 'pg/v1/status/' . $this->PHONE_PE_MERCHANT_ID . '/' . $body['transactionId'];

            $verifyHeader = hash('sha256', '/pg/v1/status/' . $this->PHONE_PE_MERCHANT_ID . '/' . $body['transactionId'] . $this->PHONE_PE_SALT) . '###1';

            $client = new Client();
            try {
                $response = $client->request('GET', $url, [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'X-VERIFY' => $verifyHeader,
                        'X-MERCHANT-ID' => config('services.phone_pe.merchant_id'),
                    ],
                ]);

                $responseBody = $response->getBody()->getContents();
                return json_decode($responseBody);
            } catch (\GuzzleHttp\Exception\RequestException $e) {
                Log::error('cURL Error: ' . $e->getMessage());
                return response()->json(['error' => 'cURL Error: ' . $e->getMessage()], 500);
            }
        }
    }
    // ============================= END CHECKOUT PROCESS ============================ 
    public function showOrderSuccess($order_id)
    {
        return view('frontend/success', compact('order_id'))->withTitle(' Ekaa Vastra');
    }
}
