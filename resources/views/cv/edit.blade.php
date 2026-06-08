<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Editar CV
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
                    href="{{ route('job-offers.cv.show', $jobOffer) }}"
                    class="text-sm font-medium text-gray-600 hover:text-gray-900">
                    Ver CV
                </a>
            </div>
        </div>
    </x-slot>

    <style>
        [x-cloak] { display: none !important; }
    </style>

    <div class="py-6">
        <div class="mx-auto w-full max-w-[1800px] px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 rounded-md bg-green-50 p-4 text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div
                x-data="{
                    openModal: null,
                    cv: {
                        full_name: @js(old('full_name', $cv->full_name)),
                        professional_title: @js(old('professional_title', $cv->professional_title)),
                        email: @js(old('email', $cv->email)),
                        phone: @js(old('phone', $cv->phone)),
                        location: @js(old('location', $cv->location)),
                        linkedin: @js(old('linkedin', $cv->linkedin)),
                        github: @js(old('github', $cv->github)),
                        professional_summary: @js(old('professional_summary', $cv->professional_summary)),
                    },
                    contactLine() {
                        return [
                            this.cv.email,
                            this.cv.phone,
                            this.cv.location,
                            this.cv.linkedin,
                            this.cv.github,
                        ].filter(value => value && value.trim().length > 0).join(' | ');
                    }
                }"
                class="grid grid-cols-1 gap-6 2xl:grid-cols-[minmax(0,1fr)_minmax(520px,720px)]"
            >
                <div class="space-y-6">
                    @include('cv.partials.main-information-form')
                    @include('cv.partials.work-experiences')
                    @include('cv.partials.educations')
                    @include('cv.partials.skills')
                    @include('cv.partials.certifications')
                    @include('cv.partials.languages')
                </div>

                @include('cv.partials.preview')
            </div>
        </div>
    </div>
</x-app-layout>
