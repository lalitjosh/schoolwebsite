<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            if (! Schema::hasColumn('settings', 'map_embed_url')) {
                $table->text('map_embed_url')->nullable()->after('address');
            }

            if (! Schema::hasColumn('settings', 'map_external_url')) {
                $table->string('map_external_url')->nullable()->after('map_embed_url');
            }
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            if (Schema::hasColumn('settings', 'map_external_url')) {
                $table->dropColumn('map_external_url');
            }

            if (Schema::hasColumn('settings', 'map_embed_url')) {
                $table->dropColumn('map_embed_url');
            }
        });
    }
};
