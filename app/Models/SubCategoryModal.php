<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategoryModal extends Model
{
    protected $table = 'subcategory';
    public $timestamps = true;
    protected $primaryKey = 'id';

    protected $fillable = [
        'category_id','name','image','seq','ip', 'added_by', 'is_active'
    ];
    use SoftDeletes;
    protected $del = ['deleted_at'];
    public function category()
    {
        return $this->belongsTo(CategoryModal::class, 'category_id')->withTrashed();
    }
}
