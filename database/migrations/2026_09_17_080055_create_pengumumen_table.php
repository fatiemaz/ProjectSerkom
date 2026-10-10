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
        Schema::create('pengumuman', function (Blueprint $table) {
            $table->uuid('id_pengumuman')->primary();
            $table->string('judul', 150);
            $table->text('isi')->nullable();
            $table->date('tanggal')->nullable();
            $table->enum('status', ['Publish', 'Draft'])->default('Draft');
            $table->uuid('id_user');
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('user')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengumuman');
    }
};
