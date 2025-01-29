@extends('layouts.admin')
@section('content')
    <div class="container">
        <h2 class="mb-4">詳細</h2>

        <div class="card p-4 mb-4">
            <form action="{{ Route('compute_detailed_summary') }}" method="POST" enctype="multipart/form-work">
                @csrf

                <table class="table">
                    <tr>
                        <td>
                            <div class="form-group mb-3">
                                <label for="user" class="form-label">発注者</label>
                                <select id="user" class="appearance-none block pl-4 pr-8 py-3 mb-2 text-sm bg-white border rounded"
                                    name="user_id">
                                    <option value="0">未選択</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" @if ($user_id == $user->id) selected @endif>
                                            {{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>

                        <td>
                            <div class="form-group mb-3">
                                <label for="subcontractor" class="form-label">発注先</label>
                                <select id="subcontractor"
                                    class="appearance-none block pl-4 pr-8 py-3 mb-2 text-sm bg-white border rounded"
                                    name="subcontractor_id">
                                    <option value="0">未選択</option>
                                    @foreach ($subcontractors as $subcontractor)
                                        <option value="{{ $subcontractor->id }}" @if ($subcontractor_id == $subcontractor->id) selected @endif>
                                            {{ $subcontractor->subcontractor_code . '_' . $subcontractor->subcontractor_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>

                        <td>
                            <div class="form-group mb-3">
                                <label for="start_date" class="form-label">開始日</label>
                                <input id="start_date" class="form-control" type="date" name="start_date" value="{{ $start_date }}" max="2382-12-31">
                            </div>
                        </td>

                        <td>
                            <div class="form-group mb-3">
                                <label for="end_date" class="form-label">終了日</label>
                                <input id="end_date" class="form-control" type="date" name="end_date" value="{{ $end_date }}" max="2382-12-31">
                            </div>
                        </td>

                        <td>
                            <div class="form-group mb-3">
                                <label for="order_by" class="form-label">並び順</label>
                                <select id="order_by" class="appearance-none block pl-4 pr-8 py-3 mb-2 text-sm bg-white border rounded" name="order_by">
                                    <option value="1" @if ($order_by==1) selected @endif>発注者</option>
                                    <option value="2" @if ($order_by==2) selected @endif>発注先</option>
                                    <option value="3" @if ($order_by==3) selected @endif>タスク</option>
                                    <option value="4" @if ($order_by==4) selected @endif>日付</option>
                                </select>
                            </div>
                        </td>

                        <td>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">表示</button>
                            </div>
                        </td>
                    </tr>
                </table>
            </form>

        </div>

        @if (is_null($weekly))
            <p class="text-danger">検索条件が指定されていません</p>
        @elseif ($weekly->isEmpty())
            <p class="text-warning">該当データが存在しません</p>
        @else
            <h3>作業記録</h3>
            <table class='table table-striped'>
                <tr>
                    <th>発注者</th>
                    <th>発注先コード

                    </th>
                    <th>発注先</th>
                    <th>プロジェクト</th>
                    <th>タスク</th>
                    <th>日付</th>
                    <th>予定時間(分)</th>
                    <th>実際時間(分)</th>
                    <th>明細</th>
                </tr>
                @foreach ($weekly as $work)
                    <tr>
                        <td>
                            {{ $work->user->name }}
                        </td>
                        <td>{{ $work ->subcontractor-> subcontractor_code }}</td>
                        <td><a href="{{Route('subcontractor.show',['subcontractor' => $work->subcontractor_id])}}">{{ $work ->subcontractor-> subcontractor_name }}</a></td>
                        <td><a href="{{Route('project.edit',['project' => $work->task->project->id])}}">{{ $work ->task-> project-> project_name }}</td>
                        <td>{{ $work->task->task_name }}</td>
                        <td>{{ $work->date }}</td>
                        <td>{{ $work->scheduled_time }}</td>
                        <td>{{ $work->actual_time }}</td>
                        <td><a href="{{ Route('work.edit', ['work' => $work]) }}">
                            @if ($work->remark == '')
                                [編集]
                            @else
                                {{ $work->remark }}
                            @endif
                        </a></td>
                    </tr>
                @endforeach
            </table>
        @endif

    </div>
@endsection
