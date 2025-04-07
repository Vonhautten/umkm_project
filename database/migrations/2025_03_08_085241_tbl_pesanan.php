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
            $table->integer('total_harga');
            $table->string('status')->default('pending');
            $table->string('alamat');
            $table->string('metode_bayar')->default('COD');
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('tbl_user')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_pesanan');
    }
};