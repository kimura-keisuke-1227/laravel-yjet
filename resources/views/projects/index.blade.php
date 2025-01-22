@extends('layouts.admin')

@section('title', 'プロジェクト')

@section('content')
    <div class="container">

        <table class='table table-striped'>
            <tr>
                <th>ID</th>
                <th>プロジェクト名</th>
                <th>開始日</th>
                <th>終了日</th>
                <th></th>
                <th></th>
            </tr>
            @foreach ($projects as $project)
                <tr>
                    <td>{{ $project -> id}}</td>
                    <td>{{ $project -> name }}</td>
                    <td>{{ $project -> start_date }}</td>
                    <td>{{ $project -> end_date }}</td>
                    <td><td><a href="{{Route('project.show',[ 'project' => $chemical -> id])}}">詳細・修正</a></td></td>
                    <td><td><a href="{{Route('project.show',[ 'project' => $chemical -> id])}}">詳細・修正</a></td></td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
