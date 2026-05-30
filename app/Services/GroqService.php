<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GroqService
{
    protected string $apiKey;
    protected string $apiUrl;
    protected string $model;

    public function __construct()
    {
        $this->apiKey = trim(config('services.groq.key', ''));
        $this->apiUrl = config('services.groq.url', 'https://api.groq.com/openai/v1/chat/completions');
        $this->model  = config('services.groq.model', 'llama-3.1-8b-instant');
    }

    public function chat(string $systemPrompt, string $userPrompt, int $maxTokens = 1024): ?string
    {
        if (empty($this->apiKey)) {
            Log::warning('Groq API key tidak dikonfigurasi.');
            return null;
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type'  => 'application/json',
            ])->timeout(30)->post($this->apiUrl, [
                'model'       => $this->model,
                'max_tokens'  => $maxTokens,
                'temperature' => 0.7,
                'messages'    => [
                    ['role' => 'system', 'content' => $systemPrompt],
                    ['role' => 'user',   'content' => $userPrompt],
                ],
            ]);

            if ($response->successful()) {
                return $response->json('choices.0.message.content');
            }

            Log::error('Groq API error: ' . $response->status() . ' - ' . $response->body());
            return null;

        } catch (\Exception $e) {
            Log::error('Groq exception: ' . $e->getMessage());
            return null;
        }
    }

    public function chatJson(string $systemPrompt, string $userPrompt, int $maxTokens = 1024): ?array
    {
        $raw = $this->chat($systemPrompt, $userPrompt, $maxTokens);
        if (!$raw) return null;

        $clean = preg_replace('/```json\s*/i', '', $raw);
        $clean = preg_replace('/```\s*/', '', $clean);
        $clean = trim($clean);

        if (preg_match('/\{.*\}/s', $clean, $matches)) {
            $clean = $matches[0];
        }

        $clean = $this->sanitizeJsonString($clean);

        $decoded = json_decode($clean, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            Log::error('Groq JSON decode error: ' . json_last_error_msg() . ' | cleaned: ' . substr($clean, 0, 400));
            
            $decoded = json_decode($clean, true, 512, JSON_INVALID_UTF8_SUBSTITUTE);
            if (json_last_error() !== JSON_ERROR_NONE) {
                return null;
            }
        }

        return $decoded;
    }


    private function sanitizeJsonString(string $json): string
    {
        $result = '';
        $inString = false;
        $escape = false;
        $len = strlen($json);

        for ($i = 0; $i < $len; $i++) {
            $char = $json[$i];
            $ord  = ord($char);

            if ($escape) {
                $result .= $char;
                $escape = false;
                continue;
            }

            if ($char === '\\' && $inString) {
                $result .= $char;
                $escape = true;
                continue;
            }

            if ($char === '"') {
                $inString = !$inString;
                $result .= $char;
                continue;
            }

            if ($inString && $ord < 0x20) {
                switch ($ord) {
                    case 0x09: $result .= '\\t';  break; // tab
                    case 0x0A: $result .= '\\n';  break; // newline
                    case 0x0D: $result .= '\\r';  break; // carriage return
                    case 0x08: $result .= '\\b';  break; // backspace
                    case 0x0C: $result .= '\\f';  break; // form feed
                    default:   $result .= sprintf('\\u%04x', $ord); break;
                }
                continue;
            }

            $result .= $char;
        }

        return $result;
    }
}