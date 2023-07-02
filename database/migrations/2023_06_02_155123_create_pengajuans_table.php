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
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mahasiswa');
            $table->char('npm', 10);
            $table->bigInteger('user_id')->unsigned();
            $table->string('program_studi');
            $table->string('semester', 2);
            $table->string('photo');
            $table->string('sertifikat');
            $table->string('video');
            $table->char('status_pengajuan', 1)->default('2');
            $table->string('alamat');
            $table->string('no_hp');
            $table->text('keterangan')->nullable();
            $table->bigInteger('ormawa_id')->unsigned()->nullable();
            $table->bigInteger('periode_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('ormawa_id')->references('id')->on('ormawas')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('periode_id')->references('id')->on('periodes')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuans');
    }
};
