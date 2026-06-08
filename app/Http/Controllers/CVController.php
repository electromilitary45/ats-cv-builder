<?php

namespace App\Http\Controllers;

use App\Models\CV;
use App\Models\JobOffer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

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

    public function edit(JobOffer $jobOffer): View
    {
        $this->authorizeJobOfferOwner($jobOffer);

        $cv = $jobOffer->cv()->firstOrFail();

        return view('cv.edit', compact('jobOffer', 'cv'));
    }

    /**
     * Este metodo se encarga de actualizar el CV asociado a una oferta de trabajo.
     * Primero, verifica que el usuario autenticado sea el propietario de la oferta de trabajo.
     * Luego, valida los datos enviados en la solicitud y actualiza el CV con la información proporcionada.
     * Finalmente, redirige al usuario a la página de visualización del CV con un mensaje de éxito.
     */

    public function update(Request $request, JobOffer $jobOffer): RedirectResponse
    {
        $this->authorizeJobOfferOwner($jobOffer);

        $cv = $jobOffer->cv()->firstOrFail();

        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'location' => ['nullable', 'string', 'max:255'],
            'linkedin' => ['nullable', 'url', 'max:255'],
            'github' => ['nullable', 'url', 'max:255'],
            'professional_title' => ['nullable', 'string', 'max:255'],
            'professional_summary' => ['nullable', 'string', 'max:3000'],
            'language' => ['required', 'in:es,en'],
        ]);

        $cv->update($validated);

        return redirect()
            ->route('job-offers.cv.show', $jobOffer)
            ->with('success', 'CV actualizado correctamente.');
    }

    public function downloadPdf(JobOffer $jobOffer): Response
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

        $fileName = Str::slug($cv->full_name . '-' . $jobOffer->title) . '-cv.pdf';

        return Pdf::loadView('cv.pdf', [
            'jobOffer' => $jobOffer,
            'cv' => $cv,
        ])
            ->setPaper('letter', 'portrait')
            ->download($fileName);
    }

    private function authorizeJobOfferOwner(JobOffer $jobOffer): void
    {
        abort_unless($jobOffer->user_id === Auth::id(), 403);
    }
}
