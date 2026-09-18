<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('municipality_settings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->string('address');
            $table->string('postal_code', 10);
            $table->string('city');
            $table->string('contact_email');
            $table->string('contact_phone')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('municipality_settings');
    }
};
