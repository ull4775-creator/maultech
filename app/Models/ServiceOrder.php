<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ServiceOrder extends Model {
    protected $fillable = ['order_number','service_id','client_name','client_email','client_phone','client_address','description','total_price','status','notes'];
    protected $casts = ['total_price'=>'decimal:2'];

    public function service() { return $this->belongsTo(Service::class); }

    protected static function boot() {
        parent::boot();
        static::creating(function($model) {
            if(empty($model->order_number)) {
                $model->order_number = 'ORD-' . date('Ymd') . '-' . str_pad(static::whereDate('created_at', today())->count() + 1, 4, '0', STR_PAD_LEFT);
            }
        });
    }
}