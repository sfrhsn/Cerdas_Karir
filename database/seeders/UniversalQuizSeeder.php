<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UniversalQuizSeeder extends Seeder
{
    public function run(): void
    {
        $quizId = DB::table('quizzes')->insertGetId([
            'title'            => 'Analisis Kepribadian Kerja Universal',
            'category'         => 'Universal',
            'description'      => 'Temukan tipe kepribadian kerjamu secara holistik, terlepas dari industri atau bidang spesifik.',
            'duration_minutes' => 15,
            'is_active'        => true,
            'created_at'       => now(),
            'updated_at'       => now(),
        ]);
    }
}