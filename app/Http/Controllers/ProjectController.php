<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\User;
use App\Models\Subcontractor;
use App\Models\Task;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');
        $projects = Project::query();

        $projects = $projects->where(Project::CLM_NAME_OF_IS_EXPIRE,false);

        $projects = $projects ->get();
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
        return view('projects.index',[
            'projects' => $projects
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');
        $users = User::query()
            ->get();
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
        return view('projects.create',['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');

        $validated = $request->validated();
        Project::create($validated);

        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
        return redirect(Route('project.create'))-> with('success','プロジェクトを登録しました。');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');
        $users = User::query()
            ->get();
        $subcontractors = Subcontractor::query()
            ->orderBy(Subcontractor::CLM_NAME_OF_SUBCONTRACTOR_CODE)
            ->get();

        $tasks = Task::query()
            ->where(Task::CLM_NAME_OF_PROJECT_ID,$project->id);

        $tasks = $tasks->where(Task::CLM_NAME_OF_IS_EXPIRE,false);

        $tasks = $tasks->get();

        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
        return view('projects.edit',[
            'project' => $project,
            'subcontractors' => $subcontractors,
            'users' => $users,
            'tasks' => $tasks
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {

        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');

        $validated = $request -> validated();
        $project ->update($validated);

        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
        return redirect(Route('project.index'))-> with('success','プロジェクトを更新しました。');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}
