<section class="bg-white p-6 shadow-sm sm:rounded-lg">
    <div class="flex items-start justify-between gap-4">
        <div>
            <h3 class="text-lg font-semibold text-gray-900">
                Certificaciones
            </h3>

            <p class="mt-1 text-sm text-gray-600">
                Agrega certificaciones relevantes para esta posición.
            </p>
        </div>

        <button
            type="button"
            @click="openModal = 'certification-create'"
            class="inline-flex items-center rounded-md bg-gray-900 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white hover:bg-gray-700"
        >
            Agregar
        </button>
    </div>

    <div class="mt-6 space-y-4">
        @forelse ($cv->certifications as $certification)
            <div class="rounded-lg border border-gray-200 p-4">
                <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
                    <div>
                        <h4 class="font-semibold text-gray-900">
                            {{ $certification->name }}
                        </h4>

                        <p class="text-sm text-gray-700">
                            {{ collect([
                                $certification->issuer,
                                $cv->monthYear($certification->issued_at),
                            ])->filter()->join(' — ') }}
                        </p>

                        @if ($certification->url)
                            <a
                                href="{{ $certification->url }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="mt-2 inline-block text-sm text-indigo-600 hover:text-indigo-900"
                            >
                                Ver credencial
                            </a>
                        @endif
                    </div>

                    <div class="flex shrink-0 gap-3">
                        <button
                            type="button"
                            @click="openModal = 'certification-edit-{{ $certification->id }}'"
                            class="text-sm font-medium text-indigo-600 hover:text-indigo-900"
                        >
                            Editar
                        </button>

                        <form
                            method="POST"
                            action="{{ route('job-offers.cv.certifications.destroy', [$jobOffer, $certification]) }}"
                            onsubmit="return confirm('¿Eliminar esta certificación?')"
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

            <x-cv-modal name="certification-edit-{{ $certification->id }}" title="Editar certificación" maxWidth="2xl">
                <form method="POST" action="{{ route('job-offers.cv.certifications.update', [$jobOffer, $certification]) }}" class="space-y-5">
                    @csrf
                    @method('PUT')

                    @include('cv.partials.certification-form-fields', ['certification' => $certification])

                    <div class="flex items-center justify-end gap-3 border-t pt-5">
                        <button type="button" @click="openModal = null" class="text-sm text-gray-600 hover:text-gray-900">
                            Cancelar
                        </button>

                        <x-primary-button>
                            Guardar certificación
                        </x-primary-button>
                    </div>
                </form>
            </x-cv-modal>
        @empty
            <p class="rounded-lg border border-dashed border-gray-300 p-4 text-sm text-gray-500">
                Aún no hay certificaciones agregadas.
            </p>
        @endforelse
    </div>

    <x-cv-modal name="certification-create" title="Agregar certificación" maxWidth="2xl">
        <form method="POST" action="{{ route('job-offers.cv.certifications.store', $jobOffer) }}" class="space-y-5">
            @csrf

            @include('cv.partials.certification-form-fields', ['certification' => null])

            <div class="flex items-center justify-end gap-3 border-t pt-5">
                <button type="button" @click="openModal = null" class="text-sm text-gray-600 hover:text-gray-900">
                    Cancelar
                </button>

                <x-primary-button>
                    Agregar certificación
                </x-primary-button>
            </div>
        </form>
    </x-cv-modal>
</section>
