<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\CategoryModal; // Adjust namespaces as per your application
use App\Models\CartModal;
use App\Models\WishListModal;
use Illuminate\Support\Facades\Session;

class DataComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Retrieve category data
        View::composer('*', function ($view) {
        });

        // Retrieve cart and wishlist data
        View::composer('*', function ($view) {
            $categories = CategoryModal::orderBy('seq', 'asc')
                ->where('is_active', 1)
                ->get();


            // Cart data
            if (auth()->check()) {
                $userId = auth()->id();
                $cartItems = CartModal::where('user_id', $userId)->get();
                $wishlistItems = WishListModal::where('user_id', $userId)->get();
                $cartCount = $cartItems->count();
                $wishlistCount = $wishlistItems->count();
                $wishlistProductIds = WishListModal::where('user_id', auth()->id())
                    ->pluck('product_id')
                    ->toArray();
            } else {
                $cartItems = Session::get('cart_data', []);
                $cartCount = count($cartItems);
                $wishlistItems = [];
                $wishlistCount = 0;
                $wishlistProductIds = [];
            }

            $view->with([
                'categoryData' => $categories,
                'cartItems' => $cartItems,
                'cartCount' => $cartCount,
                'wishlistItems' => $wishlistItems,
                'wishlistCount' => $wishlistCount,
                'wishlistProductIds' => $wishlistProductIds,
            ]);
        });
    }

    public function register()
    {
        //
    }
}
