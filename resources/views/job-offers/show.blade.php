<div class="mt-8 border-t pt-6">
    <h4 class="text-sm font-semibold uppercase tracking-wide text-gray-500">
        CV personalizado
    </h4>

    @if ($jobOffer->cv)
    <p class="mt-2 text-sm text-gray-600">
        Esta oferta ya tiene un CV personalizado.
    </p>

    <a
        href="{{ route('job-offers.cv.show', $jobOffer) }}"
        class="mt-4 inline-flex items-center rounded-md bg-gray-900 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white hover:bg-gray-700">
        Ver CV
    </a>
    @else
    <p class="mt-2 text-sm text-gray-600">
        Crea un CV personalizado para esta oferta usando tus datos base del perfil.
    </p>

    <form
        method="POST"
        action="{{ route('job-offers.cv.store', $jobOffer) }}"
        class="mt-4">
        @csrf

        <button
            type="submit"
            class="inline-flex items-center rounded-md bg-gray-900 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white hover:bg-gray-700">
            Crear CV
        </button>
    </form>
    @endif
</div>
