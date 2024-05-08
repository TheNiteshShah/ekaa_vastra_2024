<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterTypeModal extends Model
{
    protected $table = 'master_types';
    public $timestamps = true;
    protected $primaryKey = 'id';

    protected $fillable = [
        'name','image','seq','ip', 'added_by', 'is_active'
    ];
    use SoftDeletes;
    protected $del = ['deleted_at'];
    public function masterAttributes()
    {
        return $this->hasMany(MasterAttributeModal::class, 'master_id')->where('is_active', 1);
    }
    
}
