<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderAddressModal extends Model
{
    protected $table = 'order_address';
    public $timestamps = true;
    protected $primaryKey = 'id';

    protected $fillable = [
        'first_name', 'last_name', 'email', 'phone', 'address', 'country', 'pincode', 'state', 'city', 'ip', 'user_id', 'order_id'
    ];
    use SoftDeletes;
    protected $del = ['deleted_at'];
}
