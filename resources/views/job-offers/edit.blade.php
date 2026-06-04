<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar oferta laboral
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('job-offers.update', $jobOffer) }}">
                    @method('PUT')

                    @include('job-offers.partials.form')
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
