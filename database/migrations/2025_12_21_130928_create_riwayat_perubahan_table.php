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
        Schema::create('riwayat_perubahan', function (Blueprint $table) {
            $table->id('riwayat_id');
            $table->unsignedBigInteger('dokumen_id');
            $table->date('tanggal');
            $table->string('versi', 20);
            $table->text('uraian_perubahan');
            $table->timestamps();

            $table->foreign('dokumen_id')
                  ->references('dokumen_id')
                  ->on('dokumen_hukum')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_perubahan');
    }
};
