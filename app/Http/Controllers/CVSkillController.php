<?php

namespace App\Http\Controllers;

use App\Models\JobOffer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CVSkillController extends Controller
{
    public function store(Request $request, JobOffer $jobOffer): RedirectResponse
    {
        abort_unless($jobOffer->user_id === Auth::id(), 403);

        $cv = $jobOffer->cv()->firstOrFail();

        $validated = $request->validate([
            'category' => ['nullable', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
        ]);

        $validated['sort_order'] = $cv->skills()->count() + 1;

        $cv->skills()->create($validated);

        return redirect()
            ->route('job-offers.cv.edit', $jobOffer)
            ->with('success', 'Skill agregada correctamente.');
    }

    public function destroy(JobOffer $jobOffer, int $skill): RedirectResponse
    {
        abort_unless($jobOffer->user_id === Auth::id(), 403);

        $cv = $jobOffer->cv()->firstOrFail();

        $skillModel = $cv->skills()
            ->whereKey($skill)
            ->firstOrFail();

        $skillModel->delete();

        return redirect()
            ->route('job-offers.cv.edit', $jobOffer)
            ->with('success', 'Skill eliminada correctamente.');
    }

    public function update(Request $request, JobOffer $jobOffer, int $skill): RedirectResponse
    {
        abort_unless($jobOffer->user_id === Auth::id(), 403);

        $cv = $jobOffer->cv()->firstOrFail();

        $skillModel = $cv->skills()
            ->whereKey($skill)
            ->firstOrFail();

        $validated = $request->validate([
            'category' => ['nullable', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
        ]);

        $skillModel->update($validated);

        return redirect()
            ->route('job-offers.cv.edit', $jobOffer)
            ->with('success', 'Skill actualizada correctamente.');
    }
}
