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
        Schema::create('bibit', function (Blueprint $table) {
            $table->id();
            $table->string('bibit', 10);
            $table->string('foto')->nullable();
            $table->string('deskripsi', 50)->nullable();
            $table->string('inputed_by', 10)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bibit');
    }
};
