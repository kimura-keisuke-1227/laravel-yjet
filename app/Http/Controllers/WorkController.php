<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreWorkRequest;
use App\Http\Requests\UpdateWorkRequest;
use App\Models\Project;
use App\Models\Work;
use App\Models\Task;
use App\Models\Subcontractor;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Illuminate\Support\Facades\Log;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
        return 'hoge';
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Task $task)
    {
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');
        $work = new Work();
        $work[Work::CLM_NAME_OF_TASK_ID] = $task->id;
        $work[Work::CLM_NAME_OF_USER_ID] = $task->project->user_id;
        $work[Work::CLM_NAME_OF_OUT_SOURCE_ID] = 0;
        $work[Work::CLM_NAME_OF_WORK_DATE] = date('Y-m-d');
        $work[Work::CLM_NAME_OF_SCHEDULED_TIME] = 0;
        $work[Work::CLM_NAME_OF_ACTUAL_TIME] = 0;
        $work[Work::CLM_NAME_OF_CANCELED] = null;



        $work->save();
        $project = $task->project;
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
        return redirect(Route('project.edit', ['project' => $project->id]));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWorkRequest $request)
    {
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');
        $validated = $request->validated();
        Work::create($validated);
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
        return redirect(Route('work.create'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Work $work)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Work $work)
    {
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');
        $subcontractors = Subcontractor::query()
            ->get();
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
        return view('work.edit', [
            'work' => $work,
            'subcontractors' => $subcontractors
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWorkRequest $request, Work $work)
    {

        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');

        $validated = $request->validated();
        $work->update($validated);
        $subcontractors = Subcontractor::query()
            ->get();
        $users = User::query()
            ->get();
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
        return view('projects.edit', [
            'project' => $work->task->project,
            'subcontractors' => $subcontractors,
            'users' => $users
        ]);
    }


    public function multipleUpdate(Request $request, Project $project)
    {
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');
        Log::debug(__METHOD__ . '(' . __LINE__ . ')' . "request");
        Log::debug($request);

        $clm_list_of_work = [
            Work::CLM_NAME_OF_OUT_SOURCE_ID,
            Work::CLM_NAME_OF_USER_ID,
            Work::CLM_NAME_OF_WORK_DATE,
            Work::CLM_NAME_OF_SCHEDULED_TIME,
            Work::CLM_NAME_OF_ACTUAL_TIME,
        ];

        foreach ($project->tasks as $task) {
            foreach ($task->works as $work) {
                foreach ($clm_list_of_work as $clm) {
                    $set_val = $request[$clm . '_' . $work->id];
                    Log::debug(__METHOD__ . '(' . __LINE__ . ') work(' . $work['id'] . ')' . $clm  . '=> ' . $set_val);
                    Log::debug($request[$clm . '_' . $work->id]);
                    $work[$clm] = $set_val;
                }
                Log::debug($work);
                $work->save();
            }
        }

        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
        return redirect(Route('project.edit', ['project' => $project->id]));
    }

    public function singleUpdate(UpdateWorkRequest $request, Work $work)
    {
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');
        $users = User::query()
            ->get();
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
        return redirect(Route('project.edit', [
            'project' => $work->task->project->id,
            'users' => $users
        ]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Work $work)
    {
        //
    }

    public function weekly()
    {
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');
        $weekly = DB::table('works')
    ->join('subcontractors', 'works.subcontractor_id', '=', 'subcontractors.id')
    ->select(
        'subcontractors.id as subcontractor_id',
        'subcontractors.subcontractor_name as subcontractor_name',
        DB::raw('SUM(works.actual_time) as total_actual_time'),
        DB::raw('SUM(works.scheduled_time) as total_scheduled_time')
    )
    ->whereBetween('works.date', [Carbon::now()->subDays(7)->toDateString(), Carbon::now()->toDateString()])
    ->groupBy('subcontractors.id', 'subcontractors.subcontractor_name'); // idとnameでグループ化
        Log::debug(__METHOD__ . '(' . __LINE__ . ')' . $weekly->toSql());
        $weekly = $weekly ->get();
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
        return view('work.weekly', [
            'weekly' => $weekly,
        ]);
    }
}
