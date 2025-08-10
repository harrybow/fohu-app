<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Festival') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('admin.festivals.store') }}" class="bg-white p-6 rounded shadow">
                @csrf
                <div class="mb-4">
                    <label class="block">{{ __('Name') }}</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="border rounded w-full" />
                </div>
                <div class="mb-4">
                    <label class="block">{{ __('Year') }}</label>
                    <input type="number" name="year" value="{{ old('year') }}" class="border rounded w-full" />
                </div>
                <x-primary-button>{{ __('Save') }}</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
