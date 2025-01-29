<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReportHeaderRequest;
use App\Http\Requests\UpdateReportHeaderRequest;
use App\Models\ReportHeader;

use Illuminate\Support\Facades\Log;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReportHeaderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ReportHeader $reportHeader)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReportHeader $reportHeader)
    {
        //
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
