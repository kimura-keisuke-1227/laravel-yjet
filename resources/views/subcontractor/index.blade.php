@extends('layouts.admin')

@section('title', 'プロジェクト')

@section('content')
    <div class="container">

        <table class='table table-striped'>
            <tr>
                <th>ID</th>
                <th>発注先名</th>
                <th></th>
                <th></th>
            </tr>
            @foreach ($subcontractors as $subcontractor)
                <tr>
                    <td>{{ $subcontractor -> id}}</td>
                    <td>{{ $subcontractor -> subcontractor_name }}</td>

                        <td><td><a href="{{Route('subcontractor.edit',[ 'subcontractor' => $subcontractor])}}">詳細・修正</a></td></td>

                </tr>
            @endforeach
        </table>
    </div>
@endsection
