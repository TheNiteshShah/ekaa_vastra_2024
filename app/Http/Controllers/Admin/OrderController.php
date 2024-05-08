<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order1Modal;
use App\Models\Order2Modal;

class OrderController extends Controller
{
    public function new_orders(Request $req)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $foreachData = Order1Modal::withTrashed()->where(['payment_status' => 1, 'order_status' => 1])->with('user')->latest()->get();
            $title =  "New Orders";
            return view('admin/order.index', compact('foreachData', 'title'));
        } else {
            return view('admin/login/index');
        }
    }
    public function accepted_orders(Request $req)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $foreachData = Order1Modal::withTrashed()->where(['payment_status' => 1, 'order_status' => 2])->with('user')->latest()->get();
            $title =  "Accepted Orders";
            return view('admin/order.index', compact('foreachData', 'title'));
        } else {
            return view('admin/login/index');
        }
    }
    public function dispatched_orders(Request $req)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $foreachData = Order1Modal::withTrashed()->where(['payment_status' => 1, 'order_status' => 3])->with('user')->latest()->get();
            $title =  "Dispatched Orders";
            return view('admin/order.index', compact('foreachData', 'title'));
        } else {
            return view('admin/login/index');
        }
    }
    public function delivered_orders(Request $req)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $foreachData = Order1Modal::withTrashed()->where(['payment_status' => 1, 'order_status' => 4])->with('user')->latest()->get();
            $title =  "Delivered Orders";
            return view('admin/order.index', compact('foreachData', 'title'));
        } else {
            return view('admin/login/index');
        }
    }
    public function rejected_orders(Request $req)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $foreachData = Order1Modal::withTrashed()->where(['payment_status' => 1, 'order_status' => 5])->with('user')->latest()->get();
            $title =  "Rejected Orders";
            return view('admin/order.index', compact('foreachData', 'title'));
        } else {
            return view('admin/login/index');
        }
    }
    public function all_orders(Request $req)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $foreachData = Order1Modal::withTrashed()->where(['payment_status' => 1])->with('user')->latest()->get();
            $title =  "All Orders";
            return view('admin/order.index', compact('foreachData', 'title'));
        } else {
            return view('admin/login/index');
        }
    }
    public function updateOrderStatus(Request $req, $status, $idd)
    {
        if (!empty($req->session()->has('admin_data'))) {
            if ($req->session()->get('position') == "Super Admin") {
                $id = base64_decode($idd);
                switch ($status) {
                    case "accept":
                        $data = Order1Modal::findOrFail($id);
                        $data->order_status = 2;
                        $data->save();
                        break;
                    case "dispatch":
                        $data = Order1Modal::findOrFail($id);
                        $data->order_status = 3;
                        $data->save();
                        break;
                    case "deliver":
                        $data = Order1Modal::findOrFail($id);
                        $data->order_status = 4;
                        $data->save();
                        break;
                    case "reject":
                        $data = Order1Modal::findOrFail($id);
                        $data->order_status = 5;
                        $data->save();
                        break;
                    default:
                        return redirect()->back()->with('error', 'Some error occured!');
                }
                return redirect()->back()->with('success', 'Status updated Successfully!');
            } else {
                return redirect()->back()->with('error', 'Sorry you dont have Permission to delete admin, Only Super admin can change status');
            }
        } else {
            return view('admin/login/index');
        }
    }
    //------------------ VIEW Track --------------------------
    public function updateTrack(Request $req, $idd)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $id = base64_decode($idd);
            $title =  'Disptach Order #' . $id;
            return view('admin/order/track_create', compact(['id', 'title']));
        } else {
            return view('admin/login/index');
        }
    }
    public function markDispatch(Request $req)
    {
        if (!empty($req->session()->has('admin_data'))) {

            $this->validate($req, [
                'id' => $req->id === null ? 'required' : 'required',
                'tracking_url' => $req->id === null ? 'required' : 'required',
            ]);
            $uploadData = Order1Modal::where('id', $req->id)->first();
            $uploadData->tracking_url = $req->tracking_url;
            $uploadData->order_status = 3;
            $uploadData->save();
            if ($uploadData) {
                return redirect()->route('accepted_orders')->with('success', 'Status updated Successfully!');
            } else {
                return redirect()->back()->with('error', 'Something Went Wrong');
            }
        } else {
            return view('admin/login/index');
        }
    }
    //------------------ VIEW ORDER DETAILS --------------------------
    public function orderDetails(Request $req, $idd)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $id = base64_decode($idd);
            $OrderData = Order1Modal::withTrashed()->wherenull('deleted_at')->where(array('id' => $id))->first();
            $title =  'Order #' . $OrderData->id . " Details";
            $foreachData = Order2Modal::wherenull('deleted_at')->where(array('main_id' => $id))->with('product')->get();
            return view('admin/order/details', compact(['OrderData', 'foreachData', 'title']));
        } else {
            return view('admin/login/index');
        }
    }
    //------------------ VIEW ORDER Invoice --------------------------
    public function OrderInvoice(Request $req, $idd)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $id = base64_decode($idd);
            $OrderData = Order1Modal::withTrashed()
                ->where('order1.id', $id)
                ->with('user')
                ->first();
            $foreachData = Order2Modal::where(array('main_id' => $id))->get();
            return view('admin/order/invoice', compact(['OrderData', 'foreachData']));
        } else {
            return view('admin/login/index');
        }
    }
}
