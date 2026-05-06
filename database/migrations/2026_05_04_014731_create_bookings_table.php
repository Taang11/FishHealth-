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
        Schema::create('booking', function (Blueprint $table) {
    $table->bigIncrements('booking_id');

    $table->unsignedBigInteger('user_id');
    $table->unsignedBigInteger('teknisi_id');
    $table->unsignedBigInteger('layanan_id');

    $table->date('tanggal');
    $table->time('jam');
    $table->enum('status', ['pending', 'accepted', 'selesai']);
    $table->timestamps();

    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    $table->foreign('teknisi_id')->references('teknisi_id')->on('teknisi')->onDelete('cascade');
    $table->foreign('layanan_id')->references('layanan_id')->on('layanan')->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
