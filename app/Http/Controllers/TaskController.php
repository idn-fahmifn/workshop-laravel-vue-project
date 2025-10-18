<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Auth::user()->tasks()
            // Menggantikan ->get() dengan ->paginate()
            ->orderBy('is_completed')
            ->orderByDesc('created_at')
            ->paginate(5); // 👈 Menampilkan 5 item per halaman

        return Inertia::render('Task/Index',[
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Task/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $validated = $request->validate([
            'task_name' => 'required|string|max:255',
            'priority' => 'required|in:low,medium,high',
            'dateline' => 'required|date', // 👈 Field dari Vue
            'description' => 'required|string',
        ]);
        
        Task::create([
            'task_name' => $request->input('task_name'),
            'priority' => $request->input('priority'),
            'dateline' => $request->input('dateline'),
            'description' => $request->input('description'),
            'user_id' => Auth::user()->id
        ]);

        return redirect()->route('task.index')->with('success', 'Tugas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($task)
    {
        return Inertia::render('Task/Detail', [
            'task' => Task::findOrFail($task)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($task)
    {
        return Inertia::render('Task/Edit', [
            'task' => Task::findOrFail($task)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $task)
    {
        $data = Task::findOrFail($task);
        $validated = $request->validate([
            'task_name' => 'required|string|max:255',
            'priority' => 'required|in:low,medium,high',
            'dateline' => 'required|date', // 👈 Field dari Vue
            'description' => 'required|string',
            'is_completed' => 'required|boolean',
        ]);
        

        $data->update($validated);

        return redirect()->route('task.index')->with('success', 'Tugas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($task)
    {
        $data = Task::findOrFail($task);
        $data->delete();

        return redirect()->route('task.index')->with('success', 'Tugas berhasil dihapus.');
    }
}
