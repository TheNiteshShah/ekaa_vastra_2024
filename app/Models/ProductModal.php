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
        'category_id','subcategory_id','name','sku','short_description','description','is_top', 'ip', 'added_by', 'is_active','is_trending','seq','mrp','price','gst_percentage','selling_price','gst','image','image2','image3','image4','label','size_chart','seo_title','seo_description','seo_keywords','slug'
    ];
    
    use SoftDeletes;
    protected $del = ['deleted_at'];
    public function types()
    {
        return $this->hasMany(TypeModal::class, 'product_id')->where('is_active', 1);
    }
    public function category()
    {
        return $this->belongsTo(CategoryModal::class, 'category_id')->withTrashed();
    }
    public function subcategory()
    {
        return $this->belongsTo(SubCategoryModal::class, 'subcategory_id')->withTrashed();
    }
}
