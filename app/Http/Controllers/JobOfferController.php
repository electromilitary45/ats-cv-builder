<?php

namespace App\Http\Controllers;

use App\Models\JobOffer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class JobOfferController extends Controller
{
    public function index(): View
    {

        /** @var \App\Models\User $user */
        $user = Auth::user();

        $jobOffers = $user->jobOffers()
            ->latest()
            ->paginate(10);

        return view('job-offers.index', compact('jobOffers'));
    }

    public function create(): View
    {
        return view('job-offers.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateJobOffer($request);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        $jobOffer = $user->jobOffers()->create($validated);

        return redirect()
            ->route('job-offers.show', $jobOffer)
            ->with('success', 'Oferta laboral creada correctamente.');
    }

    public function show(JobOffer $jobOffer): View
    {
        $this->authorizeOwner($jobOffer);

        return view('job-offers.show', compact('jobOffer'));
    }

    public function edit(JobOffer $jobOffer): View
    {
        $this->authorizeOwner($jobOffer);

        return view('job-offers.edit', compact('jobOffer'));
    }

    public function update(Request $request, JobOffer $jobOffer): RedirectResponse
    {
        $this->authorizeOwner($jobOffer);

        $validated = $this->validateJobOffer($request);

        $jobOffer->update($validated);

        return redirect()
            ->route('job-offers.show', $jobOffer)
            ->with('success', 'Oferta laboral actualizada correctamente.');
    }

    public function destroy(JobOffer $jobOffer): RedirectResponse
    {
        $this->authorizeOwner($jobOffer);

        $jobOffer->delete();

        return redirect()
            ->route('job-offers.index')
            ->with('success', 'Oferta laboral eliminada correctamente.');
    }

    private function validateJobOffer(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'url' => ['nullable', 'url', 'max:2048'],
            'published_at' => ['nullable', 'date'],
            'description' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]);
    }

    private function authorizeOwner(JobOffer $jobOffer): void
    {
        abort_unless($jobOffer->user_id === Auth::id(), 403);
    }
}
