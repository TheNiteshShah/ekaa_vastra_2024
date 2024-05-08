<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Redirect;
use Laravel\Sanctum\PersonalAccessToken;
use DateTime;
use App\Models\CategoryModal;
use App\Models\SliderModal;
use App\Models\ProductModal;


class HomeController extends Controller
{
    // ============================= START INDEX ============================ 
    public function index(Request $req)
    {
        $sliderData = SliderModal::where('is_active',1)->get();
        $trendingData = ProductModal::where(['is_active'=>1,'is_trending'=>1])->get();
        $topData = ProductModal::where(['is_active'=>1,'is_top'=>1])->get();
        return view('frontend/index',compact('sliderData','trendingData','topData'))->withTitle('Ekaa Vastra');
    }
    // ============================= END INDEX ============================ 
    // ============================= START ALL PRODUCTS ============================ 
    public function a(Request $req)
    {
        $sliderData = SliderModal::where('is_active',1)->get();
        $trendingData = ProductModal::where(['is_active'=>1,'is_trending'=>1])->get();
        $topData = ProductModal::where(['is_active'=>1,'is_top'=>1])->get();
        return view('frontend/index',compact('sliderData','trendingData','topData'))->withTitle('Ekaa Vastra');
    }
    
}
