@extends('layouts.admin')
@section('content')
    <div class="container">

        <table class='table table-striped'>
            <tr>
                <th>外注先</th>
                <th>予定時間</th>
                <th>実際時間</th>
            </tr>
            @foreach ($weekly as $data)
                <tr>
                    <td>{{ $data -> out_source_id }}</td>
                    <td>{{ $data -> total_scheduled_time}}</td>
                    <td>{{ $data -> total_scheduled_time}}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
