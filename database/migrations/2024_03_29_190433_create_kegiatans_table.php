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
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->id();
            // $table->enum('kegiatan', ['Sosialisasi', 'Patroli Keamanan Hutan', 'Pemadaman Kebakaran']);
            $table->string('kegiatan');
            $table->string('pelaksana');
            $table->string('lokasi');
            $table->string('keterangan');
            $table->string('foto');
            $table->string('inputed_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan');
    }
};
