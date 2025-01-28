<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TopBarModal extends Model
{
    protected $table = 'top_bar';
    public $timestamps = true;
    protected $primaryKey = 'id';

    protected $fillable = [
        'name','seq','ip', 'added_by', 'is_active'
    ];
    use SoftDeletes;
    protected $del = ['deleted_at'];
}
