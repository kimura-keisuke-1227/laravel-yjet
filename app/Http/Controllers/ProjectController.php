<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\User;
use App\Models\Subcontractor;
use App\Models\Task;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');
        $projects = self::summaryProjectData(null)
            ->get();


        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
        return view('projects.index', [
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
        return view('projects.create', ['users' => $users]);
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
        return redirect(Route('project.create'))->with('success', 'プロジェクトを登録しました。');
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
            ->where(Task::CLM_NAME_OF_PROJECT_ID, $project->id);

        $tasks = $tasks->where(Task::CLM_NAME_OF_IS_EXPIRE, false);

        $tasks = $tasks->get();

        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
        return view('projects.edit', [
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

        // リクエストの内容をログに出力
        Log::debug('Request Data: ' . json_encode($request->all()));


        $validated = $request->validated();
        if (!isset($data['is_expire'])) {
            $project['is_expire'] = 0; // チェックボックスが外れている場合は 0 をセット
        }
        $project->update($validated);

        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
        return redirect(Route('project.index'))->with('success', 'プロジェクトを更新しました。');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }

    public function summaryProjectData($user)
    {
        $projects = DB::table('projects')
            ->select(
                'projects.id as project_id',  // 主キーを選択
                'projects.project_name',
                DB::raw("IFNULL(users.name, '未選択') AS user_name"),
                'projects.start_date',
                'projects.end_date',
                'projects.amount',
                DB::raw("IFNULL(SUM(works.amount), 0) AS total_work_amount"),
                'users.id AS user_id'
            )
            ->leftJoin('tasks', 'projects.id', '=', 'tasks.project_id')
            ->leftJoin('works', 'tasks.id', '=', 'works.task_id')
            ->leftJoin('users', 'projects.user_id', '=', 'users.id')
            ->groupBy('projects.id', 'projects.project_name', 'users.id', 'users.name', 'projects.start_date', 'projects.end_date', 'projects.amount');

        if($user){
            $projects = $projects ->where('user_id', $user->id);
        }
        return $projects;
    }
}
