<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Phase') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('admin.phases.store') }}" class="bg-white p-6 rounded shadow">
                @csrf
                <div class="mb-4">
                    <label class="block">{{ __('Festival') }}</label>
                    <select name="festival_id" class="border rounded w-full">
                        @foreach($festivals as $festival)
                            <option value="{{ $festival->id }}">{{ $festival->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block">{{ __('Name') }}</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="border rounded w-full" />
                </div>
                <div class="mb-4">
                    <label class="block">{{ __('Start Date') }}</label>
                    <input type="date" name="start_date" value="{{ old('start_date') }}" class="border rounded w-full" />
                </div>
                <div class="mb-4">
                    <label class="block">{{ __('End Date') }}</label>
                    <input type="date" name="end_date" value="{{ old('end_date') }}" class="border rounded w-full" />
                </div>
                <x-primary-button>{{ __('Save') }}</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
