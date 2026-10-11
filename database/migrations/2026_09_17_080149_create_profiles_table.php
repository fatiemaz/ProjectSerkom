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
        Schema::create('profile', function (Blueprint $table) {
            $table->uuid('id_profile')->primary();
            $table->string('nama_sekolah', 40);
            $table->string('kepala_sekolah', 40);
            $table->string('foto', 100)->nullable();
            $table->string('video', 100)->nullable();
            $table->string('logo', 100)->nullable();
            $table->string('npsn', 10)->nullable();
            $table->text('alamat')->nullable();
            $table->string('kontak', 15)->nullable();
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->year('tahun_berdiri')->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile');
    }
};
