<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $jobOffer->title }}
            </h2>

            <a
                href="{{ route('job-offers.edit', $jobOffer) }}"
                class="text-sm font-medium text-indigo-600 hover:text-indigo-900">
                Editar oferta
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            @if (session('success'))
            <div class="mb-6 rounded-md bg-green-50 p-4 text-sm text-green-700">
                {{ session('success') }}
            </div>
            @endif

            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">
                            {{ $jobOffer->title }}
                        </h3>

                        <p class="mt-2 text-gray-700">
                            {{ $jobOffer->company ?: 'Sin empresa' }}
                        </p>

                        @if ($jobOffer->published_at)
                        <p class="mt-1 text-sm text-gray-500">
                            Publicada: {{ $jobOffer->published_at->format('d/m/Y') }}
                        </p>
                        @endif
                    </div>

                    <span class="w-fit rounded-full px-3 py-1 text-xs font-medium {{ $jobOffer->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-700' }}">
                        {{ $jobOffer->is_active ? 'Activa' : 'Inactiva' }}
                    </span>
                </div>

                @if ($jobOffer->url)
                <div class="mt-6">
                    <a
                        href="{{ $jobOffer->url }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="text-sm font-medium text-indigo-600 hover:text-indigo-900">
                        Abrir oferta original
                    </a>
                </div>
                @endif

                <div class="mt-8">
                    <h4 class="text-sm font-semibold uppercase tracking-wide text-gray-500">
                        Descripción
                    </h4>

                    <div class="mt-3 whitespace-pre-line text-sm leading-6 text-gray-800">
                        {{ $jobOffer->description ?: 'Sin descripción.' }}
                    </div>
                </div>

                <div class="mt-8 border-t pt-6">
                    <h4 class="text-sm font-semibold uppercase tracking-wide text-gray-500">
                        CV personalizado
                    </h4>

                    <p class="mt-2 text-sm text-gray-600">
                        En el siguiente paso agregaremos la creación del CV para esta oferta.
                    </p>

                    <button
                        type="button"
                        disabled
                        class="mt-4 inline-flex cursor-not-allowed items-center rounded-md bg-gray-300 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white">
                        Crear CV próximamente
                    </button>
                </div>
            </div>

            <div class="mt-6">
                <a
                    href="{{ route('job-offers.index') }}"
                    class="text-sm font-medium text-gray-600 hover:text-gray-900">
                    ← Volver a ofertas
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
