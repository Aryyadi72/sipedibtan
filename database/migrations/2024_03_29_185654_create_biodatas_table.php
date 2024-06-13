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
        Schema::create('biodata', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id')->index()->nullable();
            $table->string('nama', 30);
            $table->string('alamat', 30)->nullable();
            $table->enum('jenis_kelamin', ['Pria', 'Wanita'])->nullable();
            $table->integer('umur')->nullable();
            $table->string('tempat_lahir', 10)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('no_ktp', 30)->nullable();
            $table->string('no_telpon', 30)->nullable();
            $table->string('pendidikan', 10)->nullable();
            $table->string('agama', 10)->nullable();
            $table->string('domisili', 30)->nullable();
            $table->string('inputed_by', 10)->nullable();
            $table->timestamps();

            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biodata');
    }
};
