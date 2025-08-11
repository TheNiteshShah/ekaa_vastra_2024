<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RkVendorOrderModal extends Model
{
    protected $table = 'rk_vendor_order';
    public $timestamps = true;
    protected $primaryKey = 'id';

    protected $fillable = [
        'vendor_id', 'invoice_no', 'invoice_date', 'sub_total', 'gst', 'gst_amount', 'total_amount', 'ip', 'added_by','hsn_code'
    ];
    use SoftDeletes;
    protected $del = ['deleted_at'];
    public function vendor()
    {
        return $this->belongsTo(RkVendorModal::class, 'vendor_id');
    }
    public function orderDetails()
    {
        return $this->hasMany(RkVendorOrderDetailsModal::class, 'order_id');
    }
}
