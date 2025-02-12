<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\User;
use App\Models\Subcontractor;
use App\Models\Task;
use App\Models\Customer;
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
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
        return self::show_project_index($is_expire = false);
    }

    public function index_expire_projects()
    {
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
        return self::show_project_index($is_expire = true);
    }

    public function project_detail_search()
    {
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
        return self::show_project_search_index([],null);
    }

    public function project_detail_search_execute(Request $request)
    {
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');

        $user_id = $request['user_id'];
        $customer_id = $request['customer_id'];
        $search_date = $request['search_date']; // 'start_date' or 'end_date'
        $from_date = $request['from_date'];
        $to_date = $request['to_date'];
        $project_name = $request['project_name'];

        $projects = self::summaryProjectData($user_id, $customer_id);

        // プロジェクト名で絞る
        if ($project_name != '') {
            $projects = $projects->where(Project::CLM_NAME_OF_PROJECT_NAME, 'LIKE', '%' . $request['project_name'] . '%');
        }

        // 日付による絞り込み
        if ($from_date) {
            Log::debug(__METHOD__ . '(' . __LINE__ . ') from_date:' . $from_date);
            $projects = $projects->where($search_date, '>=', $from_date); // from_date 以降
        }

        if ($to_date) {
            Log::debug(__METHOD__ . '(' . __LINE__ . ') to_date:' . $to_date);
            $projects = $projects->where($search_date, '<=', $to_date); // to_date 以前
        }

        $projects = $projects->get();
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
        return self::show_project_search_index($projects,$request);
    }


    private function show_project_search_index($projects,$search_conditions)
    {
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');
        $users = User::query()
            ->get();
        $customers = Customer::query()
            ->get();
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
        return view('projects.detail', [
            'users' => $users,
            'customers' => $customers,
            'projects' => $projects,
            'search_conditions' => $search_conditions
        ]);
    }

    private function show_project_index($is_expire = false)
    {
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');
        $projects = self::summaryProjectData($user_id = null, $customer_id = null)
            ->where(Project::CLM_NAME_OF_IS_EXPIRE, $is_expire)
            ->get();

        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
        return view('projects.index', [
            'projects' => $projects,
            'is_expire' => $is_expire
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
        $customers = Customer::query()
            ->get();
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
        return view('projects.create', [
            'users' => $users,
            'customers' => $customers,
        ]);
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
        $customers = Customer::query()
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
            'tasks' => $tasks,
            'customers' => $customers,
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

    public static function summaryProjectData($user_id, $customer_id = null)
    {
        $projects = DB::table('projects as p')
            ->leftJoin(DB::raw('(
            SELECT
                p.id AS project_id,
                SUM(w.amount) AS inside
            FROM works w
            JOIN tasks t ON t.id = w.task_id
            JOIN projects p ON p.id = t.project_id
            WHERE w.subcontractor_id IN (
                SELECT subcontractor_id FROM users
            )
            GROUP BY p.id
        ) as inside'), 'inside.project_id', '=', 'p.id')

            ->leftJoin(DB::raw('(
            SELECT
                p.id AS project_id,
                SUM(w.amount) AS outside
            FROM works w
            JOIN tasks t ON t.id = w.task_id
            JOIN projects p ON p.id = t.project_id
            WHERE w.subcontractor_id NOT IN (
                SELECT subcontractor_id FROM users
            )
            GROUP BY p.id
        ) as outside'), 'outside.project_id', '=', 'p.id')

            ->leftJoin('users as u', 'u.id', '=', 'p.user_id')
            ->leftJoin('customers as c', 'c.id', '=', 'p.customer_id')

            ->select(
                'p.id as project_id',
                'c.customer_name as customer_name',
                'p.project_name as project_name',
                'p.is_expire as is_expire',
                DB::raw('COALESCE(u.id, 0) as user_id'),
                DB::raw('COALESCE(u.name, "未選択") as user_name'),
                DB::raw('COALESCE(c.id, 0) as customer_id'),
                DB::raw('COALESCE(c.customer_name, "未選択") as customer_name'),
                'p.start_date',
                'p.end_date',
                'p.amount',
                DB::raw('COALESCE(inside.inside, 0) as inside'),
                DB::raw('COALESCE(outside.outside, 0) as outside'),
                DB::raw('p.amount - COALESCE(outside.outside, 0) as profit')
            )
            ->groupBy('p.id', 'p.is_expire', 'p.project_name', 'u.id', 'u.name', 'c.id', 'c.customer_name', 'p.start_date', 'p.end_date', 'p.amount', 'inside.inside', 'outside.outside');

        if ($user_id) {
            $projects = $projects->where('p.user_id', $user_id);
        }

        if ($customer_id) {
            $projects = $projects->where('p.customer_id', $customer_id);
        }

        return $projects;
    }
}
