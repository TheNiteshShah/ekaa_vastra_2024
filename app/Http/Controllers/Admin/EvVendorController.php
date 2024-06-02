<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EvVendorModal;
use App\Models\CityModal;

class EvVendorController extends Controller
{
    public function index(Request $req)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $foreachData = EvVendorModal::wherenull('deleted_at')->latest()->get();
            $title =  "EV Vendor";
            return view('admin/ev_vendor.index', compact('foreachData', 'title'));
        } else {
            return view('admin/login/index');
        }
    }
    public function create(Request $req)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $CityData = CityModal::get();
            $data = new EvVendorModal();
            $title =  "Add EV Vendor";
            return view('admin/ev_vendor.create', compact('data', 'title', 'CityData'));
        } else {
            return view('admin/login/index');
        }
    }
    public function store(Request $req)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $this->validate($req, [
                'name' => $req->id === null ? 'required' : 'required',
                'business_name' => $req->id === null ? 'required' : 'required',
                'gst' => $req->id === null ? '' : '',
                'address' => $req->id === null ? 'required' : 'required',
                'phone' => $req->id === null ? 'required' : 'required',
                'city_id' => $req->id === null ? 'required' : 'required',
                'pin_code' => $req->id === null ? 'required' : 'required',
            ]);
            if ($req->id === null) {
                $uploadData = new EvVendorModal();
            } else {
                $uploadData = EvVendorModal::where('id', $req->id)->first();
            }
            $cityData = CityModal::where('id', $req->city_id)->first();

            $userId = $req->session()->get('admin_id');
            $uploadData->name = ucwords($req->name);
            $uploadData->business_name = $req->business_name;
            $uploadData->gst = $req->gst;
            $uploadData->address = $req->address;
            $uploadData->phone = $req->phone;
            $uploadData->city_id = $req->city_id;
            $uploadData->state_id = $cityData->state_id;
            $uploadData->pin_code = $req->pin_code;
            $uploadData->ip = $req->ip();
            $uploadData->added_by = $userId;
            $uploadData->save();
            if ($uploadData) {
                if ($req->id === null) {
                    return redirect()->route('ev_vendor.index')->with('success', 'EV Vendor Added Successfully!');
                } else {
                    return redirect()->route('ev_vendor.index')->with('success', 'EV Vendor Updated Successfully');
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
            $CityData = CityModal::get();

            $data = EvVendorModal::where('id', $id)->first();
            $title =  "EV Vendor";
            return view('admin/ev_vendor.create', compact('data', 'title','CityData'));
        } else {
            return view('admin/login/index');
        }
    }

    public function destroy(Request $req, $idd)
    {
        if (!empty($req->session()->has('admin_data'))) {
            if ($req->session()->get('position') == "Super Admin") {
                $id = base64_decode($idd);
                $ev_vendors = EvVendorModal::findOrFail($id);
                $ev_vendors->delete();
                return redirect()->route('ev_vendor.index')->with('success', 'EV Vendor deleted Successfully!');
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
                $ev_vendor = EvVendorModal::findOrFail($id);
                $ev_vendor->is_active = !$ev_vendor->is_active;
                $ev_vendor->save();
                return redirect()->route('ev_vendor.index')->with('success', 'Status updated Successfully!');
            } else {
                return redirect()->back()->with('error', 'Sorry you dont have Permission to delete admin, Only Super admin can change status');
            }
        } else {
            return view('admin/login/index');
        }
    }
}
