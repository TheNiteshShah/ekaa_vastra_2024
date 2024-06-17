<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RkVendorOrderDetailsModal extends Model
{
    protected $table = 'rk_vendor_order_details';
    public $timestamps = true;
    protected $primaryKey = 'id';

    protected $fillable = [
        'order_id', 'product_id', 'name', 'unit', 'price', 'quantity', 'ip', 'added_by',
    ];
    use SoftDeletes;
    protected $del = ['deleted_at'];
    public function order()
    {
        return $this->belongsTo(RkVendorOrderModal::class, 'order_id');
    }
}
