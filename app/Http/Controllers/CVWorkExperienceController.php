<?php

namespace App\Http\Controllers;

use App\Models\JobOffer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CVWorkExperienceController extends Controller
{
    public function store(Request $request, JobOffer $jobOffer): RedirectResponse
    {
        abort_unless($jobOffer->user_id === Auth::id(), 403);

        $cv = $jobOffer->cv()->firstOrFail();

        $validated = $request->validate([
            'company' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'is_current' => ['nullable', 'boolean'],
            'description' => ['nullable', 'string', 'max:5000'],
        ]);

        $validated['is_current'] = $request->boolean('is_current');

        if ($validated['is_current']) {
            $validated['end_date'] = null;
        }

        $validated['sort_order'] = $cv->workExperiences()->count() + 1;

        $cv->workExperiences()->create($validated);

        return redirect()
            ->route('job-offers.cv.edit', $jobOffer)
            ->with('success', 'Experiencia laboral agregada correctamente.');
    }

    public function destroy(JobOffer $jobOffer, int $workExperience): RedirectResponse
    {
        abort_unless($jobOffer->user_id === Auth::id(), 403);

        $cv = $jobOffer->cv()->firstOrFail();

        $experience = $cv->workExperiences()
            ->whereKey($workExperience)
            ->firstOrFail();

        $experience->delete();

        return redirect()
            ->route('job-offers.cv.edit', $jobOffer)
            ->with('success', 'Experiencia laboral eliminada correctamente.');
    }
}
