<?php

namespace App\Services;

class CareerAnalysisService
{
    public function __construct(protected GroqService $groq) {}

    public function coreAnalysis(array $qna): array
    {
        $traits = [
            'strategic' => 0,
            'technical' => 0,
            'analytical' => 0,
            'creative' => 0,
            'leadership' => 0,
            'empathy' => 0,
        ];

        foreach ($qna as $qa) {
            $trait = strtolower($qa['trait'] ?? 'strategic');
            $score = (int) ($qa['score'] ?? 3);

            if (array_key_exists($trait, $traits)) {
                $traits[$trait] += $score;
            }
        }

        arsort($traits);

        $topTrait = array_key_first($traits);

        $map = [
            'strategic'  => 'Business Strategist',
            'technical'  => 'Software Engineer',
            'analytical' => 'Data Analyst',
            'creative'   => 'UI/UX Designer',
            'leadership' => 'Operations Manager',
            'empathy'    => 'HR Specialist',
        ];

        $position = $map[$topTrait] ?? 'Business Analyst';

        $total = array_sum($traits);

        $scores = [];
        foreach ($traits as $k => $v) {
            $scores[$k] = $total > 0
                ? round(($v / $total) * 100)
                : 0;
        }

        return [
            'position' => $position,
            'top_trait' => $topTrait,
            'trait_scores' => $scores,
            'key_strengths' => array_slice(array_keys($traits), 0, 3),
        ];
    }

    
    public function aiNarration(array $core, array $qna, string $category): array
    {
        $qaText = '';

        foreach ($qna as $i => $qa) {
            $qaText .= ($i + 1) . ". {$qa['question']}\n";
            $qaText .= "→ {$qa['selected_answer']}\n\n";
        }

        $traitScoresJson = json_encode($core['trait_scores'], JSON_PRETTY_PRINT);

        $system = "Kamu adalah career coach. Jangan ubah data, hanya menjelaskan hasil.";

        $user = <<<TXT
Kategori: {$category}

POSITION (FIXED):
{$core['position']}

TOP TRAIT:
{$core['top_trait']}

TRAIT SCORES:
{$traitScoresJson}

Jawaban:
{$qaText}

Tugas:
- analysis_summary (3 kalimat)
- short_term_advice (7 hari plan)
- growth_potential (3-5 tahun roadmap)

JANGAN UBAH DATA.

Return JSON:
{
  "analysis_summary": "",
  "short_term_advice": "",
  "growth_potential": ""
}
TXT;

        return $this->groq->chatJson($system, $user, 900) ?? [
            'analysis_summary' => 'Analisis tidak tersedia.',
            'short_term_advice' => '',
            'growth_potential' => ''
        ];
    }
}