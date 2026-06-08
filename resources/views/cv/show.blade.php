<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    CV personalizado
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    {{ $jobOffer->title }}
                    @if ($jobOffer->company)
                    — {{ $jobOffer->company }}
                    @endif
                </p>
            </div>

            <div class="flex items-center gap-4">
                <a
                    href="{{ route('job-offers.cv.download', $jobOffer) }}"
                    class="text-sm font-medium text-green-700 hover:text-green-900">
                    Descargar PDF
                </a>

                <a
                    href="{{ route('job-offers.cv.edit', $jobOffer) }}"
                    class="text-sm font-medium text-indigo-600 hover:text-indigo-900">
                    Editar CV
                </a>

                <a
                    href="{{ route('job-offers.show', $jobOffer) }}"
                    class="text-sm font-medium text-gray-600 hover:text-gray-900">
                    Volver a la oferta
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            @if (session('success'))
            <div class="mb-6 rounded-md bg-green-50 p-4 text-sm text-green-700">
                {{ session('success') }}
            </div>
            @endif

            <div class="bg-white p-8 shadow-sm sm:rounded-lg">
                <div class="border-b pb-6 text-center">
                    <h1 class="text-3xl font-bold tracking-wide text-gray-900">
                        {{ $cv->full_name }}
                    </h1>

                    @if ($cv->professional_title)
                    <p class="mt-2 text-lg text-gray-700">
                        {{ $cv->professional_title }}
                    </p>
                    @endif

                    <p class="mt-4 text-sm text-gray-600">
                        {{ collect([
                            $cv->email,
                            $cv->phone,
                            $cv->location,
                            $cv->linkedin,
                            $cv->github,
                        ])->filter()->join(' | ') }}
                    </p>
                </div>

                @if ($cv->professional_summary)
                <section class="mt-8">
                    <h2 class="text-sm font-bold uppercase tracking-widest text-gray-900">
                        {{ $cv->label('professional_summary') }}
                    </h2>

                    <p class="mt-3 text-sm leading-6 text-gray-700">
                        {{ $cv->professional_summary }}
                    </p>
                </section>
                @endif

                <section class="mt-8">
                    <h2 class="text-sm font-bold uppercase tracking-widest text-gray-900">
                        {{ $cv->label('work_experience') }}
                    </h2>

                    @forelse ($cv->workExperiences as $experience)
                    <article class="mt-4">
                        <h3 class="font-semibold text-gray-900">
                            {{ $experience->position }}
                        </h3>

                        <p class="text-sm text-gray-700">
                            {{ $experience->company }}
                            @if ($experience->location)
                            — {{ $experience->location }}
                            @endif
                        </p>

                        <p class="text-xs text-gray-500">
                            {{ optional($experience->start_date)->format('M Y') }}
                            -
                            {{ $experience->is_current ? 'Actualidad' : optional($experience->end_date)->format('M Y') }}
                        </p>

                        @if ($experience->description)
                        <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-gray-700">
                            @foreach (preg_split('/\r\n|\r|\n/', $experience->description) as $line)
                            @if (trim($line))
                            <li>{{ ltrim(trim($line), '-• ') }}</li>
                            @endif
                            @endforeach
                        </ul>
                        @endif
                    </article>
                    @empty
                    <p class="mt-3 text-sm text-gray-500">
                        Aún no hay experiencia laboral agregada.
                    </p>
                    @endforelse
                </section>

                <section class="mt-8">
                    <h2 class="text-sm font-bold uppercase tracking-widest text-gray-900">
                        {{ $cv->label('education') }}
                    </h2>

                    @forelse ($cv->educations as $education)
                    <article class="mt-4">
                        <h3 class="font-semibold text-gray-900">
                            {{ $education->degree }}
                        </h3>

                        <p class="text-sm text-gray-700">
                            {{ $education->institution }}
                            @if ($education->location)
                            — {{ $education->location }}
                            @endif
                        </p>
                    </article>
                    @empty
                    <p class="mt-3 text-sm text-gray-500">
                        Aún no hay educación agregada.
                    </p>
                    @endforelse
                </section>

                <section class="mt-8">
                    <h2 class="text-sm font-bold uppercase tracking-widest text-gray-900">
                        {{ $cv->label('skills') }}
                    </h2>

                    @if ($cv->skills->isNotEmpty())
                    <div class="mt-3 space-y-1 text-sm text-gray-700">
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
                    <p class="mt-3 text-sm text-gray-500">
                        Aún no hay skills agregadas.
                    </p>
                    @endif
                </section>

                <section class="mt-8">
                    <h2 class="text-sm font-bold uppercase tracking-widest text-gray-900">
                        {{ $cv->label('certifications') }}
                    </h2>

                    @forelse ($cv->certifications as $certification)
                    <article class="mt-4">
                        <h3 class="font-semibold text-gray-900">
                            {{ $certification->name }}
                        </h3>

                        <p class="text-sm text-gray-700">
                            {{ collect([
                                    $certification->issuer,
                                    optional($certification->issued_at)->format('M Y'),
                                ])->filter()->join(' — ') }}
                        </p>
                    </article>
                    @empty
                    <p class="mt-3 text-sm text-gray-500">
                        Aún no hay certificaciones agregadas.
                    </p>
                    @endforelse
                </section>

                <section class="mt-8">
                    <h2 class="text-sm font-bold uppercase tracking-widest text-gray-900">
                        {{ $cv->label('languages') }}
                    </h2>

                    @forelse ($cv->languages as $language)
                    <p class="mt-2 text-sm text-gray-700">
                        <strong>{{ $language->name }}:</strong>
                        {{ collect([$language->level, $language->certification])->filter()->join(' — ') }}
                    </p>
                    @empty
                    <p class="mt-3 text-sm text-gray-500">
                        Aún no hay idiomas agregados.
                    </p>
                    @endforelse
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
