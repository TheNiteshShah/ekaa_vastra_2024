<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BgImageModal;

class BgImageController extends Controller
{
    public function index(Request $req)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $foreachData = BgImageModal::wherenull('deleted_at')->latest()->get();
            $title =  "BG Images";
            return view('admin/bg_image.index', compact('foreachData', 'title'));
        } else {
            return view('admin/login/index');
        }
    }
    public function create(Request $req)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $data = new BgImageModal();
            $title =  "Add BG Image";
            return view('admin/bg_image.create', compact('data', 'title'));
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
                $uploadData = new BgImageModal();
            } else {
                $uploadData = BgImageModal::where('id', $req->id)->first();
            }
            if (!empty($req->web_image)) {
                $allowedFormats = ['jpeg', 'jpg', 'webp', 'png'];
                $extension = strtolower($req->web_image->getClientOriginalExtension());
                if (in_array($extension, $allowedFormats)) {
                    $file = time() . '_' . uniqid() . '.' . $req->web_image->extension();
                    $req->web_image->move(public_path('uploads/image/bg_image/'), $file);
                    $web_image = 'uploads/image/bg_image/' . $file;
                } else {
                    // Handle invalid file format (not allowed)
                    return redirect()->back()->with('error', 'Invalid file format. Only jpeg, jpg, png and webp files are allowed.');
                }
            } else {
                $web_image = $uploadData->web_image;
            }
            if (!empty($req->mob_image)) {
                $allowedFormats = ['jpeg', 'jpg', 'webp', 'png'];
                $extension = strtolower($req->mob_image->getClientOriginalExtension());
                if (in_array($extension, $allowedFormats)) {
                    $file = time() . '_' . uniqid() . '.' . $req->mob_image->extension();
                    $req->mob_image->move(public_path('uploads/image/bg_image/'), $file);
                    $mob_image = 'uploads/image/bg_image/' . $file;
                } else {
                    // Handle invalid file format (not allowed)
                    return redirect()->back()->with('error', 'Invalid file format. Only jpeg, jpg, png and webp files are allowed.');
                }
            } else {
                $mob_image = $uploadData->mob_image;
            }
            $userId = $req->session()->get('admin_id');
            $uploadData->name = $req->name;
            $uploadData->web_image = $web_image;
            $uploadData->mob_image = $mob_image;
            $uploadData->ip = $req->ip();
            $uploadData->added_by = $userId;
            $uploadData->save();
            if ($uploadData) {
                if ($req->id === null) {
                    return redirect()->route('bg_image.index')->with('success', 'BG Added Successfully!');
                } else {
                    return redirect()->route('bg_image.index')->with('success', 'BG Updated Successfully');
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
            $data = BgImageModal::where('id', $id)->first();
            $title =  "BG Image";
            return view('admin/bg_image.create', compact('data', 'title'));
        } else {
            return view('admin/login/index');
        }
    }

    public function destroy(Request $req, $idd)
    {
        if (!empty($req->session()->has('admin_data'))) {
            if ($req->session()->get('position') == "Super Admin") {
                $id = base64_decode($idd);
                $categorys = BgImageModal::findOrFail($id);
                $categorys->delete();
                return redirect()->route('bg_image.index')->with('success', 'BG deleted Successfully!');
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
                $bg_image = BgImageModal::findOrFail($id);
                $bg_image->is_active = !$bg_image->is_active;
                $bg_image->save();
                return redirect()->route('bg_image.index')->with('success', 'Status updated Successfully!');
            } else {
                return redirect()->back()->with('error', 'Sorry you don\'t have Permission to delete admin, Only Super admin can change status');
            }
        } else {
            return view('admin/login/index');
        }
    }
}
