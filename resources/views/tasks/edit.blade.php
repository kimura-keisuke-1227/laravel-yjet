@extends('layouts.admin')

@section('content')
    <h2>タスク編集</h2>
    <section class="py-8">
        <div class="container px-4 mx-auto">
            <div class="py-4 bg-white rounded">
                <form action="{{ Route('task.update',['task'=>$task->id ]) }}" method="post" enctype="multipart/form-data">
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
                        <div class="flex">
                            <select id="project_id" class="appearance-none block pl-4 pr-8 py-3 mb-2 text-sm bg-white border rounded" name="project_id">
                                <option value="0">プロジェクトを選択してください。</option>
                                @foreach ($projects as $project)
                                <option value="{{$project -> id}}"
                                    @if ($parentProject->id == $project -> id)
                                        selected
                                    @endif
                                    >
                                    {{$project->project_name}}
                                </option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none transform -translate-x-full flex items-center px-2 text-gray-500">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="title">タスク名</label>
                        <input id="project_name" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded"
                            type="text" name="task_name" value="{{$task->task_name}}">
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="title">メモ</label>
                        <textarea  id="remark" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded" name="remark" rows=10>{{$task->remark}}</textarea>
                    </div>

                    <div class="mb-6">
                        <label class="inline-flex items-center">
                            <input it="is_expire" type="checkbox" name="is_expire" class="form-checkbox" value="1" @if ($task->is_expire) checked @endif>
                            <span class="ml-2 text-sm">非表示にする</span>
                        </label>
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
                <h3>関連作業一覧</h3>
                <table class='table table-striped'>
                    <tr>
                        <th>ID</th>
                        <th>発注者</th>
                        <th>発注先</th>
                        <th>作業日</th>
                        <th>予定作業時間</th>
                        <th>実作業時間</th>
                        <th>金額</th>
                        <th>明細</th>
                    </tr>
                    @foreach ($works as $work)
                        <tr>
                            <td>{{ $work -> id}}</td>
                            <td>
                                @if ($work -> user_id == 0)
                                    未選択
                                @else
                                    <a href="{{Route('user.edit',[ 'user' => $work -> user -> id])}}">{{ $work -> user-> name }}</a>
                                @endif
                            </td>
                            <td>
                                @if ($work -> subcontractor_id == 0)
                                    未選択
                                @else
                                <a href="{{Route('subcontractor.show',[ 'subcontractor' => $work -> subcontractor -> id])}}">{{ $work -> subcontractor -> subcontractor_name }}</a>
                                @endif
                            </td>
                            <td>{{ $work -> date }}</td>
                            <td>{{ $work -> scheduled_time }}</td>
                            <td>{{ $work -> actual_time }}</td>
                            <td>{{ $work -> amount }}</td>
                            <td><a href="{{Route('work.edit',[ 'work' => $work -> id])}}">
                                @if ($work->remark == '')
                                [編集]
                            @else
                                {{ \Illuminate\Support\Str::limit($work->remark, 20) }}
                            @endif
                            </a></td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </section>

    <script>
        // 現在の日付を取得してフォーマット
        const today = new Date();
        const formattedDate = today.toISOString().split('T')[0]; // YYYY-MM-DD形式に変換

        // input要素に設定
        document.getElementById('start_date').value = formattedDate;
    </script>

@endsection
