<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
{
    Schema::table('checkouts', function (Blueprint $table) {
        $table->enum('status', ['diproses', 'dikemas', 'dikirim', 'selesai', 'ditolak', 'dibatalkan', 'return'])->default('diproses');
    });
}

public function down()
{
    Schema::table('checkouts', function (Blueprint $table) {
        $table->dropColumn('status');
    });
}
};
