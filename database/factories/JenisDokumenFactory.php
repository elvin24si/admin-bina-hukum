<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class JenisDokumenFactory extends Factory
{
    public function definition(): array
    {
        $jenis = [
            'Peraturan Desa',
            'Keputusan Kepala Desa',
            'Peraturan Kepala Desa',
            'Berita Acara',
            'Surat Keputusan',
            'Surat Edaran',
            'Surat Pernyataan',
            'Surat Permohonan',
            'Surat Pengantar',
            'Surat Keterangan',
            'Dokumen Rencana Kerja',
            'Dokumen RPJM Desa',
            'Dokumen RKP Desa',
            'Dokumen Laporan Realisasi',
            'Dokumen Musyawarah Desa',
            'Dokumen RAB',
            'Dokumen LPJ',
            'Dokumen Inventarisasi',
            'Dokumen Perjanjian Kerjasama',
            'Dokumen Notulen Rapat',
            'Dokumen Proposal',
            'Dokumen SPJ',
            'Dokumen Administrasi Umum',
            'Dokumen Arsip Surat',
            'Dokumen Profil Desa',
            'Dokumen APBDes',
            'Dokumen Laporan Kegiatan',
            'Dokumen Evaluasi Program',
            'Dokumen Pengawasan',
            'Dokumen Laporan Tahunan',
        ];

        $namaJenis = $this->faker->unique()->randomElement($jenis);

        return [
            'nama_jenis' => $namaJenis,
            'deskripsi' => "Dokumen terkait {$namaJenis} sesuai ketentuan administrasi dan peraturan yang berlaku.",
        ];
    }
}
