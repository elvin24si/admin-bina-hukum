<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DokumenHukumSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        // Ambil foreign key dari tabel referensi
        $jenisIds = DB::table('jenis_dokumen')->pluck('jenis_id')->toArray();
        $kategoriIds = DB::table('kategori_dokumen')->pluck('kategori_id')->toArray();

        // Array untuk judul dokumen
        $judulTopics = [
            'Pengelolaan Keuangan Desa',
            'Pembangunan Infrastruktur Desa',
            'Pendataan Masyarakat',
            'Pengembangan Sumber Daya Manusia',
            'Penanggulangan Bencana',
            'Laporan Kegiatan Tahunan',
            'Perencanaan APBDes',
            'Pengadaan Barang dan Jasa',
            'Pengelolaan Aset Desa',
            'Transparansi Pemerintahan Desa',
            'Ketertiban Umum dan Keamanan',
            'Operasional Kantor Desa',
            'Pemberdayaan Masyarakat',
            'Pelayanan Administrasi',
            'Manajemen Risiko Desa',
        ];

        // Array untuk ringkasan
        $ringkasanTemplates = [
            'Dokumen ini mengatur secara rinci tentang %s sesuai ketentuan yang berlaku.',
            'Berisi pedoman pelaksanaan %s untuk meningkatkan tata kelola desa.',
            'Menguraikan prosedur, kebijakan, dan mekanisme terkait %s.',
            'Dokumen yang memuat penjabaran kegiatan dan langkah strategis mengenai %s.',
            'Menjelaskan dasar hukum, tujuan, dan ketentuan teknis dari %s.'
        ];

        for ($i = 0; $i < 30; $i++) {

            // Ambil tema acak
            $topic = $faker->randomElement($judulTopics);

            // Buat judul yang lebih natural:
            $judul = "Peraturan Desa tentang {$topic}";

            // Buat ringkasan berdasarkan template:
            $template = $faker->randomElement($ringkasanTemplates);
            $ringkasan = sprintf($template, strtolower($topic));

            DB::table('dokumen_hukum')->insert([
                'jenis_id'    => $faker->randomElement($jenisIds),
                'kategori_id' => $faker->randomElement($kategoriIds),

                'nomor'       => strtoupper($faker->unique()->bothify('DOC-####/##/##')),
                'judul'       => $judul,
                'tanggal'     => $faker->date(),

                'ringkasan'   => $ringkasan,

                'status'      => $faker->randomElement(['Aktif', 'Tidak Aktif', 'Revisi', 'Draft']),
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }
}
