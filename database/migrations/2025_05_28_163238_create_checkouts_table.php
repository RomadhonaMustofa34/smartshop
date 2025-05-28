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
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();
            
            // Foreign key user_id, bisa null jika perlu
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            
            $table->string('nama');
            $table->text('alamat');
            $table->string('no_hp');
            
            // Bisa dibuat enum jika ingin validasi di DB level, contoh 'cod', 'qris'
            $table->string('payment_method'); 
            
            // product_id sebagai foreign key, sesuaikan jika tabel produk kamu berbeda nama
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            
            $table->integer('quantity')->default(1);
            
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
        Schema::dropIfExists('checkouts');
    }
};
