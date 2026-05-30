<?php

namespace Database\Seeders;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\Option;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    public function run(): void
    {
        $quizzes = [
            [
                'title'            => 'Teknologi & Inovasi',
                'category'         => 'Teknologi',
                'description'      => 'Jelajahi dunia rekayasa perangkat lunak, data science, dan kecerdasan buatan.',
                'duration_minutes' => 10,
            ],
            [
                'title'            => 'Industri Kreatif',
                'category'         => 'Industri Kreatif',
                'description'      => 'Dapatkan dirimu di dunia desain, copy-writing, atau produksi media digital.',
                'duration_minutes' => 10,
            ],
        ];

        foreach ($quizzes as $qData) {
            $quiz = Quiz::create($qData);

            // Tambah 10 pertanyaan per quiz
            $questions = [
                [
                    'text' => 'Bagaimana pendekatan Anda dalam memecahkan masalah teknis yang kompleks?',
                    'tag'  => 'Technical Capability',
                    'options' => [
                        ['A', 'Saya langsung memulai coding untuk menguji ide-ide awal secara praktis.', 'technical', 3],
                        ['B', 'Saya menganalisis arsitektur sistem secara menyeluruh sebelum membuat langkah pertama.', 'analytical', 4],
                        ['C', 'Saya mendiskusikan masalah dengan tim untuk mendapatkan perspektif yang berbeda.', 'leadership', 3],
                        ['D', 'Saya memecah masalah besar menjadi tugas-tugas kecil yang lebih terkelola.', 'strategic', 4],
                    ],
                ],
                [
                    'text' => 'Apa yang paling memotivasi Anda dalam pekerjaan?',
                    'tag'  => 'Motivasi',
                    'options' => [
                        ['A', 'Menyelesaikan masalah teknis yang menantang.', 'technical', 4],
                        ['B', 'Memimpin tim menuju tujuan bersama.', 'leadership', 4],
                        ['C', 'Menciptakan dampak nyata bagi pengguna.', 'strategic', 4],
                        ['D', 'Mengeksplorasi data dan menemukan pola tersembunyi.', 'analytical', 4],
                    ],
                ],
                [
                    'text' => 'Bagaimana Anda merespons ketika proyek mengalami perubahan mendadak?',
                    'tag'  => 'Adaptabilitas',
                    'options' => [
                        ['A', 'Saya merasa frustrasi tapi bisa beradaptasi dengan cepat.', 'technical', 2],
                        ['B', 'Saya langsung membuat rencana baru dan mendelegasikan tugas.', 'leadership', 4],
                        ['C', 'Saya mencari akar permasalahan sebelum mengambil tindakan.', 'analytical', 3],
                        ['D', 'Saya melihatnya sebagai peluang untuk berinovasi.', 'creative', 4],
                    ],
                ],
                [
                    'text' => 'Dalam lingkungan kerja ideal Anda, Anda lebih suka...',
                    'tag'  => 'Work Style',
                    'options' => [
                        ['A', 'Bekerja mandiri dengan fokus penuh pada tugas teknis.', 'technical', 3],
                        ['B', 'Berkolaborasi erat dengan tim lintas fungsi.', 'leadership', 4],
                        ['C', 'Menganalisis data dan membuat laporan strategis.', 'analytical', 4],
                        ['D', 'Bereksperimen dengan ide-ide kreatif baru.', 'creative', 4],
                    ],
                ],
                [
                    'text' => 'Ketika membuat keputusan penting, Anda mengandalkan...',
                    'tag'  => 'Decision Making',
                    'options' => [
                        ['A', 'Data dan angka yang sudah terbukti.', 'analytical', 5],
                        ['B', 'Intuisi dan pengalaman saya.', 'leadership', 3],
                        ['C', 'Konsensus dari tim dan stakeholder.', 'empathy', 3],
                        ['D', 'Visi jangka panjang dan strategi bisnis.', 'strategic', 5],
                    ],
                ],
                [
                    'text' => 'Skill apa yang paling ingin Anda kembangkan dalam 2 tahun ke depan?',
                    'tag'  => 'Growth',
                    'options' => [
                        ['A', 'Keahlian teknis yang lebih mendalam (coding, sistem).', 'technical', 4],
                        ['B', 'Kemampuan kepemimpinan dan manajemen orang.', 'leadership', 5],
                        ['C', 'Analisis data dan business intelligence.', 'analytical', 4],
                        ['D', 'Strategi bisnis dan product management.', 'strategic', 5],
                    ],
                ],
                [
                    'text' => 'Apa reaksi Anda ketika menerima kritik terhadap pekerjaan Anda?',
                    'tag'  => 'EQ',
                    'options' => [
                        ['A', 'Saya mempertanyakan validitas kritik tersebut.', 'technical', 1],
                        ['B', 'Saya mendengarkan, menganalisis, dan mengambil yang konstruktif.', 'analytical', 5],
                        ['C', 'Saya merasa termotivasi untuk membuktikan kemampuan saya.', 'leadership', 3],
                        ['D', 'Saya menggunakan kritik sebagai bahan untuk bereksperimen ulang.', 'creative', 4],
                    ],
                ],
                [
                    'text' => 'Proyek impian Anda adalah...',
                    'tag'  => 'Vision',
                    'options' => [
                        ['A', 'Membangun sistem backend yang powerful dan scalable.', 'technical', 4],
                        ['B', 'Meluncurkan produk baru dari nol hingga market fit.', 'strategic', 5],
                        ['C', 'Membangun tim yang solid dan budaya kerja positif.', 'leadership', 4],
                        ['D', 'Menciptakan dashboard analitik yang mengubah cara bisnis mengambil keputusan.', 'analytical', 5],
                    ],
                ],
                [
                    'text' => 'Bagaimana Anda membangun hubungan dengan rekan kerja baru?',
                    'tag'  => 'Interpersonal',
                    'options' => [
                        ['A', 'Saya membutuhkan waktu untuk mengamati sebelum membuka diri.', 'analytical', 2],
                        ['B', 'Saya langsung mencari kesamaan dan membangun koneksi personal.', 'empathy', 5],
                        ['C', 'Saya fokus pada kolaborasi profesional terlebih dahulu.', 'technical', 3],
                        ['D', 'Saya suka mengajak brainstorming dan berbagi ide.', 'creative', 4],
                    ],
                ],
                [
                    'text' => 'Dalam 5 tahun ke depan, Anda membayangkan diri sebagai...',
                    'tag'  => 'Career Vision',
                    'options' => [
                        ['A', 'Principal Engineer atau Technical Architect.', 'technical', 5],
                        ['B', 'VP Product atau Chief Product Officer.', 'strategic', 5],
                        ['C', 'Head of Data atau Chief Data Officer.', 'analytical', 5],
                        ['D', 'Engineering Manager atau CTO.', 'leadership', 5],
                    ],
                ],
            ];

            foreach ($questions as $order => $qItem) {
                $question = Question::create([
                    'quiz_id'      => $quiz->id,
                    'question_text'=> $qItem['text'],
                    'category_tag' => $qItem['tag'],
                    'order'        => $order + 1,
                ]);

                foreach ($qItem['options'] as $opt) {
                    Option::create([
                        'question_id'  => $question->id,
                        'option_label' => $opt[0],
                        'option_text'  => $opt[1],
                        'trait_key'    => $opt[2],
                        'score'        => $opt[3],
                    ]);
                }
            }
        }
    }
}