<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Your Expenses') }}
            </h2>
            <a href="{{ route('expenses.create') }}"
               class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 transition">
                + Add New Expense
            </a>
        </div>
    </x-slot>

    <div class="container mx-auto p-6">
        <div class="overflow-x-auto bg-white shadow-lg rounded-2xl p-4">

            @if(session('warning'))
                <div class="bg-yellow-200 text-yellow-800 p-3 rounded mb-4">
                    {{ session('warning') }}
                </div>
            @endif

            @if(session('success'))
                <div class="bg-green-200 text-green-800 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            <table class="w-full text-sm text-gray-700 border-collapse">
                <thead>
                <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-8 text-left">Title</th>
                    <th class="py-3 px-8 text-left">Amount ($)</th>
                    <th class="py-3 px-8 text-left">Category</th>
                    <th class="py-3 px-8 text-left">Date</th>
                    <th class="py-3 px-8 text-center">Actions</th>
                </tr>
                </thead>
                <tbody class="text-gray-700 text-sm font-light">
                @foreach($expenses as $expense)
                    <tr class="border-b border-gray-200 hover:bg-gray-50 cursor-pointer transition"
                        onclick="window.location='{{ route('expenses.show', $expense) }}'">
                        <td class="py-3 px-8">{{ $expense->title }}</td>
                        <td class="py-3 px-8">${{ number_format($expense->amount, 2) }}</td>
                        <td class="py-3 px-8">{{ $expense->category->name ?? 'Uncategorized' }}</td>
                        <td class="py-3 px-8">{{ $expense->date->format('M d, Y') }}</td>
                        <td class="py-3 px-8 text-center">
                            <form method="POST" action="{{ route('expenses.destroy', $expense) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-500 text-white py-1 px-4 rounded hover:bg-red-600 transition">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                @if($expenses->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center py-6 text-gray-500">No expenses found.</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
