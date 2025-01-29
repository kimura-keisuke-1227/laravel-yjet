@extends('layouts.admin')

@section('title', 'プロジェクト')

@section('content')
    <h2>プロジェクト一覧</h2>
    <div class="container">
        <a href="{{Route('report_headers.create')}}">レポート作成</a>
        <table class='table table-striped'>
            <tr>
                <th>ID</th>
                <th>レポートコード</th>
                <th>レポート名</th>
                <th>レポートメモ</th>
                <th></th>
            </tr>
            @foreach ($report_headers as $report_header)
                <tr>
                    <td>{{ $report_header -> id}}</td>
                    <td>{{ $report_header -> report_code }}</td>
                    <td>{{ $report_header -> report_name }}</td>
                    <td>{{ $report_header -> remark }}</td>

                    <td><a href="{{Route('report_headers.edit',[ 'report_header' => $report_header -> id])}}">詳細・修正</a></td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
