<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryModal;
use App\Models\SubCategoryModal;
use App\Models\ProductModal;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    public function index(Request $req)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $foreachData = SubCategoryModal::wherenull('deleted_at')->latest()->get();
            $title =  "SubCategory";
            return view('admin/subcategory.index', compact('foreachData', 'title'));
        } else {
            return view('admin/login/index');
        }
    }
    public function create(Request $req)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $data = new SubCategoryModal();
            $categoryData = CategoryModal::where('is_active', 1)->latest()->get();
            $title =  "Add SubCategory";
            return view('admin/subcategory.create', compact('data', 'title', 'categoryData'));
        } else {
            return view('admin/login/index');
        }
    }
    public function store(Request $req)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $this->validate($req, [
                'category_id' => $req->id === null ? 'required' : 'required',
                'name' => $req->id === null ? 'required' : 'required',
                'seq' => $req->id === null ? 'required' : 'required',
            ]);
            if ($req->id === null) {
                $uploadData = new SubCategoryModal();
            } else {
                $uploadData = SubCategoryModal::where('id', $req->id)->first();
            }
            if (!empty($req->image)) {
                $allowedFormats = ['jpeg', 'jpg', 'webp'];
                $extension = strtolower($req->image->getClientOriginalExtension());
                if (in_array($extension, $allowedFormats)) {
                    $file = time() . '_' . uniqid() . '.'. $req->image->extension();
                    $req->image->move(public_path('uploads/image/subcategory/'), $file);
                    $image = 'uploads/image/subcategory/' . $file;
                } else {
                    // Handle invalid file format (not allowed)
                    return redirect()->back()->with('error', 'Invalid file format. Only jpeg, jpg, and webp files are allowed.');
                }
            } else {
                $image = $uploadData->image;
            }
            $userId = $req->session()->get('admin_id');
            $uploadData->category_id = $req->category_id;
            $uploadData->name = ucwords($req->name);
            $uploadData->seq = $req->seq;
            $uploadData->image = $image;
            $uploadData->ip = $req->ip();
            $uploadData->added_by = $userId;
            $uploadData->slug = Str::slug($req->name);
            $uploadData->seo_title = $req->seo_title;
            $uploadData->seo_description = $req->seo_description;
            $uploadData->seo_keywords = $req->seo_keywords;
            $uploadData->save();
            if ($uploadData) {
                if ($req->id === null) {
                    return redirect()->route('subcategory.index')->with('success', 'Sub Category Added Successfully!');
                } else {
                    return redirect()->route('subcategory.index')->with('success', 'Sub Category Updated Successfully');
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
            $data = SubCategoryModal::where('id', $id)->first();
            $categoryData = CategoryModal::where('is_active', 1)->latest()->get();
            $title =  "SubCategory";
            return view('admin/subcategory.create', compact('data', 'title', 'categoryData'));
        } else {
            return view('admin/login/index');
        }
    }

    public function destroy(Request $req, $idd)
    {
        if (!empty($req->session()->has('admin_data'))) {
            if ($req->session()->get('position') == "Super Admin") {
                $id = base64_decode($idd);
                $subcategorys = SubCategoryModal::findOrFail($id);
                $subcategorys->delete();
                //-------- delete products ---
                ProductModal::where('subcategory_id', $id)->delete();
                return redirect()->route('subcategory.index')->with('success', 'SubCategory deleted Successfully!');
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
                $subcategorys = SubCategoryModal::findOrFail($id);
                $subcategorys->is_active = !$subcategorys->is_active;
                $subcategorys->save();
                //-------- update products ---
                ProductModal::where('subcategory_id', $id)
                    ->update(['is_active' => $subcategorys->is_active]);
                return redirect()->route('subcategory.index')->with('success', 'Status updated Successfully!');
            } else {
                return redirect()->back()->with('error', 'Sorry you dont have Permission to delete admin, Only Super admin can change status');
            }
        } else {
            return view('admin/login/index');
        }
    }
}
