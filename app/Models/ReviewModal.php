<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReviewModal extends Model
{
    protected $table = 'reviews';
    public $timestamps = true;
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id','product_id','review','ratings','ip'
    ];
    use SoftDeletes;
    protected $del = ['deleted_at'];
    public function user()
    {
        return $this->belongsTo(UserModal::class, 'user_id')->withTrashed();
    }
}
