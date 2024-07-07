<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\UserAddressModal;
use App\Models\User;

class AddressController extends Controller
{
    // ============================= START FETCH PIN CODE ============================ 
    public function fetchPincodeData($pincode)
    {
        $response = Http::get("http://postalpincode.in/api/pincode/{$pincode}");
        return response()->json($response->json());
    }
    // ============================= END FETCH PIN CODE ============================ 
    // ============================= START ADD ADDRESS  ============================ 
    public function addAddress(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|integer',
            'address' => 'required',
            'country' => 'required',
            'pincode' => 'required|integer',
            'state' => 'required',
            'city' => 'required',
        ]);
        $user_id = Auth::id();
        $uploadData = new UserAddressModal();
        $uploadData->user_id = $user_id;
        $uploadData->first_name = $request->input('first_name');
        $uploadData->last_name = $request->input('last_name');
        $uploadData->email = $request->input('email');
        $uploadData->phone = $request->input('phone');
        $uploadData->address = $request->input('address');
        $uploadData->country = $request->input('country');
        $uploadData->pincode = $request->input('pincode');
        $uploadData->state = $request->input('state');
        $uploadData->city = $request->input('city');
        $uploadData->ip = $request->ip();
        $uploadData->save();
        if ($uploadData) {
            $userAddressCount = UserAddressModal::where('user_id', $user_id)->count();
            if (empty($userAddressCount == 0)) {
                $userData = User::where('id', $user_id)->first();
                $userData->default_address_id = $uploadData->id;
                $userData->save();
            }
            return redirect()->back()->with('status-success', 'Address successfully added!');
        } else {
            return redirect()->back()->with('status-error', 'Some error occurred!');
        }
    }
    // ============================= END ADD ADDRESS  ============================ 
    // ============================= START CHANGE DEFAULT ADDRESS  ============================ 
    public function changeDefaultAddress(Request $request)
    {
        $request->validate([
            'address_id' => 'required',
        ]);
        $user_id = Auth::id();
        $userData = User::where('id', $user_id)->first();
        $userData->default_address_id = $request->input('address_id');;
        $userData->save();
        if ($userData) {
            return redirect()->back()->with('status-success', 'Address successfully updated!');
        } else {
            return redirect()->back()->with('status-error', 'Some error occurred!');
        }
    }
    // ============================= END CHANGE DEFAULT ADDRESS  ============================ 
    // ============================= START GET ADDRESS BY ID  ============================ 
    public function getAddressById($id)
    {
        $address = UserAddressModal::find($id);
        return response()->json($address);
    }
    // ============================= END GET ADDRESS BY ID  ============================ 
    // ============================= START EDIT ADDRESS  ============================ 
    public function editAddress(Request $request)
    {
        $request->validate([
            'address_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|integer',
            'address' => 'required',
            'country' => 'required',
            'pincode' => 'required|integer',
            'state' => 'required',
            'city' => 'required',
        ]);
        $user_id = Auth::id();
        $uploadData = UserAddressModal::where(['user_id' => $user_id, 'id' => $request->input('address_id')])->first();
        $uploadData->first_name = $request->input('first_name');
        $uploadData->last_name = $request->input('last_name');
        $uploadData->email = $request->input('email');
        $uploadData->phone = $request->input('phone');
        $uploadData->address = $request->input('address');
        $uploadData->country = $request->input('country');
        $uploadData->pincode = $request->input('pincode');
        $uploadData->state = $request->input('state');
        $uploadData->city = $request->input('city');
        $uploadData->ip = $request->ip();
        $uploadData->save();
        if ($uploadData) {
            return redirect()->back()->with('status-success', 'Address successfully updated!');
        } else {
            return redirect()->back()->with('status-error', 'Some error occurred!');
        }
    }
    // ============================= END EDIT ADDRESS  ============================ 
}
