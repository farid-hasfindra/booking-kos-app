<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('landing_infos', function (Blueprint $table) {
            $table->id();
            $table->string('text'); // e.g. "Kamar Eksklusif"
            $table->string('value'); // e.g. "20+"
            $table->string('icon')->nullable(); // Optional: class or identifier for icon
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('landing_infos');
    }
};
