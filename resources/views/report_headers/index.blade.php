@extends('layouts.admin')

@section('title', 'プロジェクト')

@section('content')
    <h2>プロジェクト一覧</h2>
    <div class="container">
        <a href="{{Route('project.create')}}">プロジェクト作成</a>
        <table class='table table-striped'>
            <tr>
                <th>ID</th>
                <th>プロジェクト名</th>
                <th>担当者</th>
                <th>開始日</th>
                <th>終了日</th>
                <th></th>
                <th></th>
            </tr>
            @foreach ($projects as $project)
                <tr>
                    <td>{{ $project -> id}}</td>
                    <td>{{ $project -> project_name }}</td>
                    <td>@if ($project->user)
                        <a href="{{Route('user.edit',['user'=>$project->user->id])}}">{{$project->user->name}}</a>

                    @else
                        未選択
                    @endif</td>
                    <td>{{ $project -> start_date }}</td>
                    <td>{{ $project -> end_date }}</td>
                    <td><td><a href="{{Route('project.edit',[ 'project' => $project -> id])}}">詳細・修正</a></td></td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
