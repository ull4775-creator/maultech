<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model {
    protected $fillable = ['entity_type','entity_id','action','description','user_id','status'];

    public function user() { return $this->belongsTo(\App\Models\User::class); }

    public static function log($entityType, $entityId, $action, $description) {
        return static::create([
            'entity_type' => $entityType,
            'entity_id' => $entityId,
            'action' => $action,
            'description' => $description,
            'user_id' => auth()->id(),
            'status' => 'SYNCED'
        ]);
    }
}