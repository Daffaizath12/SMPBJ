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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->date('tanggal_ambil')->nullable();
            $table->date('tanggal_kembali')->nullable();
            $table->enum('status', ['pending', 'berhasil', 'gagal'])->default('pending'); // Default 'pending'
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('tanggal_ambil');
            $table->dropColumn('tanggal_kembali');
            $table->enum('status', ['pending']);
        });
    }
};
