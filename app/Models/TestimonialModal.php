<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TestimonialModal extends Model
{
    protected $table = 'testimonials';
    public $timestamps = true;
    protected $primaryKey = 'id';

    protected $fillable = [
        'name','image','review','ip', 'added_by','seq'
    ];
    use SoftDeletes;
    protected $del = ['deleted_at'];
}
