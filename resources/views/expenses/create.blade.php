<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Expense') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6">
        <div class="bg-white shadow-lg rounded-2xl p-6">
            <form action="{{ route('expenses.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700">Title</label>
                    <input type="text" name="title" required
                           class="w-full border-gray-300 rounded-lg shadow-sm mt-1">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Amount ($)</label>
                    <input type="number" step="0.01" name="amount" required
                           class="w-full border-gray-300 rounded-lg shadow-sm mt-1">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Category</label>
                    <select name="category_id" required class="w-full border-gray-300 rounded-lg shadow-sm mt-1">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Date</label>
                    <input type="date" name="date" required
                           class="w-full border-gray-300 rounded-lg shadow-sm mt-1">
                </div>

                <div class="text-right">
                    <button type="submit"
                            class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition">
                        Save Expense
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
