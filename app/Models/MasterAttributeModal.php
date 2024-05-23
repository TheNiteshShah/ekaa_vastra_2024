<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterAttributeModal extends Model
{
    protected $table = 'master_attributes';
    public $timestamps = true;
    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 'master_id', 'ip', 'added_by', 'is_active'
    ];
    use SoftDeletes;
    protected $del = ['deleted_at'];
    
}
