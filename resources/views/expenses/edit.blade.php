<x-layout title="Edit Expense">
    <div class="max-w-3xl mx-auto bg-white shadow rounded-lg p-8 mt-10">
        <h2 class="text-2xl font-semibold mb-6">Edit Expense</h2>

        @if (session('warning'))
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4">
                {{ session('warning') }}
            </div>
        @endif

        <form action="{{ route('expenses.update', $expense) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-gray-700">Title</label>
                <input type="text" name="title" value="{{ old('title', $expense->title) }}"
                       class="w-full border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('title')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700">Amount ($)</label>
                <input type="number" step="0.01" name="amount" value="{{ old('amount', $expense->amount) }}"
                       class="w-full border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('amount')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700">Category</label>
                <select name="category_id"
                        class="w-full border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $expense->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700">Date</label>
                <input type="date" name="date" value="{{ old('date', $expense->date->format('Y-m-d')) }}"
                       class="w-full border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('date')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-between">
                <a href="{{ route('expenses.index') }}"
                   class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600">Cancel</a>
                <button type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">Update Expense</button>
            </div>
        </form>
    </div>
</x-layout>
