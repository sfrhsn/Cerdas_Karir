<?php

namespace App\Services;

use Illuminate\Support\Str;

class ArticleGeneratorService
{
    public function __construct(protected GroqService $groq) {}

    public function generate(string $title, string $category): ?array
    {
        $system = <<<SYS
Kamu adalah penulis artikel karir profesional Indonesia.
PENTING: Balas HANYA dengan JSON valid. Jangan tambahkan teks apapun di luar JSON.
Jangan gunakan newline literal di dalam nilai string JSON — gunakan \n sebagai escape sequence.
Gunakan TEPAT nama field yang diminta: "excerpt", "content", "read_time".
SYS;

        $user = <<<USR
Tulis artikel karir lengkap:
- Judul: "{$title}"
- Kategori: {$category}

Balas dengan JSON tepat seperti ini (tidak boleh ada field lain):
{"excerpt":"ringkasan 1-2 kalimat menarik","content":"isi artikel 5 paragraf dipisahkan dengan \\n\\n","read_time":7}
USR;

        $result = $this->groq->chatJson($system, $user, 2000);

        if (!$result) return null;

        return [
            'excerpt'   => $result['excerpt']   ?? $result['ringkasan'] ?? $result['summary'] ?? Str::limit($result['content'] ?? '', 150),
            'content'   => $result['content']   ?? $result['konten']    ?? $result['isi']      ?? '',
            'read_time' => $result['read_time']  ?? $result['waktu_baca'] ?? 5,
        ];
    }
}