<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUsModal;

class ContactUsController extends Controller
{
    public function index(Request $req)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $foreachData = ContactUsModal::wherenull('deleted_at')->latest()->get();
            $title =  "Contact Enquiries";
            return view('admin/contact_us.index', compact('foreachData', 'title'));
        } else {
            return view('admin/login/index');
        }
    }
    
}
