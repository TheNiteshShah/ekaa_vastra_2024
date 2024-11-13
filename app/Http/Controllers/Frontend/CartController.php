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
    // ============================= START VIEW CART ============================ 
    public function index(Request $req)
    {
        if (!Auth::check()) {
            $cartItems = Session::get('cart_data', []);
        } else {
            $user_id = Auth::id();
            $cartItems = CartModal::where(['user_id' => $user_id])->get();
        }

        return view('frontend/cart', compact('cartItems'))->withTitle('My Cart');
    }
    // ============================= END VIEW CART ============================ 
    // ============================= START ADD TO CART  ============================ 
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
    // ============================= END ADD TO CART  ============================ 
    // ============================= START ADD TO CART OFFLINE ============================ 
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
            'quantity' => $quantity,
            'ip' => $ip,
            'date' => $cur_date
        ];
        $cart_data = Session::get('cart_data', []);

        foreach ($cart_data as $item) {
            if ($item['product_id'] == $product_id) {
                return [
                    'status' => false,
                    'message' => 'Item is already in your cart'
                ];
            }
        }

        $cart_data[] = $cart_item;
        Session::put('cart_data', $cart_data);
        session()->flash('status-success', 'Item successfully added in your cart');
        return [
            'status' => true,
            'message' => 'Item successfully added in your cart'
        ];
    }
    // ============================= END ADD TO CART OFFLINE ============================ 
    // ============================= START ADD TO CART ONLINE ============================ 
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
        $cartInfo = CartModal::where(['user_id' => $user_id, 'product_id' => $product_id])->first();

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
            session()->flash('status-success', 'Item successfully added in your cart');
            return [
                'status' => true,
                'message' => 'Item successfully added to your cart'
            ];
        } else {
            session()->flash('status-error', 'Some error occurred');
            return [
                'status' => false,
                'message' => 'Some error occurred'
            ];
        }
    }
    // ============================= END ADD TO CART ONLINE ============================ 
    // ============================= START REMOVE FROM CART  ============================ 
    public function removeFromCart(Request $request)
    {
        $request->validate([
            'type_id' => 'required|integer',
        ]);
        $type_id = $request->input('type_id');

        if (Auth::check()) {
            $response = $this->RemoveCartOnline($type_id);
        } else {
            $response = $this->RemoveCartOffline($type_id);
        }
        if ($response['status']) {
            return redirect()->back()->with('status-success', $response['message']);
        } else {
            return redirect()->back()->with('status-error', $response['message']);
        }
        // return response()->json($response);
    }
    // ============================= END REMOVE FROM CART  ============================ 
    // ============================= START REMOVE FROM CART OFFLINE ============================ 
    public function RemoveCartOffline($type_id)
    {
        $cart_data = Session::get('cart_data', []);
        $deleteIndex = '-1';
        foreach ($cart_data as $index => $item) {
            if ($item['type_id'] == $type_id) {
                $deleteIndex = $index;
            }
        }
        if ($deleteIndex > -1) {
            unset($cart_data[$deleteIndex]);
            $cart = array_values($cart_data);
            Session::put('cart_data', $cart);
            return [
                'status' => true,
                'message' => 'Item successfully removed from your cart'
            ];
        } else {
            return [
                'status' => false,
                'message' => 'Some error occurred'
            ];
        }
    }
    // ============================= END REMOVE FROM CART OFFLINE ============================ 
    // ============================= START REMOVE FROM CART ONLINE ============================ 
    public function RemoveCartOnline($type_id)
    {
        if (!Auth::check()) {
            return [
                'status' => false,
                'message' => 'Cart data not found'
            ];
        }
        $user_id = Auth::id();
        $cartInfo = CartModal::where(['user_id' => $user_id, 'type_id' => $type_id])->first();
        $cartInfo->delete();
        return [
            'status' => true,
            'message' => 'Item successfully removed from your cart'
        ];
    }
    // ============================= END REMOVE FROM CART ONLINE ============================ 
    // ============================= START UPDATE CART  ============================ 
    public function updateCart(Request $request)
    {
        $request->validate([
            'activeTypeId' => 'required|integer',
            'CartTypeId' => 'required|integer',
            'activeQty' => 'required|integer',
        ]);
        $activeTypeId = $request->input('activeTypeId');
        $CartTypeId = $request->input('CartTypeId');
        $activeQty = $request->input('activeQty');

        if (Auth::check()) {
            $response = $this->UpdateCartOnline($activeTypeId, $CartTypeId, $activeQty);
        } else {
            $response = $this->UpdateCartOffline($activeTypeId, $CartTypeId, $activeQty);
        }

        if ($response['status']) {
            return redirect()->back()->with('status-success', $response['message']);
        } else {
            return redirect()->back()->with('status-error', $response['message']);
        }
    }
    // ============================= END UPDATE CART  ============================ 
    // ============================= START UPDATE CART OFFLINE ============================ 
    public function UpdateCartOffline($activeTypeId, $CartTypeId, $activeQty)
    {
        $type_data = TypeModal::where(['id' => $activeTypeId, 'is_active' => 1])->first();
        if (!$type_data || $type_data->inventory < $activeQty) {
            return [
                'status' => false,
                'message' => 'Product is out of stock'
            ];
        }

        $cart_data = Session::get('cart_data', []);
        $updateIndex = '-1';
        foreach ($cart_data as $index => $item) {
            if ($item['type_id'] == $CartTypeId) {
                $updateIndex = $index;
            }
        }
        if ($updateIndex > -1) {
            $cart_data[$updateIndex]['type_id'] = $activeTypeId;
            $cart_data[$updateIndex]['quantity'] = $activeQty;
            $cart = array_values($cart_data);
            Session::put('cart_data', $cart);
            return [
                'status' => true,
                'message' => 'Item successfully updated in your cart'
            ];
        } else {
            return [
                'status' => false,
                'message' => 'Some error occurred'
            ];
        }
    }
    // ============================= END UPDATE CART OFFLINE ============================ 
    // ============================= START UPDATE CART ONLINE ============================ 
    public function UpdateCartOnline($activeTypeId, $CartTypeId, $activeQty)
    {
        if (!Auth::check()) {
            return [
                'status' => false,
                'message' => 'Cart data not found'
            ];
        }

        $user_id = Auth::id();
        $type_data = TypeModal::where(['id' => $activeTypeId, 'is_active' => 1])->first();
        if (!$type_data || $type_data->inventory < $activeQty) {
            return [
                'status' => false,
                'message' => 'Product is out of stock'
            ];
        }
        $cartInfo = CartModal::where(['user_id' => $user_id, 'type_id' => $CartTypeId])->first();

        $cartInfo->type_id = $activeTypeId;
        $cartInfo->quantity = $activeQty;
        $cartInfo->save();
        if ($cartInfo) {
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
    // ============================= END UPDATE CART ONLINE ============================ 
}
