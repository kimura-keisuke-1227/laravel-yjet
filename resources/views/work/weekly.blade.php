@extends('layouts.admin')
@section('content')
    <div class="container">
    <h2>発注先別週次集計</h2>
    <hr>
    <h3>検索条件</h3>
    <table class='table table-striped'>
    <form action="{{ Route('weekly.with_date')}}" method="POST"
    enctype="multipart/form-data">
            @csrf
            <tr>
                <td>
                    <input id="base_date" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded" type="date" name="base_date" value="{{$base_date}}"  max="2382-12-31"></td>
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
        <h3>{{$start_date}}から{{$base_date}}までの{{$days}}日間の集計(発注先コード昇順)</h3>
        <table class='table table-striped'>
            <tr>
                <th>発注先コード</th>
                <th>発注先</th>
                <th>予定時間合計(分)</th>
                <th>実際時間合計(分)</th>
                <th>外注費合計</th>
            </tr>
            @foreach ($weekly as $data)
                <tr>
                    <td>{{ $data -> subcontractor_code}}</td>
                    <td><a href="{{Route('subcontractor.show',['subcontractor' => $data->subcontractor_id])}}">{{ $data -> subcontractor_name }}</a></td>
                    <td>{{ $data -> total_scheduled_time}}</td>
                    <td>{{ $data -> total_actual_time}}</td>
                    <td>{{ number_format($data->total_amount) }}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
