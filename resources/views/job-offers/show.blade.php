<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ $jobOffer->title }}
                </h2>

                <p class="mt-1 text-sm text-gray-500">
                    {{ $jobOffer->company ?: 'Sin empresa' }}
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <a
                    href="{{ route('job-offers.index') }}"
                    class="text-sm font-medium text-gray-600 hover:text-gray-900">
                    Volver a ofertas
                </a>

                <a
                    href="{{ route('job-offers.edit', $jobOffer) }}"
                    class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm hover:bg-gray-50">
                    Editar oferta
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto w-full max-w-[1400px] px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 rounded-md bg-green-50 p-4 text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-[minmax(0,1fr)_360px]">
                <section class="bg-white p-6 shadow-sm sm:rounded-lg">
                    <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">
                                {{ $jobOffer->title }}
                            </h1>

                            <p class="mt-2 text-gray-700">
                                {{ $jobOffer->company ?: 'Sin empresa' }}
                            </p>

                            <div class="mt-4 flex flex-wrap gap-2 text-sm">
                                @if ($jobOffer->is_active)
                                    <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-800">
                                        Activa
                                    </span>
                                @else
                                    <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-700">
                                        Inactiva
                                    </span>
                                @endif

                                @if ($jobOffer->published_at)
                                    <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-700">
                                        Publicada: {{ $jobOffer->published_at->format('d/m/Y') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        @if ($jobOffer->url)
                            <a
                                href="{{ $jobOffer->url }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="inline-flex items-center rounded-md bg-gray-900 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white hover:bg-gray-700">
                                Abrir oferta
                            </a>
                        @endif
                    </div>

                    <div class="mt-8 border-t pt-6">
                        <h3 class="text-sm font-semibold uppercase tracking-wide text-gray-500">
                            Descripción de la oferta
                        </h3>

                        <div class="mt-4 whitespace-pre-line text-sm leading-7 text-gray-800">
                            {{ $jobOffer->description ?: 'Sin descripción.' }}
                        </div>
                    </div>
                </section>

                <aside class="bg-white p-6 shadow-sm sm:rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-900">
                        CV personalizado
                    </h3>

                    @if ($jobOffer->cv)
                        <p class="mt-2 text-sm text-gray-600">
                            Esta oferta ya tiene un CV personalizado.
                        </p>

                        <div class="mt-5 space-y-3">
                            <a
                                href="{{ route('job-offers.cv.edit', $jobOffer) }}"
                                class="flex w-full items-center justify-center rounded-md bg-gray-900 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white hover:bg-gray-700">
                                Editar CV
                            </a>

                            <a
                                href="{{ route('job-offers.cv.show', $jobOffer) }}"
                                class="flex w-full items-center justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 hover:bg-gray-50">
                                Ver CV
                            </a>

                            <a
                                href="{{ route('job-offers.cv.download', $jobOffer) }}"
                                class="flex w-full items-center justify-center rounded-md bg-green-700 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white hover:bg-green-800">
                                Descargar PDF
                            </a>
                        </div>
                    @else
                        <p class="mt-2 text-sm text-gray-600">
                            Crea un CV personalizado para esta oferta usando tus datos base del perfil.
                        </p>

                        <form
                            method="POST"
                            action="{{ route('job-offers.cv.store', $jobOffer) }}"
                            class="mt-5">
                            @csrf

                            <button
                                type="submit"
                                class="flex w-full items-center justify-center rounded-md bg-gray-900 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white hover:bg-gray-700">
                                Crear CV
                            </button>
                        </form>
                    @endif

                    <div class="mt-6 border-t pt-5">
                        <h4 class="text-sm font-semibold text-gray-900">
                            Acciones de oferta
                        </h4>

                        <div class="mt-3 space-y-2 text-sm">
                            <a
                                href="{{ route('job-offers.edit', $jobOffer) }}"
                                class="block font-medium text-indigo-600 hover:text-indigo-900">
                                Editar información de la oferta
                            </a>

                            <a
                                href="{{ route('job-offers.index') }}"
                                class="block font-medium text-gray-600 hover:text-gray-900">
                                Volver al listado
                            </a>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</x-app-layout>
