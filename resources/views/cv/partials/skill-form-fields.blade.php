@php
    $skill = $skill ?? null;
@endphp

<div>
    <x-input-label value="Categoría" />
    <x-text-input
        name="category"
        type="text"
        class="mt-1 block w-full"
        :value="old('category', $skill?->category)"
        placeholder="Backend"
    />
    <x-input-error class="mt-2" :messages="$errors->get('category')" />
</div>

<div>
    <x-input-label value="Skill" />
    <x-text-input
        name="name"
        type="text"
        class="mt-1 block w-full"
        :value="old('name', $skill?->name)"
        placeholder="Laravel"
        required
    />
    <x-input-error class="mt-2" :messages="$errors->get('name')" />
</div>
