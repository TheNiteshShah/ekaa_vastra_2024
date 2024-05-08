<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RkVendorModal extends Model
{
    protected $table = 'rk_vendor';
    public $timestamps = true;
    protected $primaryKey = 'id';

    protected $fillable = [
        'name','business_name','gst','address','phone','city','state','pin_code','ip', 'added_by', 'is_active',
    ];
    use SoftDeletes;
    protected $del = ['deleted_at'];
    public function city()
    {
        return $this->belongsTo(CityModal::class, 'city_id');
    }
}
