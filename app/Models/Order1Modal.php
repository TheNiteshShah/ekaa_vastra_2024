<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order1Modal extends Model
{
    protected $table = 'order1';
    public $timestamps = true;
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id','promo_id','promo_discount','wallet_discount','prepaid_discount','cod_charge','total_amount','final_amount', 'payment_status', 'order_status', 'payment_type', 'address_id', 'ip','shipping','txn_id','invoice_no'
    ];
    use SoftDeletes;
    protected $del = ['deleted_at'];
     public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }
     public function address()
    {
        return $this->belongsTo(OrderAddressModal::class, 'address_id')->withTrashed();
    }
    public function details()
    {
        return $this->hasMany(Order2Modal::class, 'id')->withTrashed();
    }
    // public function details()
    // {
    //     return $this->belongsTo(Order2Modal::class, 'id')->withTrashed();
    // }
     public function promo()
    {
        return $this->belongsTo(PromoModal::class, 'promo_id')->withTrashed();
    }
}
