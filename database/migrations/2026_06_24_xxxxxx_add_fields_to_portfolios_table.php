<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->json('images')->nullable()->after('image');
            $table->json('tech_stack_detail')->nullable()->after('tech_stack');
            $table->json('features')->nullable()->after('tech_stack_detail');
            $table->string('client_name')->nullable()->after('features');
            $table->string('project_url')->nullable()->after('client_name');
            $table->string('start_date')->nullable()->after('project_url');
            $table->string('end_date')->nullable()->after('start_date');
            $table->text('challenge')->nullable()->after('end_date');
            $table->text('solution')->nullable()->after('challenge');
            $table->text('result')->nullable()->after('solution');
        });
    }
    public function down(): void {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->dropColumn(['images', 'tech_stack_detail', 'features', 'client_name', 'project_url', 'start_date', 'end_date', 'challenge', 'solution', 'result']);
        });
    }
};