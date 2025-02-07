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
use App\Models\PromoModal;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Exception;
use App\Services\OrderNotificationService;

class UserOrderController extends Controller
{
    private $PHONE_PE_SALT; // Replace with your PhonePe API Key
    private $PHONE_PE_MERCHANT_ID; // Replace with your PhonePe Salt Key
    private $PHONE_PE_URL; // Replace with your PhonePe Salt Key
    protected $orderNotificationService;
    protected $FREE_SHIPPING;
    protected $COD_CHARGE;

    public function __construct(OrderNotificationService $orderNotificationService)
    {
        $this->orderNotificationService = $orderNotificationService;
        $this->PHONE_PE_MERCHANT_ID = env('PHONE_PE_MERCHANT_ID'); // Get Salt Key from config
        $this->PHONE_PE_URL = env('PHONE_PE_URL'); // Get Salt Key from config
        $this->PHONE_PE_SALT = env('PHONE_PE_SALT'); // Get API Key from config
        $this->FREE_SHIPPING = env('FREE_SHIPPING'); // Get API Key from config
        $this->COD_CHARGE = env('COD_CHARGE'); // Get API Key from config
    }

    // ============================= START VIEW CHECKOUT ============================ 
    public function index(Request $req)
    {
        $user_id = Auth::id();
        $user = User::where(['id' => $user_id])->first();
        $cartItems = CartModal::where(['user_id' => $user_id])->get();
        if (count($cartItems) == 0) {
            return Redirect('/');
        }
        foreach ($cartItems as $item) {
            $type_data = TypeModal::where(['id' => $item->type_id, 'is_active' => 1])->first();
            if (!$type_data || $type_data->inventory < $item->quantity) {
                return redirect()->back()->with('status-error', $type_data->product->name . ' is out of stock');
            }
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
        $user = User::where(['id' => $user_id])->first();
        $defaultAddress = UserAddressModal::where('id', $user->default_address_id)->first();
        $d_pin = $defaultAddress->pincode;
        $weight = 200;
        if ($payment_type == 1) {
            $pt = 'COD';
            $cod = $cart_total;
        } else {
            // $pt = 'Pre-paid';
            // $cod = 0;
            $pt = 'COD';
            $cod = $cart_total;
        }
        $response = $this->calculateShippingCharges($d_pin, $weight, $pt, $cod, $cart_total);
        return json_encode($response);
    }
    // ============================= END GET SHIPPING CHARGES ============================ 
    // ============================= START CALCULATE SHIPPING CHARGES ============================ 
    public function calculateShippingCharges($d_pin, $weight, $pt, $cod, $cart_total)
    {
        if ($cart_total > $this->FREE_SHIPPING) {
            $res = array('sub_total' => $cart_total, 'shipping' => 0);
            $respone['status'] = true;
            $respone['message'] = 'Shipping Calculated Successfully!';
            $respone['data'] = $res;
            return $respone;
        }
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
                $res = array('sub_total' => round($new_total), 'shipping' => round($shipping));
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
    // ============================= START CALCULATE WALLET DISCOUNT ============================ 
    public function calculateWalletDiscount()
    {
        $cart_total = 0;
        $user_id = Auth::id();
        $cartItems = CartModal::where(['user_id' => $user_id])->get();
        foreach ($cartItems as $cart) {
            $cart_total += ($cart->product->selling_price * $cart->quantity);
        }
        $user = User::find($user_id);
        $Discount = round($cart_total * 0.10);

        $walletDiscount = min($Discount, $user->wallet);
        return response()->json([
            'status' => true,
            'message' => 'Wallet applied successfully!',
            'walletDiscount' => $walletDiscount,
        ]);
    }
    // ============================= END CALCULATE WALLET DISCOUNT ============================
    // ============================= START CALCULATE WALLET DISCOUNT ============================ 
    public function calculatePaymentCharges(Request $request)
    {
        $cart_total = 0;
        $user_id = Auth::id();
        // Calculate cart total
        $cartItems = CartModal::where('user_id', $user_id)->get();
        foreach ($cartItems as $cart) {
            $cart_total += ($cart->product->selling_price * $cart->quantity);
        }
        if ($request->input('payment_mode') == 2) {
            $cod_charge = 0;
            $min = 30;
            $max = 40;
            // Generate a consistent "random" number based on $cart_total
            $hash = crc32($cart_total);
            $prepaid_discount = $min + ($hash % ($max - $min + 1));
        } else {
            $cod_charge = $this->COD_CHARGE;
            $prepaid_discount = 0;
        }
        return response()->json([
            'status' => true,
            'message' => 'Payment charges calculated successfully!',
            'prepaid_discount' => $prepaid_discount,
            'cod_charge' => $cod_charge,
        ]);
    }
    // ============================= END CALCULATE WALLET DISCOUNT ============================
    // ============================= START CALL PROMO CODE DISCOUNT ============================

    public function applyPromoCode(Request $request)
    {
        $promo_code = $request->input('promo_code');
        $wallet = $request->input('wallet');

        if (!$promo_code) {
            return response()->json([
                'status' => false,
                'message' => 'Promo code is required!',
            ]);
        }

        // Call the internal function to calculate discount
        $promoDiscount =  $this->calculatePromoCodeDiscount($promo_code);
        return $promoDiscount;
    }
    // ============================= END CALL PROMO CODE DISCOUNT ============================ 
    // ============================= START CALCULATE PROMO CODE DISCOUNT ============================ 
    public function calculatePromoCodeDiscount($promo_code)
    {
        $cart_total = 0;
        $user_id = Auth::id();

        // Calculate cart total
        $cartItems = CartModal::where('user_id', $user_id)->get();
        foreach ($cartItems as $cart) {
            $cart_total += ($cart->product->selling_price * $cart->quantity);
        }

        // Check promo code validity and expiry
        $PromoData = PromoModal::where('name', $promo_code)
            ->where('expiry_date', '>=', Carbon::now()->format('Y-m-d'))
            ->where('is_active', 1)
            ->first();

        if (!$PromoData) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid or expired promo code!',
            ]);
        }

