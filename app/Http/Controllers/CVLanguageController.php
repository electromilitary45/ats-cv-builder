<?php

namespace App\Http\Controllers;

use App\Models\JobOffer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CVLanguageController extends Controller
{
    public function store(Request $request, JobOffer $jobOffer): RedirectResponse
    {
        abort_unless($jobOffer->user_id === Auth::id(), 403);

        $cv = $jobOffer->cv()->firstOrFail();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'level' => ['nullable', 'string', 'max:50'],
            'certification' => ['nullable', 'string', 'max:255'],
        ]);

        $validated['sort_order'] = $cv->languages()->count() + 1;

        $cv->languages()->create($validated);

        return redirect()
            ->route('job-offers.cv.edit', $jobOffer)
            ->with('success', 'Idioma agregado correctamente.');
    }

    public function destroy(JobOffer $jobOffer, int $language): RedirectResponse
    {
        abort_unless($jobOffer->user_id === Auth::id(), 403);

        $cv = $jobOffer->cv()->firstOrFail();

        $languageModel = $cv->languages()
            ->whereKey($language)
            ->firstOrFail();

        $languageModel->delete();

        return redirect()
            ->route('job-offers.cv.edit', $jobOffer)
            ->with('success', 'Idioma eliminado correctamente.');
    }
}
