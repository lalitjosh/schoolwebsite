<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            if (! Schema::hasColumn('settings', 'tagline')) {
                $table->string('tagline')->nullable()->after('school_name');
            }
            if (! Schema::hasColumn('settings', 'established_year')) {
                $table->string('established_year')->nullable()->after('tagline');
            }
            if (! Schema::hasColumn('settings', 'footer_about')) {
                $table->text('footer_about')->nullable()->after('youtube');
            }
            if (! Schema::hasColumn('settings', 'footer_credit')) {
                $table->string('footer_credit')->nullable()->after('footer_about');
            }
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            foreach (['tagline', 'established_year', 'footer_about', 'footer_credit'] as $column) {
                if (Schema::hasColumn('settings', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
