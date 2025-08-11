<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RkVendorProductModal extends Model
{
    protected $table = 'rk_vendor_products';
    public $timestamps = true;
    protected $primaryKey = 'id';

    protected $fillable = [
        'vendor_id','name','unit','price','ip', 'added_by', 'is_active','hsn_code'
    ];
    use SoftDeletes;
    protected $del = ['deleted_at'];
    public function vendor()
    {
        return $this->belongsTo(RkVendorModal::class, 'vendor_id');
    }
}
