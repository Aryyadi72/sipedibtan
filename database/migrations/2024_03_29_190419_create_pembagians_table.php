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
        Schema::create('pembagian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bibit_id')->index();
            $table->integer('jumlah');
            $table->string('lokasi');
            $table->string('keterangan');
            $table->string('foto');
            $table->string('inputed_by');
            $table->date('tanggal');
            $table->timestamps();

            $table->foreign('bibit_id')->references('id')->on('bibit')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembagian');
    }
};
