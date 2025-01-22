<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubcontractorRequest;
use App\Http\Requests\UpdateSubcontractorRequest;
use App\Models\Subcontractor;

use Illuminate\Support\Facades\Log;

class SubcontractorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');
        $subcontractors = Subcontractor::query()
            ->get();
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
        return view('subcontractor.index',[
            'subcontractors' => $subcontractors
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
        return view('subcontractor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubcontractorRequest $request)
    {
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');

        $validated = $request->validated();
        Subcontractor::create($validated);
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
        return redirect('subcontractor.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subcontractor $subcontractor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subcontractor $subcontractor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubcontractorRequest $request, Subcontractor $subcontractor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subcontractor $subcontractor)
    {
        //
    }
}
