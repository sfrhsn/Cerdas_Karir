<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\BookmarkRepositoryInterface;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class BookmarkApiController extends Controller
{
    public function __construct(protected BookmarkRepositoryInterface $bookmarkRepository) {}

    #[OA\Get(
        path: '/api/bookmarks',
        summary: 'Get semua bookmark milik user yang login',
        tags: ['Bookmarks'],
        security: [['bearerAuth' => []]],
        responses: [
            new OA\Response(response: 200, description: 'Success'),
            new OA\Response(response: 401, description: 'Unauthenticated'),
        ]
    )]
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data'   => $this->bookmarkRepository->getByUser(auth('api')->id()),
        ]);
    }

    #[OA\Post(
        path: '/api/bookmarks',
        summary: 'Tambah bookmark quiz result',
        tags: ['Bookmarks'],
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['quiz_result_id'],
                properties: [
                    new OA\Property(property: 'quiz_result_id', type: 'integer', example: 1),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: 'Bookmark created'),
            new OA\Response(response: 422, description: 'Validation error'),
            new OA\Response(response: 401, description: 'Unauthenticated'),
        ]
    )]
    public function store(Request $request)
    {
        $request->validate(['quiz_result_id' => 'required|exists:quiz_results,id']);

        $bookmark = $this->bookmarkRepository->create([
            'user_id'        => auth('api')->id(),
            'quiz_result_id' => $request->quiz_result_id,
        ]);

        return response()->json(['status' => 'success', 'data' => $bookmark], 201);
    }

    #[OA\Delete(
        path: '/api/bookmarks/{id}',
        summary: 'Hapus bookmark berdasarkan quiz_result_id',
        tags: ['Bookmarks'],
        security: [['bearerAuth' => []]],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                description: 'quiz_result_id dari bookmark yang ingin dihapus',
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: 'Bookmark deleted'),
            new OA\Response(response: 404, description: 'Not found'),
            new OA\Response(response: 401, description: 'Unauthenticated'),
        ]
    )]
    public function destroy(int $id)
    {
        $bookmark = $this->bookmarkRepository->findByUserAndResult(auth('api')->id(), $id);

        if (!$bookmark) {
            return response()->json(['status' => 'error', 'message' => 'Not found'], 404);
        }

        $this->bookmarkRepository->delete($bookmark->id);

        return response()->json(['status' => 'success', 'message' => 'Bookmark deleted']);
    }
}