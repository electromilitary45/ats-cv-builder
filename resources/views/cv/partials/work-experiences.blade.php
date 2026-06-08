<section class="bg-white p-6 shadow-sm sm:rounded-lg">
    <div class="flex items-start justify-between gap-4">
        <div>
            <h3 class="text-lg font-semibold text-gray-900">
                Experiencia laboral
            </h3>

            <p class="mt-1 text-sm text-gray-600">
                Agrega experiencias relevantes para esta posición.
            </p>
        </div>

        <button
            type="button"
            @click="openModal = 'work-create'"
            class="inline-flex items-center rounded-md bg-gray-900 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white hover:bg-gray-700"
        >
            Agregar
        </button>
    </div>

    <div class="mt-6 space-y-4">
        @forelse ($cv->workExperiences as $experience)
            <div class="rounded-lg border border-gray-200 p-4">
                <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
                    <div>
                        <h4 class="font-semibold text-gray-900">
                            {{ $experience->position }}
                        </h4>

                        <p class="text-sm text-gray-700">
                            {{ $experience->company }}
                            @if ($experience->location)
                                — {{ $experience->location }}
                            @endif
                        </p>

                        <p class="mt-1 text-xs text-gray-500">
                            {{ $cv->dateRange($experience->start_date, $experience->end_date, $experience->is_current) }}
                        </p>

                        @if ($experience->description)
                            <ul class="mt-3 list-disc space-y-1 pl-5 text-sm text-gray-600">
                                @foreach (preg_split('/\r\n|\r|\n/', $experience->description) as $line)
                                    @if (trim($line))
                                        <li>{{ ltrim(trim($line), '-• ') }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    <div class="flex shrink-0 gap-3">
                        <button
                            type="button"
                            @click="openModal = 'work-edit-{{ $experience->id }}'"
                            class="text-sm font-medium text-indigo-600 hover:text-indigo-900"
                        >
                            Editar
                        </button>

                        <form
                            method="POST"
                            action="{{ route('job-offers.cv.work-experiences.destroy', [$jobOffer, $experience]) }}"
                            onsubmit="return confirm('¿Eliminar esta experiencia?')"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="text-sm font-medium text-red-600 hover:text-red-900"
                            >
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <x-cv-modal name="work-edit-{{ $experience->id }}" title="Editar experiencia laboral" maxWidth="3xl">
                <form
                    method="POST"
                    action="{{ route('job-offers.cv.work-experiences.update', [$jobOffer, $experience]) }}"
                    class="space-y-5"
                >
                    @csrf
                    @method('PUT')

                    @include('cv.partials.work-experience-form-fields', ['experience' => $experience])

                    <div class="flex items-center justify-end gap-3 border-t pt-5">
                        <button type="button" @click="openModal = null" class="text-sm text-gray-600 hover:text-gray-900">
                            Cancelar
                        </button>

                        <x-primary-button>
                            Guardar experiencia
                        </x-primary-button>
                    </div>
                </form>
            </x-cv-modal>
        @empty
            <p class="rounded-lg border border-dashed border-gray-300 p-4 text-sm text-gray-500">
                Aún no hay experiencia laboral agregada.
            </p>
        @endforelse
    </div>

    <x-cv-modal name="work-create" title="Agregar experiencia laboral" maxWidth="3xl">
        <form
            method="POST"
            action="{{ route('job-offers.cv.work-experiences.store', $jobOffer) }}"
            class="space-y-5"
        >
            @csrf

            @include('cv.partials.work-experience-form-fields', ['experience' => null])

            <div class="flex items-center justify-end gap-3 border-t pt-5">
                <button type="button" @click="openModal = null" class="text-sm text-gray-600 hover:text-gray-900">
                    Cancelar
                </button>

                <x-primary-button>
                    Agregar experiencia
                </x-primary-button>
            </div>
        </form>
    </x-cv-modal>
</section>
