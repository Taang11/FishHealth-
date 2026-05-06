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
        Schema::create('pembayaran', function (Blueprint $table) {
    $table->bigIncrements('pembayaran_id');

    $table->unsignedBigInteger('booking_id');

    $table->integer('jumlah');
    $table->enum('status', ['pending', 'paid']);
    $table->timestamps();

    $table->foreign('booking_id')->references('booking_id')->on('booking')->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
