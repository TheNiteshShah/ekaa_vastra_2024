<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryModal;
use App\Models\SubCategoryModal;
use App\Models\ProductModal;

class CategoryController extends Controller
{
    public function index(Request $req)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $foreachData = CategoryModal::wherenull('deleted_at')->latest()->get();
            $title =  "Category";
            return view('admin/category.index', compact('foreachData', 'title'));
        } else {
            return view('admin/login/index');
        }
    }
    public function create(Request $req)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $data = new CategoryModal();
            $title =  "Add Category";
            return view('admin/category.create', compact('data', 'title'));
        } else {
            return view('admin/login/index');
        }
    }
    public function store(Request $req)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $this->validate($req, [
                'name' => $req->id === null ? 'required' : 'required',
                'seq' => $req->id === null ? 'required' : 'required',
            ]);
            if ($req->id === null) {
                $uploadData = new CategoryModal();
            } else {
                $uploadData = CategoryModal::where('id', $req->id)->first();
            }
            if (!empty($req->image)) {
                $allowedFormats = ['jpeg', 'jpg', 'webp'];
                $extension = strtolower($req->image->getClientOriginalExtension());
                if (in_array($extension, $allowedFormats)) {
                    $file = time() . '_' . uniqid() . '.' . $req->image->extension();
                    $req->image->move(public_path('uploads/image/category/'), $file);
                    $image = 'uploads/image/category/' . $file;
                } else {
                    // Handle invalid file format (not allowed)
                    return redirect()->back()->with('error', 'Invalid file format. Only jpeg, jpg, and webp files are allowed.');
                }
            } else {
                $image = $uploadData->image;
            }
            $userId = $req->session()->get('admin_id');
            $uploadData->name = ucwords($req->name);
            $uploadData->seq = $req->seq;
            $uploadData->image = $image;
            $uploadData->ip = $req->ip();
            $uploadData->added_by = $userId;
            $uploadData->save();
            if ($uploadData) {
                if ($req->id === null) {
                    return redirect()->route('category.index')->with('success', 'Category Added Successfully!');
                } else {
                    return redirect()->route('category.index')->with('success', 'Category Updated Successfully');
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
            $data = CategoryModal::where('id', $id)->first();
            $title =  "Category";
            return view('admin/category.create', compact('data', 'title'));
        } else {
            return view('admin/login/index');
        }
    }

    public function destroy(Request $req, $idd)
    {
        if (!empty($req->session()->has('admin_data'))) {
            if ($req->session()->get('position') == "Super Admin") {
                $id = base64_decode($idd);
                $categorys = CategoryModal::findOrFail($id);
                $categorys->delete();
                //-------- delete subcategory ---
                SubCategoryModal::where('category_id', $id)->delete();
                //-------- delete products ---
                ProductModal::where('category_id', $id)->delete();
                return redirect()->route('category.index')->with('success', 'Category deleted Successfully!');
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
                $category = CategoryModal::findOrFail($id);
                $category->is_active = !$category->is_active;
                $category->save();
                //-------- update subcategory ---
                SubCategoryModal::where('category_id', $id)
                    ->update(['is_active' => $category->is_active]);
                //-------- update products ---
                ProductModal::where('category_id', $id)
                    ->update(['is_active' => $category->is_active]);
                return redirect()->route('category.index')->with('success', 'Status updated Successfully!');
            } else {
                return redirect()->back()->with('error', 'Sorry you dont have Permission to delete admin, Only Super admin can change status');
            }
        } else {
            return view('admin/login/index');
        }
    }
}
