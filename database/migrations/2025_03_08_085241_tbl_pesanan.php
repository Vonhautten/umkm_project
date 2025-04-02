<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_pesanan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('produk_id');
            $table->integer('jumlah');
            $table->integer('total_harga');
            $table->string('status')->default('pending');
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('tbl_user')->onDelete('cascade');
            $table->foreign('produk_id')->references('id')->on('tbl_produk')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_pesanan');
    }
};