<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BgImageModal extends Model
{
    protected $table = 'bg_image';
    public $timestamps = true;
    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 'web_image', 'mob_image', 'ip', 'added_by', 'is_active'
    ];
    use SoftDeletes;
    protected $del = ['deleted_at'];
}
