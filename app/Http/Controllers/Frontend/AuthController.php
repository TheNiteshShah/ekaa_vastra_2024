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
use App\Services\EmailService;
use Log;


class AuthController extends Controller
{
    protected $EmailService;

    public function __construct(EmailService $EmailService)
    {
        $this->EmailService = $EmailService;
    }
    public function login(Request $request)
    {
        // Get email from the request
        $email = $request->input('email');
        $isResend = $request->input('resend', false); // Check if it's a resend request

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return response()->json(['success' => false, 'message' => 'Invalid email address']);
        }

        // Find or create the user using email
        $user = User::firstOrCreate(['email' => $email]);

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found']);
        }

        // Generate a random 6-digit OTP
        $otp = rand(100000, 999999);

        // Store OTP for verification (optional, but usually required)
        session(['otp' => $otp]);

        // Log the email and OTP for debugging (DO NOT use this in production)


        // Call the service method to send the OTP and check if it's sent successfully
        $emailSent = $this->EmailService->sendEmail($email, $otp, 'login');

        // Check if the email was sent successfully
        if (!$emailSent) {
            return response()->json(['success' => false, 'message' => 'Failed to send OTP email']);
        }
        Log::info("OTP {$otp} sent to email: {$email} for login successfully.");
        // Return a success response
        $message = $isResend ? 'OTP resent successfully.' : 'OTP sent successfully.';

        return response()->json(['success' => true, 'message' => $message]);
    }
    // ============================= END LOGIN ============================ 
    public function otpVerify(Request $request)
    {
        // Get OTP entered by the user
        $otpEntered = $request->input('otp');
        $email = $request->input('email');

        // Check if the OTP matches the one stored in the session
        if ($otpEntered != session('otp')) {
            return response()->json(['success' => false, 'message' => 'Invalid OTP']);
        }

        // Find the user by email
        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found']);
        }
        // User ID and IP address
        $user_id = $user->id;
        $ip = request()->ip();
        // Handle cart data if it exists in the session
        $cart_data = Session::get('cart_data', []);
        if ($cart_data) {
            foreach ($cart_data as $item) {
                $type_data = TypeModal::where(['id' => $item['type_id'], 'is_active' => 1])->first();
                if (!$type_data || $type_data->inventory < $item['quantity']) {
                    continue;
                }
                $cartInfo = CartModal::where(['user_id' => $user_id, 'type_id' => $item['type_id']])->first();
                if (empty($cartInfo)) {
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

        // Log the user in (but don't verify OTP yet)
        Session::forget('cart_data');

        // Log the user in
        Auth::login($user);

        // Clear the OTP from session after successful verification
        session()->forget('otp');

        // Return a success response
        return response()->json(['success' => true, 'message' => 'Login Successfully']);
    }

    // ============================= START SIGNUP ============================ 
    public function signup(Request $request)
    {
        $signupName = $request->input('signupName');
        $signupPhone = $request->input('signupPhone');
        $user_id = Auth::id();
        $ip = request()->ip();
        $userData = User::where('id', $user_id)->first();
        $userData->name = $signupName;
        $userData->phone = $signupPhone;
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
