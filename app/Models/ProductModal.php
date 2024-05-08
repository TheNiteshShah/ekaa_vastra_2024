<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductModal extends Model
{
    protected $table = 'products';
    public $timestamps = true;
    protected $primaryKey = 'id';

    protected $fillable = [
        'category_id','subcategory_id','name','sku','description','is_top', 'ip', 'added_by', 'is_active','is_trending','seq'
    ];
    
    use SoftDeletes;
    protected $del = ['deleted_at'];
    public function types()
    {
        return $this->hasMany(TypeModal::class, 'product_id')->where('is_active', 1);
    }
}
