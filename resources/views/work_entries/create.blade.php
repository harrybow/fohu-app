<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Work Day') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('work-entries.store') }}">
                        @csrf

                        <div>
                            <x-input-label for="work_date" :value="__('Date')" />
                            <x-text-input id="work_date" class="block mt-1 w-full" type="date" name="work_date" :value="old('work_date')" required />
                            <x-input-error :messages="$errors->get('work_date')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="duration" :value="__('Duration (days)')" />
                            <x-text-input id="duration" class="block mt-1 w-full" type="number" step="0.5" min="0.5" max="2" name="duration" :value="old('duration')" required />
                            <x-input-error :messages="$errors->get('duration')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="tshirt_size" :value="__('T-Shirt Size')" />
                            <select id="tshirt_size" name="tshirt_size" class="block mt-1 w-full" required>
                                <option value="">--</option>
                                @foreach(['XS','S','M','L','XL','XXL'] as $size)
                                    <option value="{{ $size }}" @selected(old('tshirt_size', optional($participant)->tshirt_size) == $size)>{{ $size }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('tshirt_size')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <label class="flex items-center">
                                <input type="checkbox" name="needs_car_ticket" value="1" @checked(old('needs_car_ticket', optional($participant)->needs_car_ticket))>
                                <span class="ml-2">{{ __('Need Car Ticket') }}</span>
                            </label>
                            <x-input-error :messages="$errors->get('needs_car_ticket')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="arrival_date" :value="__('Arrival Date')" />
                            <x-text-input id="arrival_date" class="block mt-1 w-full" type="date" name="arrival_date" :value="old('arrival_date', optional($participant)->arrival_date)" />
                            <x-input-error :messages="$errors->get('arrival_date')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="departure_date" :value="__('Departure Date')" />
                            <x-text-input id="departure_date" class="block mt-1 w-full" type="date" name="departure_date" :value="old('departure_date', optional($participant)->departure_date)" />
                            <x-input-error :messages="$errors->get('departure_date')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
