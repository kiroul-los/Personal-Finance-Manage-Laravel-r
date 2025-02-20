<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Monthly Budgets') }}
        </h2>
    </x-slot>

    <div class="max-w-5xl mx-auto py-10">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('warning'))
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4 rounded">
                <p>{{ session('warning') }}</p>
            </div>
        @endif

        <div class="flex justify-end mb-4">
            <a href="{{ route('budget.create') }}"
               class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                + Add New Budget
            </a>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Month
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Year
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Budget Amount ($)
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Total Expenses ($)
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($budgets as $budget)
                    <tr class="{{ $budget->exceeded ? 'bg-red-100' : '' }}">
                        <td>{{ $budget->month }}/{{ $budget->year }}</td>
                        <td>${{ number_format($budget->amount, 2) }}</td>
                        <td>${{ number_format($budget->totalExpenses, 2) }}</td>
                        <td>
                            @if ($budget->exceeded)
                                <span class="text-red-500 font-semibold">⚠️ Exceeded!</span>
                            @else
                                <span class="text-green-500 font-semibold">✅ Within Budget</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-6 text-gray-500">No budgets found.</td>
                    </tr>
                @endforelse



                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
