<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\QuizRepositoryInterface;
use App\Interfaces\QuizResultRepositoryInterface;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class QuizApiController extends Controller
{
    public function __construct(
        protected QuizRepositoryInterface $quizRepository,
        protected QuizResultRepositoryInterface $quizResultRepository,
    ) {}

    #[OA\Get(
        path: '/api/quizzes',
        summary: 'Get semua quiz yang aktif',
        tags: ['Quiz'],
        responses: [
            new OA\Response(response: 200, description: 'Success'),
        ]
    )]
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data'   => $this->quizRepository->getActive(),
        ]);
    }

    #[OA\Get(
        path: '/api/quizzes/{id}',
        summary: 'Get detail quiz beserta pertanyaan dan opsi jawaban',
        tags: ['Quiz'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: 'Success'),
            new OA\Response(response: 404, description: 'Not found'),
        ]
    )]
    public function show(int $id)
    {
        return response()->json([
            'status' => 'success',
            'data'   => $this->quizRepository->findById($id),
        ]);
    }

    #[OA\Post(
        path: '/api/quizzes/{id}/submit',
        summary: 'Submit jawaban quiz dan dapatkan hasil analisis karir',
        tags: ['Quiz'],
        security: [['bearerAuth' => []]],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['answers'],
                properties: [
                    new OA\Property(
                        property: 'answers',
                        type: 'object',
                        example: ['1' => 2, '2' => 5, '3' => 8],
                        description: 'Key = question_id, Value = option_id'
                    ),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: 'Quiz result created dengan rekomendasi posisi karir'),
            new OA\Response(response: 401, description: 'Unauthenticated'),
        ]
    )]
    public function submit(Request $request, int $id)
    {
        $quiz    = $this->quizRepository->findById($id);
        $answers = $request->input('answers', []);

        $traitScores = [];
        foreach ($quiz->questions as $question) {
            $selectedOptionId = $answers[$question->id] ?? null;
            if ($selectedOptionId) {
                $option = $question->options->find($selectedOptionId);
                if ($option && $option->trait_key) {
                    $traitScores[$option->trait_key] = ($traitScores[$option->trait_key] ?? 0) + $option->score;
                }
            }
        }

        arsort($traitScores);
        $topTrait    = array_key_first($traitScores);
        $positionMap = [
            'strategic'  => 'Senior Product Manager',
            'technical'  => 'Senior Software Engineer',
            'creative'   => 'Creative Director',
            'analytical' => 'Data Analyst',
            'leadership' => 'Team Lead / Manager',
            'empathy'    => 'HR Business Partner',
        ];

        $result = $this->quizResultRepository->create([
            'user_id'              => auth('api')->id(),
            'quiz_id'              => $quiz->id,
            'recommended_position' => $positionMap[$topTrait] ?? 'Business Analyst',
            'analysis_summary'     => 'Berdasarkan analisis psikometrik Anda.',
            'trait_scores'         => $traitScores,
            'key_strengths'        => array_slice(array_keys($traitScores), 0, 2),
            'answers'              => $answers,
        ]);

        return response()->json(['status' => 'success', 'data' => $result], 201);
    }

    #[OA\Get(
        path: '/api/quiz-results/{id}',
        summary: 'Get hasil quiz berdasarkan result ID',
        tags: ['Quiz'],
        security: [['bearerAuth' => []]],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: 'Success'),
            new OA\Response(response: 403, description: 'Forbidden - bukan milik user ini'),
            new OA\Response(response: 401, description: 'Unauthenticated'),
        ]
    )]
    public function result(int $resultId)
    {
        $result = $this->quizResultRepository->findById($resultId);

        if ($result->user_id !== auth('api')->id()) {
            return response()->json(['status' => 'error', 'message' => 'Forbidden'], 403);
        }

        return response()->json(['status' => 'success', 'data' => $result]);
    }
}