        // Check if promo code is 'one-time use' and already used by the user
        if ($PromoData->type == 1) { // Type 1 = One-time use
            $isUsed = Order1Modal::where('user_id', $user_id)
                ->where('promo_id', $PromoData->id)
                ->where('payment_status', 1)
                ->exists();

            if ($isUsed) {
                return response()->json([
                    'status' => false,
                    'message' => 'Promo code has already been used!',
                ]);
            }
        }

        // Check if cart total meets the minimum order limit
        if ($cart_total < $PromoData->mini_amount) {
            return response()->json([
                'status' => false,
                'message' => 'Your cart total must be at least ' . number_format($PromoData->mini_amount, 2) . ' to use this promo code.',
            ]);
        }

        // Calculate discount based on promo code type (Percentage or Flat Off)
        $PromoDiscount = 0;
        if ($PromoData->discount_type == 1) { // Percentage Off
            $PromoDiscount = ($cart_total * $PromoData->discount) / 100;

            // Ensure discount does not exceed the max discount limit
            $PromoDiscount = min($PromoDiscount, $PromoData->max_discount);
        } else if ($PromoData->discount_type == 2) { // Flat Off
            $PromoDiscount = $PromoData->discount;
        }

        // Return success response with the discount amount
        return response()->json([
            'status' => true,
            'message' => 'Promo code applied successfully!',
            'promoDiscount' => round($PromoDiscount),
            'promoId' => $PromoData->id,
        ]);
    }

    // ============================= END CALCULATE PROMO CODE DISCOUNT ============================ 
    // ============================= START CHECKOUT PROCESS ============================ 
    public function checkout(Request $request)
    {
        $request->validate([
            'payment_mode' => 'required|in:1,2',
            'isWalletChecked' => 'required',
        ]);
        $user_id = Auth::id();
        $ip = request()->ip();
        $cartItems = CartModal::where(['user_id' => $user_id])->get();
        foreach ($cartItems as $item) {
            $type_data = TypeModal::where(['id' => $item->type_id, 'is_active' => 1])->first();
            if (!$type_data || $type_data->inventory < $item->quantity) {
                return redirect()->back()->with('status-error', $type_data->product->name . ' is out of stock');
            }
        }
        $user = User::where(['id' => $user_id])->first();
        $defaultAddress = UserAddressModal::where('id', $user->default_address_id)->first();
        //---------- ORDER1 Entry -----------
        $order1Upload = new Order1Modal();
        $order1Upload->payment_mode = $request->input('payment_mode');
        $order1Upload->user_id = $user_id;
        $order1Upload->payment_status = $request->input('payment_mode') == 1 ? 1 : 0;
        $order1Upload->order_status = $request->input('payment_mode') == 1 ? 1 : 0;
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
            // $pt = 'Pre-paid';
            // $cod = 0;
            $pt = 'COD';
            $cod = $cart_total;
        }
        $ShippingResponse = $this->calculateShippingCharges($d_pin, $weight, $pt, $cod, $cart_total);
        if ($request->isWalletChecked) {
            $walletResponse = json_decode($this->calculateWalletDiscount()->getContent(), true); // Decode JSON
            $walletDiscount = $walletResponse['walletDiscount']; // Access the value

        } else {
            $walletDiscount = 0;
        }
        if ($request->promoCodeValue) {
            $promoCodeResponse = json_decode($this->calculatePromoCodeDiscount($request->promoCodeValue)->getContent(), true);
            $promo_discount = $promoCodeResponse['promoDiscount'];
            $promoId = $promoCodeResponse['promoId'];
        } else {
            $promo_discount = 0;
            $promoId = null;
        }
        $txn_id = bin2hex(random_bytes(12));
        //---- calculate payment charges -------
        if ($request->input('payment_mode') == 2) {
            $cod_charge = 0;
            $min = 30;
            $max = 40;
            // Generate a consistent "random" number based on $cart_total
            $hash = crc32($cart_total);
            $prepaid_discount = $min + ($hash % ($max - $min + 1));
        } else {
            $cod_charge = $this->COD_CHARGE;
            $prepaid_discount = 0;
        }
        //---------- ORDER1 Entry -----------
        $order1Update = Order1Modal::where('id', $order1Upload->id)->first();
        $order1Update->total_amount = $cart_total;
        $order1Update->shipping = $ShippingResponse['data']['shipping'];
        $order1Update->wallet_discount = $walletDiscount;
        $order1Update->prepaid_discount = $prepaid_discount;
        $order1Update->cod_charge = $cod_charge;
        $order1Update->promo_id = $promoId;
        $order1Update->promo_discount = $promo_discount;
        $order1Update->final_amount = ($cart_total + $ShippingResponse['data']['shipping'] + $cod_charge) - $walletDiscount - $promo_discount - $prepaid_discount;
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
        // ------ Update address id -------
        $orderData = Order1Modal::where('id', $order1Upload->id)->first();
        $orderData->address_id = $orderAddressUpload->id;
        $orderData->save();
        if ($request->input('payment_mode') == 2) { // for prepaid orders
            $res = $this->getPhonePeUrl($order1Update, $orderAddressUpload);
            return $res;
        } else {
            //-------- GENERATE INVOICE NUMBER ----------
            $currentYear = Carbon::now()->year;
            $nextYear = $currentYear + 1;
            $financialYear = substr($currentYear, -2) . '-' . substr($nextYear, -2);
            $orderCount = Order1Modal::whereYear('created_at', $currentYear)
                ->where('payment_status', 1)
                ->count();
            $invoiceNumber = str_pad($orderCount + 1, 3, '0', STR_PAD_LEFT) . "/EV/" . $financialYear;
            $orderData = Order1Modal::where('id', $order1Upload->id)->first();
            $orderData->invoice_no = $invoiceNumber;
            $orderData->save();
            //---------- UPDATE INVENTORY ---------
            $cartData = CartModal::where('user_id', $order1Update->user_id)->get();
            foreach ($cartData as $cart) {
                $type_data = TypeModal::where(['id' => $cart->type_id, 'is_active' => 1])->first();
                $type_data->inventory = $type_data->inventory - $cart->quantity;
                $type_data->save();
            }
            //------------ EMPTY CART ---------
            CartModal::where('user_id', $user_id)->delete();
            //---------- Send Admin Email -------
            $orderData = Order1Modal::where('id', $order1Upload->id)->first();
            $this->orderNotificationService->sendOrderNotification('ekaavastra@gmail.com', $orderData, 'admin_order');
            //---------- Send User Email -------
            $this->orderNotificationService->sendOrderNotification($orderData->address->email, $orderData, 'user_order_placed');

            return response()->json(['status' => true, 'message' => 'Order placed successfully!', 'order_id' => $order1Upload->id]);
        }
    }
    public function checkMail()
    {
        $toEmail = 'ekaavastra@gmail.com';
        $orderData = Order1Modal::where('id', 76)->first();

        try {
            $this->orderNotificationService->sendOrderNotification('ekaavastra@gmail.com', $orderData, 'admin_order_canceled');

            echo "Email sent successfully!";
        } catch (Exception $e) {
            // Log the error or handle it as needed
            \Log::error('Failed to send email: ' . $e->getMessage());
            // echo "Email failed: " . $e->getMessage();
        }
    }
    // ============================= END CHECKOUT PROCESS ============================ 
    // ============================= START GET PHONEPE URL ============================ 
    public function getPhonePeUrl($order1Update, $orderAddressUpload)
    {
        $url = $this->PHONE_PE_URL . 'pg/v1/pay';
        $payload = (object)[
            "merchantId" => $this->PHONE_PE_MERCHANT_ID, // Get from config
            "merchantTransactionId" => $order1Update->txn_id,
            "merchantUserId" => $order1Update->user_id,
            "amount" => $order1Update->final_amount * 100,
            "redirectUrl" => route('verify-phone-pe-payment'), // Route to handle PhonePe response
            "callbackUrl" => route('verify-phone-pe-payment'), // Route for PhonePe callbacks
            "mobileNumber" => $orderAddressUpload->phone,
            "redirectMode" => "POST",
            "paymentInstrument" => (object)[
                "type" => "PAY_PAGE",
            ],
        ];
        $jsonPayload = json_encode($payload);
        $encodedPayload = base64_encode($jsonPayload);

        $signature = hash('sha256', $encodedPayload . '/pg/v1/pay' . $this->PHONE_PE_SALT) . '###1'; // Salt index set to 1
        $requestJson = [
            'request' => $encodedPayload,
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
    // ============================= END GET PHONEPE URL ============================ 
    // ============================= START VERIFY PHONEPE PAYMENT ============================ 
    public function verifyPhonePePayment(Request $request)
    {
        $body = $request->all();
        $url = $this->PHONE_PE_URL;
        // Log::error('PhonePeResponse: ' . $body);

        if (isset($body['code']) && $body['code'] === 'PAYMENT_SUCCESS') {
            $url = $url . 'pg/v1/status/' . $this->PHONE_PE_MERCHANT_ID . '/' . $body['transactionId'];

            $verifyHeader = hash('sha256', '/pg/v1/status/' . $this->PHONE_PE_MERCHANT_ID . '/' . $body['transactionId'] . $this->PHONE_PE_SALT) . '###1';

            $client = new Client();
            try {
                $response = $client->request('GET', $url, [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'X-VERIFY' => $verifyHeader,
                        'X-MERCHANT-ID' => $this->PHONE_PE_MERCHANT_ID,
                    ],
                ]);

                $responseBody = $response->getBody()->getContents();
                $decodeRes = json_decode($responseBody);
                if (isset($decodeRes->code) && $decodeRes->code === 'PAYMENT_SUCCESS') {
                    //---------- ORDER1 Entry -----------
                    $order1Update = Order1Modal::where('txn_id', $decodeRes->data->merchantTransactionId)->first();
                    $order1Update->payment_status = 1;
                    $order1Update->order_status = 1;
                    //-------- GENERATE INVOICE NUMBER ----------
                    $currentYear = Carbon::now()->year;
                    $nextYear = $currentYear + 1;
                    $financialYear = substr($currentYear, -2) . '-' . substr($nextYear, -2);
                    $orderCount = Order1Modal::whereYear('created_at', $currentYear)
                        ->where('payment_status', 1)
                        ->count();
                    $invoiceNumber = str_pad($orderCount + 1, 3, '0', STR_PAD_LEFT) . "/EV/" . $financialYear;
                    $order1Update->invoice_no = $invoiceNumber;
                    $order1Update->save();
                    //---------- UPDATE INVENTORY ---------
                    $cartData = CartModal::where('user_id', $order1Update->user_id)->get();
                    foreach ($cartData as $cart) {
                        $type_data = TypeModal::where(['id' => $cart->type_id, 'is_active' => 1])->first();
                        $type_data->inventory = $type_data->inventory - $cart->quantity;
                        $type_data->save();
                    }
                    //------------ EMPTY CART ---------
                    CartModal::where('user_id', $order1Update->user_id)->delete();
                    //---------- Send Admin Email -------
                    $orderData = Order1Modal::where('id', $order1Update->id)->first();
                    $this->orderNotificationService->sendOrderNotification('ekaavastra@gmail.com', $orderData, 'admin_order');
                    //---------- Send User Email -------
                    $this->orderNotificationService->sendOrderNotification($orderData->address->email, $orderData, 'user_order_placed');
                    return Redirect('/order-success/' . $order1Update->id);
                } else {
                }
            } catch (\GuzzleHttp\Exception\RequestException $e) {
                Log::error('cURL Error: ' . $e->getMessage());
                return response()->json(['error' => 'cURL Error: ' . $e->getMessage()], 500);
            }
        }
    }
    // ============================= END VERIFY PHONEPE PAYMENT ============================ 

    // ============================= END CHECKOUT PROCESS ============================ 
    public function showOrderSuccess($order_id)
    {
        return view('frontend/success', compact('order_id'))->withTitle(' Ekaa Vastra');
    }
}
