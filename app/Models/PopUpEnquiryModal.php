<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PopUpEnquiryModal extends Model
{
    protected $table='popup_enquiry';
    public $timestamps=true;
	protected $primaryKey = 'id';

    protected $fillable = [
        'name','email','phone','message','ip','added_by',
    ];
    use SoftDeletes;
    protected $del = ['deleted_at'];
}
