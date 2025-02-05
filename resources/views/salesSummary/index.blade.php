@extends('layouts.admin')

@section('title', 'プロジェクト')

@section('content')
    <h2>プロジェクト一覧</h2>
    <div class="container">
        <h3>{{ $start_date }} から {{ $end_date }} までの集計</h3>
        <table class='table table-striped'>
            <tr>
                <th>担当者名</th>
                <th>売上合計</th>
                <th>外注費合計</th>
                <th>ヘルプ売上</th>
                <th>収益</th>
            </tr>
            @foreach ($sales as $sale)
                <tr>
                    <td><a href="{{ route('user.edit', ['user' => $sale->user_id]) }}">{{ $sale->name }}</a></td>
                    <td>{{ number_format($sale->total_project_amount) }}</td>
                    <td>{{ number_format($sale->total_subcontractor_work_amount) }}</td>
                    <td>{{ number_format($sale->total_work_amount) }}</td>
                    <td>{{ number_format($sale->total_project_amount + $sale->total_work_amount - $sale->total_subcontractor_work_amount) }}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
