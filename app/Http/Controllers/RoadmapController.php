<?php

namespace App\Http\Controllers;

use App\Models\Roadmap;
use App\Models\RoadmapStep;
use App\Interfaces\QuizResultRepositoryInterface;
use App\Services\RoadmapGeneratorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoadmapController extends Controller
{
    public function __construct(
        protected QuizResultRepositoryInterface $quizResultRepository,
        protected RoadmapGeneratorService       $roadmapGenerator,
    ) {}

    public function show(int $resultId)
    {
        $result  = $this->quizResultRepository->findById($resultId);
        abort_if($result->user_id !== Auth::id(), 403);

        $roadmap = $result->roadmap ?? $this->generateRoadmap($result);

        return view('roadmap.show', compact('roadmap', 'result'));
    }

    private function generateRoadmap($result): Roadmap
    {
        // Generate via AI
        $aiData = $this->roadmapGenerator->generate(
            $result->recommended_position,
            $result->key_strengths ?? [],
            $result->trait_scores  ?? []
        );

        $roadmap = Roadmap::create([
            'quiz_result_id' => $result->id,
            'user_id'        => $result->user_id,
            'title'          => $aiData['title']         ?? $result->recommended_position . ' Journey',
            'overall_rank'   => $aiData['starting_rank'] ?? 'Junior',
            'steps_done'     => 0,
        ]);

        $steps = $aiData['steps'] ?? [];
        foreach ($steps as $order => $step) {
            RoadmapStep::create([
                'roadmap_id'  => $roadmap->id,
                'title'       => $step['title']       ?? 'Step ' . ($order + 1),
                'description' => $step['description'] ?? '',
                'status'      => $order === 0 ? 'in_progress' : 'not_started',
                'order'       => $order + 1,
            ]);
        }

        return $roadmap->load('steps');
    }

    public function updateStep(Request $request, int $stepId)
    {
        $step = RoadmapStep::findOrFail($stepId);
        abort_if($step->roadmap->user_id !== Auth::id(), 403);

        $step->update(['status' => $request->input('status')]);

        $roadmap = $step->roadmap;
        $roadmap->update([
            'steps_done' => $roadmap->steps()->where('status', 'completed')->count(),
        ]);

        return back()->with('success', 'Progress diperbarui!');
    }
}