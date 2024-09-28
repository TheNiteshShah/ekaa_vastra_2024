<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
//============== FRONTEND CONTROLLERS =================
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\UserOrderController;
use App\Http\Controllers\Frontend\AddressController;
//============== BACKEND CONTROLLERS =================
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
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
use App\Http\Controllers\Admin\RkVendorProductController;
use App\Http\Controllers\Admin\RkVendorOrderController;
use App\Http\Controllers\Admin\EvVendorController;
use App\Http\Controllers\Admin\FabricController;

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
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/user-signup', [AuthController::class, 'signup'])->name('user-signup')->middleware('auth');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/collection/{id}', [HomeController::class, 'collection'])->name('collection');
    Route::get('/product/{id}', [HomeController::class, 'product'])->name('product');
    Route::get('/contact-us', [HomeController::class, 'contactUs'])->name('contact-us');
    Route::post('/contact-us-store', [HomeController::class, 'contactUsStore'])->name('contact-us-store');
    Route::get('/about-us', [HomeController::class, 'aboutUs'])->name('about-us');
    Route::get('/return-refund-policy', [HomeController::class, 'refundPolicy'])->name('return-refund-policy');
    Route::get('/terms-and-conditions', [HomeController::class, 'termsAndConditions'])->name('terms-and-conditions');
    Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy-policy');
    Route::get('/shipping-policy', [HomeController::class, 'shippingPolicy'])->name('shipping-policy');
    Route::get('/order-bill', [HomeController::class, 'OrderInvoice'])->name('order-bill');
    Route::get('/my-account', [HomeController::class, 'myAccount'])->name('my-account')->middleware('auth');
    Route::get('/order-detail/{id}', [HomeController::class, 'orderDetail'])->name('order-detail')->middleware('auth');

    //------------ CART ----------------
    Route::get('/cart', [CartController::class, 'index'])->name('cart');;
    Route::post('/add-to-cart', [CartController::class, 'addToCart']);
    Route::post('/remove-from-cart', [CartController::class, 'removeFromCart'])->name('removeFromCart');
    Route::get('/get-sizes/{id}', [TypeController::class, 'getSizes'])->name('getSizes');
    Route::get('/get-qty/{id}', [TypeController::class, 'getQty'])->name('getQty');
    Route::post('/update-cart', [CartController::class, 'updateCart'])->name('updateCart');
    //------------ Order ----------------
    Route::get('/checkout', [UserOrderController::class, 'index'])->name('checkout')->middleware('auth');
    Route::get('/get-shipping-charges/{id}', [UserOrderController::class, 'getShippingCharges'])->name('getShippingCharges')->middleware('auth');
    Route::post('/checkout-process', [UserOrderController::class, 'checkout'])->name('checkout-process')->middleware('auth');
    Route::get('/order-success/{order_id}', [UserOrderController::class, 'showOrderSuccess'])->name('order.success');
    Route::get('/checkMail', [UserOrderController::class, 'checkMail'])->name('checkMail');
    //------------ ADDRESS ----------------
    Route::get('fetch-pin-data/{pincode}', [AddressController::class, 'fetchPincodeData']);
    Route::post('add-address', [AddressController::class, 'addAddress'])->name('addAddress')->middleware('auth');
    Route::post('edit-address', [AddressController::class, 'editAddress'])->name('editAddress')->middleware('auth');
    Route::post('change-default-address', [AddressController::class, 'changeDefaultAddress'])->name('changeDefaultAddress')->middleware('auth');
    Route::get('get-address/{id}', [AddressController::class, 'getAddressById']);
});

//=========================================== ADMIN =====================================================

Route::get('/admin_login', [LoginController::class, 'admin_login'])->name('admin_login');
Route::get('/admin_index', [TeamController::class, 'admin_index'])->name('admin_index');
Route::post('/admin_login_process', [LoginController::class, 'admin_login_process'])->name('admin_login_process');
Route::get('/admin_logout', [LoginController::class, 'admin_logout'])->name('admin_logout');
Route::get('/admin_profile', [LoginController::class, 'admin_profile'])->name('admin_profile');
Route::get('/view_change_password', [LoginController::class, 'admin_change_pass_view'])->name('view_change_password');
Route::post('/admin_change_password', [LoginController::class, 'admin_change_password'])->name('admin_change_password');

