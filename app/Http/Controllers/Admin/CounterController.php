<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Counter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CounterController extends Controller
{
    /**
     * Display a listing of counters.
     */
    public function index(): View
    {
        $counters = Counter::all();
        return view('admin.counter.index', compact('counters'));
    }

    /**
     * Show the form for creating a new counter.
     */
    public function create(): View
    {
        return view('admin.counter.create');
    }

    /**
     * Store a newly created counter in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'icon' => ['required', 'string', 'max:255'],
            'number' => ['required', 'string', 'max:100'],
            'title' => ['required', 'string', 'max:255'],
            'status' => ['required', 'boolean'],
        ]);

        Counter::create([
            'icon' => $request->icon,
            'number' => $request->number,
            'title' => $request->title,
            'status' => $request->status,
        ]);

        toastr()->success('Counter statistic created successfully!');
        return redirect()->route('admin.counters.index');
    }

    /**
     * Show the form for editing the specified counter.
     */
    public function edit(Counter $counter): View
    {
        return view('admin.counter.edit', compact('counter'));
    }

    /**
     * Update the specified counter in storage.
     */
    public function update(Request $request, Counter $counter): RedirectResponse
    {
        $request->validate([
            'icon' => ['required', 'string', 'max:255'],
            'number' => ['required', 'string', 'max:100'],
            'title' => ['required', 'string', 'max:255'],
            'status' => ['required', 'boolean'],
        ]);

        $counter->update([
            'icon' => $request->icon,
            'number' => $request->number,
            'title' => $request->title,
            'status' => $request->status,
        ]);

        toastr()->success('Counter statistic updated successfully!');
        return redirect()->route('admin.counters.index');
    }

    /**
     * Remove the specified counter from storage.
     */
    public function destroy(Counter $counter): JsonResponse
    {
        try {
            $counter->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Counter deleted successfully!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong: ' . $e->getMessage(),
            ], 500);
        }
    }
}

