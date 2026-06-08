@php
    $languageItem = $languageItem ?? null;
    $selectedLevel = old('level', $languageItem?->level);
@endphp

<div class="grid grid-cols-1 gap-5 md:grid-cols-2">
    <div>
        <x-input-label value="Idioma" />
        <x-text-input
            name="name"
            type="text"
            class="mt-1 block w-full"
            :value="old('name', $languageItem?->name)"
            placeholder="Inglés"
            required
        />
        <x-input-error class="mt-2" :messages="$errors->get('name')" />
    </div>

    <div>
        <x-input-label value="Nivel" />

        <select
            name="level"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
        >
            <option value="" @selected($selectedLevel === null || $selectedLevel === '')>Seleccionar nivel</option>
            <option value="Nativo" @selected($selectedLevel === 'Nativo')>Nativo</option>
            <option value="C2" @selected($selectedLevel === 'C2')>C2</option>
            <option value="C1" @selected($selectedLevel === 'C1')>C1</option>
            <option value="B2" @selected($selectedLevel === 'B2')>B2</option>
            <option value="B1" @selected($selectedLevel === 'B1')>B1</option>
            <option value="A2" @selected($selectedLevel === 'A2')>A2</option>
            <option value="A1" @selected($selectedLevel === 'A1')>A1</option>
        </select>

        <x-input-error class="mt-2" :messages="$errors->get('level')" />
    </div>
</div>

<div>
    <x-input-label value="Certificación" />
    <x-text-input
        name="certification"
        type="text"
        class="mt-1 block w-full"
        :value="old('certification', $languageItem?->certification)"
        placeholder="TOEIC, TOEFL, IELTS..."
    />
    <x-input-error class="mt-2" :messages="$errors->get('certification')" />
</div>
