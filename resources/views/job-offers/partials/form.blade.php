@csrf

<div class="space-y-6">
    <div>
        <x-input-label for="title" value="Título del puesto" />
        <x-text-input
            id="title"
            name="title"
            type="text"
            class="mt-1 block w-full"
            :value="old('title', $jobOffer->title ?? '')"
            required
            autofocus
            placeholder="Fullstack Developer" />
        <x-input-error class="mt-2" :messages="$errors->get('title')" />
    </div>

    <div>
        <x-input-label for="company" value="Empresa" />
        <x-text-input
            id="company"
            name="company"
            type="text"
            class="mt-1 block w-full"
            :value="old('company', $jobOffer->company ?? '')"
            placeholder="Empresa X" />
        <x-input-error class="mt-2" :messages="$errors->get('company')" />
    </div>

    <div>
        <x-input-label for="url" value="URL de la oferta" />
        <x-text-input
            id="url"
            name="url"
            type="url"
            class="mt-1 block w-full"
            :value="old('url', $jobOffer->url ?? '')"
            placeholder="https://empresa.com/oferta/123" />
        <x-input-error class="mt-2" :messages="$errors->get('url')" />
    </div>

    <div>
        <x-input-label for="published_at" value="Fecha de publicación" />
        <x-text-input
            id="published_at"
            name="published_at"
            type="date"
            class="mt-1 block w-full"
            :value="old('published_at', isset($jobOffer) && $jobOffer->published_at ? $jobOffer->published_at->format('Y-m-d') : '')" />
        <x-input-error class="mt-2" :messages="$errors->get('published_at')" />
    </div>

    <div>
        <x-input-label for="description" value="Descripción de la oferta" />
        <textarea
            id="description"
            name="description"
            rows="10"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
            placeholder="Pega aquí la descripción de la posición...">{{ old('description', $jobOffer->description ?? '') }}</textarea>
        <x-input-error class="mt-2" :messages="$errors->get('description')" />
    </div>

    <div class="flex items-center gap-3">
        <input
            id="is_active"
            name="is_active"
            type="checkbox"
            value="1"
            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
            @checked(old('is_active', $jobOffer->is_active ?? true))
        />

        <label for="is_active" class="text-sm text-gray-700">
            Oferta activa
        </label>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>
            Guardar
        </x-primary-button>

        <a
            href="{{ route('job-offers.index') }}"
            class="text-sm text-gray-600 hover:text-gray-900">
            Cancelar
        </a>
    </div>
</div>
