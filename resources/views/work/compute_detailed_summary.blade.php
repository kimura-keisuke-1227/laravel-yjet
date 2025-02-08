@extends('layouts.admin')
@section('content')
    <div class="container">
        <h2 class="mb-4">作業検索(条件指定)</h2>

        <div class="card p-4 mb-4">
            <h3>検索条件</h3> 最低１つは指定が必要
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
                                    <option value="1" @if ($order_by==1) selected @endif>発注者(ID昇順)</option>
                                    <option value="2" @if ($order_by==2) selected @endif>発注先(コード昇順)</option>
                                    <option value="3" @if ($order_by==3) selected @endif>タスク(ID昇順)</option>
                                    <option value="4" @if ($order_by==4) selected @endif>日付(古い順)</option>
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
            <p class="text-dark">該当データが存在しません</p>
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
                    <th>発注金額</th>
                    <th>明細</th>
                </tr>
                @foreach ($weekly as $work)
                    <tr>
                        <td>
                            @if ($work->user_id==0)
                                未選択
                            @else
                                <a href="{{Route('user.edit',['user'=>$work->user->id])}}">{{ $work->user->name }}</a>
                            @endif
                        </td>
                        <td>{{ $work ->subcontractor-> subcontractor_code }}</td>
                        <td>
                            @if ($work->subcontractor_id==0)
                                未選択
                            @else
                            <a href="{{Route('subcontractor.show',['subcontractor' => $work->subcontractor_id])}}">{{ $work ->subcontractor-> subcontractor_name }}</a>
                            @endif
                        </td>
                        <td><a href="{{Route('project.edit',['project' => $work->task->project->id])}}">{{ $work ->task-> project-> project_name }}</td>
                        <td><a href="{{Route('task.edit',['task' => $work->task->id])}}">{{ $work ->task-> task_name }}</td>
                        <td>{{ $work->date }}</td>
                        <td>{{ $work->scheduled_time }}</td>
                        <td>{{ $work->actual_time }}</td>
                        <td>{{ number_format($work->amount) }}</td>
                        <td><a href="{{ Route('work.edit', ['work' => $work]) }}">
                            @if ($work->remark == '')
                                [編集]
                            @else
                                {{ \Illuminate\Support\Str::limit($work->remark, 20) }}
                            @endif
                        </a></td>
                    </tr>
                @endforeach
            </table>
        @endif

    </div>
@endsection
