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
        Schema::create('dokumen_hukum', function (Blueprint $table) {
            $table->increments('dokumen_id');

            $table->unsignedInteger('jenis_id');
            $table->unsignedInteger('kategori_id');

            $table->string('nomor')->unique();
            $table->string('judul');
            $table->date('tanggal')->nullable();
            $table->text('ringkasan')->nullable();
            $table->string('status')->default('aktif');

            $table->timestamps();

            $table->foreign('jenis_id')
                ->references('jenis_id')
                ->on('jenis_dokumen')
                ->onDelete('cascade');

            $table->foreign('kategori_id')
                ->references('kategori_id')
                ->on('kategori_dokumen')
                ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_hukum');
    }
};
