<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FabricModal;
use App\Models\EvVendorModal;
use App\Models\FabricTxnModal;

class FabricController extends Controller
{
    public function index(Request $req)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $foreachData = FabricModal::wherenull('deleted_at')->latest()->get();
            $title =  "Fabric";
            return view('admin/fabric.index', compact('foreachData', 'title'));
        } else {
            return view('admin/login/index');
        }
    }
    public function create(Request $req)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $data = new FabricModal();
            $vendors = EvVendorModal::where('is_active', 1)->get();
            $title =  "Add Fabric";
            return view('admin/fabric.create', compact('data', 'title', 'vendors'));
        } else {
            return view('admin/login/index');
        }
    }
    public function store(Request $req)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $this->validate($req, [
                'vendor_id' => $req->id === null ? 'required' : '',
                'quantity' => $req->id === null ? 'required' : 'required',
                'unit' => $req->id === null ? 'required' : '',
                'sample_price' => $req->id === null ? 'required' : '',
                'bulk_price' => $req->id === null ? 'required' : '',
                'date' => $req->id === null ? 'required' : 'required',
            ]);
            if ($req->id === null) {
                $uploadData = new FabricModal();
            } else {
                $uploadData = FabricModal::where('id', $req->id)->first();
            }
            if (!empty($req->image)) {
                $allowedFormats = ['jpeg', 'jpg', 'webp'];
                $extension = strtolower($req->image->getClientOriginalExtension());
                if (in_array($extension, $allowedFormats)) {
                    $file = time() . '.' . $req->image->extension();
                    $req->image->move(public_path('uploads/image/fabric/'), $file);
                    $image = 'uploads/image/fabric/' . $file;
                } else {
                    // Handle invalid file format (not allowed)
                    return redirect()->back()->with('error', 'Invalid file format. Only jpeg, jpg, and webp files are allowed.');
                }
            } else {
                $image = $uploadData->image;
            }
            $userId = $req->session()->get('admin_id');
            if ($req->id === null) {
                $uploadData->vendor_id = $req->vendor_id;
                $uploadData->quantity = $req->quantity;
                $uploadData->unit = $req->unit;
                $uploadData->sample_price = $req->sample_price;
                $uploadData->bulk_price = $req->bulk_price;
                $uploadData->image = $image;
                $uploadData->ip = $req->ip();
                $uploadData->added_by = $userId;
                $uploadData->save();
            } else {
                $uploadData->quantity = $uploadData->quantity + $req->quantity;
                $uploadData->save();
            }
            if ($uploadData) {
                // ------ creating fabric transaction ----------
                $uploadData2 = new FabricTxnModal();
                $userId = $req->session()->get('admin_id');
                $uploadData2->fabric_id = $uploadData->id;
                $uploadData2->receive = $req->quantity;
                $uploadData2->unit = $uploadData->unit;
                $uploadData2->date = $req->date;
                $uploadData2->ip = $req->ip();
                $uploadData2->added_by = $userId;
                $uploadData2->save();
                if ($req->id === null) {
                    return redirect()->route('fabric.index')->with('success', 'Fabric Added Successfully!');
                } else {
                    return redirect()->route('fabric.index')->with('success', 'Fabric Updated Successfully');
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
            $data = FabricModal::where('id', $id)->first();
            $vendors = EvVendorModal::where('is_active', 1)->get();

            $title =  "Fabric";
            return view('admin/fabric.create', compact('data', 'title', 'vendors'));
        } else {
            return view('admin/login/index');
        }
    }

    public function destroy(Request $req, $idd)
    {
        if (!empty($req->session()->has('admin_data'))) {
            if ($req->session()->get('position') == "Super Admin") {
                $id = base64_decode($idd);
                $fabrics = FabricModal::findOrFail($id);
                $fabrics->delete();
                return redirect()->route('fabric.index')->with('success', 'Fabric deleted Successfully!');
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
                $fabric = FabricModal::findOrFail($id);
                $fabric->is_active = !$fabric->is_active;
                $fabric->save();
                return redirect()->route('fabric.index')->with('success', 'Status updated Successfully!');
            } else {
                return redirect()->back()->with('error', 'Sorry you dont have Permission to delete admin, Only Super admin can change status');
            }
        } else {
            return view('admin/login/index');
        }
    }
    public function showTxn(Request $req, $idd)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $id = base64_decode($idd);
            $fabricData = FabricModal::where('id', $id)->first();
            $foreachData = FabricTxnModal::where('fabric_id', $id)->get();
            $title =  "Fabric ".$fabricData->code.' Transaction';
            return view('admin/fabric.transaction', compact('foreachData', 'title','fabricData'));
        } else {
            return view('admin/login/index');
        }
    }
}
