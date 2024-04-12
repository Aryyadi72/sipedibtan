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
        Schema::create('bibit_masuk', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bibit_id')->index();
            $table->integer('stok');
            $table->string('inputed_by');
            $table->timestamps();

            $table->foreign('bibit_id')->references('id')->on('bibit')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bibit_masuk');
    }
};
