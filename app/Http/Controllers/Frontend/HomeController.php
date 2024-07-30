<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Redirect;
use Illuminate\Support\Facades\Http;
use Laravel\Sanctum\PersonalAccessToken;
use DateTime;
use Illuminate\Support\Facades\Auth;
use App\Models\CategoryModal;
use Illuminate\Support\Facades\Session;
use App\Models\SubCategoryModal;
use App\Models\SliderModal;
use App\Models\ProductModal;
use App\Models\ContactUsModal;
use App\Models\CartModal;
use App\Models\TestimonialModal;


class HomeController extends Controller
{
    // ============================= START INDEX ============================ 
    public function index(Request $req)
    {
        $sliderData = SliderModal::where('is_active', 1)->get();
        $trendingData = ProductModal::where(['is_active' => 1, 'is_trending' => 1])->get();
        $topData = ProductModal::where(['is_active' => 1, 'is_top' => 1])->get();
        $testimonialsData = TestimonialModal::orderBy('seq', 'asc')->get();

        return view('frontend/index', compact('sliderData', 'trendingData', 'topData', 'testimonialsData'))->withTitle('Ekaa Vastra');
    }
    // ============================= END INDEX ============================ 
    // ============================= START ALL PRODUCTS ============================ 
    public function collection(Request $req, $encodeSub)
    {
        $originalName = urldecode(str_replace('-', '+', $encodeSub));
        $subcategoryData = SubCategoryModal::where(['is_active' => 1, 'name' => $originalName])->first();
        $title = $subcategoryData->name . ' - Ekaa Vastra';
        $productData = ProductModal::where(['is_active' => 1, 'subcategory_id' => $subcategoryData->id])->paginate(10);;
        return view('frontend/all_products', compact('subcategoryData', 'productData', 'title'));
    }
    // ============================= END ALL PRODUCTS ============================ 
    // ============================= START PRODUCTS DETAILS ============================ 
    public function product(Request $req, $encodeSub)
    {
        $originalName = urldecode(str_replace('-', '+', $encodeSub));
        $productData = ProductModal::where(['is_active' => 1, 'name' => $originalName])->first();
        $cartInfo = 0;
        if (Auth::check()) {
            $user_id = Auth::id();
            $cartInfo = CartModal::where(['user_id' => $user_id, 'product_id' => $productData->id])->count();
        } else {
            $cart_data = Session::get('cart_data', []);

            foreach ($cart_data as $item) {
                if ($item['product_id'] == $productData->id) {
                    $cartInfo = 1;
                }
            }
        }
        $relatedData = ProductModal::where('is_active', 1)
            ->where('subcategory_id', $productData->subcategory_id)
            ->where('id', '!=', $productData->id)
            ->limit(10)
            ->get();
        $title = $productData->name . ' - Ekaa Vastra';
        return view('frontend/product_details', compact('productData', 'relatedData', 'title', 'cartInfo'));
    }
    // ============================= END PRODUCTS DETAILS ============================ 
    // ============================= START CONTACT US ============================ 
    public function contactUs(Request $req)
    {
        return view('frontend.contact_us');
    }
    // ============================= END CONTACT US ============================ 
    // ============================= START REFUND POLICY ============================ 
    public function refundPolicy(Request $req)
    {
        return view('frontend.refund_policy');
    }
    // ============================= END REFUND POLICY ============================ 
    // ============================= START TERMS AND CONDITIONS ============================ 
    public function termsAndConditions(Request $req)
    {
        return view('frontend.terms_and_conditions');
    }
    // ============================= END TERMS AND CONDITIONS ============================ 
    // ============================= START PRIVACY POLICY ============================ 
    public function privacyPolicy(Request $req)
    {
        return view('frontend.privacy_policy');
    }
    // ============================= END PRIVACY POLICY ============================ 
    // ============================= START SHIPPING POLICY ============================ 
    public function shippingPolicy(Request $req)
    {
        return view('frontend.shipping_policy');
    }
    // ============================= END SHIPPING POLICY ============================ 
    // ============================= START PRIVACY POLICY ============================ 
    public function aboutUs(Request $req)
    {
        return view('frontend.about_us');
    }
    // ============================= END PRIVACY POLICY ============================ 
    // ============================= START CONTACT US STORE ============================ 
    public function contactUsStore(Request $req)
    {
        $this->validate($req, [
            'customerName' =>  'required',
            'customerEmail' =>  'required',
            'customerPhone' =>  'required',
            'customerMessage' => 'required',
            'g-recaptcha-response' => 'required',
        ]);
        // reCAPTCHA verification
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => '6LffcxsqAAAAADSJJ0G_C_V8MU8i7lnLHfXJVW0f',
            'response' => $req->input('g-recaptcha-response'),
            'remoteip' => $req->ip(),
        ]);

        $body = $response->json();
        if (!$body['success']) {
            return redirect()->back()->withErrors(['g-recaptcha-response' => 'Invalid reCAPTCHA'])->withInput();
        }
        $uploadData = new ContactUsModal();
        $uploadData->name = ucwords($req->customerName);
        $uploadData->email = $req->customerEmail;
        $uploadData->phone = $req->customerPhone;
        $uploadData->message = $req->customerMessage;
        $uploadData->ip = $req->ip();
        $uploadData->save();
        if ($uploadData) {
            return redirect()->back()->with('status-success', 'Thank you for reaching out! We will get back to you shortly.');
        } else {
            return redirect()->back()->with('status-error', 'Something Went Wrong');
        }
    }
    // ============================= END CONTACT US STORE ============================ 
    public function OrderInvoice(Request $req)
    {

        $foreachData = [
            [
                'gst_percentage' => 5,
                'quantity' => 1,
                'price' => 999,
                'product' => [
                    'name' => 'Blue Abstract Print Suit Set',
                    'sku' => 'EV130',
                ],
                'type' => [
                    'name' => 'L',
                ]
            ],
            [
                'gst_percentage' => 12,
                'quantity' => 1,
                'price' => 1149,
                'product' => [
                    'name' => 'Forest Green Abstract Print Co-ord Set',
                    'sku' => 'EV130',
                ],
                'type' => [
                    'name' => 'S',
                ]
            ]
        ];
        $total = 999 + 1149;
        $shipping = 0;
        $discount = 0;
        $final = ($total - $discount) + $shipping;
        $OrderData = [
            'id' => 19,
            'invoice_no' => '19/EV/24-25',
            'payment_mode' => 'Prepaid',
            'shipping' => $shipping,
            'discount' => $discount,
            'total_amount' => $total,
            'final_amount' => $final,
            'address' => [
                'name' => 'Riya Gupta',
                'phone' => '9928413990',
                'email' => '',
                'address' => '139, Mangal Vihar, Near Riddhi Siddhe sweets, Gopalpura Bypass, Jaipur, Rajasthan, 302018',
            ],
            'created_at' => '07-Jul-2024',
        ];
        $enOr =  json_encode($OrderData);
        $OrderData = json_decode($enOr);
        $enFor =  json_encode($foreachData);
        $foreachData = json_decode($enFor);
        return view('admin/order/invoice', compact(['OrderData', 'foreachData']));
    }
}
