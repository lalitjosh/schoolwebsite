<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('faculties', function (Blueprint $table) {
            if (! Schema::hasColumn('faculties', 'photo_position_x')) {
                $table->unsignedTinyInteger('photo_position_x')->default(50)->after('photo');
            }

            if (! Schema::hasColumn('faculties', 'photo_position_y')) {
                $table->unsignedTinyInteger('photo_position_y')->default(35)->after('photo_position_x');
            }

            if (! Schema::hasColumn('faculties', 'photo_zoom')) {
                $table->unsignedSmallInteger('photo_zoom')->default(115)->after('photo_position_y');
            }
        });
    }

    public function down(): void
    {
        Schema::table('faculties', function (Blueprint $table) {
            if (Schema::hasColumn('faculties', 'photo_zoom')) {
                $table->dropColumn('photo_zoom');
            }

            if (Schema::hasColumn('faculties', 'photo_position_y')) {
                $table->dropColumn('photo_position_y');
            }

            if (Schema::hasColumn('faculties', 'photo_position_x')) {
                $table->dropColumn('photo_position_x');
            }
        });
    }
};
