<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void {
        DB::table('settings')->insertOrIgnore([
            ['key' => 'favicon', 'value' => '', 'type' => 'image', 'group' => 'general', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'profile_photo', 'value' => '', 'type' => 'image', 'group' => 'general', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
    public function down(): void {
        DB::table('settings')->whereIn('key', ['favicon', 'profile_photo'])->delete();
    }
};