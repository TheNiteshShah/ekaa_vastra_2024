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
        'user_id','promo_id','promo_discount','total_amount','final_amount', 'payment_status', 'order_status', 'payment_type', 'address', 'ip','tracking_url'
    ];
    use SoftDeletes;
    protected $del = ['deleted_at'];
     public function user()
    {
        return $this->belongsTo(UserModal::class, 'user_id')->withTrashed();
    }
     public function promo()
    {
        return $this->belongsTo(PromoModal::class, 'promo_id')->withTrashed();
    }
}
