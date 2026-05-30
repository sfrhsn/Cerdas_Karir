<?php

namespace App\Http\Controllers;

use App\Interfaces\BookmarkRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function __construct(protected BookmarkRepositoryInterface $bookmarkRepository) {}

    public function index()
    {
        $bookmarks = $this->bookmarkRepository->getByUser(Auth::id());
        return view('bookmark.index', compact('bookmarks'));
    }

    public function store(Request $request)
    {
        $request->validate(['quiz_result_id' => 'required|exists:quiz_results,id']);

        $this->bookmarkRepository->create([
            'user_id'        => Auth::id(),
            'quiz_result_id' => $request->quiz_result_id,
        ]);

        return back()->with('success', 'Bookmark ditambahkan');
    }

    public function destroy(int $id)
    {
        $bookmark = $this->bookmarkRepository->findByUserAndResult(Auth::id(), $id);

        if (!$bookmark) {
            return back()->with('error', 'Bookmark tidak ditemukan');
        }

        $this->bookmarkRepository->delete($bookmark->id);

        return back()->with('success', 'Bookmark dihapus');
    }

    public function show(int $resultId)
    {
        $bookmark = $this->bookmarkRepository->findByUserAndResult(Auth::id(), $resultId);

        if (!$bookmark) {
            abort(404);
        }

        $result = $bookmark->quizResult;

        return view('bookmark.detail', compact('bookmark', 'result'));
    }
}