<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;
use App\Models\Subcontractor;

use App\Http\Controllers\ProjectController;
use App\Models\Work;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');
        $users = User::query()
            ->get();
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
        return view('admin.users.index',[
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');

    // バリデーション
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
    ]);

    DB::transaction(function () use ($request, &$user) {
        // Userの作成
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Subcontractorの作成
        $subcontractor = Subcontractor::create([
            Subcontractor::CLM_NAME_OF_SUBCONTRACTOR_NAME => $request->name,
            Subcontractor::CLM_NAME_OF_SUBCONTRACTOR_CODE => $request[Subcontractor::CLM_NAME_OF_SUBCONTRACTOR_CODE],
        ]);

        // Userにsubcontractor_idを設定して保存
        $user->subcontractor_id = $subcontractor->id;
        $user->save();
    });

    Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');

    return redirect()->route('user.index') ->with('success','ユーザーを登録しました。また、作業者としても追加しています。');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');

        $projects = ProjectController::summaryProjectData($user->id);

        Log::debug(__METHOD__ . '(' . __LINE__ . ')' . $projects->toSql());
        $projects = $projects->get();
        $helps = Work::query()
            ->where(Work::CLM_NAME_OF_OUT_SOURCE_ID,$user->subcontractor_id)
            ->orderBy(Work::CLM_NAME_OF_WORK_DATE,'desc');

        $helps = $helps->get();
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
        return view('admin.users.edit',[
            'user' => $user,
            'projects' => $projects,
            'helps' => $helps
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');
        $user['name'] = $request['name'];
        $user['email'] = $request['email'];
        $user->save();
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
        return redirect(Route('user.index'))
            ->with('success','ユーザー情報を更新しました。');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
