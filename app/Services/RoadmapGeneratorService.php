<?php

namespace App\Services;

class RoadmapGeneratorService
{
    public function __construct(protected GroqService $groq) {}

    public function generate(string $position, array $strengths, array $traitScores): array
    {
        $strengthsText = implode(', ', array_slice($strengths, 0, 3));
        $topTraits     = collect($traitScores)->sortDesc()->take(3)->keys()->implode(', ');

        $system = 'Kamu adalah career coach profesional Indonesia. Balas HANYA JSON valid tanpa markdown, tanpa komentar.';

        $user = <<<USR
Buatkan roadmap karir personal untuk:
- Posisi target: {$position}
- Kekuatan: {$strengthsText}
- Trait dominan: {$topTraits}

Kembalikan JSON tepat seperti ini:
{
  "title": "nama roadmap singkat (contoh: Product Management Journey)",
  "starting_rank": "Junior",
  "steps": [
    {"title": "judul langkah 1", "description": "deskripsi konkret 1-2 kalimat"},
    {"title": "judul langkah 2", "description": "deskripsi konkret 1-2 kalimat"},
    {"title": "judul langkah 3", "description": "deskripsi konkret 1-2 kalimat"},
    {"title": "judul langkah 4", "description": "deskripsi konkret 1-2 kalimat"},
    {"title": "judul langkah 5", "description": "deskripsi konkret 1-2 kalimat"}
  ]
}

Buat tepat 5 langkah progresif dari dasar ke mahir, spesifik dan actionable untuk pasar kerja Indonesia.
USR;

        $result = $this->groq->chatJson($system, $user, 1200);

        return $result ?? $this->fallback($position);
    }

    private function fallback(string $position): array
    {
        return [
            'title'         => $position . ' Journey',
            'starting_rank' => 'Junior',
            'steps'         => [
                ['title' => 'Fondasi Profesional',   'description' => 'Kuasai hard skills dan soft skills dasar yang dibutuhkan di bidang Anda.'],
                ['title' => 'Bangun Portfolio',       'description' => 'Kerjakan 2-3 proyek nyata untuk membuktikan kemampuan kepada recruiter.'],
                ['title' => 'Spesialisasi',           'description' => 'Pilih niche spesifik dan dalami keahlian yang paling relevan dengan target posisi.'],
                ['title' => 'Networking & Branding',  'description' => 'Perkuat profil LinkedIn dan aktif di komunitas industri terkait.'],
                ['title' => 'Leadership & Mentoring', 'description' => 'Mulai mentori junior dan ambil tanggung jawab yang lebih besar dalam tim.'],
            ],
        ];
    }
}