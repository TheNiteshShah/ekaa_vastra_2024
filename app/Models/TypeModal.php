<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeModal extends Model
{
    protected $table = 'types';
    public $timestamps = true;
    protected $primaryKey = 'id';

    protected $fillable = [
        'product_id','mrp','price','gst_percentage','selling_price','gst','inventory', 'ip', 'added_by', 'is_active','image','image2','image3','image4','attribute1','attribute2','attribute3','attribute4'
    ];
    
    use SoftDeletes;
    protected $del = ['deleted_at'];
}
