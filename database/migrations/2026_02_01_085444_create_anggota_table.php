<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('anggota', function (Blueprint $table) {
            $table->id();
            $table->string('nis')->unique();
            $table->string('no_telp', 15)->nullable();
            $table->text('alamat')->nullable();
            $table->string('email', 100)->nullable();
            $table->date('tanggal_daftar')->nullable();
            $table->enum('status_anggota', ['aktif', 'nonaktif'])->default('aktif');

            $table->timestamps();

            // Foreign key
            $table->foreign('nis')
                ->references('nis')
                ->on('users')
                ->onDelete('cascade'); // user dihapus → anggota ikut
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anggota');
    }
};

