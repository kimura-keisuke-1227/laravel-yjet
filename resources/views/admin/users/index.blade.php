@extends('layouts.admin')

@section('title', 'プロジェクト')

@section('content')
    <div class="container">
        <a href="{{Route('user.create')}}">ユーザー作成</a>
        <table class='table table-striped'>
            <tr>
                <th>ID</th>
                <th>名前</th>
                <th>名前</th>
            </tr>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user -> id}}</td>
                    <td>{{ $user -> name }}</td>
                    <td><a href="{{Route('user.edit',[ 'user' => $user -> id])}}">詳細・修正</a></td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
