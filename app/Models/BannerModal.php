<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BannerModal extends Model
{
    protected $table = 'banners';
    public $timestamps = true;
    protected $primaryKey = 'id';

    protected $fillable = [
        'web_image','mob_image', 'link','ip', 'added_by', 'is_active'
    ];
    use SoftDeletes;
    protected $del = ['deleted_at'];
}
