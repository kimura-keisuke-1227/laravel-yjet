<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use App\Models\Subcontractor;
use App\Models\Work;
use Illuminate\Support\Facades\DB;
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
        $task = Task::create($validated);
        $users = User::query()
            ->get();
        $subcontractors = Subcontractor::query()
            ->get();
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
        return redirect()->route('project.edit', ['project' => $task->project->id])
        ->with('success', 'タスクを登録しました。');
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
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');
        $projects = Project::query()
            ->get();

        $works = Work::query()
            ->where(Work::CLM_NAME_OF_TASK_ID,$task->id)
            ->orderBy(Work::CLM_NAME_OF_WORK_DATE,'desc');

        $works = $works->get();
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
        return view('tasks.edit',[
            'task' => $task,
            'projects' => $projects,
            'parentProject' => $task->project,
            'works' => $works,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');

        $validated = $request -> validated();
        $task ->update($validated);

        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
        return redirect()->route('project.edit', ['project' => $task->project->id])
        ->with('success', 'タスクを更新しました。');
    }

    /**
     * Remove the specified resource from storage.
     */


    public function destroy(Task $task)
    {
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');
        $project = $task->project;

        DB::transaction(function () use ($task) {
            Work::query()
                ->where(Work::CLM_NAME_OF_TASK_ID, $task->id)
                ->delete();
            $task->delete();
        });
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
        return redirect()->route('project.edit', ['project' => $project->id])
        ->with('success', 'タスクと配下の作業を削除しました。');
    }
}
