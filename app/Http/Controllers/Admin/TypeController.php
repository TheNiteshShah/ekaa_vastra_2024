<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductModal;
use App\Models\TypeModal;
use App\Models\MasterTypeModal;

class TypeController extends Controller
{
    public function index(Request $req, $product_id)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $id = base64_decode($product_id);
            $foreachData = TypeModal::where('product_id', $id)->latest()->get();
            $MasterTypeData = MasterTypeModal::with('masterAttributes')->get();
            $title =  "Types";
            $parentData = ProductModal::where('id', $id)->first();
            return view('admin/type.index', compact('foreachData', 'title', 'product_id', 'parentData', 'MasterTypeData'));
        } else {
            return view('admin/login/index');
        }
    }
    public function create(Request $req, $product_id)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $product_id = base64_decode($product_id);
            $MasterTypeData = MasterTypeModal::with('masterAttributes')->get();
            $data = new TypeModal();
            $title =  "Add Types";
            return view('admin/type.create', compact('data', 'title', 'product_id', 'MasterTypeData'));
        } else {
            return view('admin/login/index');
        }
    }
    public function store(Request $req)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $this->validate($req, [
                'product_id' => $req->id === null ? 'required' : 'required',
                'inventory' => $req->id === null ? 'required' : 'required',
                'copy' => $req->id === null ? '' : '',
            ]);
            if ($req->id === null) {
                $uploadData = new TypeModal();
                $copyData = [];
            } else {
                if (empty($req->copy)) {
                    $uploadData = TypeModal::where('id', $req->id)->first();
                    $copyData = TypeModal::where('id', $req->id)->first();
                } else {
                    $uploadData = new TypeModal();
                    $copyData = TypeModal::where('id', $req->id)->first();
                }
            }

            $userId = $req->session()->get('admin_id');
            $uploadData->product_id = $req->product_id;

            $uploadData->inventory = $req->inventory;
            $uploadData->attribute1 = $req->attribute1;
            $uploadData->attribute2 = $req->attribute2;
            $uploadData->attribute3 = $req->attribute3;
            $uploadData->attribute4 = $req->attribute4;

            $uploadData->ip = $req->ip();
            $uploadData->added_by = $userId;
            $uploadData->save();
            if ($uploadData) {
                if ($req->id === null) {
                    return redirect()->route('types.index', base64_encode($req->product_id))->with('success', 'Type Added Successfully!');
                } else {
                    return redirect()->route('types.index', base64_encode($req->product_id))->with('success', 'Type Updated Successfully');
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
            $MasterTypeData = MasterTypeModal::with('masterAttributes')->get();
            $data = TypeModal::where('id', $id)->first();
            $title =  "Types";
            return view('admin/type.create', compact('data', 'title', 'MasterTypeData'));
        } else {
            return view('admin/login/index');
        }
    }

    public function destroy(Request $req, $idd)
    {
        if (!empty($req->session()->has('admin_data'))) {
            if ($req->session()->get('position') == "Super Admin") {
                $id = base64_decode($idd);
                $types = TypeModal::findOrFail($id);
                $types->delete();
                return redirect()->route('types.index', base64_encode($types->product_id))->with('success', 'Type deleted Successfully!');
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
                $types = TypeModal::findOrFail($id);
                $types->is_active = !$types->is_active;
                $types->save();
                return redirect()->back()->with('success', 'Status updated Successfully!');
            } else {
                return redirect()->back()->with('error', 'Sorry you dont have Permission to delete admin, Only Super admin can change status');
            }
        } else {
            return view('admin/login/index');
        }
    }
    function uploadImage($image, $folderName)
    {
        $allowedFormats = ['jpeg', 'jpg', 'webp'];
        $extension = strtolower($image->getClientOriginalExtension());
        // Check if the file format is allowed
        if (in_array($extension, $allowedFormats)) {
            $file = time() . '_' . uniqid() . '.' . $image->extension();
            $image->move(public_path("uploads/image/$folderName/"), $file);
            return "uploads/image/$folderName/" . $file;
        } else {
            // Handle invalid file format (not allowed)
            throw new InvalidFileFormatException('Invalid file format. Only jpeg, jpg, and webp files are allowed.');
        }
    }
    public function img_remove(Request $req, $idd, $column)
    {
        if (!empty($req->session()->has('admin_data'))) {
            if ($req->session()->get('position') == "Super Admin") {
                $id = base64_decode($idd);
                $product = TypeModal::where('id', $id)->first();
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
                return redirect()->back()->with('error', 'Sorry you dont have Permission to delete admin, Only Super admin can change status');
            }
        } else {
            return view('admin/login/index');
        }
    }
    public function copy(Request $req, $idd)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $id = base64_decode($idd);
            $data = TypeModal::where('id', $id)->first();
            $MasterTypeData = MasterTypeModal::with('masterAttributes')->get();
            $title =  "Copy Type";
            $copy =  "1";
            return view('admin/type.create', compact('data', 'title', 'MasterTypeData', 'copy'));
        } else {
            return view('admin/login/index');
        }
    }
    public function getSizes(Request $req, $id)
    {
        $types = TypeModal::where('product_id', $id)->get();
        $sizes = $types->map(function ($type) {
            $size = $type->size;
            return [
                'type_id' => $type->id,
                'inventory' => $type->inventory,
                'size' => $size,
            ];
        });
        return response()->json($sizes);
    }
    public function getQty(Request $req, $id)
    {
        $type = TypeModal::Find($id);
        $loop = 5;
        $inventory = [];
        for ($i = 1; $i <= $loop; $i++) {
            $inventory[] = [
                'type_id' => $id,
                'qty' => $i,
                'stock' => $type->inventory >= $i
            ];
        }
        return response()->json($inventory);
    }
}
class InvalidFileFormatException extends \Exception
{
}
