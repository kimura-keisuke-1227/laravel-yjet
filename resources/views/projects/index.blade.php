@extends('layouts.admin')

@section('title', 'プロジェクト')

@section('content')
    <h2>プロジェクト一覧</h2>
    <div class="container">
        <a href="{{Route('project.create')}}">プロジェクト作成</a>
        <table class='table table-striped'>
            <tr>
                <th>プロジェクト名</th>
                <th>顧客</th>
                <th>担当者</th>
                <th>開始日</th>
                <th>終了日</th>
                <th>受注金額</th>
                <th>外注費合計</th>
                <th></th>
            </tr>
            @foreach ($projects as $project)
                <tr>
                    <td>{{ $project -> project_name }}</td>
                    <td>
                        @if ($project->customer_id == 0)
                            顧客未選択
                        @else
                        <a href="{{Route('customer.edit',['customer' => $project->customer_id])}}">{{ $project->customer_name ? $project->customer_name : '顧客情報なし' }}</a>
                        @endif
                    </td>
                    <td>@if (!is_null($project->user_id))
                        <a href="{{ route('user.edit', ['user' => $project->user_id]) }}">{{ $project->user_name }}</a>
                    @else
                        未選択
                    @endif</td>
                    <td>{{ $project -> start_date }}</td>
                    <td>{{ $project -> end_date }}</td>
                    <td>{{ number_format($project->amount) }}円</td>
                    <td>{{ number_format($project->total_work_amount) }}円</td>
                    <td><a href="{{Route('project.edit',[ 'project' => $project -> project_id])}}">詳細・修正</a></td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
