<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StateModal extends Model
{
    protected $table = 'all_states';
    public $timestamps = true;
    protected $primaryKey = 'id';

    protected $fillable = [
        'name'
    ];
}
