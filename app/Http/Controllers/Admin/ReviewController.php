<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReviewModal;
use App\Models\ProductModal;

class ReviewController extends Controller
{
    public function index(Request $req, $parent_id)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $parent_id = base64_decode($parent_id);
            $parentData = ProductModal::where('id', $parent_id)->first();
            $foreachData = ReviewModal::where('product_id', $parent_id)->latest()->get();
            $title =  "Reviews";
            return view('admin/review.index', compact('foreachData', 'title', 'parent_id', 'parentData'));
        } else {
            return view('admin/login/index');
        }
    }

    public function destroy(Request $req, $idd)
    {
        if (!empty($req->session()->has('admin_data'))) {
            if ($req->session()->get('position') == "Super Admin") {
                $id = base64_decode($idd);
                $reviews = ReviewModal::findOrFail($id);
                $reviews->delete();
                return redirect()->route('review.index', base64_encode($reviews->product_id))->with('success', 'Review deleted Successfully!');
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
                $category = ReviewModal::findOrFail($id);
                $category->is_active = !$category->is_active;
                $category->save();
                return redirect()->route('review.index', base64_encode($category->product_id))->with('success', 'Status updated Successfully!');
            } else {
                return redirect()->back()->with('error', 'Sorry you dont have Permission to delete admin, Only Super admin can change status');
            }
        } else {
            return view('admin/login/index');
        }
    }
}
