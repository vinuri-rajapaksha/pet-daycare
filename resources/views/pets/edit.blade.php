<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit {{ $pet->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-6 shadow sm:rounded-lg">

                @if ($errors->any())
                <div class="mb-4 text-red-600 text-sm">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form method="POST" action="{{ route('pets.update', $pet) }}" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Pet Name</label>
                        <input type="text" name="name" value="{{ old('name', $pet->name) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Pet Type</label>
                        <select name="pet_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                            <option value="dog" {{ old('pet_type', $pet->pet_type) === 'dog' ? 'selected' : '' }}>Dog</option>
                            <option value="cat" {{ old('pet_type', $pet->pet_type) === 'cat' ? 'selected' : '' }}>Cat</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Age (years, optional)</label>
                        <input type="number" name="age" min="0" max="30" value="{{ old('age', $pet->age) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Breed</label>
                        <input type="text" name="breed" value="{{ old('breed', $pet->breed) }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Notes (allergies, etc.)</label>
                        <textarea name="notes"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('notes', $pet->notes) }}</textarea>
                    </div>

                    <div class="flex gap-3">
                        <button type="submit"
                            class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                            Save Changes
                        </button>
                        <a href="{{ route('pets.index') }}"
                            class="px-4 py-2 rounded-md text-gray-600 hover:bg-gray-100">
                            Cancel
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>