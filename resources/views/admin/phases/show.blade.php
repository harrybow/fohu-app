<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $phase->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow">
                <p>{{ __('Festival') }}: {{ $phase->festival->name }}</p>
                <p>{{ __('Start Date') }}: {{ $phase->start_date }}</p>
                <p>{{ __('End Date') }}: {{ $phase->end_date }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
