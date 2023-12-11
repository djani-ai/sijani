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
        Schema::create('lhps', function (Blueprint $table) {
            $table->id();
            $table->integer('no')->nullable();
            $table->string('nomor');
            $table->foreignId('tahapan_id')->nullable()->nullOnDelete();
            $table->foreignId('user_id')->nullable()->nullOnDelete();
            // $table->foreignId('jabatan_id')->nullable()->nullOnDelete();
            $table->foreignId('spt_id')->nullable()->nullOnDelete();
            $table->string('bentuk');
            $table->string('tujuan');
            $table->string('sasaran');
            $table->string('waktem');
            $table->text('uraian');
            $table->string('peristiwa_pel')->nullable();
            $table->string('tem_kejadian_pel')->nullable();
            $table->date('wak_kejadian_pel')->nullable();
            $table->string('pelaku_pel')->nullable();
            $table->string('alamat_pel')->nullable();
            $table->string('nama_saksi_1')->nullable();
            $table->string('alamat_saksi_1')->nullable();
            $table->string('nama_saksi_2')->nullable();
            $table->string('alamat_saksi_2')->nullable();
            $table->string('alat_bukti_1')->nullable();
            $table->string('alat_bukti_2')->nullable();
            $table->string('alat_bukti_3')->nullable();
            $table->string('bb_1')->nullable();
            $table->string('bb_2')->nullable();
            $table->string('bb_3')->nullable();
            $table->text('uraian_pel')->nullable();
            $table->text('fakta_pel')->nullable();
            $table->text('analisa_pel')->nullable();
            $table->string('peserta_pemilu_seng')->nullable();
            $table->string('tempat_seng')->nullable();
            $table->string('waktu_kejadian_seng')->nullable();
            $table->string('bentuk_seng')->nullable();
            $table->string('identitas_seng')->nullable();
            $table->string('hari_seng')->nullable();
            $table->string('kerugian_seng')->nullable();
            $table->text('uraian_seng')->nullable();
            $table->date('tanggal_lap_seng');
            $table->string('dok1')->nullable();
            $table->string('dok2')->nullable();
            $table->string('dok3')->nullable();
            $table->string('dok4')->nullable();
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('lhps');
    }
};
