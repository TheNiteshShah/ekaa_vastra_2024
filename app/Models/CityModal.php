<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CityModal extends Model
{
    protected $table = 'all_cities';
    public $timestamps = true;
    protected $primaryKey = 'id';

    protected $fillable = [
        'name','state_id'
    ];
    public function state()
    {
        return $this->belongsTo(StateModal::class, 'state_id');
    }
}
