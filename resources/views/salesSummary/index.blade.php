@extends('layouts.admin')

@section('title', 'プロジェクト')

@section('content')
    <h2>売上集計({{$year}}年度)</h2>
    <div class="container">
        <h3>{{ $start_date }} から {{ $end_date }} までの集計</h3>
        <table class='table table-striped'>
            <tr>
                <th>担当者名</th>
                <th>受注分合計</th>
                <th>外注費合計</th>
                <th>ヘルプ売上</th>
                <th>収益</th>
            </tr>
            @foreach ($sales as $sale)
                <tr>
                    <td><a href="{{ route('user.edit', ['user' => $sale->user_id]) }}">{{ $sale->name }}</a></td>
                    <td>{{ number_format($sale->total_project_amount) }}</td>
                    <td>{{ number_format($sale->subcontractor_expenses_total) }}</td>
                    <td>{{ number_format($sale->help_sales_total) }}</td>
                    <td>{{ number_format($sale->total_project_amount - $sale->subcontractor_expenses_total + $sale->help_sales_total) }}
                    </td>
                </tr>
            @endforeach
        </table>
        <a href="{{Route('annual.show.year',['year'=> $year-1])}}">{{$year-1}}年へ</a>　　　<a href="{{Route('annual.show.year',['year'=> $year+1])}}">{{$year+1}}年へ</a>
    </div>
@endsection
