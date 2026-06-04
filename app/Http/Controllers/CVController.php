<?php

namespace App\Http\Controllers;

use App\Models\CV;
use App\Models\JobOffer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CVController extends Controller
{
    public function store(JobOffer $jobOffer): RedirectResponse
    {
        $this->authorizeJobOfferOwner($jobOffer);

        if ($jobOffer->cv()->exists()) {
            return redirect()
                ->route('job-offers.cv.show', $jobOffer)
                ->with('success', 'Esta oferta ya tiene un CV creado.');
        }

        $user = Auth::user();

        $jobOffer->cv()->create([
            'user_id' => $user->id,
            'full_name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'location' => $user->location,
            'linkedin' => $user->linkedin,
            'github' => $user->github,
            'professional_title' => $user->professional_title,
            'professional_summary' => null,
            'language' => app()->getLocale() ?: 'es',
        ]);

        return redirect()
            ->route('job-offers.cv.show', $jobOffer)
            ->with('success', 'CV creado correctamente.');
    }

    public function show(JobOffer $jobOffer): View
    {
        $this->authorizeJobOfferOwner($jobOffer);

        $cv = $jobOffer->cv()
            ->with([
                'workExperiences',
                'educations',
                'skills',
                'certifications',
                'languages',
            ])
            ->firstOrFail();

        return view('cv.show', compact('jobOffer', 'cv'));
    }

    private function authorizeJobOfferOwner(JobOffer $jobOffer): void
    {
        abort_unless($jobOffer->user_id === Auth::id(), 403);
    }
}
