<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\CartModal;
use App\Models\TypeModal;


class AuthController extends Controller
{
    // ============================= START LOGIN ============================ 
    public function login(Request $request)
    {
        $phone = $request->input('phone');
        $uid = $request->input('token');
        $user = User::firstOrCreate(['firebase_id' => $uid, 'phone' => $phone]);
        $user_id = Auth::id();
        $ip = request()->ip();
        $cart_data = Session::get('cart_data', []);
        if ($cart_data) {
            foreach ($cart_data as $item) {
                $type_data = TypeModal::where(['id' => $item['type_id'], 'is_active' => 1])->first();
                if (!$type_data || $type_data->inventory < $item['quantity']) {
                    continue;
                }
                $cartInfo = CartModal::where(['user_id' => $user_id, 'type_id' => $item['type_id']])->first();
                if (!$cartInfo) {
                    $cart_insert = new CartModal();
                    $cart_insert->user_id = $user_id;
                    $cart_insert->product_id = $item['product_id'];
                    $cart_insert->type_id = $item['type_id'];
                    $cart_insert->quantity = $item['quantity'];
                    $cart_insert->ip = $ip;
                    $cart_insert->save();
                }
            }
        }
        // Log the user in
        Session::forget('cart_data');
        Auth::login($user);
        return response()->json(['success' => true]);
    }
    // ============================= END LOGIN ============================ 
    // ============================= START SIGNUP ============================ 
    public function signup(Request $request)
    {
        $signupName = $request->input('signupName');
        $signupEmail = $request->input('signupEmail');
        $user_id = Auth::id();
        $ip = request()->ip();
        $userData = User::where('id', $user_id)->first();
        $userData->name = $signupName;
        $userData->email = $signupEmail;
        $userData->ip = $ip;
        $userData->save();
        Auth::login($userData);
        return redirect()->back()->with('status-success', 'Signup successfully');
    }
    // ============================= END LOGIN ============================ 
    // ============================= START LOGOUT ============================ 
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->back()->with('status-success', 'Logout successfully');
    }
    // ============================= END LOGOUT ============================ 

}
