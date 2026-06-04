<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Ofertas laborales
            </h2>

            <a
                href="{{ route('job-offers.create') }}"
                class="inline-flex items-center rounded-md bg-gray-900 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white hover:bg-gray-700">
                Nueva oferta
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            @if (session('success'))
            <div class="mb-6 rounded-md bg-green-50 p-4 text-sm text-green-700">
                {{ session('success') }}
            </div>
            @endif

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @forelse ($jobOffers as $jobOffer)
                    <div class="border-b border-gray-200 py-5 last:border-b-0">
                        <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
                            <div>
                                <div class="flex items-center gap-3">
                                    <h3 class="text-lg font-semibold text-gray-900">
                                        {{ $jobOffer->title }}
                                    </h3>

                                    @if ($jobOffer->is_active)
                                    <span class="rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800">
                                        Activa
                                    </span>
                                    @else
                                    <span class="rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-700">
                                        Inactiva
                                    </span>
                                    @endif
                                </div>

                                <p class="mt-1 text-sm text-gray-600">
                                    {{ $jobOffer->company ?: 'Sin empresa' }}
                                </p>

                                @if ($jobOffer->published_at)
                                <p class="mt-1 text-xs text-gray-500">
                                    Publicada: {{ $jobOffer->published_at->format('d/m/Y') }}
                                </p>
                                @endif
                            </div>

                            <div class="flex flex-wrap gap-3 text-sm">
                                <a
                                    href="{{ route('job-offers.show', $jobOffer) }}"
                                    class="font-medium text-indigo-600 hover:text-indigo-900">
                                    Ver
                                </a>

                                <a
                                    href="{{ route('job-offers.edit', $jobOffer) }}"
                                    class="font-medium text-gray-600 hover:text-gray-900">
                                    Editar
                                </a>

                                <form
                                    method="POST"
                                    action="{{ route('job-offers.destroy', $jobOffer) }}"
                                    onsubmit="return confirm('¿Eliminar esta oferta?')">
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="font-medium text-red-600 hover:text-red-900">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="py-12 text-center">
                        <h3 class="text-lg font-medium text-gray-900">
                            Aún no tienes ofertas laborales
                        </h3>

                        <p class="mt-2 text-sm text-gray-600">
                            Crea tu primera oferta para empezar a construir un CV personalizado.
                        </p>

                        <a
                            href="{{ route('job-offers.create') }}"
                            class="mt-6 inline-flex items-center rounded-md bg-gray-900 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white hover:bg-gray-700">
                            Crear oferta
                        </a>
                    </div>
                    @endforelse

                    <div class="mt-6">
                        {{ $jobOffers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
