<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryModal extends Model
{
    protected $table = 'category';
    public $timestamps = true;
    protected $primaryKey = 'id';

    protected $fillable = [
        'name','image','seq','ip', 'added_by', 'is_active','slug'
    ];
    use SoftDeletes;
    protected $del = ['deleted_at'];
    public function SubCategory()
    {
        return $this->hasMany(SubCategoryModal::class, 'category_id')->orderBy('seq','asc')->where('is_active', 1);
    }
}
