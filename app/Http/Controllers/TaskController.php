<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Requests\StoreTaskRequest;

/**
 * Class TaskController
 *
 * Handles CRUD operations for tasks including creation, listing,
 * updating, and deletion. Supports both JSON and Inertia responses.
 */
class TaskController extends Controller
{
    /**
     * Display a listing of the tasks.
     * Returns JSON if requested, otherwise renders the Inertia page.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse|\Inertia\Response
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return response()->json([
                'tasks' => Task::with('category')->get()
            ]);
        }

        return Inertia::render('Tasks/Index');
    }

    /**
     * Show the form for creating a new task (currently unused).
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created task in the database.
     *
     * @param \App\Http\Requests\StoreTaskRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreTaskRequest $request)
    {
        $task = Task::create($request->validated());

        return response()->json(['task' => $task], 201);
    }

    /**
     * Display the specified task (currently unused).
     *
     * @param \App\Models\Task $task
     * @return void
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified task (currently unused).
     *
     * @param \App\Models\Task $task
     * @return void
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified task in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'category_id' => ['nullable', 'exists:categories,id'],
        ]);

        $task->update($validated);

        return response()->json(['task' => $task]);
    }

    /**
     * Remove the specified task from the database.
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return response()->noContent();
    }
}
