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
            @if (session('success'))
            <div class="mb-6 rounded-md bg-green-50 p-4 text-sm text-green-700">
                {{ session('success') }}
            </div>
            @endif
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

                <!-- //=== Aquí podríamos agregar secciones para editar experiencia laboral, educación, habilidades, etc. en el futuro. -->
                <div class="mt-10 border-t pt-8">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Experiencia laboral
                    </h3>

                    <p class="mt-1 text-sm text-gray-600">
                        Agrega experiencias relevantes para esta posición.
                    </p>

                    @if ($cv->workExperiences->isNotEmpty())
                    <div class="mt-6 space-y-4">
                        @foreach ($cv->workExperiences as $experience)
                        <div class="rounded-lg border border-gray-200 p-4">
                            <div class="flex flex-col gap-3 md:flex-row md:items-start md:justify-between">
                                <div>
                                    <h4 class="font-semibold text-gray-900">
                                        {{ $experience->position }}
                                    </h4>

                                    <p class="text-sm text-gray-700">
                                        {{ $experience->company }}
                                        @if ($experience->location)
                                        — {{ $experience->location }}
                                        @endif
                                    </p>

                                    <p class="mt-1 text-xs text-gray-500">
                                        {{ optional($experience->start_date)->format('M Y') }}
                                        -
                                        {{ $experience->is_current ? 'Actualidad' : optional($experience->end_date)->format('M Y') }}
                                    </p>

                                    @if ($experience->description)
                                    <ul class="mt-3 list-disc space-y-1 pl-5 text-sm text-gray-600">
                                        @foreach (preg_split('/\r\n|\r|\n/', $experience->description) as $line)
                                        @if (trim($line))
                                        <li>{{ ltrim(trim($line), '-• ') }}</li>
                                        @endif
                                        @endforeach
                                    </ul>
                                    @endif
                                </div>

                                <form
                                    method="POST"
                                    action="{{ route('job-offers.cv.work-experiences.destroy', [$jobOffer, $experience]) }}"
                                    onsubmit="return confirm('¿Eliminar esta experiencia?')">
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="text-sm font-medium text-red-600 hover:text-red-900">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    <form
                        method="POST"
                        action="{{ route('job-offers.cv.work-experiences.store', $jobOffer) }}"
                        class="mt-6 space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div>
                                <x-input-label for="position" value="Puesto" />
                                <x-text-input
                                    id="position"
                                    name="position"
                                    type="text"
                                    class="mt-1 block w-full"
                                    placeholder="Fullstack Developer"
                                    required />
                                <x-input-error class="mt-2" :messages="$errors->get('position')" />
                            </div>

                            <div>
                                <x-input-label for="company" value="Empresa" />
                                <x-text-input
                                    id="company"
                                    name="company"
                                    type="text"
                                    class="mt-1 block w-full"
                                    placeholder="Empresa X"
                                    required />
                                <x-input-error class="mt-2" :messages="$errors->get('company')" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="work_location" value="Ubicación" />
                            <x-text-input
                                id="work_location"
                                name="location"
                                type="text"
                                class="mt-1 block w-full"
                                placeholder="San José, Costa Rica" />
                            <x-input-error class="mt-2" :messages="$errors->get('location')" />
                        </div>

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div>
                                <x-input-label for="start_date" value="Fecha inicio" />
                                <x-text-input
                                    id="start_date"
                                    name="start_date"
                                    type="date"
                                    class="mt-1 block w-full" />
                                <x-input-error class="mt-2" :messages="$errors->get('start_date')" />
                            </div>

                            <div>
                                <x-input-label for="end_date" value="Fecha fin" />
                                <x-text-input
                                    id="end_date"
                                    name="end_date"
                                    type="date"
                                    class="mt-1 block w-full" />
                                <x-input-error class="mt-2" :messages="$errors->get('end_date')" />
                            </div>
                        </div>

                        <label class="flex items-center gap-2">
                            <input
                                type="checkbox"
                                name="is_current"
                                value="1"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">

                            <span class="text-sm text-gray-700">
                                Actualmente trabajo aquí
                            </span>
                        </label>

                        <div>
                            <x-input-label for="description" value="Descripción / bullets" />

                            <textarea
                                id="description"
                                name="description"
                                rows="6"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="- Desarrollé APIs REST con Laravel.
                                    - Optimicé consultas MySQL.
                                    - Implementé autenticación y autorización."></textarea>

                            <x-input-error class="mt-2" :messages="$errors->get('description')" />

                            <p class="mt-2 text-xs text-gray-500">
                                Escribe un bullet por línea. Luego el CV los mostrará como lista.
                            </p>
                        </div>

                        <x-primary-button>
                            Agregar experiencia
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
