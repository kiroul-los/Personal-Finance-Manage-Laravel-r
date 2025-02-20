<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Category;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expenses = Expense::with('category')->where('user_id', auth()->id())->get();
        $categories = Category::all();
        return view('expenses.index', compact('expenses', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::all();
        if ($categories->isEmpty()){
            return redirect()->route('categories.create')->with('warning', 'You need to add at least one category before adding expenses.');;
        }
        return view('expenses.create', compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'category_id' => 'required|exists:categories,id',
        ]);

        $this->checkBudget($request->amount, $request->date);

        Expense::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'amount' => $request->amount,
            'date' => $request->date,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('expenses.index')->with('success', 'Expense added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        $this->authorize('view', $expense);
        return view('expenses.show', compact('expense'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        $this->authorize('update', $expense);
        return view('expenses.edit', compact('expense'));
    }

    public function update(Request $request, Expense $expense)
    {
        $this->authorize('update', $expense);

        $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'category_id' => 'required|exists:categories,id',
        ]);

        $this->checkBudget($request->amount - $expense->amount, $request->date);

        $expense->update($request->all());

        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        $this->authorize('delete', $expense);
        $expense->delete();

        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully!');
    }

    private function checkBudget($newAmount, $date)
    {
        $month = date('m', strtotime($date));
        $year = date('Y', strtotime($date));

        $budget = Budget::where('user_id', Auth::id())
            ->where('month', $month)
            ->where('year', $year)
            ->first();

        if ($budget) {
            $totalExpenses = Expense::where('user_id', Auth::id())
                ->whereMonth('date', $month)
                ->whereYear('date', $year)
                ->sum('amount');

            $newTotal = $totalExpenses + $newAmount;

            if ($newTotal > $budget->amount) {
                session()->flash('warning', 'Warning: This expense exceeds your monthly budget!');
            }
        }
    }
}
