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

    <div class="py-6">
        <div class="mx-auto w-full max-w-[1800px] px-4 sm:px-6 lg:px-8">
            @if (session('success'))
            <div class="mb-6 rounded-md bg-green-50 p-4 text-sm text-green-700">
                {{ session('success') }}
            </div>
            @endif
            <!--GRID-->
            <div
                x-data="{
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
                class="grid grid-cols-1 gap-6 2xl:grid-cols-[minmax(0,1fr)_minmax(520px,720px)]">
                <!-- Información personal -->
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
                                x-model="cv.full_name"
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
                                x-model="cv.professional_title"
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
                                x-model="cv.email"
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
                                    x-model="cv.phone"
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
                                    x-model="cv.location"
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
                                x-model="cv.linkedin"
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
                                x-model="cv.github"
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
                                x-model="cv.professional_summary"
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

                    <!-- //=== Experiencia laboral. -->
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
                                <form
                                    method="POST"
                                    action="{{ route('job-offers.cv.work-experiences.update', [$jobOffer, $experience]) }}"
                                    class="space-y-4">
                                    @csrf
                                    @method('PUT')

                                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                        <div>
                                            <x-input-label for="experience_position_{{ $experience->id }}" value="Puesto" />
                                            <x-text-input
                                                id="experience_position_{{ $experience->id }}"
                                                name="position"
                                                type="text"
                                                class="mt-1 block w-full"
                                                :value="old('position', $experience->position)"
                                                required />
                                        </div>

                                        <div>
                                            <x-input-label for="experience_company_{{ $experience->id }}" value="Empresa" />
                                            <x-text-input
                                                id="experience_company_{{ $experience->id }}"
                                                name="company"
                                                type="text"
                                                class="mt-1 block w-full"
                                                :value="old('company', $experience->company)"
                                                required />
                                        </div>
                                    </div>

                                    <div>
                                        <x-input-label for="experience_location_{{ $experience->id }}" value="Ubicación" />
                                        <x-text-input
                                            id="experience_location_{{ $experience->id }}"
                                            name="location"
                                            type="text"
                                            class="mt-1 block w-full"
                                            :value="old('location', $experience->location)" />
                                    </div>

                                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                        <div>
                                            <x-input-label for="experience_start_date_{{ $experience->id }}" value="Fecha inicio" />
                                            <x-text-input
                                                id="experience_start_date_{{ $experience->id }}"
                                                name="start_date"
                                                type="date"
                                                class="mt-1 block w-full"
                                                :value="old('start_date', optional($experience->start_date)->format('Y-m-d'))" />
                                        </div>

                                        <div>
                                            <x-input-label for="experience_end_date_{{ $experience->id }}" value="Fecha fin" />
                                            <x-text-input
                                                id="experience_end_date_{{ $experience->id }}"
                                                name="end_date"
                                                type="date"
                                                class="mt-1 block w-full"
                                                :value="old('end_date', optional($experience->end_date)->format('Y-m-d'))" />
                                        </div>
                                    </div>

                                    <label class="flex items-center gap-2">
                                        <input
                                            type="checkbox"
                                            name="is_current"
                                            value="1"
                                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                            @checked(old('is_current', $experience->is_current))
                                        >

                                        <span class="text-sm text-gray-700">
                                            Actualmente trabajo aquí
                                        </span>
                                    </label>

                                    <div>
                                        <x-input-label for="experience_description_{{ $experience->id }}" value="Descripción / bullets" />

                                        <textarea
                                            id="experience_description_{{ $experience->id }}"
                                            name="description"
                                            rows="5"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $experience->description) }}</textarea>
                                    </div>

                                    <div class="flex items-center gap-4">
                                        <x-primary-button>
                                            Guardar experiencia
                                        </x-primary-button>
                                    </div>
                                </form>

                                <form
                                    method="POST"
                                    action="{{ route('job-offers.cv.work-experiences.destroy', [$jobOffer, $experience]) }}"
                                    onsubmit="return confirm('¿Eliminar esta experiencia?')"
                                    class="mt-3">
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="text-sm font-medium text-red-600 hover:text-red-900">
                                        Eliminar experiencia
                                    </button>
                                </form>
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


                    <!-- //=== Educación. -->
                    <div class="mt-10 border-t pt-8">
                        <h3 class="text-lg font-semibold text-gray-900">
                            Educación
                        </h3>

                        <p class="mt-1 text-sm text-gray-600">
                            Agrega tu formación académica relevante para este CV.
                        </p>

                        @if ($cv->educations->isNotEmpty())
                        <div class="mt-6 space-y-4">
                            @foreach ($cv->educations as $education)
                            <div class="rounded-lg border border-gray-200 p-4">
                                <form
                                    method="POST"
                                    action="{{ route('job-offers.cv.educations.update', [$jobOffer, $education]) }}"
                                    class="space-y-4">
                                    @csrf
                                    @method('PUT')

                                    <div>
                                        <x-input-label for="education_degree_{{ $education->id }}" value="Título / Grado" />
                                        <x-text-input
                                            id="education_degree_{{ $education->id }}"
                                            name="degree"
                                            type="text"
                                            class="mt-1 block w-full"
                                            :value="old('degree', $education->degree)"
                                            required />
                                    </div>

                                    <div>
                                        <x-input-label for="education_institution_{{ $education->id }}" value="Institución" />
                                        <x-text-input
                                            id="education_institution_{{ $education->id }}"
                                            name="institution"
                                            type="text"
                                            class="mt-1 block w-full"
                                            :value="old('institution', $education->institution)"
                                            required />
                                    </div>

                                    <div>
                                        <x-input-label for="education_location_existing_{{ $education->id }}" value="Ubicación" />
                                        <x-text-input
                                            id="education_location_existing_{{ $education->id }}"
                                            name="location"
                                            type="text"
                                            class="mt-1 block w-full"
                                            :value="old('location', $education->location)" />
                                    </div>

                                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                        <div>
                                            <x-input-label for="education_start_date_existing_{{ $education->id }}" value="Fecha inicio" />
                                            <x-text-input
                                                id="education_start_date_existing_{{ $education->id }}"
                                                name="start_date"
                                                type="date"
                                                class="mt-1 block w-full"
                                                :value="old('start_date', optional($education->start_date)->format('Y-m-d'))" />
                                        </div>

                                        <div>
                                            <x-input-label for="education_end_date_existing_{{ $education->id }}" value="Fecha fin" />
                                            <x-text-input
                                                id="education_end_date_existing_{{ $education->id }}"
                                                name="end_date"
                                                type="date"
                                                class="mt-1 block w-full"
                                                :value="old('end_date', optional($education->end_date)->format('Y-m-d'))" />
                                        </div>
                                    </div>

                                    <div>
                                        <x-input-label for="education_description_existing_{{ $education->id }}" value="Descripción" />

                                        <textarea
                                            id="education_description_existing_{{ $education->id }}"
                                            name="description"
                                            rows="4"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $education->description) }}</textarea>
                                    </div>

                                    <div>
                                        <x-primary-button>
                                            Guardar educación
                                        </x-primary-button>
                                    </div>
                                </form>

                                <form
                                    method="POST"
                                    action="{{ route('job-offers.cv.educations.destroy', [$jobOffer, $education]) }}"
                                    onsubmit="return confirm('¿Eliminar esta educación?')"
                                    class="mt-3">
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="text-sm font-medium text-red-600 hover:text-red-900">
                                        Eliminar educación
                                    </button>
                                </form>
                            </div>
                            @endforeach
                        </div>
                        @endif

                        <form
                            method="POST"
                            action="{{ route('job-offers.cv.educations.store', $jobOffer) }}"
                            class="mt-6 space-y-6">
                            @csrf

                            <div>
                                <x-input-label for="degree" value="Título / Grado" />
                                <x-text-input
                                    id="degree"
                                    name="degree"
                                    type="text"
                                    class="mt-1 block w-full"
                                    placeholder="Bachillerato en Ingeniería en Sistemas"
                                    required />
                                <x-input-error class="mt-2" :messages="$errors->get('degree')" />
                            </div>

                            <div>
                                <x-input-label for="institution" value="Institución" />
                                <x-text-input
                                    id="institution"
                                    name="institution"
                                    type="text"
                                    class="mt-1 block w-full"
                                    placeholder="Universidad de Costa Rica"
                                    required />
                                <x-input-error class="mt-2" :messages="$errors->get('institution')" />
                            </div>

                            <div>
                                <x-input-label for="education_location" value="Ubicación" />
                                <x-text-input
                                    id="education_location"
                                    name="location"
                                    type="text"
                                    class="mt-1 block w-full"
                                    placeholder="San José, Costa Rica" />
                                <x-input-error class="mt-2" :messages="$errors->get('location')" />
                            </div>

                            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                                <div>
                                    <x-input-label for="education_start_date" value="Fecha inicio" />
                                    <x-text-input
                                        id="education_start_date"
                                        name="start_date"
                                        type="date"
                                        class="mt-1 block w-full" />
                                    <x-input-error class="mt-2" :messages="$errors->get('start_date')" />
                                </div>

                                <div>
                                    <x-input-label for="education_end_date" value="Fecha fin" />
                                    <x-text-input
                                        id="education_end_date"
                                        name="end_date"
                                        type="date"
                                        class="mt-1 block w-full" />
                                    <x-input-error class="mt-2" :messages="$errors->get('end_date')" />
                                </div>
                            </div>

                            <div>
                                <x-input-label for="education_description" value="Descripción" />

                                <textarea
                                    id="education_description"
                                    name="description"
                                    rows="4"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    placeholder="Formación en programación, bases de datos e ingeniería de software."></textarea>

                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>

                            <x-primary-button>
                                Agregar educación
                            </x-primary-button>
                        </form>
                    </div>

                    <!-- //=== Habilidades. -->
                    <div class="mt-10 border-t pt-8">
                        <h3 class="text-lg font-semibold text-gray-900">
                            Skills
                        </h3>

                        <p class="mt-1 text-sm text-gray-600">
                            Agrega habilidades relevantes para esta posición.
                        </p>

                        @if ($cv->skills->isNotEmpty())
                        <div class="mt-6 space-y-3">
                            @foreach ($cv->skills->groupBy('category') as $category => $skills)
                            <div class="rounded-lg border border-gray-200 p-4">
                                <h4 class="text-sm font-semibold text-gray-900">
                                    {{ $category ?: 'Sin categoría' }}
                                </h4>

                                <div class="mt-3 flex flex-wrap gap-2">
                                    @foreach ($skills as $skill)
                                    <div class="inline-flex items-center gap-2 rounded-full bg-gray-100 px-3 py-1 text-sm text-gray-700">
                                        <span>{{ $skill->name }}</span>

                                        <form
                                            method="POST"
                                            action="{{ route('job-offers.cv.skills.destroy', [$jobOffer, $skill]) }}"
                                            onsubmit="return confirm('¿Eliminar esta skill?')">
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="font-semibold text-red-600 hover:text-red-900"
                                                title="Eliminar">
                                                ×
                                            </button>
                                        </form>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif

                        <form
                            method="POST"
                            action="{{ route('job-offers.cv.skills.store', $jobOffer) }}"
                            class="mt-6 space-y-6">
                            @csrf

                            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                                <div>
                                    <x-input-label for="skill_category" value="Categoría" />
                                    <x-text-input
                                        id="skill_category"
                                        name="category"
                                        type="text"
                                        class="mt-1 block w-full"
                                        placeholder="Backend" />
                                    <x-input-error class="mt-2" :messages="$errors->get('category')" />
                                </div>

                                <div>
                                    <x-input-label for="skill_name" value="Skill" />
                                    <x-text-input
                                        id="skill_name"
                                        name="name"
                                        type="text"
                                        class="mt-1 block w-full"
                                        placeholder="Laravel"
                                        required />
                                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                </div>
                            </div>

                            <x-primary-button>
                                Agregar skill
                            </x-primary-button>
                        </form>
                    </div>

                    <!-- //=== Certificaciones. -->
                    <div class="mt-10 border-t pt-8">
                        <h3 class="text-lg font-semibold text-gray-900">
                            Certificaciones
                        </h3>

                        <p class="mt-1 text-sm text-gray-600">
                            Agrega certificaciones relevantes para esta posición.
                        </p>

                        @if ($cv->certifications->isNotEmpty())
                        <div class="mt-6 space-y-4">
                            @foreach ($cv->certifications as $certification)
                            <div class="rounded-lg border border-gray-200 p-4">
                                <div class="flex flex-col gap-3 md:flex-row md:items-start md:justify-between">
                                    <div>
                                        <h4 class="font-semibold text-gray-900">
                                            {{ $certification->name }}
                                        </h4>

                                        <p class="text-sm text-gray-700">
                                            {{ collect([
                                    $certification->issuer,
                                    optional($certification->issued_at)->format('M Y'),
                                ])->filter()->join(' — ') }}
                                        </p>

                                        @if ($certification->url)
                                        <a
                                            href="{{ $certification->url }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="mt-2 inline-block text-sm text-indigo-600 hover:text-indigo-900">
                                            Ver credencial
                                        </a>
                                        @endif
                                    </div>

                                    <form
                                        method="POST"
                                        action="{{ route('job-offers.cv.certifications.destroy', [$jobOffer, $certification]) }}"
                                        onsubmit="return confirm('¿Eliminar esta certificación?')">
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
                            action="{{ route('job-offers.cv.certifications.store', $jobOffer) }}"
                            class="mt-6 space-y-6">
                            @csrf

                            <div>
                                <x-input-label for="certification_name" value="Nombre de la certificación" />
                                <x-text-input
                                    id="certification_name"
                                    name="name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    placeholder="Laravel Certification"
                                    required />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-label for="issuer" value="Emisor" />
                                <x-text-input
                                    id="issuer"
                                    name="issuer"
                                    type="text"
                                    class="mt-1 block w-full"
                                    placeholder="Laravel" />
                                <x-input-error class="mt-2" :messages="$errors->get('issuer')" />
                            </div>

                            <div>
                                <x-input-label for="issued_at" value="Fecha de obtención" />
                                <x-text-input
                                    id="issued_at"
                                    name="issued_at"
                                    type="date"
                                    class="mt-1 block w-full" />
                                <x-input-error class="mt-2" :messages="$errors->get('issued_at')" />
                            </div>

                            <div>
                                <x-input-label for="certification_url" value="URL de credencial" />
                                <x-text-input
                                    id="certification_url"
                                    name="url"
                                    type="url"
                                    class="mt-1 block w-full"
                                    placeholder="https://example.com/certification" />
                                <x-input-error class="mt-2" :messages="$errors->get('url')" />
                            </div>

                            <x-primary-button>
                                Agregar certificación
                            </x-primary-button>
                        </form>
                    </div>

                    <!-- //=== Idiomas. -->
                    <div class="mt-10 border-t pt-8">
                        <h3 class="text-lg font-semibold text-gray-900">
                            Idiomas
                        </h3>

                        <p class="mt-1 text-sm text-gray-600">
                            Agrega los idiomas relevantes para este CV.
                        </p>

                        @if ($cv->languages->isNotEmpty())
                        <div class="mt-6 space-y-3">
                            @foreach ($cv->languages as $language)
                            <div class="rounded-lg border border-gray-200 p-4">
                                <div class="flex flex-col gap-3 md:flex-row md:items-start md:justify-between">
                                    <div>
                                        <h4 class="font-semibold text-gray-900">
                                            {{ $language->name }}
                                        </h4>

                                        <p class="text-sm text-gray-700">
                                            {{ collect([
                                    $language->level,
                                    $language->certification,
                                ])->filter()->join(' — ') ?: 'Sin nivel especificado' }}
                                        </p>
                                    </div>

                                    <form
                                        method="POST"
                                        action="{{ route('job-offers.cv.languages.destroy', [$jobOffer, $language]) }}"
                                        onsubmit="return confirm('¿Eliminar este idioma?')">
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
                            action="{{ route('job-offers.cv.languages.store', $jobOffer) }}"
                            class="mt-6 space-y-6">
                            @csrf

                            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                                <div>
                                    <x-input-label for="language_name" value="Idioma" />
                                    <x-text-input
                                        id="language_name"
                                        name="name"
                                        type="text"
                                        class="mt-1 block w-full"
                                        placeholder="Inglés"
                                        required />
                                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                </div>

                                <div>
                                    <x-input-label for="language_level" value="Nivel" />

                                    <select
                                        id="language_level"
                                        name="level"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="">Seleccionar nivel</option>
                                        <option value="Nativo">Nativo</option>
                                        <option value="C2">C2</option>
                                        <option value="C1">C1</option>
                                        <option value="B2">B2</option>
                                        <option value="B1">B1</option>
                                        <option value="A2">A2</option>
                                        <option value="A1">A1</option>
                                    </select>

                                    <x-input-error class="mt-2" :messages="$errors->get('level')" />
                                </div>
                            </div>

                            <div>
                                <x-input-label for="language_certification" value="Certificación" />
                                <x-text-input
                                    id="language_certification"
                                    name="certification"
                                    type="text"
                                    class="mt-1 block w-full"
                                    placeholder="TOEIC, TOEFL, IELTS..." />
                                <x-input-error class="mt-2" :messages="$errors->get('certification')" />
                            </div>

                            <x-primary-button>
                                Agregar idioma
                            </x-primary-button>
                        </form>
                    </div>
                </div>
                <!-- //=== Vista previa del CV. -->
                <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                    <div class="mb-4 flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">
                                Preview CV
                            </h3>

                            <p class="mt-1 text-sm text-gray-500">
                                Vista preliminar del CV con los datos guardados.
                            </p>
                        </div>

                        <a
                            href="{{ route('job-offers.cv.show', $jobOffer) }}"
                            class="text-sm font-medium text-indigo-600 hover:text-indigo-900">
                            Ver pantalla completa
                        </a>
                    </div>

                    <div class="rounded-lg border border-gray-200 bg-gray-50 p-4">
                        <div class="mx-auto w-full max-w-[794px] bg-white px-8 py-10 shadow-sm">
                            <div class="border-b border-gray-300 pb-5 text-center">
                                <h1
                                    class="text-2xl font-bold uppercase tracking-wide text-gray-900"
                                    x-text="cv.full_name || 'Nombre completo'">
                                </h1>

                                <p
                                    x-show="cv.professional_title && cv.professional_title.trim().length > 0"
                                    x-text="cv.professional_title"
                                    class="mt-2 text-sm font-medium text-gray-700">
                                </p>

                                <p
                                    x-show="contactLine().length > 0"
                                    x-text="contactLine()"
                                    class="mt-3 text-xs leading-5 text-gray-600">
                                </p>
                            </div>

                            <section
                                x-show="cv.professional_summary && cv.professional_summary.trim().length > 0"
                                class="mt-6">
                                <h2 class="border-b border-gray-300 pb-1 text-xs font-bold uppercase tracking-widest text-gray-900">
                                    Resumen profesional
                                </h2>

                                <p
                                    x-text="cv.professional_summary"
                                    class="mt-3 whitespace-pre-line text-xs leading-5 text-gray-700">
                                </p>
                            </section>

                            <section class="mt-6">
                                <h2 class="border-b border-gray-300 pb-1 text-xs font-bold uppercase tracking-widest text-gray-900">
                                    Experiencia laboral
                                </h2>

                                @forelse ($cv->workExperiences as $experience)
                                <article class="mt-4">
                                    <div class="flex items-start justify-between gap-4">
                                        <div>
                                            <h3 class="text-sm font-bold text-gray-900">
                                                {{ $experience->position }}
                                            </h3>

                                            <p class="text-xs text-gray-700">
                                                {{ $experience->company }}
                                                @if ($experience->location)
                                                — {{ $experience->location }}
                                                @endif
                                            </p>
                                        </div>

                                        <p class="shrink-0 text-right text-xs text-gray-600">
                                            {{ optional($experience->start_date)->format('M Y') }}
                                            -
                                            {{ $experience->is_current ? 'Actualidad' : optional($experience->end_date)->format('M Y') }}
                                        </p>
                                    </div>

                                    @if ($experience->description)
                                    <ul class="mt-2 list-disc space-y-1 pl-5 text-xs leading-5 text-gray-700">
                                        @foreach (preg_split('/\r\n|\r|\n/', $experience->description) as $line)
                                        @if (trim($line))
                                        <li>{{ ltrim(trim($line), '-• ') }}</li>
                                        @endif
                                        @endforeach
                                    </ul>
                                    @endif
                                </article>
                                @empty
                                <p class="mt-3 text-xs text-gray-500">
                                    Aún no hay experiencia laboral agregada.
                                </p>
                                @endforelse
                            </section>

                            <section class="mt-6">
                                <h2 class="border-b border-gray-300 pb-1 text-xs font-bold uppercase tracking-widest text-gray-900">
                                    Educación
                                </h2>

                                @forelse ($cv->educations as $education)
                                <article class="mt-4">
                                    <div class="flex items-start justify-between gap-4">
                                        <div>
                                            <h3 class="text-sm font-bold text-gray-900">
                                                {{ $education->degree }}
                                            </h3>

                                            <p class="text-xs text-gray-700">
                                                {{ $education->institution }}
                                                @if ($education->location)
                                                — {{ $education->location }}
                                                @endif
                                            </p>
                                        </div>

                                        <p class="shrink-0 text-right text-xs text-gray-600">
                                            {{ optional($education->start_date)->format('M Y') }}
                                            -
                                            {{ optional($education->end_date)->format('M Y') }}
                                        </p>
                                    </div>

                                    @if ($education->description)
                                    <p class="mt-2 text-xs leading-5 text-gray-700">
                                        {{ $education->description }}
                                    </p>
                                    @endif
                                </article>
                                @empty
                                <p class="mt-3 text-xs text-gray-500">
                                    Aún no hay educación agregada.
                                </p>
                                @endforelse
                            </section>

                            <section class="mt-6">
                                <h2 class="border-b border-gray-300 pb-1 text-xs font-bold uppercase tracking-widest text-gray-900">
                                    Skills
                                </h2>

                                @if ($cv->skills->isNotEmpty())
                                <div class="mt-3 space-y-1 text-xs leading-5 text-gray-700">
                                    @foreach ($cv->skills->groupBy('category') as $category => $skills)
                                    <p>
                                        @if ($category)
                                        <strong>{{ $category }}:</strong>
                                        @endif

                                        {{ $skills->pluck('name')->join(', ') }}
                                    </p>
                                    @endforeach
                                </div>
                                @else
                                <p class="mt-3 text-xs text-gray-500">
                                    Aún no hay skills agregadas.
                                </p>
                                @endif
                            </section>

                            @if ($cv->certifications->isNotEmpty())
                            <section class="mt-6">
                                <h2 class="border-b border-gray-300 pb-1 text-xs font-bold uppercase tracking-widest text-gray-900">
                                    Certificaciones
                                </h2>

                                @foreach ($cv->certifications as $certification)
                                <article class="mt-3">
                                    <h3 class="text-sm font-bold text-gray-900">
                                        {{ $certification->name }}
                                    </h3>

                                    <p class="text-xs text-gray-700">
                                        {{ collect([
                                    $certification->issuer,
                                    optional($certification->issued_at)->format('M Y'),
                                ])->filter()->join(' — ') }}
                                    </p>
                                </article>
                                @endforeach
                            </section>
                            @endif

                            @if ($cv->languages->isNotEmpty())
                            <section class="mt-6">
                                <h2 class="border-b border-gray-300 pb-1 text-xs font-bold uppercase tracking-widest text-gray-900">
                                    Idiomas
                                </h2>

                                <div class="mt-3 space-y-1 text-xs leading-5 text-gray-700">
                                    @foreach ($cv->languages as $language)
                                    <p>
                                        <strong>{{ $language->name }}:</strong>
                                        {{ collect([$language->level, $language->certification])->filter()->join(' — ') }}
                                    </p>
                                    @endforeach
                                </div>
                            </section>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
