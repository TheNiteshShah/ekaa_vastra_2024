<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\TypeModal;
use App\Models\CartModal;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'type_id' => 'required|integer',
            'quantity' => 'required|integer',
        ]);
        $product_id = $request->input('product_id');
        $type_id = $request->input('type_id');
        $quantity = $request->input('quantity');

        if (Auth::check()) {
            $response = $this->AddToCartOnline($product_id, $type_id, $quantity);
        } else {
            $response = $this->AddToCartOffline($product_id, $type_id, $quantity);
        }

        return response()->json($response);
    }

    public function AddToCartOffline($product_id, $type_id, $quantity)
    {
        $ip = request()->ip();
        $cur_date = now();

        
        $type_data = TypeModal::where(['id' => $type_id, 'is_active' => 1])->first();
        if (!$type_data || $type_data->inventory < $quantity) {
            return [
                'status' => false,
                'message' => 'Product is out of stock'
            ];
        }
        
        $cart_item = [
            'product_id' => $product_id,
            'type_id' => $type_id,
            'product_name' => $type_data->product->name,
            'type_name' => $type_data->size->name,
            'quantity' => $quantity,
            'ip' => $ip,
            'date' => $cur_date
        ];
        $cart_data = Session::get('cart_data', []);

        foreach ($cart_data as $item) {
            if ($item['product_id'] == $product_id && $item['type_id'] == $type_id) {
                return [
                    'status' => false,
                    'message' => 'Item is already in your cart'
                ];
            }
        }

        $cart_data[] = $cart_item;
        Session::put('cart_data', $cart_data);

        return [
            'status' => true,
            'message' => 'Item successfully added in your cart'
        ];
    }

    public function AddToCartOnline($product_id, $type_id, $quantity)
    {
        if (!Auth::check()) {
            return [
                'status' => false,
                'message' => 'Cart data not found'
            ];
        }

        $user_id = Auth::id();
        $ip = request()->ip();
        $type_data = TypeModal::where(['id' => $type_id, 'is_active' => 1])->first();
        if (!$type_data || $type_data->inventory < $quantity) {
            return [
                'status' => false,
                'message' => 'Product is out of stock'
            ];
        }
        $cartInfo = CartModal::where(['user_id' => $user_id, 'type_id' => $type_id])->first();

        if ($cartInfo) {
            return [
                'status' => false,
                'message' => 'Item is already in your cart'
            ];
        }
        $cart_insert = new CartModal();
        $cart_insert->user_id = $user_id;
        $cart_insert->product_id = $product_id;
        $cart_insert->type_id = $type_id;
        $cart_insert->quantity = $quantity;
        $cart_insert->ip = $ip;
        $cart_insert->save();

        if ($cart_insert) {
            return [
                'status' => true,
                'message' => 'Item successfully added to your cart'
            ];
        } else {
            return [
                'status' => false,
                'message' => 'Some error occurred'
            ];
        }
    }
}
