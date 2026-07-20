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
        Schema::table('products', function (Blueprint $table) {
            $table->string('merk')->nullable()->after('nama_barang');
            $table->integer('tahun')->nullable()->after('merk');
            $table->string('warna')->nullable()->after('tahun');
            $table->string('no_polisi')->nullable()->after('warna');
            $table->enum('status', ['tersedia', 'terjual', 'booking'])->default('tersedia')->after('no_polisi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['merk', 'tahun', 'warna', 'no_polisi', 'status']);
        });
    }
};