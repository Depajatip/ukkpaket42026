<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::table('anggota', function (Blueprint $table) {

        // Drop foreign key kalau ada
        try {
            $table->dropForeign(['nis']);
        } catch (\Exception $e) {}

        // Drop unique index
        $table->dropUnique('anggota_nis_unique');
    });
}

public function down()
{
    //
}
};
