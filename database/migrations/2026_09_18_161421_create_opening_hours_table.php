<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('opening_hours', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->unsignedTinyInteger('day_of_week');
            $table->boolean('is_open')->default(false);
            $table->time('morning_open')->nullable();
            $table->time('morning_close')->nullable();
            $table->time('afternoon_open')->nullable();
            $table->time('afternoon_close')->nullable();
            $table->unique('day_of_week');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('opening_hours');
    }
};
