<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactUsModal extends Model
{
    protected $table='contact_us';
    public $timestamps=true;
	protected $primaryKey = 'id';

    protected $fillable = [
        'name','email','phone','message','ip',
    ];
    use SoftDeletes;
    protected $del = ['deleted_at'];
}
