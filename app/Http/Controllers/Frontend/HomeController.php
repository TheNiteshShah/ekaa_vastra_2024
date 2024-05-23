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
        $productData = ProductModal::where(['is_active' => 1, 'subcategory_id' => $subcategoryData->id])->paginate(10);;
        return view('frontend/all_products', compact('subcategoryData', 'productData'))->withTitle($subcategoryData->name . ' Ekaa Vastra');
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
        return view('frontend/product_details', compact('productData','relatedData'))->withTitle(' Ekaa Vastra');
    }
    // ============================= END PRODUCTS DETAILS ============================ 

}
