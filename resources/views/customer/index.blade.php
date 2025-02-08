@extends('layouts.admin')

@section('title', 'プロジェクト')

@section('content')
<h2>発注先一覧</h2>
    <div class="container">
        <a href="{{Route('subcontractor.create')}}">発注先登録</a>
        <table class='table table-striped'>
            <tr>
                <th>ID</th>
                <th>発注先コード</th>
                <th>発注先名</th>
                <th></th>
            </tr>
            @foreach ($subcontractors as $subcontractor)
                <tr>
                    <td>{{ $subcontractor -> id}}</td>
                    <td>{{ $subcontractor -> subcontractor_code }}</td>
                    <td>{{ $subcontractor -> subcontractor_name }}</td>
                    <td><a href="{{Route('subcontractor.edit',[ 'subcontractor' => $subcontractor])}}">詳細・修正</a></td>

                </tr>
            @endforeach
        </table>
    </div>
@endsection
