<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ikan', function (Blueprint $table) {
            $table->bigIncrements('ikan_id');
            $table->string('nama');
            $table->string('jenis');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ikans');
    }
};