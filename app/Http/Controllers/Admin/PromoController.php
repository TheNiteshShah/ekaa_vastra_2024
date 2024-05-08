<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PromoModal;

class PromoController extends Controller
{
    public function index(Request $req)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $foreachData = PromoModal::wherenull('deleted_at')->latest()->get();
            $title =  "Promo";
            return view('admin/promo.index', compact('foreachData', 'title'));
        } else {
            return view('admin/login/index');
        }
    }
    public function create(Request $req)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $data = new PromoModal();
            $title =  "Add Promo";
            return view('admin/promo.create', compact('data', 'title'));
        } else {
            return view('admin/login/index');
        }
    }
    public function store(Request $req)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $this->validate($req, [
                'name' => $req->id === null ? 'required' : 'required',
                'type' => $req->id === null ? 'required' : 'required',
                'discount' => $req->id === null ? 'required' : 'required',
                'discount_type' => $req->id === null ? 'required' : 'required',
                'max_discount' => $req->id === null ? '' : '',
                'mini_amount' => $req->id === null ? 'required' : 'required',
                'expiry_date' => $req->id === null ? 'required' : 'required',
            ]);
            if ($req->id === null) {
                $uploadData = new PromoModal();
            } else {
                $uploadData = PromoModal::where('id', $req->id)->first();
            }
            $userId = $req->session()->get('admin_id');
            $uploadData->name = ucwords($req->name);
            $uploadData->type = $req->type;
            $uploadData->discount = $req->discount;
            $uploadData->discount_type = $req->discount_type;
            $uploadData->max_discount = $req->discount_type==1?$req->max_discount:null;
            $uploadData->mini_amount = $req->mini_amount;
            $uploadData->expiry_date = $req->expiry_date;
            $uploadData->ip = $req->ip();
            $uploadData->added_by = $userId;
            $uploadData->save();
            if ($uploadData) {
                if ($req->id === null) {
                    return redirect()->route('promo.index')->with('success', 'Promo Added Successfully!');
                } else {
                    return redirect()->route('promo.index')->with('success', 'Promo Updated Successfully');
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
            $data = PromoModal::where('id', $id)->first();
            $title =  "Promo";
            return view('admin/promo.create', compact('data', 'title'));
        } else {
            return view('admin/login/index');
        }
    }

    public function destroy(Request $req, $idd)
    {
        if (!empty($req->session()->has('admin_data'))) {
            if ($req->session()->get('position') == "Super Admin") {
                $id = base64_decode($idd);
                $promos = PromoModal::findOrFail($id);
                $promos->delete();
                return redirect()->route('promo.index')->with('success', 'Promo deleted Successfully!');
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
                $promo = PromoModal::findOrFail($id);
                $promo->is_active = !$promo->is_active;
                $promo->save();
                return redirect()->route('promo.index')->with('success', 'Status updated Successfully!');
            } else {
                return redirect()->back()->with('error', 'Sorry you dont have Permission to delete admin, Only Super admin can change status');
            }
        } else {
            return view('admin/login/index');
        }
    }
}
