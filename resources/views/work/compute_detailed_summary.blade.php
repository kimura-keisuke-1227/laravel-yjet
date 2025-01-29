@extends('layouts.admin')
@section('content')
    <div class="container">
        <h2 class="mb-4">詳細</h2>

        <div class="card p-4 mb-4">
            <form action="{{ Route('compute_detailed_summary_form') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group mb-3">
                    <label for="base_date" class="form-label">発注者</label>
                    <select id="user" class="appearance-none block pl-4 pr-8 py-3 mb-2 text-sm bg-white border rounded"
                        name="user_id">
                        <option value="0">
                            未選択
                        </option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" @if ($user_id == $user->id) selected @endif>
                                {{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="base_date" class="form-label">外注先</label>
                    <select id="subcontractor"
                        class="appearance-none block pl-4 pr-8 py-3 mb-2 text-sm bg-white border rounded"
                        name="subcontractor_id">
                        <option value="0">
                            未選択
                        </option>
                        @foreach ($subcontractors as $subcontractor)
                            <option value="{{ $subcontractor->id }}" @if ($subcontractor_id == $subcontractor->id) selected @endif>
                                {{ $subcontractor->subcontractor_code . '_' . $subcontractor->subcontractor_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="base_date" class="form-label">開始日</label>
                    <input id="base_date" class="form-control" type="date" name="start_date" value="{{ $start_date }}"
                        max="2382-12-31">
                </div>
                <div class="form-group mb-3">
                    <label for="base_date" class="form-label">終了日</label>
                    <input id="base_date" class="form-control" type="date" name="end_date" value="{{ $end_date }}"
                        max="2382-12-31">
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">表示</button>
                </div>
            </form>
        </div>

        @if (is_null($weekly))
            <p class="text-danger">検索条件が指定されていません</p>
        @elseif ($weekly->isEmpty())
            <p class="text-warning">該当データが存在しません</p>
        @else
            <table class='table table-striped'>
                <tr>
                    <th>発注者</th>
                    <th>発注先</th>
                    <th>予定時間</th>
                    <th>実際時間</th>
                </tr>
                @foreach ($weekly as $data)
                    <tr>
                        <td>
                            <a href="{{ Route('subcontractor.show', ['subcontractor' => $data->subcontractor_id]) }}">
                                {{ $data->subcontractor_name }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ Route('subcontractor.show', ['subcontractor' => $data->subcontractor_id]) }}">
                                {{ $data->subcontractor_name }}
                            </a>
                        </td>
                        <td>{{ $data->total_scheduled_time }}</td>
                        <td>{{ $data->total_actual_time }}</td>
                    </tr>
                @endforeach
            </table>
        @endif

    </div>
@endsection
