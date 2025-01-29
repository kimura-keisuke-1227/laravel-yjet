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
        return redirect(Route('project.edit', ['project' => $project->id]))->with('success', $task->task_name . '　に作業データを追加しました。');
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
        return redirect(Route('work.create'))->with('success', '作業データを登録しました。');
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
        return redirect(Route('project.edit', ['project' => $work->task->project]))->with('success', '作業データを更新しました。');
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
        return redirect(Route('project.edit', ['project' => $project->id]))->with('success', 'プロジェクト内の作業データを一括更新しました。');
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
    // public function destroy(Work $work)
    // {
    //     Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');
    //     $project = $work->task->project;
    //     $work->delete();
    //     $users = User::query()
    //         ->get();
    //     Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
    //     return redirect(Route('project.edit', [
    //         'project' => $project->id,
    //         'users' => $users
    //     ]))-> with('success','作業データを削除しました。');
    // }

    public function work_delete(Work $work)
    {
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');
        $project = $work->task->project;
        $work->delete();
        $users = User::query()
            ->get();
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
        return redirect(Route('project.edit', [
            'project' => $project->id,
            'users' => $users
        ]))->with('success', '作業データを削除しました。');
    }

    public function weekly()
    {
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');

        $start_date = Carbon::now()->subDays(6)->toDateString();
        $end_date   = Carbon::now()->toDateString();

        $weekly =  $weekly = self::get_weekly_data_by_sdate_edate($start_date, $end_date);

        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');

        return self::get_weekly_view($weekly, date("Y-m-d"), 7, $start_date);
    }

    public function weekly_with_base_date(Request $request)
    {
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');

        // リクエストから base_date と days を取得
        $base_date = Carbon::parse($request['base_date']); // Carbon で日付をパース
        $days = (int) $request['days_before'];

        $start_date = $base_date->copy()->subDays($days - 1)->toDateString();
        $end_date = $base_date->toDateString(); // $base_date を最終日とする

        Log::debug(__METHOD__ . '(' . __LINE__ . ') data between' . $start_date . "~" . $end_date);

        $weekly = self::get_weekly_data_by_sdate_edate($start_date, $end_date);

        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');

        return self::get_weekly_view($weekly, $end_date, $days, $start_date);
    }

    private function get_weekly_data_by_sdate_edate($start_date, $end_date)
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
            ->whereBetween('works.date', [$start_date, $end_date]) // $start_date と $end_date を条件に使用
            ->groupBy('subcontractors.id', 'subcontractors.subcontractor_name'); // id と name でグループ化

        Log::debug(__METHOD__ . '(' . __LINE__ . ')' . $weekly->toSql());
        $weekly = $weekly->get();

        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
        return $weekly;
    }

    private function get_weekly_view($weekly, $base_date, $days, $start_date)
    {
        return view('work.weekly', [
            'weekly' => $weekly,
            'base_date' => $base_date,
            'days' => $days,
            'start_date' => $start_date
        ]);
    }

    public function copy_work(Work $work)
    {
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');
        $new_work = new Work();
        $task = $work->task;
        $new_work[Work::CLM_NAME_OF_TASK_ID] = $task->id;
        $new_work[Work::CLM_NAME_OF_USER_ID] = $task->project->user_id;
        $new_work[Work::CLM_NAME_OF_OUT_SOURCE_ID] = $work->subcontractor_id;
        $new_work[Work::CLM_NAME_OF_WORK_DATE] = date('Y-m-d');
        $new_work[Work::CLM_NAME_OF_SCHEDULED_TIME] = $work->scheduled_time;
        $new_work[Work::CLM_NAME_OF_ACTUAL_TIME] = $work->actual_time;
        $new_work[Work::CLM_NAME_OF_CANCELED] = null;
        $new_work[Work::CLM_NAME_OF_REMARK] = $work->remark;

        $new_work->save();
        $project = $task->project;
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
        return redirect(Route('project.edit', ['project' => $project->id]))->with('success', '作業データを複製しました。');
    }

    public function show_compute_detailed_summary_form()
    {
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');

        $start_date = Carbon::now()->subDays(6)->toDateString();
        $end_date   = Carbon::now()->toDateString();

        $user_id = 0;
        $subcontractors_id = 0;

        $order_by = 1;

        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
        return self::show_compute_detailed_summary_form_with_summary($start_date, $end_date, $user_id, $subcontractors_id,$order_by);
    }

    public function compute_detailed_summary_form(Request $request)
    {
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');

        //検索条件
        $start_date        = $request['start_date'];
        $end_date          = $request['end_date'];
        $user_id           = $request['user_id'];
        $subcontractor_id  = $request['subcontractor_id'];

        //並び順
        $order_by = $request['order_by'];

        // 条件に基づいて処理を分岐
        if ($start_date === null && $end_date === null && $user_id == 0 && $subcontractor_id == 0) {
            Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' No filters specified.');
            // 検索条件が指定されていない場合、特定の処理（例: 空データを返す等）を実行
            return redirect(Route('show_compute_detailed_summary_form'))-> with('error','検索条件が指定されていません');
        } else {
            Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' filters provided, proceeding to query.');
            // 検索条件が指定されている場合、次の処理へ
            return self::show_compute_detailed_summary_form_with_summary($start_date, $end_date, $user_id, $subcontractor_id,$order_by);
        }

        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
    }

    private function show_compute_detailed_summary_form_with_summary($start_date, $end_date, $user_id, $subcontractor_id,$order_by)
    {
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');

        // パラメータをまとめて配列形式でログに記録
        Log::debug(__METHOD__ . '(' . __LINE__ . ') パラメータ:', [
            'start_date' => $start_date,
            'end_date' => $end_date,
            'user_id' => $user_id,
            'subcontractor_id' => $subcontractor_id,
        ]);

        // 発注者と外注先を取得
        $users = User::all();
        $subcontractors = Subcontractor::all();

        // 週次集計データを取得（新しい関数を呼び出し）
        $weekly = $this->compute_weekly_summary($start_date, $end_date, $user_id, $subcontractor_id,$order_by);

        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');

        return view('work.compute_detailed_summary', [
            'start_date' => $start_date,
            'end_date' => $end_date,
            'weekly' => $weekly,
            'users' => $users,
            'subcontractors' => $subcontractors,
            'user_id' => $user_id,
            'subcontractor_id' => $subcontractor_id,
            'order_by' => 2
        ]);
    }

    /**
     * 週次集計データを取得する関数
     */
    private function compute_weekly_summary($start_date, $end_date, $user_id, $subcontractor_id,$order_by)
    {
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');

        // 検索条件が1つも指定されていない場合はnull
        $hasFilters = $user_id == 0 || $subcontractor_id != 0 || ($start_date !== null && $end_date !== null);
        if (!$hasFilters) {
            Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end! return [] ');
            return null;
        }

        $weekly = Work::query()
            ->when($user_id != 0, function ($query) use ($user_id) {
                Log::debug(__METHOD__ . '(' . __LINE__ . ') user_id:' . $user_id);
                return $query->where('user_id', $user_id);
            })
            ->when($subcontractor_id != 0, function ($query) use ($subcontractor_id) {
                Log::debug(__METHOD__ . '(' . __LINE__ . ') subcontractor_id:' . $subcontractor_id);
                return $query->where('subcontractor_id', $subcontractor_id);
            })
            ->when($start_date !== null, function ($query) use ($start_date) {
                Log::debug(__METHOD__ . '(' . __LINE__ . ') start_date:' . $start_date);
                return $query->where('date', '>=', $start_date);
            })
            ->when($end_date !== null, function ($query) use ($end_date) {
                Log::debug(__METHOD__ . '(' . __LINE__ . ') end_date:' . $end_date);
                return $query->where('date', '<=', $end_date);
            })
            ->get();

        Log::debug(__METHOD__ . '(' . __LINE__ . ')' . ' Weekly Data:', $weekly->toArray());
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end! get from Database.');

        return $weekly;
    }

    private function get_order_column($order_by){
        switch ($order_by) {
            case 0:
                $order_column = Work::CLM_NAME_OF_USER_ID;
                break;
            case 1:
                $order_column =  Work::CLM_NAME_OF_OUT_SOURCE_ID;
                break;
            case 2:
                $order_column =  Work::CLM_NAME_OF_WORK_DATE;
                break;
        }

        return $order_column;
    }
}
