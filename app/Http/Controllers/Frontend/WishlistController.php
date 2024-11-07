<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\WishListModal;
use Auth;
use App\Http\Controllers\Controller;

class WishlistController extends Controller
{
    // ============================= START WISHLIST TOGGLE ============================

    public function toggle(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $user = Auth::user();
        $productId = $request->input('product_id');

        $wishlistItem = WishListModal::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->first();

        if ($wishlistItem) {
            $wishlistItem->delete();
            $message = 'Product removed from wishlist';
        } else {
            WishListModal::create([
                'user_id' => $user->id,
                'product_id' => $productId,
                'ip' => $request->ip(),
            ]);
            $message = 'Product added to wishlist';
        }

        $wishlistItems = WishListModal::where('user_id', $user->id)->with('product')->get();
        $wishlistCount = $wishlistItems->count();

        return response()->json([
            'status' => isset($wishlistItem) ? 'removed' : 'added',
            'message' => $message,
            'wishlistCount' => $wishlistCount,
            'wishlistItems' => $wishlistItems,
        ]);
    }
    // ============================= END WISHLIST TOGGLE ============================

}
