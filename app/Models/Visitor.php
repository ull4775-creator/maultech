<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model {
    public $timestamps = false;
    protected $fillable = ['ip_address','page_visited','browser','os','country','city','referrer','visited_at'];
    protected $casts = ['visited_at'=>'datetime'];
}