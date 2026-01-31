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
    Schema::table('users', function (Blueprint $table) {
        $table->string('nis')->unique()->after('id');
        $table->string('nama_siswa')->after('nis');
        $table->string('kelas')->after('nama_siswa');
    });
}



    /**
     * Reverse the migrations.
     */
public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['nis', 'nama_siswa', 'kelas']);
    });
}
};
