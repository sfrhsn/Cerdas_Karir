<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();

        $articles = [
            [
                'title'       => 'Navigasi Karir di Era Kecerdasan Buatan: Apa yang Perlu Anda Siapkan?',
                'category'    => 'Industry Trends',
                'excerpt'     => 'Dunia kerja berubah dengan cepat. Temukan bagaimana AI membentuk ulang industri dan langkah strategis apa yang harus Anda ambil untuk tetap relevan dan kompetitif.',
                'content'     => "Kecerdasan buatan (AI) bukan lagi sekadar buzzword—ia sudah menjadi realita yang mengubah cara kita bekerja...\n\nDalam dekade terakhir, kita telah menyaksikan gelombang otomasi yang belum pernah terjadi sebelumnya. Pekerjaan-pekerjaan yang dulunya membutuhkan keahlian manusia kini mulai dapat dilakukan oleh mesin dengan lebih efisien.\n\nNamun, ini bukan berarti era kegelapan bagi para profesional. Justru sebaliknya—ada peluang besar bagi mereka yang mau beradaptasi dan mengembangkan skill yang komplementer dengan AI.",
                'read_time'   => 12,
                'is_featured' => true,
                'is_published'=> true,
            ],
            [
                'title'       => '5 Kesalahan Fatal dalam CV yang Sering Diabaikan',
                'category'    => 'CV Writing',
                'excerpt'     => 'Pastikan CV Anda lolos seleksi ATS dengan menghindari elemen-elemen desain yang tidak perlu ini.',
                'content'     => "CV adalah pintu gerbang pertama Anda ke dunia profesional. Sayangnya, banyak kandidat berbakat gagal di tahap awal hanya karena kesalahan sederhana dalam menyusun CV mereka.\n\n**1. Tidak Mengoptimalkan untuk ATS**\nApplicant Tracking System (ATS) adalah software yang digunakan sebagian besar perusahaan besar untuk menyaring ribuan lamaran...",
                'read_time'   => 8,
                'is_featured' => false,
                'is_published'=> true,
            ],
            [
                'title'       => 'Taktik Negosiasi Gaji: Dapatkan Penawaran Terbaik',
                'category'    => 'Interview Tips',
                'excerpt'     => 'Jangan langsung menerima penawaran pertama. Pelajari riset pasar dan cara menyampaikan ekspektasi Anda.',
                'content'     => "Negosiasi gaji adalah seni yang bisa dipelajari. Banyak profesional meninggalkan uang di atas meja karena terlalu cepat menerima tawaran pertama...\n\n**Riset Pasar adalah Kunci**\nSebelum masuk ke sesi negosiasi, pastikan Anda sudah melakukan riset mendalam tentang standar gaji di industri dan level Anda.",
                'read_time'   => 7,
                'is_featured' => false,
                'is_published'=> true,
            ],
            [
                'title'       => 'Membangun Networking yang Autentik Tanpa Canggung',
                'category'    => 'Networking',
                'excerpt'     => 'Networking bukan sekadar bertukar kartu nama. Temukan cara membangun relasi jangka panjang yang saling menguntungkan.',
                'content'     => "Bagi banyak orang, kata 'networking' terasa seperti beban. Bayangan berdiri canggung di pojok ruangan sambil memegang segelas minuman dan mencoba memulai percakapan dengan orang asing...\n\nPadahal, networking yang efektif justru jauh lebih sederhana dari itu.",
                'read_time'   => 6,
                'is_featured' => false,
                'is_published'=> true,
            ],
            [
                'title'       => 'Skill Digital Paling Dicari Tahun 2024',
                'category'    => 'Industry Trends',
                'excerpt'     => 'Data analytics hingga manajemen proyek hybrid. Cek apakah Anda sudah menguasai kompetensi kunci ini.',
                'content'     => "Lanskap keahlian digital terus berevolusi dengan pesat. Berikut adalah skill-skill yang paling banyak dicari oleh recruiter di tahun 2024...\n\n**1. AI Prompt Engineering**\nKemampuan berkomunikasi efektif dengan AI tools seperti ChatGPT dan Claude menjadi keahlian yang sangat bernilai.",
                'read_time'   => 9,
                'is_featured' => false,
                'is_published'=> true,
            ],
        ];

        foreach ($articles as $a) {
            Article::create([
                ...$a,
                'user_id' => $admin->id,
                'slug'    => Str::slug($a['title']) . '-' . time() . rand(100, 999),
            ]);
        }
    }
}