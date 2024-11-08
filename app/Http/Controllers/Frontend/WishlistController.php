<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\WishListModal;
use App\Models\TypeModal;
use App\Models\CartModal;
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
        $wishlistData = $wishlistItems->map(function ($item) {
            return [
                'id' => $item->id,
                'product_id' => $item->product->id,
                'type_id' => $item->type ? $item->type->id : null, // Adjust if type may be null
                'product_name' => $item->product->name,
                'product_image' => asset($item->product->image),
                'product_url' => route('product', strtolower(str_replace('+', '-', urlencode($item->product->name)))),
                'product_mrp' => $item->product->mrp,
                'product_selling_price' => $item->product->selling_price,
            ];
        });

        $wishlistCount = $wishlistItems->count();

        return response()->json([
            'status' => isset($wishlistItem) ? 'removed' : 'added',
            'message' => $message,
            'wishlistCount' => $wishlistCount,
            'wishlistItems' => $wishlistData,
        ]);
    }
    // ============================= END WISHLIST TOGGLE ============================
    // ============================= START MOVE TO CART ============================ 
    public function moveToCart(Request $request)
    {
        if (!Auth::check()) {
            return [
                'status' => false,
                'message' => 'Wishlist data not found'
            ];
        }
        $request->validate([
            'ProductId' => 'required|integer',
            'TypeId' => 'required|integer',
        ]);
        $ProductId = $request->input('ProductId');
        $TypeId = $request->input('TypeId');
        $user_id = Auth::id();
        $type_data = TypeModal::where(['id' => $TypeId, 'is_active' => 1])->first();
        if (!$type_data || $type_data->inventory < 1) {
            return [
                'status' => false,
                'message' => 'Product is out of stock'
            ];
        }
        $cartInfo = CartModal::where(['user_id' => $user_id, 'type_id' => $TypeId])->first();
        if (empty($cartInfo)) {
            //---- Add in cart -------
            $cartInfo = CartModal::create([
                'user_id' => $user_id,
                'product_id' => $ProductId,
                'type_id' => $TypeId,
                'quantity' => 1,
                'ip' => $request->ip(),
            ]);
        }
        //---- Remove from wishlist -------
        $wishlistItem = WishListModal::where(['user_id' => $user_id, 'product_id' => $ProductId])->first();
        if ($wishlistItem) {
            $wishlistItem->delete();
        }

        if ($cartInfo) {
            return redirect()->back()->with('status-success', 'Item successfully move to your cart');
        } else {
            return redirect()->back()->with('error-success', 'Item successfully move to your cart');

        }
    }
    // ============================= END MOVE TO CART ============================ 

}
