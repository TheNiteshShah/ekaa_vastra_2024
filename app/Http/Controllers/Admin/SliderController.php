<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SliderModal;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    public function index(Request $req)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $foreachData = SliderModal::wherenull('deleted_at')->latest()->get();
            $title =  "Sliders";
            return view('admin/slider.index', compact('foreachData', 'title'));
        } else {
            return view('admin/login/index');
        }
    }
    public function create(Request $req)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $data = new SliderModal();
            $title =  "Add Sliders";
            return view('admin/slider.create', compact('data', 'title'));
        } else {
            return view('admin/login/index');
        }
    }
    public function store(Request $req)
    {
        if (!empty($req->session()->has('admin_data'))) {
            if ($req->id === null) {
                $uploadData = new SliderModal();
            } else {
                $uploadData = SliderModal::where('id', $req->id)->first();
            }
            if (!empty($req->web_image)) {
                $allowedFormats = ['jpeg', 'jpg', 'webp','png'];
                $extension = strtolower($req->web_image->getClientOriginalExtension());
                if (in_array($extension, $allowedFormats)) {
                    $file = time() . '_' . uniqid() . '.' . $req->web_image->extension();
                    $req->web_image->move(public_path('uploads/image/sliders/'), $file);
                    $web_image = 'uploads/image/sliders/' . $file;
                } else {
                    // Handle invalid file format (not allowed)
                    return redirect()->back()->with('error', 'Invalid file format. Only jpeg, jpg, png and webp files are allowed.');
                }
            } else {
                $web_image = $uploadData->web_image;
            }
            if (!empty($req->mob_image)) {
                $allowedFormats = ['jpeg', 'jpg', 'webp'];
                $extension = strtolower($req->mob_image->getClientOriginalExtension());
                if (in_array($extension, $allowedFormats)) {
                    $file = time() . '_' . uniqid() . '.' . $req->mob_image->extension();
                    $req->mob_image->move(public_path('uploads/image/sliders/'), $file);
                    $mob_image = 'uploads/image/sliders/' . $file;
                } else {
                    // Handle invalid file format (not allowed)
                    return redirect()->back()->with('error', 'Invalid file format. Only jpeg, jpg, and webp files are allowed.');
                }
            } else {
                $mob_image = $uploadData->mob_image;
            }
            $userId = $req->session()->get('admin_id');
            $uploadData->link = $req->link;
            $uploadData->web_image = $web_image;
            $uploadData->mob_image = $mob_image;
            $uploadData->ip = $req->ip();
            $uploadData->added_by = $userId;
            $uploadData->seq = $req->seq;
            $uploadData->save();
            if ($uploadData) {
                if ($req->id === null) {
                    return redirect()->route('sliders.index')->with('success', 'Slider Added Successfully!');
                } else {
                    return redirect()->route('sliders.index')->with('success', 'Slider Updated Successfully');
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
            $data = SliderModal::where('id', $id)->first();
            $title =  "Sliders";
            return view('admin/slider.create', compact('data', 'title'));
        } else {
            return view('admin/login/index');
        }
    }

    public function destroy(Request $req, $idd)
    {
        if (!empty($req->session()->has('admin_data'))) {
            if ($req->session()->get('position') == "Super Admin") {
                $id = base64_decode($idd);
                $sliders = SliderModal::findOrFail($id);
                $sliders->delete();
                return redirect()->route('sliders.index')->with('success', 'Slider deleted Successfully!');
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
                $sliders = SliderModal::findOrFail($id);
                $sliders->is_active = !$sliders->is_active;
                $sliders->save();
                return redirect()->route('sliders.index')->with('success', 'Status updated Successfully!');
            } else {
                return redirect()->back()->with('error', 'Sorry you dont have Permission to delete admin, Only Super admin can change status');
            }
        } else {
            return view('admin/login/index');
        }
    }
}
