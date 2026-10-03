<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            My Pets
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

            {{-- Add Pet + Your Pets side by side --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                {{-- Add a new pet --}}
                <div class="bg-white p-6 shadow rounded-xl">
                    <h3 class="text-lg font-semibold mb-4 text-gray-800">Add a Pet</h3>

                    <form method="POST" action="{{ route('pets.store') }}" class="space-y-4">
                        @csrf

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
                            <label class="block text-sm font-medium text-gray-700">Age (years, optional)</label>
                            <input type="number" name="age" min="0" max="30" value="{{ old('age') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Breed</label>
                            <input type="text" name="breed" value="{{ old('breed') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Notes (allergies, etc.)</label>
                            <textarea name="notes"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">{{ old('notes') }}</textarea>
                        </div>

                        <button type="submit"
                            class="bg-amber-500 hover:bg-amber-600 text-white font-semibold px-5 py-2.5 rounded-lg shadow transition-colors">
                            Add Pet
                        </button>
                    </form>
                </div>

                {{-- Your Pets list --}}
                <div class="bg-white p-6 shadow rounded-xl">
                    <h3 class="text-lg font-semibold mb-4 text-gray-800">Your Pets</h3>

                    @if ($pets->isEmpty())
                    <p class="text-gray-500">No pets added yet.</p>
                    @else
                    <ul class="divide-y divide-gray-100">
                        @foreach ($pets as $pet)
                        <li class="py-4 flex justify-between items-start gap-3">
                            <div>
                                <p class="font-medium text-gray-800">{{ $pet->name }}</p>
                                <p class="text-sm text-gray-500">{{ $pet->breed ?? 'Breed not specified' }}</p>
                                @if ($pet->notes)
                                <p class="text-sm text-gray-400 mt-1">{{ $pet->notes }}</p>
                                @endif
                            </div>

                            <div class="flex gap-2 flex-shrink-0">
                                <a href="{{ route('pets.edit', $pet) }}"
                                    class="bg-amber-100 hover:bg-amber-200 text-amber-700 text-sm font-medium px-3 py-1.5 rounded-md transition-colors">
                                    Edit
                                </a>

                                <form method="POST" action="{{ route('pets.destroy', $pet) }}"
                                    onsubmit="return confirm('Delete {{ $pet->name }}? This also deletes their bookings.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-100 hover:bg-red-200 text-red-700 text-sm font-medium px-3 py-1.5 rounded-md transition-colors">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>

            </div>

            {{-- Promo banner --}}
            <div class="relative rounded-2xl overflow-hidden shadow-lg">
                <img src="https://images.unsplash.com/photo-1601758228041-f3b2795255f1?w=1600&q=80"
                    class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-black/50"></div>

                <div class="relative z-10 flex flex-col lg:flex-row items-center justify-between gap-8 p-8 sm:p-12">
                    <div class="max-w-xl">
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-white uppercase leading-tight mb-4">
                            Ready to give your pet the best care?
                        </h2>
                        <p class="text-white/90">
                            Book daycare, overnight boarding, or grooming in just a few clicks - your pet's next great day is just around the corner.
                        </p>
                    </div>

                    <div class="bg-amber-400 rounded-xl p-6 text-center w-full lg:w-72 flex-shrink-0">
                        <ul class="text-gray-900 font-semibold text-sm space-y-1 mb-4">
                            <li>Daytime Daycare</li>
                            <li>Overnight Boarding</li>
                            <li>Pet Grooming</li>
                        </ul>
                        <div class="border-t border-gray-900/20 my-4"></div>
                        <p class="font-bold text-gray-900 mb-3">Ready to book your pet's stay?</p>
                        <a href="{{ route('bookings.index') }}"
                            class="inline-block bg-gray-900 hover:bg-black text-white font-semibold px-5 py-2.5 rounded-full">
                            Book Now
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>