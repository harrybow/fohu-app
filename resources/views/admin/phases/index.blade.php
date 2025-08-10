<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Phases') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="{{ route('admin.phases.create') }}" class="text-blue-500">{{ __('Create Phase') }}</a>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <ul>
                    @foreach($phases as $phase)
                        <li class="p-6 border-b">
                            <a href="{{ route('admin.phases.show', $phase) }}" class="text-indigo-600">{{ $phase->name }}</a>
                            <span class="ml-2 text-gray-600">({{ $phase->festival->name }})</span>
                            <a href="{{ route('admin.phases.edit', $phase) }}" class="ml-4 text-blue-600">{{ __('Edit') }}</a>
                            <form action="{{ route('admin.phases.destroy', $phase) }}" method="POST" class="inline-block ml-4">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600" onclick="return confirm('Are you sure?')">{{ __('Delete') }}</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
