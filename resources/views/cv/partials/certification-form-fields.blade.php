@php
    $certification = $certification ?? null;
@endphp

<div>
    <x-input-label value="Nombre de la certificación" />
    <x-text-input
        name="name"
        type="text"
        class="mt-1 block w-full"
        :value="old('name', $certification?->name)"
        placeholder="Laravel Certification"
        required
    />
    <x-input-error class="mt-2" :messages="$errors->get('name')" />
</div>

<div>
    <x-input-label value="Emisor" />
    <x-text-input
        name="issuer"
        type="text"
        class="mt-1 block w-full"
        :value="old('issuer', $certification?->issuer)"
        placeholder="Laravel"
    />
    <x-input-error class="mt-2" :messages="$errors->get('issuer')" />
</div>

<div>
    <x-input-label value="Fecha de obtención" />
    <x-text-input
        name="issued_at"
        type="date"
        class="mt-1 block w-full"
        :value="old('issued_at', optional($certification?->issued_at)->format('Y-m-d'))"
    />
    <x-input-error class="mt-2" :messages="$errors->get('issued_at')" />
</div>

<div>
    <x-input-label value="URL de credencial" />
    <x-text-input
        name="url"
        type="url"
        class="mt-1 block w-full"
        :value="old('url', $certification?->url)"
        placeholder="https://example.com/certification"
    />
    <x-input-error class="mt-2" :messages="$errors->get('url')" />
</div>
