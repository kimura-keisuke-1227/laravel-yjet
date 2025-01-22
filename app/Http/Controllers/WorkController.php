<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWorkRequest;
use App\Http\Requests\UpdateWorkRequest;
use App\Models\Work;

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
    public function create()
    {
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
        return view('work.create');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWorkRequest $request, Work $work)
    {
        //
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
        ->select('out_source_id',
                 DB::raw('SUM(actual_time) as total_actual_time'),
                 DB::raw('SUM(scheduled_time) as total_scheduled_time'))
        ->whereBetween('date', [Carbon::now()->subDays(7)->toDateString(), Carbon::now()->toDateString()])
        ->groupBy('out_source_id')
        ->get();
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
        return view('work.weekly',[
            'weekly' => $weekly,
        ]);
    }
}
