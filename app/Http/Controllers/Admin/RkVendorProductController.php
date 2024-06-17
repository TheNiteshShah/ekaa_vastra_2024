<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RkVendorModal;
use App\Models\RkVendorProductModal;
use App\Models\CityModal;

class RkVendorProductController extends Controller
{
    public function index(Request $req, $parent_id)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $parent_id = base64_decode($parent_id);
            $parentData = RkVendorModal::where('id', $parent_id)->first();
            $foreachData = RkVendorProductModal::where('vendor_id', $parent_id)->latest()->get();
            $title =  "RK Vendor - ".$parentData->name.' Products';
            return view('admin/rk_vendor_product.index', compact('foreachData', 'title','parent_id'));
        } else {
            return view('admin/login/index');
        }
    }
    public function create(Request $req, $parent_id)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $parent_idx = base64_decode($parent_id);
            $parentData = RkVendorModal::where('id', $parent_idx)->first();
            $data = new RkVendorProductModal();
            $title =  "Add - ".$parentData->name.' Product';
            return view('admin/rk_vendor_product.create', compact('data', 'title', 'parent_id'));
        } else {
            return view('admin/login/index');
        }
    }
    public function store(Request $req)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $this->validate($req, [
                'vendor_id' => $req->id === null ? 'required' : 'required',
                'name' => $req->id === null ? 'required' : 'required',
                'unit' => $req->id === null ? 'required' : 'required',
                'price' => $req->id === null ? 'required' : 'required',
            ]);
            if ($req->id === null) {
                $uploadData = new RkVendorProductModal();
            } else {
                $uploadData = RkVendorProductModal::where('id', $req->id)->first();
            }

            $userId = $req->session()->get('admin_id');
            $uploadData->name = ucwords($req->name);
            $uploadData->vendor_id = base64_decode($req->vendor_id);
            $uploadData->unit = $req->unit;
            $uploadData->price = $req->price;
            $uploadData->ip = $req->ip();
            $uploadData->added_by = $userId;
            $uploadData->save();
            if ($uploadData) {
                if ($req->id === null) {
                    return redirect()->route('rk-vendor-product.index',$req->vendor_id)->with('success', 'RK Vendor Product Added Successfully!');
                } else {
                    return redirect()->route('rk-vendor-product.index',$req->vendor_id)->with('success', 'RK Vendor Product Updated Successfully');
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
            $data = RkVendorProductModal::where('id', $id)->first();
            $title =  "RK Vendor";
            return view('admin/rk_vendor_product.create', compact('data', 'title'));
        } else {
            return view('admin/login/index');
        }
    }

    public function destroy(Request $req, $idd)
    {
        if (!empty($req->session()->has('admin_data'))) {
            if ($req->session()->get('position') == "Super Admin") {
                $id = base64_decode($idd);
                $rk_vendor_products = RkVendorProductModal::findOrFail($id);
                $rk_vendor_products->delete();
                return redirect()->route('rk_vendor_product.index')->with('success', 'RK Vendor Product deleted Successfully!');
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
                $rk_vendor_product = RkVendorProductModal::findOrFail($id);
                $rk_vendor_product->is_active = !$rk_vendor_product->is_active;
                $rk_vendor_product->save();
                return redirect()->route('rk-vendor-product.index',base64_encode($rk_vendor_product->vendor_id))->with('success', 'Status updated Successfully!');
            } else {
                return redirect()->back()->with('error', 'Sorry you dont have Permission to delete admin, Only Super admin can change status');
            }
        } else {
            return view('admin/login/index');
        }
    }
}
