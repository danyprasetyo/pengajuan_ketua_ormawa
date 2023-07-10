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
        Schema::table('pengajuans', function (Blueprint $table) {
            $table->string('scan_ktm')->nullable();
            $table->string('suket_mhs_aktif')->nullable();
            $table->string('surat_kebersediaan')->nullable();
            $table->string('suket_rekomendasi')->nullable();
            $table->string('nilai_ipk')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuans', function (Blueprint $table) {
            $table->dropColumn('scan_ktm');
            $table->dropColumn('suket_mhs_aktif');
            $table->dropColumn('surat_kebersediaan');
            $table->dropColumn('suket_rekomendasi');
            $table->dropColumn('nilai_ipk');
        });
    }
};
