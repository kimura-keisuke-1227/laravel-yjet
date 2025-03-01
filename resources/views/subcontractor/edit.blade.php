@extends('layouts.admin')

@section('content')
    <h2>
        発注先編集</h2>
    <section class="py-8">
        <div class="container px-4 mx-auto">
            <div class="py-4 bg-white rounded">
                <form action="{{ Route('subcontractor.update', ['subcontractor' => $subcontractor->id]) }}" method="post"
                    enctype="multipart/form-data">
                    <!-- ▼▼▼▼エラーメッセージ▼▼▼▼　-->
                    @if ($errors->any())
                        <div class="mb-8 py-4 px-6 border border-red-300 bg-red-50 rounded">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="text-red-400">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <!-- ▲▲▲▲エラーメッセージ▲▲▲▲　-->
                    @csrf
                    @method('PUT')
                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="title">発注先名称</label>
                        <input id="subcontractor_name" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded"
                            type="text" name="subcontractor_name" value="{{ $subcontractor->subcontractor_name }}">
                    </div>


                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="title">発注先コード</label>
                        <input id="subcontractor_code" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded"
                            type="text" name="subcontractor_code" value="{{ $subcontractor->subcontractor_code }}">
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="title">発注先略称</label>
                        <input id="subcontractor_abbreviation"
                            class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded" type="text"
                            name="subcontractor_abbreviation" value="{{ $subcontractor->subcontractor_abbreviation }}">
                    </div>
                    <div class="flex px-6 pb-4 border-b">
                        <div class="ml-auto">
                            <button type="submit"
                                class="py-2 px-3 text-xs text-white font-semibold bg-indigo-500 rounded-md">保存</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="py-4 bg-white rounded">
                <h3>履歴</h3>
                <table class='table table-striped'>
                    <tr>
                        <th>プロジェクト</th>
                        <th>タスク</th>
                        <th>発注者</th>
                        <th>日付</th>
                        <th>予定時間(分)</th>
                        <th>実時間(分)</th>
                        <th>金額</th>
                        <th></th>
                    </tr>
                    @foreach ($works as $work)
                        <tr>
                            <td><a href="{{ Route('project.edit', ['project' => $work->task->project->id]) }}">{{ $work->task->project->project_name }}
                            </td>
                            <td><a href="{{ Route('task.edit', ['task' => $work->task->id]) }}">{{ $work->task->task_name }}
                            </td>
                            <td>
                                @if ($work->user)
                                    <a
                                        href="{{ Route('user.edit', ['user' => $work->user->id]) }}">{{ $work->user->name }}</a>
                                @else
                                    未選択
                                @endif
                            </td>
                            <td>{{ $work->date }}</td>
                            <td>{{ $work->scheduled_time }}</td>
                            <td>{{ $work->actual_time }}</td>
                            <td>{{ number_format($work->amount) }}</td>
                            <td> <a href="{{ Route('work.edit', ['work' => $work->id]) }}">[データ修正]</a></td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </section>
@endsection
