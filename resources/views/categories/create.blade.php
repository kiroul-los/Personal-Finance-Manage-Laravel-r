<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Category') }}
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto py-10">
        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded-lg shadow mb-4">
                {{ session('success') }}
            </div>
        @endif

            @if (session('warning'))
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4" role="alert">
                    <p>{{ session('warning') }}</p>
                </div>
            @endif


        <div class="bg-white shadow rounded-lg p-6">
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Category Name:</label>
                    <input type="text" name="name" id="name"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           placeholder="Enter category name" value="{{ old('name') }}" required>
                    @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Add Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
