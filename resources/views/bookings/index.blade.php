<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Bookings
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-10">

            @if ($errors->any())
            <div class="bg-red-50 text-red-600 text-sm p-4 rounded-lg">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{-- Book a Daycare Day + Upcoming Bookings side by side --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                {{-- Booking form --}}
                <div class="bg-white p-6 shadow rounded-xl">
                    <h3 class="text-lg font-semibold mb-4 text-gray-800">Book a Daycare Day</h3>

                    @if ($pets->isEmpty())
                    <p class="text-gray-500 mb-4">You don't have any pets yet — add one below to get started.</p>

                    <form method="POST" action="{{ route('pets.store') }}" class="space-y-4">
                        @csrf
                        <input type="hidden" name="redirect_to" value="bookings.index">

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Pet Name</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Pet Type</label>
                            <select name="pet_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                                <option value="dog">Dog</option>
                                <option value="cat">Cat</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Breed</label>
                            <input type="text" name="breed" value="{{ old('breed') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                        </div>

                        <button type="submit"
                            class="bg-amber-500 hover:bg-amber-600 text-white font-semibold px-5 py-2.5 rounded-lg shadow transition-colors">
                            Add Pet &amp; Continue
                        </button>
                    </form>
                    @else
                    <form method="POST" action="{{ route('bookings.store') }}" class="space-y-4">
                        @csrf

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Which Pet(s)?</label>
                            <div class="space-y-2">
                                @foreach ($pets as $pet)
                                <label class="flex items-center gap-2">
                                    <input type="checkbox" name="pet_ids[]" value="{{ $pet->id }}"
                                        class="rounded border-gray-300 text-amber-500 focus:ring-amber-500">
                                    <span>{{ $pet->name }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Service Type</label>
                            <select name="service_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                                <option value="daycare">Daytime Daycare</option>
                                <option value="overnight">Overnight Boarding</option>
                                <option value="grooming">Grooming</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Start Date</label>
                            <input type="date" name="booking_date"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Duration (days)</label>
                            <input type="number" name="duration" min="1" max="30" value="1"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Contact Phone (optional)</label>
                            <input type="tel" name="contact_phone" value="{{ old('contact_phone') }}"
                                placeholder="e.g. 0771234567"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                        </div>

                        <button type="submit"
                            class="bg-amber-500 hover:bg-amber-600 text-white font-semibold px-5 py-2.5 rounded-lg shadow transition-colors">
                            Book Now
                        </button>
                    </form>
                    @endif
                </div>

                {{-- Upcoming bookings (live component) --}}
                <div class="bg-white p-6 shadow rounded-xl">
                    <h3 class="text-lg font-semibold mb-4 text-gray-800">Upcoming Bookings</h3>
                    <livewire:booking-list />
                </div>

            </div>

            {{-- Static reviews section --}}
            <div class="bg-amber-50 rounded-2xl p-8 sm:p-10">
                <h2 class="text-2xl font-bold text-center mb-8">What Our Customers Say</h2>

                <div class="bg-white rounded-xl p-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                    <div>
                        <p class="font-semibold text-gray-800">Customer Reviews</p>
                        <p class="text-amber-500 font-bold text-lg">4.9 ★★★★★ <span class="text-gray-400 text-sm font-normal">(348)</span></p>
                    </div>
                    <span class="inline-block bg-gray-900 text-white text-sm font-medium px-5 py-2 rounded-full text-center">
                        Trusted by pet owners
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="bg-white rounded-xl p-5">
                        <p class="font-semibold text-gray-800">Ruvini S.</p>
                        <p class="text-amber-400 text-sm mb-2">★★★★★</p>
                        <p class="text-gray-600 text-sm">Best place to board my dog — the staff clearly love animals.</p>
                    </div>
                    <div class="bg-white rounded-xl p-5">
                        <p class="font-semibold text-gray-800">Kalpa G.</p>
                        <p class="text-amber-400 text-sm mb-2">★★★★★</p>
                        <p class="text-gray-600 text-sm">The best place! My cat comes home happy every single time.</p>
                    </div>
                    <div class="bg-white rounded-xl p-5">
                        <p class="font-semibold text-gray-800">Ashen D.</p>
                        <p class="text-amber-400 text-sm mb-2">★★★★★</p>
                        <p class="text-gray-600 text-sm">Perfect place for your pet while you're away. No stress at all.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>