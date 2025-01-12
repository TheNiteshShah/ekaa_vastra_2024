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
use App\Models\User;
use App\Models\Order1Modal;
use App\Models\Order2Modal;
use App\Models\UserAddressModal;
use App\Models\BannerModal;
use App\Models\WishListModal;


class HomeController extends Controller
{
    // ============================= START INDEX ============================ 
    public function index(Request $req)
    {
        $sliderData = SliderModal::where('is_active', 1)->get();
        $bannerData = BannerModal::where('is_active', 1)->get();
        $trendingData = ProductModal::where(['is_active' => 1, 'is_trending' => 1])->get();
        $topData = ProductModal::where(['is_active' => 1, 'is_top' => 1])->get();
        $testimonialsData = TestimonialModal::orderBy('seq', 'asc')->get();

        // $user = User::where(['phone' => '8387039990'])->first();
        // Auth::login($user);
        return view('frontend/index', compact('sliderData', 'bannerData', 'trendingData', 'topData', 'testimonialsData',))->withTitle('Ekaa Vastra');
    }
    // ============================= END INDEX ============================ 
    // ============================= START ALL PRODUCTS ============================ 
    public function collection(Request $req, $encodeSub)
    {
        $originalName = urldecode(str_replace('-', '+', $encodeSub));
        $subcategoryData = SubCategoryModal::where(['is_active' => 1, 'name' => $originalName])->first();
        $title = $subcategoryData->name . ' - Ekaa Vastra';
        $productData = ProductModal::where(['is_active' => 1, 'subcategory_id' => $subcategoryData->id])->paginate(10);
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
        $title = $productData->seo_title ? $productData->seo_title : $productData->name . ' - Ekaa Vastra';
        $seo_description = $productData->seo_description;
        $seo_keywords = $productData->seo_keywords;
        return view('frontend/product_details', compact('productData', 'relatedData', 'title', 'cartInfo','seo_description','seo_keywords'));
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
    // ============================= START MY ACCOUNT ============================ 
    public function myAccount(Request $req)
    {
        $user_id = Auth::id();
        $orders = Order1Modal::where(['user_id' => $user_id, 'payment_status' => 1])->orderBy('id', 'desc')->get();

        return view('frontend.my_account', compact('orders'));
    }
    // ============================= END MY ACCOUNT ============================ 
    // ============================= START ORDER DETAIL ============================ 
    public function orderDetail(Request $req, $id)
    {
        $user_id = Auth::id();
        $user = User::where(['id' => $user_id])->first();
        $ordersDetail = Order1Modal::where(['id' => base64_decode($id)])->first();
        if (empty($ordersDetail)) {
            return redirect('/')->with('status-error', 'Something Went Wrong');
        }
        $orderAddress = UserAddressModal::where('id', $ordersDetail->address_id)->first();

        return view('frontend.order_detail', compact('ordersDetail', 'orderAddress'));
    }
    // ============================= END MY ACCOUNT ============================ 
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
    // ============================= START SEARCH PRODUCT ============================ 
    public function searchProduct(Request $request)
    {
        $query = $request->input('search');

        // Query products by name (case-insensitive search)
        $productData = ProductModal::where('name', 'LIKE', '%' . $query . '%')->where('is_active', 1)->paginate(10);

        $title = 'Search - ' . $query;
        return view('frontend/search_products', compact('productData', 'title'));
    }
    // ============================= END SEARCH PRODUCT ============================ 
    public function OrderInvoice(Request $req)
    {

        $foreachData = [
            [
                'gst_percentage' => 5,
                'quantity' => 1,
                'price' => 999,
                'product' => [
                    'name' => 'Forest Green Abstract Print Co-ord Set',
                    'sku' => 'EV132',
                ],
                'type' => [
                    'name' => 'M',
                ]
            ],
        ];
        $total = 999 + 999;
        $shipping = 0;
        $discount = 0;
        $final = ($total - $discount) + $shipping;
        $OrderData = [
            'id' => 22,
            'invoice_no' => '22/EV/24-25',
            'payment_mode' => 'Prepaid',
            'shipping' => $shipping,
            'discount' => $discount,
            'total_amount' => $total,
            'final_amount' => $final,
            'address' => [
                'name' => 'Sumita Kanwar',
                'phone' => '7357813114',
                'email' => 'sumitashekhawat255@gmail.com',
                'address' => 'Flat 307, Sunshine Aditya, Maharana Pratap Marg, Near Teoler High School, Jaipur, Rajasthan 302012',
            ],
            'created_at' => '7-Aug-2024',
        ];
        $enOr =  json_encode($OrderData);
        $OrderData = json_decode($enOr);
        $enFor =  json_encode($foreachData);
        $foreachData = json_decode($enFor);
        return view('admin/order/invoice', compact(['OrderData', 'foreachData']));
    }
}
