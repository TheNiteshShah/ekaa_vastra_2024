<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RkVendorModal;
use App\Models\RkVendorOrderDetailsModal;
use App\Models\RkVendorOrderModal;
use App\Models\RkVendorProductModal;
use Illuminate\Http\Request;

class RkVendorOrderController extends Controller
{
    public function index(Request $req, $parent_id)
    {
        if (! empty($req->session()->has('admin_data'))) {
            $parent_id   = base64_decode($parent_id);
            $parentData  = RkVendorModal::where('id', $parent_id)->first();
            $foreachData = RkVendorOrderModal::where('vendor_id', $parent_id)->latest()->get();
            $title       = "RK Vendor - " . $parentData->name . ' Invoice';
            return view('admin/rk_vendor_order.index', compact('foreachData', 'title', 'parent_id'));
        } else {
            return view('admin/login/index');
        }
    }
    public function create(Request $req, $parent_id)
    {
        if (! empty($req->session()->has('admin_data'))) {
            $parent_idx  = base64_decode($parent_id);
            $productData = RkVendorProductModal::where(['vendor_id' => $parent_idx, 'is_active' => 1])->latest()->get();
            $parentData  = RkVendorModal::where('id', $parent_idx)->first();
            $data        = new RkVendorOrderModal();
            $title       = "Add - " . $parentData->name . ' Bill';
            return view('admin/rk_vendor_order.create', compact('data', 'title', 'parent_id', 'productData'));
        } else {
            return view('admin/login/index');
        }
    }
    public function store(Request $req)
    {
        if (! empty($req->session()->has('admin_data'))) {
            $this->validate($req, [
                'vendor_id'    => $req->id === null ? 'required' : 'required',
                'count'        => $req->id === null ? 'required' : 'required',
                'vendor_id'    => $req->id === null ? 'required' : 'required',
                'invoice_date' => $req->id === null ? 'required' : 'required',
                'invoice_no'   => $req->id === null ? 'required' : 'required',
                'name'         => $req->id === null ? 'required' : 'required',
                'quantity'     => $req->id === null ? 'required' : 'required',
                'total'        => $req->id === null ? 'required' : 'required',
            ]);
            if ($req->id === null) {
                $uploadData = new RkVendorOrderModal();
            } else {
                $uploadData = RkVendorOrderModal::where('id', $req->id)->first();
            }

            $userId                     = $req->session()->get('admin_id');
            $uploadData->vendor_id      = base64_decode($req->vendor_id);
            $uploadData->invoice_date   = $req->invoice_date;
            $uploadData->invoice_no     = $req->invoice_no;
            $uploadData->reverse_charge = $req->reverse_charge;
            $uploadData->challan_no     = $req->challan_no;
            $uploadData->transport      = $req->transport;
            $uploadData->vehicle_no     = $req->vehicle_no;
            $uploadData->station        = $req->station;
            $uploadData->ip             = $req->ip();
            $uploadData->added_by       = $userId;
            $uploadData->save();
            if (! empty($req->id)) {
                RkVendorOrderDetailsModal::where('order_id', $req->id)->delete();
            }
            //----- update bill details ------
            $sub_total = 0;
            for ($i = 0; $i < $req->count; $i++) {
                $pro_data = RkVendorProductModal::where('id', $req->name[$i])->first();
                $sub_total += $pro_data->price * $req->quantity[$i];
                $uploadData2             = new RkVendorOrderDetailsModal();
                $uploadData2->order_id   = $uploadData->id;
                $uploadData2->product_id = $pro_data->id;
                $uploadData2->name       = $pro_data->name;
                $uploadData2->unit       = $pro_data->unit;
                $uploadData2->price      = $pro_data->price;
                $uploadData2->quantity   = $req->quantity[$i];
                $uploadData2->ip         = $req->ip();
                $uploadData2->added_by   = $userId;
                $uploadData2->save();
            }
            // --- update order data -----
            $uploadData3  = RkVendorOrderModal::where('id', $uploadData->id)->first();
            $gst          = 5;
            $gst_amount   = $sub_total * $gst / 100;
            $total_amount = round($sub_total + $gst_amount);
            //--------------------------------
            $uploadData3->sub_total    = $sub_total;
            $uploadData3->gst          = $gst;
            $uploadData3->gst_amount   = $gst_amount;
            $uploadData3->total_amount = $total_amount;
            $uploadData3->save();
            if ($uploadData) {
                if ($req->id === null) {
                    return redirect()->route('rk-vendor-order.index', $req->vendor_id)->with('success', 'RK Vendor Order Added Successfully!');
                } else {
                    return redirect()->route('rk-vendor-order.index', $req->vendor_id)->with('success', 'RK Vendor Order Updated Successfully');
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
        if (! empty($req->session()->has('admin_data'))) {
            $id          = base64_decode($idd);
            $data        = RkVendorOrderModal::where('id', $id)->first();
            $title       = "RK Vendor";
            $productData = RkVendorProductModal::where(['vendor_id' => $data->vendor_id, 'is_active' => 1])->latest()->get();

            return view('admin/rk_vendor_order.create', compact('data', 'title', 'productData'));
        } else {
            return view('admin/login/index');
        }
    }

    public function destroy(Request $req, $idd)
    {
        if (! empty($req->session()->has('admin_data'))) {
            if ($req->session()->get('position') == "Super Admin") {
                $id               = base64_decode($idd);
                $rk_vendor_orders = RkVendorOrderModal::findOrFail($id);
                $rk_vendor_orders->delete();
                return redirect()->route('rk_vendor_order.index')->with('success', 'RK Vendor Product deleted Successfully!');
            } else {
                return redirect()->back()->with('error', 'Sorry you dont have Permission to delete admin, Only Super admin can change status');
            }
        } else {
            return view('admin/login/index');
        }
    }
    public function show(Request $req, $idd)
    {
        if (! empty($req->session()->has('admin_data'))) {
            if ($req->session()->get('position') == "Super Admin") {
                $id                         = base64_decode($idd);
                $rk_vendor_order            = RkVendorOrderModal::findOrFail($id);
                $rk_vendor_order->is_active = ! $rk_vendor_order->is_active;
                $rk_vendor_order->save();
                return redirect()->route('rk-vendor-product.index', base64_encode($rk_vendor_order->vendor_id))->with('success', 'Status updated Successfully!');
            } else {
                return redirect()->back()->with('error', 'Sorry you dont have Permission to delete admin, Only Super admin can change status');
            }
        } else {
            return view('admin/login/index');
        }
    }
    public function print(Request $req, $idd)
    {
        if (! empty($req->session()->has('admin_data'))) {
            $id        = base64_decode($idd);
            $bill_data = RkVendorOrderModal::where('id', $id)->first();
            $title     = "RK Invoice " . $bill_data->invoice_no;
            return view('admin/rk_vendor_order.print', compact('bill_data', 'title'));
        } else {
            return view('admin/login/index');
        }
    }
}
