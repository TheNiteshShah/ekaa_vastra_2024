<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserModal;
use App\Models\CartModal;

class UserController extends Controller
{
    public function index(Request $req)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $foreachData = UserModal::wherenull('deleted_at')->latest()->get();
            $title =  "Users";
            return view('admin/user.index', compact('foreachData', 'title'));
        } else {
            return view('admin/login/index');
        }
    }
    public function create(Request $req)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $data = new UserModal();
            $title =  "Add Users";
            return view('admin/user.create', compact('data', 'title'));
        } else {
            return view('admin/login/index');
        }
    }
    public function store(Request $req)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $this->validate($req, [
                'name' => $req->id === null ? 'required' : 'required',
                'phone' => $req->id === null ? 'required' : 'required',
                'email' => $req->id === null ? 'required|unique:users|email' : 'required',
                'password' => $req->id === null ? 'required' : '',
                'address' => $req->id === null ? 'required' : '',
            ]);
            if ($req->id === null) {
                $uploadData = new UserModal();
            } else {
                $uploadData = UserModal::where('id', $req->id)->first();
            }
            $userId = $req->session()->get('admin_id');
            $uploadData->name = ucwords($req->name);
            $uploadData->phone = $req->phone;
            $uploadData->email = $req->email;
            $uploadData->address = $req->address;
            if (!empty($req->password)) {
                $uploadData->password = md5($req->password);
            }
            $uploadData->ip = $req->ip();
            $uploadData->added_by = $userId;
            $uploadData->save();
            if ($uploadData) {
                if ($req->id === null) {
                    return redirect()->route('users.index')->with('success', 'User Added Successfully!');
                } else {
                    return redirect()->route('users.index')->with('success', 'User Updated Successfully');
                }
            } else {
                return redirect()->back()->with('error', 'Something Went Wrong');
            }
        } else {
            return view('admin/login/index');
        }
    }
    public function edit(Request $req, $idd)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $id = base64_decode($idd);
            $data = UserModal::where('id', $id)->first();
            $title =  "Users";
            return view('admin/user.create', compact('data', 'title'));
        } else {
            return view('admin/login/index');
        }
    }

    public function destroy(Request $req, $idd)
    {
        if (!empty($req->session()->has('admin_data'))) {
            if ($req->session()->get('position') == "Super Admin") {
                $id = base64_decode($idd);
                $users = UserModal::findOrFail($id);
                $users->delete();
                return redirect()->route('users.index')->with('success', 'User deleted Successfully!');
            } else {
                return redirect()->back()->with('error', 'Sorry you dont have Permission to delete admin, Only Super admin can change status');
            }
        } else {
            return view('admin/login/index');
        }
    }
    public function show(Request $req, $idd)
    {
        if (!empty($req->session()->has('admin_data'))) {
            if ($req->session()->get('position') == "Super Admin") {
                $id = base64_decode($idd);
                $users = UserModal::findOrFail($id);
                $users->is_active = !$users->is_active;
                $users->save();
                return redirect()->route('users.index')->with('success', 'Status updated Successfully!');
            } else {
                return redirect()->back()->with('error', 'Sorry you dont have Permission to delete admin, Only Super admin can change status');
            }
        } else {
            return view('admin/login/index');
        }
    }
    public function userCart(Request $req, $idd)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $id = base64_decode($idd);
            $UserData = UserModal::where('id', $id)->first();
            $foreachData = CartModal::where('user_id', $id)->get();
            $title =  $UserData->name . " Cart";
            return view('admin/user.cart', compact('foreachData', 'title'));
        } else {
            return view('admin/login/index');
        }
    }
}
