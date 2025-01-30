<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QrDetailModal extends Model
{
    protected $table = 'qr_detail';
    public $timestamps = true;
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_agent', 'ip'
    ];
}
