<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PopUpEnquiryModal;

class PopUpEnquiryController extends Controller
{
    public function index(Request $req)
    {
        if (!empty($req->session()->has('admin_data'))) {
            $foreachData = PopUpEnquiryModal::wherenull('deleted_at')->latest()->get();
            $title =  "Popup Enquiries";
            return view('admin/popup_enquiry.index', compact('foreachData', 'title'));
        } else {
            return view('admin/login/index');
        }
    }
    
}
