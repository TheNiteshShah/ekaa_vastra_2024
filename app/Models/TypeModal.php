<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeModal extends Model
{
    protected $table = 'types';
    public $timestamps = true;
    protected $primaryKey = 'id';

    protected $fillable = [
        'product_id','inventory', 'ip', 'added_by', 'is_active','attribute1','attribute2','attribute3','attribute4'
    ];
    
    use SoftDeletes;
    protected $del = ['deleted_at'];
    public function size()
    {
        return $this->belongsTo(MasterAttributeModal::class, 'attribute1')->withTrashed();
    }
}
