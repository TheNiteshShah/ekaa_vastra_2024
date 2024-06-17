<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FabricTxnModal extends Model
{
    protected $table = 'fabric_txn';
    public $timestamps = true;
    protected $primaryKey = 'id';

    protected $fillable = [
        'fabric_id','receive','issue','unit','date','ip', 'added_by',
    ];
    use SoftDeletes;
    protected $del = ['deleted_at'];
    public function fabric()
    {
        return $this->belongsTo(FabricModal::class, 'fabric')->withTrashed();
    }
}
