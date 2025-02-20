<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BudgetController extends Controller
{
    public function index()
    {
        $budgets = Budget::where('user_id', Auth::id())->get()->map(function ($budget) {
            $totalExpenses = \App\Models\Expense::where('user_id', auth()->id())
                ->whereMonth('date', $budget->month)
                ->whereYear('date', $budget->year)
                ->sum('amount');
            $budget->totalExpenses = $totalExpenses;
            $budget->exceeded = $totalExpenses > $budget->amount;
            return $budget;
        });

        return view('budget.index', compact('budgets'));
    }


    public function create()
    {
        return view('budget.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'month' => 'required|integer|between:1,12',
            'year' => 'required|integer|min:2000',
        ]);

        Budget::create([
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'month' => $request->month,
            'year' => $request->year,
        ]);

        return redirect()->route('budget.index')->with('success', 'Budget set successfully!');
    }
}
