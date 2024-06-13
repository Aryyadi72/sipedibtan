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
        Schema::create('penanaman', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bibit_id')->index();
            $table->integer('jumlah');
            $table->string('pelaksana', 30);
            $table->string('lokasi', 30);
            $table->string('keterangan', 50)->nullable();
            $table->string('foto');
            $table->date('tanggal');
            $table->string('inputed_by', 10);
            $table->timestamps();

            $table->foreign('bibit_id')->references('id')->on('bibit')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penanaman');
    }
};
