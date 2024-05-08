<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterTypeModal;
use App\Models\MasterAttributeModal;

class MasterAttributeController extends Controller
{
    public function index(Request $req,$parent_id)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $id = base64_decode($parent_id);
            $foreachData = MasterAttributeModal::where('master_id',$id)->latest()->get();
            $title =  "Master Attributes";
            $parentData = MasterTypeModal::where('id', $id)->first();
            return view('admin/master_attributes.index', compact('foreachData', 'title','parentData','parent_id'));
        } else {
            return view('admin/login/index');
        }
    }
    public function create(Request $req,$parent_id)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $parent_id = base64_decode($parent_id);
            $data = new MasterAttributeModal();
            $title =  "Add Master Attributes";
            return view('admin/master_attributes.create', compact('data', 'title','parent_id'));
        } else {
            return view('admin/login/index');
        }
    }
    public function store(Request $req)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $this->validate($req, [
                'name' => $req->id === null ? 'required' : 'required',
                'master_id' => $req->id === null ? 'required' : 'required',
            ]);
            if ($req->id === null) {
                $uploadData = new MasterAttributeModal();
            } else {
                $uploadData = MasterAttributeModal::where('id', $req->id)->first();
            }
            $userId = $req->session()->get('admin_id');
            $uploadData->name = ucwords($req->name);
            $uploadData->master_id = $req->master_id;
            $uploadData->ip = $req->ip();
            $uploadData->added_by = $userId;
            $uploadData->save();
            if ($uploadData) {
                if ($req->id === null) {
                    return redirect()->route('master_attributes.index',base64_encode($req->master_id))->with('success', 'MasterAttribute Added Successfully!');
                } else {
                    return redirect()->route('master_attributes.index',base64_encode($req->master_id))->with('success', 'MasterAttribute Updated Successfully');
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
            $data = MasterAttributeModal::where('id', $id)->first();
            $title =  "Master Attributes";
            return view('admin/master_attributes.create', compact('data', 'title'));
        } else {
            return view('admin/login/index');
        }
    }
    public function show(Request $req, $idd)
    {
        if (!empty($req->session()->has('admin_data'))) {
            if ($req->session()->get('position') == "Super Admin") {
                $id = base64_decode($idd);
                $category = MasterAttributeModal::findOrFail($id);
                $category->is_active = !$category->is_active;
                $category->save();
                return redirect()->route('master_attributes.index')->with('success', 'Status updated Successfully!');
            } else {
                return redirect()->back()->with('error', 'Sorry you dont have Permission to delete admin, Only Super admin can change status');
            }
        } else {
            return view('admin/login/index');
        }
    }
}
