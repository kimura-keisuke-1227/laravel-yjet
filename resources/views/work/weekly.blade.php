@extends('layouts.admin')
@section('content')
    <div class="container">
    <h2>週次集計</h2>
    <table class='table table-striped'>
    <form action="{{ Route('weekly.with_date')}}" method="POST"
    enctype="multipart/form-data">
            @csrf
            <tr>
                <td>
                    <input id="base_date" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded" type="date" name="base_date" value="{{$base_date}}"></td>
                </td>
                <td>
                    <input id="days_before" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded" type="number" name="days_before" value="{{$days}}">日間
                </td>
                <td>
                    <div class="flex px-6 pb-4 border-b">
                        <div class="ml-auto">
                            <button type="submit"
                                class="py-2 px-3 text-xs text-white font-semibold bg-indigo-500 rounded-md">表示</button>
                        </div>
                    </div>
                </td>
            </tr>
        </form>
    </table>
        <br>
        <br>
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