//------ Admin Team ----------
Route::get('/add_team_view', [TeamController::class, 'add_team_view'])->name('add_team_view');
Route::get('/view_team', [TeamController::class, 'view_team'])->name('view_team');
Route::post('/add_team_process', [TeamController::class, 'add_team_process'])->name('add_team_process');
Route::get('/UpdateTeamStatus/{status}/{id}', [TeamController::class, 'UpdateTeamStatus'])->name('UpdateTeamStatus');
Route::get('/deleteTeam/{id}', [TeamController::class, 'deleteTeam'])->name('deleteTeam');
//-------- NEW -----------
Route::resource('/sliders', SliderController::class);
Route::resource('/banners', BannerController::class);
Route::resource('/popup', PopUpController::class);
Route::resource('/users', UserController::class);
Route::resource('/testimonial', TestimonialController::class);
Route::resource('/promo', PromoController::class);
Route::resource('/master_type', MasterTypeController::class);
Route::get('/user_cart/{id}', [UserController::class, 'userCart'])->name('user_cart');
Route::resource('/category', CategoryController::class);
Route::get('/contact_enquiry', [ContactUsController::class, 'index'])->name('contact_enquiry');
Route::get('/popup_enquiry', [PopUpEnquiryController::class, 'index'])->name('popup_enquiry');
//------ Subcategory ----------
Route::resource('/subcategory', SubCategoryController::class);
//------ products ----------
Route::get('/products/{id}', [ProductController::class, 'index'])->name('products.index');
Route::get('/products-create/{id}', [ProductController::class, 'create'])->name('products.create');
Route::post('/products-store', [ProductController::class, 'store'])->name('products.store');
Route::get('/products-show/{id}', [ProductController::class, 'show'])->name('products.show');
Route::get('/products-edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
Route::delete('/products-destroy/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::get('/products-img_remove/{id}/{id2}', [ProductController::class, 'img_remove'])->name('products.img_remove');
//------ master_attributes ----------
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
//---------- ev vendor ---------
Route::resource('/ev_vendor', EvVendorController::class);
Route::resource('/fabric', FabricController::class);
Route::get('/show-txn/{id}', [FabricController::class, 'showTxn'])->name('show-txn');

//---------- rk vendor ---------
Route::resource('/rk_vendor', RkVendorController::class);
//---------- rk Products ---------
Route::get('/rk-vendor-product/{id}', [RkVendorProductController::class, 'index'])->name('rk-vendor-product.index');
Route::get('/rk-vendor-product-create/{id}', [RkVendorProductController::class, 'create'])->name('rk-vendor-product.create');
Route::post('/rk-vendor-product', [RkVendorProductController::class, 'store'])->name('rk-vendor-product.store');
Route::get('/rk-vendor-product-edit/{id}', [RkVendorProductController::class, 'edit'])->name('rk-vendor-product.edit');
Route::get('/rk-vendor-product-show/{id}', [RkVendorProductController::class, 'show'])->name('rk-vendor-product.show');
//---------- rk orders ---------
Route::get('/rk-vendor-order/{id}', [RkVendorOrderController::class, 'index'])->name('rk-vendor-order.index');
Route::get('/rk-vendor-order-create/{id}', [RkVendorOrderController::class, 'create'])->name('rk-vendor-order.create');
Route::post('/rk-vendor-order', [RkVendorOrderController::class, 'store'])->name('rk-vendor-order.store');
Route::get('/rk-vendor-order-edit/{id}', [RkVendorOrderController::class, 'edit'])->name('rk-vendor-order.edit');
Route::get('/rk-vendor-order-show/{id}', [RkVendorOrderController::class, 'show'])->name('rk-vendor-order.show');
Route::get('/rk-vendor-order-print/{id}', [RkVendorOrderController::class, 'print'])->name('rk-vendor-order.print');
