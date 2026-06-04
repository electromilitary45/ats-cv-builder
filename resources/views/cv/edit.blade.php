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

            <a
                href="{{ route('job-offers.cv.show', $jobOffer) }}"
                class="text-sm font-medium text-gray-600 hover:text-gray-900">
                Ver CV
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('job-offers.cv.update', $jobOffer) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="full_name" value="Nombre completo" />
                        <x-text-input
                            id="full_name"
                            name="full_name"
                            type="text"
                            class="mt-1 block w-full"
                            :value="old('full_name', $cv->full_name)"
                            required
                            autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('full_name')" />
                    </div>

                    <div>
                        <x-input-label for="professional_title" value="Título profesional para este CV" />
                        <x-text-input
                            id="professional_title"
                            name="professional_title"
                            type="text"
                            class="mt-1 block w-full"
                            :value="old('professional_title', $cv->professional_title)"
                            placeholder="Fullstack Developer" />
                        <x-input-error class="mt-2" :messages="$errors->get('professional_title')" />
                    </div>

                    <div>
                        <x-input-label for="email" value="Email" />
                        <x-text-input
                            id="email"
                            name="email"
                            type="email"
                            class="mt-1 block w-full"
                            :value="old('email', $cv->email)"
                            required />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                    </div>

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <x-input-label for="phone" value="Teléfono" />
                            <x-text-input
                                id="phone"
                                name="phone"
                                type="text"
                                class="mt-1 block w-full"
                                :value="old('phone', $cv->phone)" />
                            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                        </div>

                        <div>
                            <x-input-label for="location" value="Ubicación" />
                            <x-text-input
                                id="location"
                                name="location"
                                type="text"
                                class="mt-1 block w-full"
                                :value="old('location', $cv->location)"
                                placeholder="San José, Costa Rica" />
                            <x-input-error class="mt-2" :messages="$errors->get('location')" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="linkedin" value="LinkedIn" />
                        <x-text-input
                            id="linkedin"
                            name="linkedin"
                            type="url"
                            class="mt-1 block w-full"
                            :value="old('linkedin', $cv->linkedin)"
                            placeholder="https://www.linkedin.com/in/tuusuario" />
                        <x-input-error class="mt-2" :messages="$errors->get('linkedin')" />
                    </div>

                    <div>
                        <x-input-label for="github" value="GitHub" />
                        <x-text-input
                            id="github"
                            name="github"
                            type="url"
                            class="mt-1 block w-full"
                            :value="old('github', $cv->github)"
                            placeholder="https://github.com/tuusuario" />
                        <x-input-error class="mt-2" :messages="$errors->get('github')" />
                    </div>

                    <div>
                        <x-input-label for="professional_summary" value="Resumen profesional personalizado" />
                        <textarea
                            id="professional_summary"
                            name="professional_summary"
                            rows="7"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="Escribe un resumen enfocado en esta posición...">{{ old('professional_summary', $cv->professional_summary) }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('professional_summary')" />

                        <p class="mt-2 text-xs text-gray-500">
                            Recomendado: 3 a 5 líneas, usando palabras clave de la oferta.
                        </p>
                    </div>

                    <div>
                        <x-input-label for="language" value="Idioma del CV" />

                        <select
                            id="language"
                            name="language"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            required>
                            <option value="es" @selected(old('language', $cv->language) === 'es')>
                                Español
                            </option>
                            <option value="en" @selected(old('language', $cv->language) === 'en')>
                                Inglés
                            </option>
                        </select>

                        <x-input-error class="mt-2" :messages="$errors->get('language')" />
                    </div>

                    <div class="flex items-center gap-4 border-t pt-6">
                        <x-primary-button>
                            Guardar cambios
                        </x-primary-button>

                        <a
                            href="{{ route('job-offers.cv.show', $jobOffer) }}"
                            class="text-sm text-gray-600 hover:text-gray-900">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
