<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PromoModal extends Model
{
    protected $table = 'promocodes';
    public $timestamps = true;
    protected $primaryKey = 'id';

    protected $fillable = [
        'name','type','discount_type','discount','max_discount','mini_amount','expiry_date','ip', 'added_by', 'is_active',
    ];
    use SoftDeletes;
    protected $del = ['deleted_at'];
}
