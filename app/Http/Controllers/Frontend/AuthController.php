<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\User;


class AuthController extends Controller
{
    // ============================= START LOGIN ============================ 
    public function login(Request $request)
    {
        $phone = $request->input('phone');
        $uid = $request->input('token');
        $user = User::firstOrCreate(['firebase_id' => $uid, 'phone' => $phone]);
        // Log the user in
        Auth::login($user);
        return response()->json(['success' => true]);
    }
    // ============================= END LOGIN ============================ 
    // ============================= START LOGOUT ============================ 
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
    // ============================= END LOGOUT ============================ 

}
