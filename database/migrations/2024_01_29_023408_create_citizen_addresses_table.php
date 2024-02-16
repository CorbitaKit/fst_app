<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('citizen_addresses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('citizen_id');
            $table->string('address');
            $table->string('postcode');
            $table->foreignId('city_id');
            $table->foreignId('region_id');
            $table->foreignId('municipality_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citizen_addresses');
    }
};
