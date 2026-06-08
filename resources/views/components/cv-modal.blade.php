@props([
    'name',
    'title',
    'maxWidth' => '2xl',
])

@php
    $maxWidthClass = [
        'sm' => 'sm:max-w-sm',
        'md' => 'sm:max-w-md',
        'lg' => 'sm:max-w-lg',
        'xl' => 'sm:max-w-xl',
        '2xl' => 'sm:max-w-2xl',
        '3xl' => 'sm:max-w-3xl',
    ][$maxWidth] ?? 'sm:max-w-2xl';
@endphp

<div
    x-cloak
    x-show="openModal === @js($name)"
    x-transition.opacity
    class="fixed inset-0 z-50 overflow-y-auto px-4 py-6 sm:px-0"
    aria-modal="true"
    role="dialog"
>
    <div
        class="fixed inset-0 bg-gray-900/50"
        @click="openModal = null"
    ></div>

    <div class="relative mx-auto mt-10 w-full {{ $maxWidthClass }}">
        <div
            x-show="openModal === @js($name)"
            x-transition
            @keydown.escape.window="openModal = null"
            class="overflow-hidden rounded-lg bg-white shadow-xl"
        >
            <div class="flex items-start justify-between border-b px-6 py-4">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">
                        {{ $title }}
                    </h3>
                </div>

                <button
                    type="button"
                    class="rounded-md text-gray-400 hover:text-gray-600"
                    @click="openModal = null"
                >
                    <span class="sr-only">Cerrar</span>
                    ×
                </button>
            </div>

            <div class="px-6 py-5">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
