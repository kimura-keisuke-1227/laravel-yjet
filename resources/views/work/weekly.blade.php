@extends('layouts.admin')
@section('content')
    <div class="container">
    <table class='table table-striped'>
        <tr>
            <td>
                <input id="date" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded" type="date" name="date" ></td>
            </td>
            <td>
                <input id="scheduled_time" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded" type="number" name="scheduled_time" value="">
            </td>
        </tr>
    </table>

        <table class='table table-striped'>
            <tr>
                <th>外注先</th>
                <th>予定時間</th>
                <th>実際時間</th>
            </tr>
            @foreach ($weekly as $data)
                <tr>
                    <td><a href="{{Route('subcontractor.show',['subcontractor' => $data->subcontractor_id])}}">{{ $data -> subcontractor_name }}</a></td>
                    <td>{{ $data -> total_scheduled_time}}</td>
                    <td>{{ $data -> total_actual_time}}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
