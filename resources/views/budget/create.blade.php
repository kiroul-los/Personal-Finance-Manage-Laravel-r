<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Set Monthly Budget') }}
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto py-10">
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('budget.store') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700">Amount ($)</label>
                <input type="number" name="amount" step="0.01" class="w-full border-gray-300 rounded-lg" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Month</label>
                <input type="number" name="month" min="1" max="12" class="w-full border-gray-300 rounded-lg" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Year</label>
                <input type="number" name="year" min="2000" class="w-full border-gray-300 rounded-lg" required>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                Save Budget
            </button>
        </form>
    </div>
</x-app-layout>
