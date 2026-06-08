<section class="bg-white p-6 shadow-sm sm:rounded-lg">
    <div class="flex items-start justify-between gap-4">
        <div>
            <h3 class="text-lg font-semibold text-gray-900">
                Educación
            </h3>

            <p class="mt-1 text-sm text-gray-600">
                Agrega tu formación académica relevante para este CV.
            </p>
        </div>

        <button
            type="button"
            @click="openModal = 'education-create'"
            class="inline-flex items-center rounded-md bg-gray-900 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white hover:bg-gray-700"
        >
            Agregar
        </button>
    </div>

    <div class="mt-6 space-y-4">
        @forelse ($cv->educations as $education)
            <div class="rounded-lg border border-gray-200 p-4">
                <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
                    <div>
                        <h4 class="font-semibold text-gray-900">
                            {{ $education->degree }}
                        </h4>

                        <p class="text-sm text-gray-700">
                            {{ $education->institution }}
                            @if ($education->location)
                                — {{ $education->location }}
                            @endif
                        </p>

                        <p class="mt-1 text-xs text-gray-500">
                            {{ $cv->dateRange($education->start_date, $education->end_date) }}
                        </p>

                        @if ($education->description)
                            <p class="mt-3 text-sm text-gray-600">
                                {{ $education->description }}
                            </p>
                        @endif
                    </div>

                    <div class="flex shrink-0 gap-3">
                        <button
                            type="button"
                            @click="openModal = 'education-edit-{{ $education->id }}'"
                            class="text-sm font-medium text-indigo-600 hover:text-indigo-900"
                        >
                            Editar
                        </button>

                        <form
                            method="POST"
                            action="{{ route('job-offers.cv.educations.destroy', [$jobOffer, $education]) }}"
                            onsubmit="return confirm('¿Eliminar esta educación?')"
                        >
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-900">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <x-cv-modal name="education-edit-{{ $education->id }}" title="Editar educación" maxWidth="3xl">
                <form method="POST" action="{{ route('job-offers.cv.educations.update', [$jobOffer, $education]) }}" class="space-y-5">
                    @csrf
                    @method('PUT')

                    @include('cv.partials.education-form-fields', ['education' => $education])

                    <div class="flex items-center justify-end gap-3 border-t pt-5">
                        <button type="button" @click="openModal = null" class="text-sm text-gray-600 hover:text-gray-900">
                            Cancelar
                        </button>

                        <x-primary-button>
                            Guardar educación
                        </x-primary-button>
                    </div>
                </form>
            </x-cv-modal>
        @empty
            <p class="rounded-lg border border-dashed border-gray-300 p-4 text-sm text-gray-500">
                Aún no hay educación agregada.
            </p>
        @endforelse
    </div>

    <x-cv-modal name="education-create" title="Agregar educación" maxWidth="3xl">
        <form method="POST" action="{{ route('job-offers.cv.educations.store', $jobOffer) }}" class="space-y-5">
            @csrf

            @include('cv.partials.education-form-fields', ['education' => null])

            <div class="flex items-center justify-end gap-3 border-t pt-5">
                <button type="button" @click="openModal = null" class="text-sm text-gray-600 hover:text-gray-900">
                    Cancelar
                </button>

                <x-primary-button>
                    Agregar educación
                </x-primary-button>
            </div>
        </form>
    </x-cv-modal>
</section>
