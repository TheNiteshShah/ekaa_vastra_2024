<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TopBarModal;

class TopBarController extends Controller
{
    public function index(Request $req)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $foreachData = TopBarModal::wherenull('deleted_at')->latest()->get();
            $title =  "TopBar";
            return view('admin/top_bar.index', compact('foreachData', 'title'));
        } else {
            return view('admin/login/index');
        }
    }
    public function create(Request $req)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $data = new TopBarModal();
            $title =  "Add TopBar";
            return view('admin/top_bar.create', compact('data', 'title'));
        } else {
            return view('admin/login/index');
        }
    }
    public function store(Request $req)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $this->validate($req, [
                'content' => $req->id === null ? 'required' : 'required',
                'seq' => $req->id === null ? 'required' : 'required',
            ]);
            if ($req->id === null) {
                $uploadData = new TopBarModal();
            } else {
                $uploadData = TopBarModal::where('id', $req->id)->first();
            }
            $userId = $req->session()->get('admin_id');
            $uploadData->content = $req->content;
            $uploadData->seq = $req->seq;
            $uploadData->ip = $req->ip();
            $uploadData->added_by = $userId;
            $uploadData->save();
            if ($uploadData) {
                if ($req->id === null) {
                    return redirect()->route('top_bar.index')->with('success', 'TopBar Added Successfully!');
                } else {
                    return redirect()->route('top_bar.index')->with('success', 'TopBar Updated Successfully');
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
            $data = TopBarModal::where('id', $id)->first();
            $title =  "TopBar";
            return view('admin/top_bar.create', compact('data', 'title'));
        } else {
            return view('admin/login/index');
        }
    }

    public function destroy(Request $req, $idd)
    {
        if (!empty($req->session()->has('admin_data'))) {
            if ($req->session()->get('position') == "Super Admin") {
                $id = base64_decode($idd);
                $top = TopBarModal::findOrFail($id);
                $top->delete();
                return redirect()->route('top_bar.index')->with('success', 'TopBar deleted Successfully!');
            } else {
                return redirect()->back()->with('error', 'Sorry you don\'t have Permission to delete admin, Only Super admin can change status');
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
                $top_bar = TopBarModal::findOrFail($id);
                $top_bar->is_active = !$top_bar->is_active;
                $top_bar->save();
                return redirect()->route('top_bar.index')->with('success', 'Status updated Successfully!');
            } else {
                return redirect()->back()->with('error', 'Sorry you don\'t have Permission to delete admin, Only Super admin can change status');
            }
        } else {
            return view('admin/login/index');
        }
    }
}
