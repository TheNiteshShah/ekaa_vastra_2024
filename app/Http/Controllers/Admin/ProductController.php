<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategoryModal;
use App\Models\CategoryModal;
use App\Models\ProductModal;
use App\Models\TypeModal;
use App\Models\MasterTypeModal;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function products_subcategory(Request $req)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $foreachData = SubCategoryModal::wherenull('deleted_at')->latest()->get();
            $title =  "SubCategory";
            $show =  1;
            return view('admin/subcategory.index', compact('foreachData', 'title', 'show'));
        } else {
            return view('admin/login/index');
        }
    }
    public function all_products(Request $req)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $foreachData = ProductModal::latest()->get();
            $title =  "All Products";
            return view('admin/product.index', compact('foreachData', 'title'));
        } else {
            return view('admin/login/index');
        }
    }
    public function index(Request $req, $type, $parent_id)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $id = base64_decode($parent_id);
            if ($type == 'category') {
                $parentData = CategoryModal::where('id', $id)->first();
                $foreachData = ProductModal::where('category_id', $id)->latest()->get();
            } else {
                $parentData = SubcategoryModal::where('id', $id)->first();
                $foreachData = ProductModal::where('subcategory_id', $id)->latest()->get();
            }
            $title =  "Products";
            return view('admin/product.index', compact('foreachData', 'title', 'parent_id', 'parentData', 'type'));
        } else {
            return view('admin/login/index');
        }
    }
    public function create(Request $req, $type, $parent_id)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $parent_id = base64_decode($parent_id);
            $category_id = '';
            $subcategory_id = '';
            if ($type == 'category') {
                $category_id = $parent_id;
            } else {
                $subcategory_id = $parent_id;
            }
            $data = new ProductModal();
            $title =  "Add Products";
            return view('admin/product.create', compact('data', 'title', 'category_id', 'subcategory_id'));
        } else {
            return view('admin/login/index');
        }
    }
    public function store(Request $req)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $this->validate($req, [
                'name' => $req->id === null ? 'required' : 'required',
                'sku' => $req->id === null
                    ? 'required|unique:products,sku'
                    : 'required|unique:products,sku,' . $req->id,
                'description' => $req->id === null ? 'required' : 'required',
                'is_top' => $req->id === null ? 'required' : 'required',
                'is_trending' => $req->id === null ? 'required' : 'required',
                'seq' => $req->id === null ? 'required' : 'required',
                'mrp' => $req->id === null ? 'required' : 'required',
                'selling_price' => $req->id === null ? 'required' : 'required',
                'gst_percentage' => $req->id === null ? 'required' : 'required',
                'gst' => $req->id === null ? 'required' : 'required',
                'price' => $req->id === null ? 'required' : 'required',
                'attribute1' => $req->id === null ? '' : '',
                'attribute2' => $req->id === null ? '' : '',
                'attribute3' => $req->id === null ? '' : '',
                'label' => $req->id === null ? '' : '',
            ]);
            if ($req->id === null) {
                $uploadData = new ProductModal();
                // $uploadData->is_active = 0;
            } else {
                $uploadData = ProductModal::where('id', $req->id)->first();
            }
            try {
                $image = $req->hasFile('image') ? $this->uploadImage($req->file('image'), 'products') : (isset($uploadData->image) ? $uploadData->image : null);
                $image2 = $req->hasFile('image2') ? $this->uploadImage($req->file('image2'), 'products') : (isset($uploadData->image2) ? $uploadData->image2 : null);
                $image3 = $req->hasFile('image3') ? $this->uploadImage($req->file('image3'), 'products') : (isset($uploadData->image3) ? $uploadData->image3 : null);
                $image4 = $req->hasFile('image4') ? $this->uploadImage($req->file('image4'), 'products') : (isset($uploadData->image4) ? $uploadData->image4 : null);
                $size_chart = $req->hasFile('size_chart') ? $this->uploadImage($req->file('size_chart'), 'products') : (isset($uploadData->size_chart) ? $uploadData->size_chart : null);
            } catch (InvalidFileFormatException $e) {
                return redirect()->back()->with('error', $e->getMessage());
            }
            $parentData = SubcategoryModal::where('id', $req->subcategory_id)->first();
            $userId = $req->session()->get('admin_id');
            $uploadData->category_id = $req->category_id ? $req->category_id : $parentData->category_id;
            $uploadData->subcategory_id = $req->subcategory_id;
            $uploadData->name =  ucwords($req->name);
            $uploadData->sku = $req->sku;
            $uploadData->short_description = $req->short_description;
            $uploadData->description = $req->description;
            $uploadData->is_top = $req->is_top;
            $uploadData->is_trending = $req->is_trending;
            $uploadData->seq = $req->seq;
            $uploadData->mrp = $req->mrp;
            $uploadData->selling_price = $req->selling_price;
            $uploadData->gst_percentage = $req->gst_percentage;
            $uploadData->price = $req->price;
            $uploadData->gst = $req->gst;
            $uploadData->image = $image;
            $uploadData->image2 = $image2;
            $uploadData->image3 = $image3;
            $uploadData->image4 = $image4;
            $uploadData->size_chart = $size_chart;
            $uploadData->label = $req->label;
            $uploadData->seo_title = $req->seo_title;
            $uploadData->seo_description = $req->seo_description;
            $uploadData->seo_keywords = $req->seo_keywords;
            $uploadData->ip = $req->ip();
            $uploadData->added_by = $userId;
            $uploadData->slug = Str::slug($req->name);
            $uploadData->save();
            if ($uploadData) {
                if ($req->id === null) {
                    return redirect()->route('types.index', base64_encode($uploadData->id))->with('success', 'Product Added Successfully!');
                } else {
                    return redirect()->route('products.index', [$req->subcategory_id ? 'subcategory' : 'category', base64_encode($req->subcategory_id ? $req->subcategory_id : $req->category_id)])->with('success', 'Product Updated Successfully');
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
            $data = ProductModal::where('id', $id)->first();
            $title =  "Products";
            return view('admin/product.create', compact('data', 'title'));
        } else {
            return view('admin/login/index');
        }
    }

    public function destroy(Request $req, $idd)
    {
        if (!empty($req->session()->has('admin_data'))) {
            if ($req->session()->get('position') == "Super Admin") {
                $id = base64_decode($idd);
                $products = ProductModal::findOrFail($id);
                $products->delete();
                //-------- delete products ---
                TypeModal::where('product_id', $id)->delete();
                return redirect()->route('products.index', base64_encode($products->subcategory_id))->with('success', 'Product deleted Successfully!');
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
                $products = ProductModal::findOrFail($id);
                $products->is_active = !$products->is_active;
                $products->save();
                return redirect()->back()->with('success', 'Status updated Successfully!');
            } else {
                return redirect()->back()->with('error', 'Sorry you don\'t have Permission to delete admin, Only Super admin can change status');
            }
        } else {
            return view('admin/login/index');
        }
    }
    function uploadImage($image, $folderName)
    {
        $allowedFormats = ['jpeg', 'jpg', 'webp','avif'];
        $extension = strtolower($image->getClientOriginalExtension());
        // Check if the file format is allowed
        if (in_array($extension, $allowedFormats)) {
            $file = time() . '_' . uniqid() . '.' . $image->extension();
            $image->move(public_path("uploads/image/$folderName/"), $file);
            return "uploads/image/$folderName/" . $file;
        } else {
            // Handle invalid file format (not allowed)
            throw new InvalidFileFormatException('Invalid file format. Only jpeg, jpg, avif and webp files are allowed.');
        }
    }
    public function img_remove(Request $req, $idd, $column)
    {
        if (!empty($req->session()->has('admin_data'))) {
            if ($req->session()->get('position') == "Super Admin") {
                $id = base64_decode($idd);
                $product = ProductModal::where('id', $id)->first();
                if ($column == 'image') {
                    $product->image = null;
                } elseif ($column == 'image2') {
                    $product->image2 = null;
                } elseif ($column == 'image3') {
                    $product->image3 = null;
                } else if ($column == 'image4') {
                    $product->image4 = null;
                }
                $product->save();
                return redirect()->back()->with('success', 'Removed Successfully!');
            } else {
                return redirect()->back()->with('error', 'Sorry you don\'t have Permission to delete admin, Only Super admin can change status');
            }
        } else {
            return view('admin/login/index');
        }
    }
}
