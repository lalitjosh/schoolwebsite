<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('exam_name')->nullable();
            $table->string('grade')->nullable();
            $table->string('academic_year')->nullable();
            $table->date('result_date')->nullable();
            $table->text('description')->nullable();
            $table->string('file')->nullable();
            $table->string('external_url')->nullable();
            $table->boolean('is_published')->default(true);
            $table->timestamps();

            $table->index(['is_published', 'result_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
