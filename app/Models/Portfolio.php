<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Portfolio extends Model {
    protected $fillable = [
        'title','slug','description','image','images','category','tech_stack','tech_stack_detail',
        'link_demo','link_github','project_url','views','is_featured','is_published','sort_order',
        'client_name','features','start_date','end_date','challenge','solution','result'
    ];
    protected $casts = [
        'is_featured'=>'boolean','is_published'=>'boolean','views'=>'integer',
        'images'=>'array','tech_stack_detail'=>'array','features'=>'array'
    ];

    protected static function boot() {
        parent::boot();
        static::creating(function($model) {
            if(empty($model->slug)) $model->slug = Str::slug($model->title);
        });
    }
}