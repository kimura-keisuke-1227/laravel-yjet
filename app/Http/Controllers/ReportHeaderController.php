<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReportHeaderRequest;
use App\Http\Requests\UpdateReportHeaderRequest;
use App\Models\ReportHeader;

use Illuminate\Support\Facades\Log;

class ReportHeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');
        $report_headers = ReportHeader::query();

        $report_headers = $report_headers->get();

        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
        return view('report_headers.index',[
            'report_headers' => $report_headers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
        return view('report_headers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReportHeaderRequest $request)
    {
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');

        $validated = $request->validated();
        ReportHeader::create($validated);

        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
        return redirect(Route('report.index'))-> with('success','レポートヘッダーを登録しました。');
    }

    /**
     * Display the specified resource.
     */
    public function show(ReportHeader $reportHeader)
    {
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
        return 'fuga';
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReportHeader $reportHeader)
    {
        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' start!');

        Log::info(__METHOD__ . '(' . __LINE__ . ')' . ' end!');
        return view('report_headers.edit', ['report_header' => $reportHeader]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReportHeaderRequest $request, ReportHeader $reportHeader)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReportHeader $reportHeader)
    {
        //
    }
}
