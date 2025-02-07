<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TestimonialModal;

class TestimonialController extends Controller
{
    public function index(Request $req)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $foreachData = TestimonialModal::wherenull('deleted_at')->latest()->get();
            $title =  "Testimonial";
            return view('admin/testimonial.index', compact('foreachData', 'title'));
        } else {
            return view('admin/login/index');
        }
    }
    public function create(Request $req)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $data = new TestimonialModal();
            $title =  "Add Testimonial";
            return view('admin/testimonial.create', compact('data', 'title'));
        } else {
            return view('admin/login/index');
        }
    }
    public function store(Request $req)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $this->validate($req, [
                'name' => $req->id === null ? 'required' : 'required',
                'review' => $req->id === null ? 'required' : 'required',
                'rating' => $req->id === null ? 'required' : 'required',
                'seq' => $req->id === null ? 'required' : 'required',
            ]);
            if ($req->id === null) {
                $uploadData = new TestimonialModal();
            } else {
                $uploadData = TestimonialModal::where('id', $req->id)->first();
            }
            if (!empty($req->image)) {
                $allowedFormats = ['jpeg', 'jpg', 'webp'];
                $extension = strtolower($req->image->getClientOriginalExtension());
                if (in_array($extension, $allowedFormats)) {
                    $file = time() . '_' . uniqid() . '.' . $req->image->extension();
                    $req->image->move(public_path('uploads/image/testimonial/'), $file);
                    $image = 'uploads/image/testimonial/' . $file;
                } else {
                    // Handle invalid file format (not allowed)
                    return redirect()->back()->with('error', 'Invalid file format. Only jpeg, jpg, and webp files are allowed.');
                }
            } else {
                $image = $uploadData->image;
            }
            $userId = $req->session()->get('admin_id');
            $uploadData->name = ucwords($req->name);
            $uploadData->review = $req->review;
            $uploadData->rating = $req->rating;
            $uploadData->seq = $req->seq;
            $uploadData->image = $image;
            $uploadData->ip = $req->ip();
            $uploadData->added_by = $userId;
            $uploadData->save();
            if ($uploadData) {
                if ($req->id === null) {
                    return redirect()->route('testimonial.index')->with('success', 'Testimonial Added Successfully!');
                } else {
                    return redirect()->route('testimonial.index')->with('success', 'Testimonial Updated Successfully');
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
            $data = TestimonialModal::where('id', $id)->first();
            $title =  "Testimonial";
            return view('admin/testimonial.create', compact('data', 'title'));
        } else {
            return view('admin/login/index');
        }
    }

    public function destroy(Request $req, $idd)
    {
        if (!empty($req->session()->has('admin_data'))) {
            if ($req->session()->get('position') == "Super Admin") {
                $id = base64_decode($idd);
                $testimonials = TestimonialModal::findOrFail($id);
                $testimonials->delete();
                return redirect()->route('testimonial.index')->with('success', 'Testimonial deleted Successfully!');
            } else {
                return redirect()->back()->with('error', 'Sorry you dont have Permission to delete admin, Only Super admin can change status');
            }
        } else {
            return view('admin/login/index');
        }
    }
}
