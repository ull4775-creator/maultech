<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model {
    protected $fillable = ['position','company','year_start','year_end','description','is_current','sort_order'];
    protected $casts = ['is_current'=>'boolean'];
}