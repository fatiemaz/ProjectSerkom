<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profile_user', function (Blueprint $table) {
            $table->uuid('id_profile_user')->primary();
            $table->uuid('id_user')->unique();
            $table->string('nama_lengkap', 40);
            $table->string('jabatan', 40)->nullable();
            $table->string('no_hp', 15)->nullable();
            $table->text('alamat')->nullable();
            $table->string('foto', 100)->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('user')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profile_user');
    }
};
