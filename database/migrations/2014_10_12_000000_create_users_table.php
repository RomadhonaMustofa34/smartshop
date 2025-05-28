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
        Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email')->unique();
    $table->timestamp('email_verified_at')->nullable(); // standar Laravel
    $table->string('password');
    $table->string('alamat')->nullable(); // boleh null kalau belum diisi
    $table->string('no_hp', 20)->nullable(); // panjang dibatasi & bisa null
    $table->rememberToken(); // untuk login remember me
    $table->timestamps();
});

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
