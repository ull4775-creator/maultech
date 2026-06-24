<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model {
    protected $fillable = ['client_name','client_position','client_avatar','message','rating','is_published','sort_order'];
    protected $casts = ['is_published'=>'boolean','rating'=>'integer'];
}