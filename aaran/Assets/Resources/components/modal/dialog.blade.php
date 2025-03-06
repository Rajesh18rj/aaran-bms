@props(['id' => null, 'maxWidth' => null])

<x-jet.modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6  pt-4">
        <div class="text-lg">
            {{ $title }}
        </div>

        <div class="mt-1 overscroll-y-contain w-full">
            {{ $content }}
        </div>
    </div>

    <div class="px-6 py-3 bg-gray-100 text-right">
        {{ $footer }}
    </div>
</x-jet.modal>
