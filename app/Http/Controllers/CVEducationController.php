<?php

namespace App\Http\Controllers;

use App\Models\JobOffer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CVEducationController extends Controller
{
    public function store(Request $request, JobOffer $jobOffer): RedirectResponse
    {
        abort_unless($jobOffer->user_id === Auth::id(), 403);

        $cv = $jobOffer->cv()->firstOrFail();

        $validated = $request->validate([
            'institution' => ['required', 'string', 'max:255'],
            'degree' => ['required', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'description' => ['nullable', 'string', 'max:3000'],
        ]);

        $validated['sort_order'] = $cv->educations()->count() + 1;

        $cv->educations()->create($validated);

        return redirect()
            ->route('job-offers.cv.edit', $jobOffer)
            ->with('success', 'Educación agregada correctamente.');
    }

    public function destroy(JobOffer $jobOffer, int $education): RedirectResponse
    {
        abort_unless($jobOffer->user_id === Auth::id(), 403);

        $cv = $jobOffer->cv()->firstOrFail();

        $educationModel = $cv->educations()
            ->whereKey($education)
            ->firstOrFail();

        $educationModel->delete();

        return redirect()
            ->route('job-offers.cv.edit', $jobOffer)
            ->with('success', 'Educación eliminada correctamente.');
    }

    public function update(Request $request, JobOffer $jobOffer, int $education): RedirectResponse
    {
        abort_unless($jobOffer->user_id === Auth::id(), 403);

        $cv = $jobOffer->cv()->firstOrFail();

        $educationModel = $cv->educations()
            ->whereKey($education)
            ->firstOrFail();

        $validated = $request->validate([
            'institution' => ['required', 'string', 'max:255'],
            'degree' => ['required', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'description' => ['nullable', 'string', 'max:3000'],
        ]);

        $educationModel->update($validated);

        return redirect()
            ->route('job-offers.cv.edit', $jobOffer)
            ->with('success', 'Educación actualizada correctamente.');
    }

    
}
