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
        Schema::table('booking', function (Blueprint $table) {
            $table->string('ikan_nama')->nullable()->after('layanan_id');
            $table->string('ikan_jenis')->nullable()->after('ikan_nama');
            $table->string('ikan_foto')->nullable()->after('ikan_jenis');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('booking', function (Blueprint $table) {
            $table->dropColumn(['ikan_nama', 'ikan_jenis', 'ikan_foto']);
        });
    }
};
