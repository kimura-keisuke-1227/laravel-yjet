<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Models\Project;

use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Project $seproject)
    {
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');
        $projects = Project::query()
            ->get();
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
        return view('tasks.create',[
            'projects' => $projects
        ]);
    }

    public function createTaskForProject(Project $project)
    {
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');
        $projects = Project::query()
            ->get();
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
        return view('tasks.create',[
            'projects' => $projects,
            'parentProject' => $project
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');

        $validated = $request->validated();
        Task::create($validated);
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
        return redirect(Route('project.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}
