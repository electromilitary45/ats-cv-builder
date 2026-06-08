<section class="bg-white p-6 shadow-sm sm:rounded-lg">
    <div class="flex items-start justify-between gap-4">
        <div>
            <h3 class="text-lg font-semibold text-gray-900">
                Skills
            </h3>

            <p class="mt-1 text-sm text-gray-600">
                Agrega habilidades relevantes para esta posición.
            </p>
        </div>

        <button
            type="button"
            @click="openModal = 'skill-create'"
            class="inline-flex items-center rounded-md bg-gray-900 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white hover:bg-gray-700"
        >
            Agregar
        </button>
    </div>

    <div class="mt-6 space-y-3">
        @forelse ($cv->skills as $skill)
            <div class="rounded-lg border border-gray-200 p-4">
                <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                    <div>
                        <p class="font-semibold text-gray-900">
                            {{ $skill->name }}
                        </p>

                        <p class="text-sm text-gray-600">
                            {{ $skill->category ?: 'Sin categoría' }}
                        </p>
                    </div>

                    <div class="flex shrink-0 gap-3">
                        <button
                            type="button"
                            @click="openModal = 'skill-edit-{{ $skill->id }}'"
                            class="text-sm font-medium text-indigo-600 hover:text-indigo-900"
                        >
                            Editar
                        </button>

                        <form
                            method="POST"
                            action="{{ route('job-offers.cv.skills.destroy', [$jobOffer, $skill]) }}"
                            onsubmit="return confirm('¿Eliminar esta skill?')"
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

            <x-cv-modal name="skill-edit-{{ $skill->id }}" title="Editar skill">
                <form method="POST" action="{{ route('job-offers.cv.skills.update', [$jobOffer, $skill]) }}" class="space-y-5">
                    @csrf
                    @method('PUT')

                    @include('cv.partials.skill-form-fields', ['skill' => $skill])

                    <div class="flex items-center justify-end gap-3 border-t pt-5">
                        <button type="button" @click="openModal = null" class="text-sm text-gray-600 hover:text-gray-900">
                            Cancelar
                        </button>

                        <x-primary-button>
                            Guardar skill
                        </x-primary-button>
                    </div>
                </form>
            </x-cv-modal>
        @empty
            <p class="rounded-lg border border-dashed border-gray-300 p-4 text-sm text-gray-500">
                Aún no hay skills agregadas.
            </p>
        @endforelse
    </div>

    <x-cv-modal name="skill-create" title="Agregar skill">
        <form method="POST" action="{{ route('job-offers.cv.skills.store', $jobOffer) }}" class="space-y-5">
            @csrf

            @include('cv.partials.skill-form-fields', ['skill' => null])

            <div class="flex items-center justify-end gap-3 border-t pt-5">
                <button type="button" @click="openModal = null" class="text-sm text-gray-600 hover:text-gray-900">
                    Cancelar
                </button>

                <x-primary-button>
                    Agregar skill
                </x-primary-button>
            </div>
        </form>
    </x-cv-modal>
</section>
