<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FabricModal extends Model
{
    protected $table = 'fabric';
    public $timestamps = true;
    protected $primaryKey = 'id';

    protected $fillable = [
        'vendor_id','code','image','quantity','unit','sample_price','bulk_price','date','ip', 'added_by', 'is_active'
    ];
    use SoftDeletes;
    protected $del = ['deleted_at'];
    public function vendor()
    {
        return $this->belongsTo(EvVendorModal::class, 'vendor_id')->withTrashed();
    }
}
