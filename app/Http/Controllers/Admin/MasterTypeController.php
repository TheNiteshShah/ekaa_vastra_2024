<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterTypeModal;

class MasterTypeController extends Controller
{
    public function index(Request $req)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $foreachData = MasterTypeModal::wherenull('deleted_at')->latest()->get();
            $title =  "Master Types";
            return view('admin/master_type.index', compact('foreachData', 'title'));
        } else {
            return view('admin/login/index');
        }
    }
    public function create(Request $req)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $data = new MasterTypeModal();
            $title =  "Add Master Type";
            return view('admin/master_type.create', compact('data', 'title'));
        } else {
            return view('admin/login/index');
        }
    }
    public function store(Request $req)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $this->validate($req, [
                'name' => $req->id === null ? 'required' : 'required',
            ]);
            if ($req->id === null) {
                $uploadData = new MasterTypeModal();
                $count = MasterTypeModal::count();
                if ($count == 4) {
                    return redirect()->route('master_type.index')->with('error', 'Master Type Add Limit reached!');
                }
            } else {
                $uploadData = MasterTypeModal::where('id', $req->id)->first();
            }
            $userId = $req->session()->get('admin_id');
            $uploadData->name = ucwords($req->name);
            $uploadData->ip = $req->ip();
            $uploadData->added_by = $userId;
            $uploadData->save();
            if ($uploadData) {
                if ($req->id === null) {
                    return redirect()->route('master_type.index')->with('success', 'MasterType Added Successfully!');
                } else {
                    return redirect()->route('master_type.index')->with('success', 'MasterType Updated Successfully');
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
            $data = MasterTypeModal::where('id', $id)->first();
            $title =  "Master Type";
            return view('admin/master_type.create', compact('data', 'title'));
        } else {
            return view('admin/login/index');
        }
    }
}
