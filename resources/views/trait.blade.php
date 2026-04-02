<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Trait Page
        </h2>
    </x-slot>

    <div class="p-6">
        <p>{{ $photo }}</p>
        <p>{{ $music }}</p>
    </div>
</x-app-layout>