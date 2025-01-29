<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;

use Illuminate\Support\Facades\Log;

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

    // Validate the incoming request data
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        // 'password' => 'required|string|min:8|confirmed', // Use 'password_confirmation' for confirmation
    ]);

    // // Add the hashed password to the validated data
    // $validatedData['password'] = bcrypt($validatedData['password']);

    // Create the user
    User::create($validatedData);

    Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');

    return redirect()->route('user.index');
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

        $projects = Project::query()
            ->where(Project::CLM_NAME_OF_USER_ID,$user->id);
        $projects = $projects->orderBy(Project::CLM_NAME_OF_IS_EXPIRE);
        $projects = $projects->orderBy(Project::CLM_NAME_OF_START_DATE,'desc');

        Log::debug(__METHOD__ . '(' . __LINE__ . ')' . $projects->toSql());
        $projects = $projects->get();
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
        return view('admin.users.edit',[
            'user' => $user,
            'projects' => $projects,
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
        return view('admin.users.edit',[
            'user' => $user
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
