<section class="bg-white p-6 shadow-sm sm:rounded-lg">
    <div class="mb-6">
        <h3 class="text-lg font-semibold text-gray-900">
            Información principal
        </h3>

        <p class="mt-1 text-sm text-gray-600">
            Estos datos aplican solo a este CV.
        </p>
    </div>

    <form method="POST" action="{{ route('job-offers.cv.update', $jobOffer) }}" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <x-input-label for="full_name" value="Nombre completo" />
            <x-text-input
                id="full_name"
                name="full_name"
                type="text"
                x-model="cv.full_name"
                class="mt-1 block w-full"
                :value="old('full_name', $cv->full_name)"
                required
                autofocus
            />
            <x-input-error class="mt-2" :messages="$errors->get('full_name')" />
        </div>

        <div>
            <x-input-label for="professional_title" value="Título profesional para este CV" />
            <x-text-input
                id="professional_title"
                name="professional_title"
                type="text"
                x-model="cv.professional_title"
                class="mt-1 block w-full"
                :value="old('professional_title', $cv->professional_title)"
                placeholder="Fullstack Developer"
            />
            <x-input-error class="mt-2" :messages="$errors->get('professional_title')" />
        </div>

        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input
                id="email"
                name="email"
                type="email"
                x-model="cv.email"
                class="mt-1 block w-full"
                :value="old('email', $cv->email)"
                required
            />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div>
                <x-input-label for="phone" value="Teléfono" />
                <x-text-input
                    id="phone"
                    name="phone"
                    type="text"
                    x-model="cv.phone"
                    class="mt-1 block w-full"
                    :value="old('phone', $cv->phone)"
                />
                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
            </div>

            <div>
                <x-input-label for="location" value="Ubicación" />
                <x-text-input
                    id="location"
                    name="location"
                    type="text"
                    x-model="cv.location"
                    class="mt-1 block w-full"
                    :value="old('location', $cv->location)"
                    placeholder="San José, Costa Rica"
                />
                <x-input-error class="mt-2" :messages="$errors->get('location')" />
            </div>
        </div>

        <div>
            <x-input-label for="linkedin" value="LinkedIn" />
            <x-text-input
                id="linkedin"
                name="linkedin"
                type="url"
                x-model="cv.linkedin"
                class="mt-1 block w-full"
                :value="old('linkedin', $cv->linkedin)"
                placeholder="https://www.linkedin.com/in/tuusuario"
            />
            <x-input-error class="mt-2" :messages="$errors->get('linkedin')" />
        </div>

        <div>
            <x-input-label for="github" value="GitHub" />
            <x-text-input
                id="github"
                name="github"
                type="url"
                x-model="cv.github"
                class="mt-1 block w-full"
                :value="old('github', $cv->github)"
                placeholder="https://github.com/tuusuario"
            />
            <x-input-error class="mt-2" :messages="$errors->get('github')" />
        </div>

        <div>
            <x-input-label for="professional_summary" value="Resumen profesional personalizado" />
            <textarea
                id="professional_summary"
                name="professional_summary"
                rows="7"
                x-model="cv.professional_summary"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                placeholder="Escribe un resumen enfocado en esta posición..."
            >{{ old('professional_summary', $cv->professional_summary) }}</textarea>
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
                required
            >
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
                class="text-sm text-gray-600 hover:text-gray-900"
            >
                Cancelar
            </a>
        </div>
    </form>
</section>
