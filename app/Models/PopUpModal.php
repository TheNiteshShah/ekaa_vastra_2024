<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PopUpModal extends Model
{
    protected $table = 'popup';
    public $timestamps = true;
    protected $primaryKey = 'id';

    protected $fillable = [
        'image', 'link','ip', 'added_by', 'is_active','form_active'
    ];
    use SoftDeletes;
    protected $del = ['deleted_at'];
}
