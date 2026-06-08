<aside class="bg-white p-6 shadow-sm sm:rounded-lg">
    <div class="mb-4 flex items-center justify-between">
        <div>
            <h3 class="text-lg font-semibold text-gray-900">
                Preview CV
            </h3>

            <p class="mt-1 text-sm text-gray-500">
                Vista preliminar del CV con los datos guardados.
            </p>
        </div>

        <a
            href="{{ route('job-offers.cv.show', $jobOffer) }}"
            class="text-sm font-medium text-indigo-600 hover:text-indigo-900"
        >
            Ver pantalla completa
        </a>
    </div>

    <div class="rounded-lg border border-gray-200 bg-gray-50 p-4">
        <div class="mx-auto w-full max-w-[794px] bg-white px-8 py-10 shadow-sm">
            <div class="border-b border-gray-300 pb-5 text-center">
                <h1
                    class="text-2xl font-bold uppercase tracking-wide text-gray-900"
                    x-text="cv.full_name || 'Nombre completo'">
                </h1>

                <p
                    x-show="cv.professional_title && cv.professional_title.trim().length > 0"
                    x-text="cv.professional_title"
                    class="mt-2 text-sm font-medium text-gray-700">
                </p>

                <p
                    x-show="contactLine().length > 0"
                    x-text="contactLine()"
                    class="mt-3 text-xs leading-5 text-gray-600">
                </p>
            </div>

            <section
                x-show="cv.professional_summary && cv.professional_summary.trim().length > 0"
                class="mt-6">
                <h2 class="border-b border-gray-300 pb-1 text-xs font-bold uppercase tracking-widest text-gray-900">
                    {{ $cv->label('professional_summary') }}
                </h2>

                <p
                    x-text="cv.professional_summary"
                    class="mt-3 whitespace-pre-line text-xs leading-5 text-gray-700">
                </p>
            </section>

            <section class="mt-6">
                <h2 class="border-b border-gray-300 pb-1 text-xs font-bold uppercase tracking-widest text-gray-900">
                    {{ $cv->label('work_experience') }}
                </h2>

                @forelse ($cv->workExperiences as $experience)
                    <article class="mt-4">
                        <h3 class="text-sm font-bold text-gray-900">
                            {{ $experience->position }}
                        </h3>

                        <p class="text-xs text-gray-700">
                            {{ collect([
                                $experience->company,
                                $experience->location,
                                $cv->dateRange($experience->start_date, $experience->end_date, $experience->is_current),
                            ])->filter()->join(' - ') }}
                        </p>

                        @if ($experience->description)
                            <ul class="mt-2 list-disc space-y-1 pl-5 text-xs leading-5 text-gray-700">
                                @foreach (preg_split('/\r\n|\r|\n/', $experience->description) as $line)
                                    @if (trim($line))
                                        <li>{{ ltrim(trim($line), '-• ') }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        @endif
                    </article>
                @empty
                    <p class="mt-3 text-xs text-gray-500">
                        {{ $cv->label('no_work_experience') }}
                    </p>
                @endforelse
            </section>

            <section class="mt-6">
                <h2 class="border-b border-gray-300 pb-1 text-xs font-bold uppercase tracking-widest text-gray-900">
                    {{ $cv->label('education') }}
                </h2>

                @forelse ($cv->educations as $education)
                    <article class="mt-4">
                        <h3 class="text-sm font-bold text-gray-900">
                            {{ $education->degree }}
                        </h3>

                        <p class="text-xs text-gray-700">
                            {{ collect([
                                $education->institution,
                                $education->location,
                                $cv->dateRange($education->start_date, $education->end_date),
                            ])->filter()->join(' - ') }}
                        </p>

                        @if ($education->description)
                            <p class="mt-2 text-xs leading-5 text-gray-700">
                                {{ $education->description }}
                            </p>
                        @endif
                    </article>
                @empty
                    <p class="mt-3 text-xs text-gray-500">
                        {{ $cv->label('no_education') }}
                    </p>
                @endforelse
            </section>

            <section class="mt-6">
                <h2 class="border-b border-gray-300 pb-1 text-xs font-bold uppercase tracking-widest text-gray-900">
                    {{ $cv->label('skills') }}
                </h2>

                @if ($cv->skills->isNotEmpty())
                    <div class="mt-3 space-y-1 text-xs leading-5 text-gray-700">
                        @foreach ($cv->skills->groupBy('category') as $category => $skills)
                            <p>
                                @if ($category)
                                    <strong>{{ $category }}:</strong>
                                @endif

                                {{ $skills->pluck('name')->join(', ') }}
                            </p>
                        @endforeach
                    </div>
                @else
                    <p class="mt-3 text-xs text-gray-500">
                        {{ $cv->label('no_skills') }}
                    </p>
                @endif
            </section>

            @if ($cv->certifications->isNotEmpty())
                <section class="mt-6">
                    <h2 class="border-b border-gray-300 pb-1 text-xs font-bold uppercase tracking-widest text-gray-900">
                        {{ $cv->label('certifications') }}
                    </h2>

                    @foreach ($cv->certifications as $certification)
                        <article class="mt-3">
                            <h3 class="text-sm font-bold text-gray-900">
                                {{ $certification->name }}
                            </h3>

                            <p class="text-xs text-gray-700">
                                {{ collect([
                                    $certification->issuer,
                                    $cv->monthYear($certification->issued_at),
                                ])->filter()->join(' - ') }}
                            </p>
                        </article>
                    @endforeach
                </section>
            @endif

            @if ($cv->languages->isNotEmpty())
                <section class="mt-6">
                    <h2 class="border-b border-gray-300 pb-1 text-xs font-bold uppercase tracking-widest text-gray-900">
                        {{ $cv->label('languages') }}
                    </h2>

                    <div class="mt-3 space-y-1 text-xs leading-5 text-gray-700">
                        @foreach ($cv->languages as $language)
                            <p>
                                <strong>{{ $language->name }}:</strong>
                                {{ collect([$language->level, $language->certification])->filter()->join(' - ') }}
                            </p>
                        @endforeach
                    </div>
                </section>
            @endif
        </div>
    </div>
</aside>
