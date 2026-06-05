<?php

namespace App\Http\Controllers;

use App\Models\JobOffer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CVCertificationController extends Controller
{
    public function store(Request $request, JobOffer $jobOffer): RedirectResponse
    {
        abort_unless($jobOffer->user_id === Auth::id(), 403);

        $cv = $jobOffer->cv()->firstOrFail();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'issuer' => ['nullable', 'string', 'max:255'],
            'issued_at' => ['nullable', 'date'],
            'url' => ['nullable', 'url', 'max:2048'],
        ]);

        $validated['sort_order'] = $cv->certifications()->count() + 1;

        $cv->certifications()->create($validated);

        return redirect()
            ->route('job-offers.cv.edit', $jobOffer)
            ->with('success', 'Certificación agregada correctamente.');
    }

    public function destroy(JobOffer $jobOffer, int $certification): RedirectResponse
    {
        abort_unless($jobOffer->user_id === Auth::id(), 403);

        $cv = $jobOffer->cv()->firstOrFail();

        $certificationModel = $cv->certifications()
            ->whereKey($certification)
            ->firstOrFail();

        $certificationModel->delete();

        return redirect()
            ->route('job-offers.cv.edit', $jobOffer)
            ->with('success', 'Certificación eliminada correctamente.');
    }
}
