<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\ArticleRepositoryInterface;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class ArticleApiController extends Controller
{
    public function __construct(protected ArticleRepositoryInterface $articleRepository) {}

    #[OA\Get(
        path: '/api/articles',
        summary: 'Get semua artikel',
        tags: ['Articles'],
        parameters: [
            new OA\Parameter(
                name: 'search',
                in: 'query',
                required: false,
                schema: new OA\Schema(type: 'string')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: 'Success')
        ]
    )]
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $articles = $this->articleRepository->search($request->search);
        } else {
            $articles = $this->articleRepository->getPublished(10);
        }

        return response()->json([
            'status' => 'success',
            'data' => $articles
        ]);
    }

    #[OA\Get(
        path: '/api/articles/{slug}',
        summary: 'Get artikel by slug',
        tags: ['Articles'],
        parameters: [
            new OA\Parameter(
                name: 'slug',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'string')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: 'Success'),
            new OA\Response(response: 404, description: 'Not Found')
        ]
    )]
    public function show(string $slug)
    {
        $article = $this->articleRepository->findBySlug($slug);

        return response()->json([
            'status' => 'success',
            'data' => $article
        ]);
    }

    #[OA\Post(
        path: '/api/articles',
        summary: 'Tambah artikel',
        tags: ['Articles'],
        responses: [
            new OA\Response(response: 201, description: 'Created')
        ]
    )]
    public function store(Request $request)
    {
        $article = $this->articleRepository->create($request->all());

        return response()->json([
            'status' => 'success',
            'data' => $article
        ], 201);
    }

    #[OA\Put(
        path: '/api/articles/{id}',
        summary: 'Update artikel',
        tags: ['Articles'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: 'Updated')
        ]
    )]
    public function update(Request $request, int $id)
    {
        $article = $this->articleRepository->update($id, $request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Article updated successfully',
            'data' => $article
        ]);
    }

    #[OA\Delete(
        path: '/api/articles/{id}',
        summary: 'Hapus artikel',
        tags: ['Articles'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: 'Deleted')
        ]
    )]
    public function destroy(int $id)
    {
        $this->articleRepository->delete($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Article deleted successfully'
        ]);
    }
}