<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PopUpModal;

class PopUpController extends Controller
{
    public function index(Request $req)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $foreachData = PopUpModal::wherenull('deleted_at')->latest()->get();
            $title =  "PopUp Image";
            return view('admin/popup.index', compact('foreachData', 'title'));
        } else {
            return view('admin/login/index');
        }
    }

    public function store(Request $req)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $this->validate($req, [
                'form_active' => $req->id === null ? 'required' : 'required',
                'link' => $req->id === null ? '' : '',
            ]);
            $uploadData = PopUpModal::where('id', $req->id)->first();
            if (!empty($req->image)) {
                $allowedFormats = ['jpeg', 'jpg', 'webp'];
                $extension = strtolower($req->image->getClientOriginalExtension());
                if (in_array($extension, $allowedFormats)) {
                    $file = time() . '_' . uniqid() . '.' . $req->image->extension();
                    $req->image->move(public_path('uploads/image/popup/'), $file);
                    $image = 'uploads/image/popup/' . $file;
                } else {
                    // Handle invalid file format (not allowed)
                    return redirect()->back()->with('error', 'Invalid file format. Only jpeg, jpg, and webp files are allowed.');
                }
            } else {
                $image = $uploadData->image;
            }
            $userId = $req->session()->get('admin_id');
            $uploadData->form_active = $req->form_active;
            $uploadData->link = $req->link;
            $uploadData->image = $image;
            $uploadData->ip = $req->ip();
            $uploadData->added_by = $userId;
            $uploadData->save();
            if ($uploadData) {
                return redirect()->route('popup.index')->with('success', 'PopUp Updated Successfully');
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
            $data = PopUpModal::where('id', $id)->first();
            $title =  "PopUp Image";
            return view('admin/popup.create', compact('data', 'title'));
        } else {
            return view('admin/login/index');
        }
    }

    public function show(Request $req, $idd)
    {
        if (!empty($req->session()->has('admin_data'))) {
            if ($req->session()->get('position') == "Super Admin") {
                $id = base64_decode($idd);
                $popups = PopUpModal::findOrFail($id);
                $popups->is_active = !$popups->is_active;
                $popups->save();
                return redirect()->route('popup.index')->with('success', 'Status updated Successfully!');
            } else {
                return redirect()->back()->with('error', 'Sorry you dont have Permission to delete admin, Only Super admin can change status');
            }
        } else {
            return view('admin/login/index');
        }
    }
}
