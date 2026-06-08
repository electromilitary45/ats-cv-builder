@php
    $education = $education ?? null;
@endphp

<div>
    <x-input-label value="Título / Grado" />
    <x-text-input
        name="degree"
        type="text"
        class="mt-1 block w-full"
        :value="old('degree', $education?->degree)"
        placeholder="Bachillerato en Ingeniería en Sistemas"
        required
    />
    <x-input-error class="mt-2" :messages="$errors->get('degree')" />
</div>

<div>
    <x-input-label value="Institución" />
    <x-text-input
        name="institution"
        type="text"
        class="mt-1 block w-full"
        :value="old('institution', $education?->institution)"
        placeholder="Universidad de Costa Rica"
        required
    />
    <x-input-error class="mt-2" :messages="$errors->get('institution')" />
</div>

<div>
    <x-input-label value="Ubicación" />
    <x-text-input
        name="location"
        type="text"
        class="mt-1 block w-full"
        :value="old('location', $education?->location)"
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
            :value="old('start_date', optional($education?->start_date)->format('Y-m-d'))"
        />
        <x-input-error class="mt-2" :messages="$errors->get('start_date')" />
    </div>

    <div>
        <x-input-label value="Fecha fin" />
        <x-text-input
            name="end_date"
            type="date"
            class="mt-1 block w-full"
            :value="old('end_date', optional($education?->end_date)->format('Y-m-d'))"
        />
        <x-input-error class="mt-2" :messages="$errors->get('end_date')" />
    </div>
</div>

<div>
    <x-input-label value="Descripción" />

    <textarea
        name="description"
        rows="4"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
        placeholder="Formación en programación, bases de datos e ingeniería de software."
    >{{ old('description', $education?->description) }}</textarea>

    <x-input-error class="mt-2" :messages="$errors->get('description')" />
</div>
