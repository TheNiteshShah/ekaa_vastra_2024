<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Redirect;
use Laravel\Sanctum\PersonalAccessToken;
use DateTime;
use App\Models\CategoryModal;
use App\Models\SubCategoryModal;
use App\Models\SliderModal;
use App\Models\ProductModal;
use App\Models\ContactUsModal;


class HomeController extends Controller
{
    // ============================= START INDEX ============================ 
    public function index(Request $req)
    {
        $sliderData = SliderModal::where('is_active', 1)->get();
        $trendingData = ProductModal::where(['is_active' => 1, 'is_trending' => 1])->get();
        $topData = ProductModal::where(['is_active' => 1, 'is_top' => 1])->get();
        return view('frontend/index', compact('sliderData', 'trendingData', 'topData'))->withTitle('Ekaa Vastra');
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
        $relatedData = ProductModal::where('is_active', 1)
            ->where('subcategory_id', $productData->subcategory_id)
            ->where('id', '!=', $productData->id)
            ->limit(10)
            ->get();
        $title = $productData->name . ' - Ekaa Vastra';
        return view('frontend/product_details', compact('productData', 'relatedData','title'));
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
    // ============================= START CONTACT US STORE ============================ 
    public function contactUsStore(Request $req)
    {
        $this->validate($req, [
            'customerName' =>  'required',
            'customerEmail' =>  'required',
            'customerPhone' =>  'required',
            'customerMessage' => 'required',
        ]);
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

}
