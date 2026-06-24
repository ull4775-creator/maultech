<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('portfolios', function (Blueprint $table) {
            if (!Schema::hasColumn('portfolios', 'images')) {
                $table->json('images')->nullable()->after('image');
            }
            if (!Schema::hasColumn('portfolios', 'tech_stack_detail')) {
                $table->json('tech_stack_detail')->nullable()->after('tech_stack');
            }
            if (!Schema::hasColumn('portfolios', 'features')) {
                $table->json('features')->nullable()->after('tech_stack_detail');
            }
            if (!Schema::hasColumn('portfolios', 'client_name')) {
                $table->string('client_name')->nullable()->after('features');
            }
            if (!Schema::hasColumn('portfolios', 'project_url')) {
                $table->string('project_url')->nullable()->after('client_name');
            }
            if (!Schema::hasColumn('portfolios', 'start_date')) {
                $table->string('start_date')->nullable()->after('project_url');
            }
            if (!Schema::hasColumn('portfolios', 'end_date')) {
                $table->string('end_date')->nullable()->after('start_date');
            }
            if (!Schema::hasColumn('portfolios', 'challenge')) {
                $table->text('challenge')->nullable()->after('end_date');
            }
            if (!Schema::hasColumn('portfolios', 'solution')) {
                $table->text('solution')->nullable()->after('challenge');
            }
            if (!Schema::hasColumn('portfolios', 'result')) {
                $table->text('result')->nullable()->after('solution');
            }
        });
    }

    public function down(): void {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->dropColumn([
                'images', 'tech_stack_detail', 'features', 'client_name',
                'project_url', 'start_date', 'end_date', 'challenge',
                'solution', 'result'
            ]);
        });
    }
};