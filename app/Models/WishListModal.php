<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WishListModal extends Model
{
    protected $table = 'wishlist';
    public $timestamps = true;
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id', 'product_id', 'ip'
    ];
    use SoftDeletes;
    protected $del = ['deleted_at'];
    public function product()
    {
        return $this->belongsTo(ProductModal::class, 'product_id')->withTrashed();
    }
    public function type()
    {
        return $this->belongsTo(TypeModal::class, 'type_id')->withTrashed();
    }
}