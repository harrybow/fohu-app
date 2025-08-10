<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Festival') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('admin.festivals.update', $festival) }}" class="bg-white p-6 rounded shadow">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block">{{ __('Name') }}</label>
                    <input type="text" name="name" value="{{ old('name', $festival->name) }}" class="border rounded w-full" />
                </div>
                <div class="mb-4">
                    <label class="block">{{ __('Year') }}</label>
                    <input type="number" name="year" value="{{ old('year', $festival->year) }}" class="border rounded w-full" />
                </div>
                <x-primary-button>{{ __('Update') }}</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
