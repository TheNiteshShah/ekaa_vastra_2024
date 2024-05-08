<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\Slider2Controller;
use App\Http\Controllers\Admin\Slider3Controller;
use App\Http\Controllers\Admin\Slider4Controller;
use App\Http\Controllers\Admin\Slider5Controller;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\MinorCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\PopUpEnquiryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PopUpController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\PromoController;
use App\Http\Controllers\Admin\MasterTypeController;
use App\Http\Controllers\Admin\MasterAttributeController;
use App\Http\Controllers\Admin\RkVendorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    // $exitCode = Artisan::call('route:clear');
    // $exitCode = Artisan::call('config:clear');
    // $exitCode = Artisan::call('view:clear');
    // return what you want
});
//=========================================== FRONTEND =====================================================

Route::group(['prefix' => '/'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('/');
});

//=========================================== ADMIN =====================================================

Route::get('/admin_login', [LoginController::class, 'admin_login'])->name('admin_login');
Route::get('/admin_index', [TeamController::class, 'admin_index'])->name('admin_index');
Route::post('/admin_login_process', [LoginController::class, 'admin_login_process'])->name('admin_login_process');
Route::get('/admin_logout', [LoginController::class, 'admin_logout'])->name('admin_logout');
Route::get('/admin_profile', [LoginController::class, 'admin_profile'])->name('admin_profile');
Route::get('/view_change_password', [LoginController::class, 'admin_change_pass_view'])->name('view_change_password');
Route::post('/admin_change_password', [LoginController::class, 'admin_change_password'])->name('admin_change_password');

// Admin Team
Route::get('/add_team_view', [TeamController::class, 'add_team_view'])->name('add_team_view');
Route::get('/view_team', [TeamController::class, 'view_team'])->name('view_team');
Route::post('/add_team_process', [TeamController::class, 'add_team_process'])->name('add_team_process');
Route::get('/UpdateTeamStatus/{status}/{id}', [TeamController::class, 'UpdateTeamStatus'])->name('UpdateTeamStatus');
Route::get('/deleteTeam/{id}', [TeamController::class, 'deleteTeam'])->name('deleteTeam');
//-------- NEW -----------
Route::resource('/sliders', SliderController::class);
Route::resource('/popup', PopUpController::class);
Route::resource('/users', UserController::class);
Route::resource('/testimonial', TestimonialController::class);
Route::resource('/promo', PromoController::class);
Route::resource('/master_type', MasterTypeController::class);
Route::get('/user_cart/{id}', [UserController::class, 'userCart'])->name('user_cart');
Route::resource('/category', CategoryController::class);
Route::get('/contact_enquiry', [ContactUsController::class, 'index'])->name('contact_enquiry');
Route::get('/popup_enquiry', [PopUpEnquiryController::class, 'index'])->name('popup_enquiry');
//------ Subcategpry ----------
Route::resource('/subcategory', SubCategoryController::class);
//------ products ----------
Route::get('/products_minorcategory', [ProductController::class, 'products_minorcategory'])->name('products.minorcategory');
Route::get('/products/{id}', [ProductController::class, 'index'])->name('products.index');
Route::get('/products-create/{id}', [ProductController::class, 'create'])->name('products.create');
Route::post('/products-store', [ProductController::class, 'store'])->name('products.store');
Route::get('/products-show/{id}', [ProductController::class, 'show'])->name('products.show');
Route::get('/products-edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
Route::delete('/products-destroy/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
//------ products ----------
Route::get('/master_attributes/{id}', [MasterAttributeController::class, 'index'])->name('master_attributes.index');
Route::get('/master_attributes-create/{id}', [MasterAttributeController::class, 'create'])->name('master_attributes.create');
Route::post('/master_attributes-store', [MasterAttributeController::class, 'store'])->name('master_attributes.store');
Route::get('/master_attributes-show/{id}', [MasterAttributeController::class, 'show'])->name('master_attributes.show');
Route::get('/master_attributes-edit/{id}', [MasterAttributeController::class, 'edit'])->name('master_attributes.edit');
Route::delete('/master_attributes-destroy/{id}', [MasterAttributeController::class, 'destroy'])->name('master_attributes.destroy');
//------ review ----------
Route::get('/review/{id}', [ReviewController::class, 'index'])->name('review.index');
Route::get('/review-show/{id}', [ReviewController::class, 'show'])->name('review.show');
Route::delete('/review-destroy/{id}', [ReviewController::class, 'destroy'])->name('review.destroy');
//------ types ----------
Route::get('/types/{id}', [TypeController::class, 'index'])->name('types.index');
Route::get('/types-create/{id}', [TypeController::class, 'create'])->name('types.create');
Route::post('/types-store', [TypeController::class, 'store'])->name('types.store');
Route::get('/types-show/{id}', [TypeController::class, 'show'])->name('types.show');
Route::get('/types-edit/{id}', [TypeController::class, 'edit'])->name('types.edit');
Route::get('/types-copy/{id}', [TypeController::class, 'copy'])->name('types.copy');
Route::delete('/types-destroy/{id}', [TypeController::class, 'destroy'])->name('types.destroy');
Route::get('/types-img_remove/{id}/{id2}', [TypeController::class, 'img_remove'])->name('types.img_remove');

//---------- Orders ---------
Route::get('/new_orders', [OrderController::class, 'new_orders'])->name('new_orders');
Route::get('/accepted_orders', [OrderController::class, 'accepted_orders'])->name('accepted_orders');
Route::get('/dispatched_orders', [OrderController::class, 'dispatched_orders'])->name('dispatched_orders');
Route::get('/delivered_orders', [OrderController::class, 'delivered_orders'])->name('delivered_orders');
Route::get('/rejected_orders', [OrderController::class, 'rejected_orders'])->name('rejected_orders');
Route::get('/all_orders', [OrderController::class, 'all_orders'])->name('all_orders');
Route::get('/updateOrderStatus/{status}/{id}', [OrderController::class, 'updateOrderStatus'])->name('update-order-status');
Route::get('/orderDetails/{id}', [OrderController::class, 'orderDetails'])->name('order-details');
Route::get('/OrderInvoice/{id}', [OrderController::class, 'OrderInvoice'])->name('order-invoice');
Route::get('/update-track/{id}', [OrderController::class, 'updateTrack'])->name('update-track');
Route::post('/mark-dispatch', [OrderController::class, 'markDispatch'])->name('mark-dispatch');
//---------- rk vendor ---------
Route::resource('/rk_vendor', RkVendorController::class);

