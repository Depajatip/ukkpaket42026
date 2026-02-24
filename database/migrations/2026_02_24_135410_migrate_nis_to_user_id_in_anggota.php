<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    DB::statement("
        UPDATE anggota
        JOIN users ON anggota.nis = users.nis
        SET anggota.user_id = users.id
    ");
}

public function down()
{
    //
}
};
