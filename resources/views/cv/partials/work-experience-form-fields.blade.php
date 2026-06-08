@php
    $experience = $experience ?? null;
@endphp

<div class="grid grid-cols-1 gap-5 md:grid-cols-2">
    <div>
        <x-input-label value="Puesto" />
        <x-text-input
            name="position"
            type="text"
            class="mt-1 block w-full"
            :value="old('position', $experience?->position)"
            placeholder="Fullstack Developer"
            required
        />
        <x-input-error class="mt-2" :messages="$errors->get('position')" />
    </div>

    <div>
        <x-input-label value="Empresa" />
        <x-text-input
            name="company"
            type="text"
            class="mt-1 block w-full"
            :value="old('company', $experience?->company)"
            placeholder="Empresa X"
            required
        />
        <x-input-error class="mt-2" :messages="$errors->get('company')" />
    </div>
</div>

<div>
    <x-input-label value="Ubicación" />
    <x-text-input
        name="location"
        type="text"
        class="mt-1 block w-full"
        :value="old('location', $experience?->location)"
        placeholder="San José, Costa Rica"
    />
    <x-input-error class="mt-2" :messages="$errors->get('location')" />
</div>

<div class="grid grid-cols-1 gap-5 md:grid-cols-2">
    <div>
        <x-input-label value="Fecha inicio" />
        <x-text-input
            name="start_date"
            type="date"
            class="mt-1 block w-full"
            :value="old('start_date', optional($experience?->start_date)->format('Y-m-d'))"
        />
        <x-input-error class="mt-2" :messages="$errors->get('start_date')" />
    </div>

    <div>
        <x-input-label value="Fecha fin" />
        <x-text-input
            name="end_date"
            type="date"
            class="mt-1 block w-full"
            :value="old('end_date', optional($experience?->end_date)->format('Y-m-d'))"
        />
        <x-input-error class="mt-2" :messages="$errors->get('end_date')" />
    </div>
</div>

<label class="flex items-center gap-2">
    <input
        type="checkbox"
        name="is_current"
        value="1"
        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
        @checked(old('is_current', $experience?->is_current ?? false))
    >

    <span class="text-sm text-gray-700">
        Actualmente trabajo aquí
    </span>
</label>

<div>
    <x-input-label value="Descripción / bullets" />

    <textarea
        name="description"
        rows="6"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
        placeholder="- Desarrollé APIs REST con Laravel.
- Optimicé consultas MySQL.
- Implementé autenticación y autorización."
    >{{ old('description', $experience?->description) }}</textarea>

    <x-input-error class="mt-2" :messages="$errors->get('description')" />

    <p class="mt-2 text-xs text-gray-500">
        Escribe un bullet por línea. Luego el CV los mostrará como lista.
    </p>
</div>
