@extends('layouts.admin')
@section('content')
    <div class="container">
        <h2 class="mb-4">詳細</h2>

        <div class="card p-4 mb-4">
            <form action="{{ Route('weekly.with_date') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="base_date" class="form-label">開始日</label>
                    <input id="base_date" class="form-control" type="date" name="base_date" value="{{ $start_date }}" max="2382-12-31">
                </div>
                <div class="form-group mb-3">
                    <label for="base_date" class="form-label">終了日</label>
                    <input id="base_date" class="form-control" type="date" name="base_date" value="{{ $end_date }}" max="2382-12-31">
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">表示</button>
                </div>
            </form>
        </div>

        <table class='table table-striped'>
            <tr>
                <th>発注先</th>
                <th>予定時間</th>
                <th>実際時間</th>
            </tr>
            @foreach ($weekly as $data)
                <tr>
                    <td><a
                            href="{{ Route('subcontractor.show', ['subcontractor' => $data->subcontractor_id]) }}">{{ $data->subcontractor_name }}</a>
                    </td>
                    <td>{{ $data->total_scheduled_time }}</td>
                    <td>{{ $data->total_actual_time }}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
