<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model {
    protected $fillable = ['title','slug','description','icon','image','price_min','price_max','price_label','status','features','sort_order'];
    protected $casts = ['features'=>'array','price_min'=>'decimal:2','price_max'=>'decimal:2'];

    public function orders() { return $this->hasMany(ServiceOrder::class); }

    protected static function boot() {
        parent::boot();
        static::creating(function($model) {
            if(empty($model->slug)) $model->slug = Str::slug($model->title);
        });
    }
}