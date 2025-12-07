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
        Schema::create('lampiran_dokumen', function (Blueprint $table) {
    $table->bigIncrements('lampiran_id');
    $table->unsignedBigInteger('dokumen_id'); // FK ke dokumen_hukum
    $table->text('keterangan')->nullable();
    $table->timestamps();

    // FK boleh ada di sini, karena ini tabel utama
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
        //
    }
};
