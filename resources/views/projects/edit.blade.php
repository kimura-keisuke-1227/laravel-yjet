@extends('layouts.admin')

@section('content')
    <h2>プロジェクト編集</h2>
    <section class="py-8">
        <div class="container px-4 mx-auto">
            <div class="py-4 bg-white rounded">
                <form action="{{ Route('project.update', ['project' => $project]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
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

                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="project_name">プロジェクト名</label>
                        <input id="project_name" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded"
                            type="text" name="project_name" value="{{ $project->project_name }}">
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="user_id">担当者</label>
                        <select id="user_id"
                            class="appearance-none block pl-4 pr-8 py-3 mb-2 text-sm bg-white border rounded"
                            name="user_id">
                            <option value="0">未選択</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" @if ($user->id == $project->user_id) selected @endif>
                                    {{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="title"> 開始日</label>
                        <input id="start_date" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded"
                            type="date" name="start_date" value="{{ $project->start_date }}"  max="2382-12-31">
                    </div>


                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="title"> 終了日</label>
                        <input id="end_date" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded"
                            type="date" name="end_date" value="{{ $project->end_date }}"  max="2382-12-31">
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="title">メモ</label>
                        <textarea  rea id="remark" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded" name="remark" rows=10>{{$project->remark}}</textarea>
                    </div>

                    <div class="flex px-6 pb-4 border-b">
                        <div class="ml-auto">
                            <button type="submit"
                                class="py-2 px-3 text-xs text-white font-semibold bg-indigo-500 rounded-md">プロジェクトデータ保存</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <hr>
        <div class="container px-4 mx-auto">
            <h2>[タスク]</h2>
            <p>タスク名をクリックで詳細</p>
            <a href="{{ Route('task.create', ['project' => $project]) }}">タスク追加</a>
        </div>
        <div class="container px-4 mx-auto">
            <div class="py-4 bg-white rounded">
                <form action="{{ Route('work.multipleUpdate', ['project' => $project]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
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
                    <div class="flex px-6 pb-4 border-b">
                        <div class="ml-auto">
                            <button type="submit"
                                class="py-2 px-3 text-xs text-white font-semibold bg-indigo-500 rounded-md">作業データ保存</button>
                        </div>
                    </div>
                    @foreach ($project->tasks as $task)
                        <!-- Accordion Header -->
                        <h3 class="accordion-header" style="cursor: pointer; display: flex; align-items: center;">
                            <span>{{ $task->task_name }}</span>
                            <a href="{{ Route('task.edit', ['task' => $task->id]) }}" style="margin-left: 10px;">[編集]</a>
                            {{-- <form action="{{ route('task.destroy', ['task' => $task->id]) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');" style="display: inline-block; margin-left: 10px;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">[削除]</button>
                            </form> --}}
                        </h3>

                        <!-- Accordion Content (Initially Hidden) -->
                        <div class="accordion-content" style="display: none;">
                            <p><a href="{{ Route('work.create', ['task' => $task->id]) }}">作業追加</a></p>
                            <hr>
                            <table class='table table-striped'>
                                <tr>
                                    <th>ID</th>
                                    <th>発注者</th>
                                    <th>作業者</th>
                                    <th>日付</th>
                                    <th>予定時間(分)</th>
                                    <th>実際時間(分)</th>
                                    <th>メモ</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                @foreach ($task->works as $work)
                                    <tr>
                                        <td>{{ $work->id }}</td>
                                        <td>
                                            <select id="user_id_{{ $work->id }}"
                                                class="appearance-none block pl-4 pr-8 py-3 mb-2 text-sm bg-white border rounded"
                                                name="user_id_{{ $work->id }}">
                                                <option value="0">未選択</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}"
                                                        @if ($user->id == $work->user_id) selected @endif>
                                                        {{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select id="subcontractor_id_{{ $work->id }}"
                                                class="appearance-none block pl-4 pr-8 py-3 mb-2 text-sm bg-white border rounded"
                                                name="subcontractor_id_{{ $work->id }}">
                                                <option value="0">未選択</option>
                                                @foreach ($subcontractors as $subcontractor)
                                                    <option value="{{ $subcontractor->id }}"
                                                        @if ($subcontractor->id == $work->subcontractor_id) selected @endif>
                                                        {{ $subcontractor->subcontractor_code . '_' . $subcontractor->subcontractor_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input id="date"
                                                class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded"
                                                type="date" name="date_{{ $work->id }}"  max="2382-12-31"
                                                value="{{ $work->date }}"></td>
                                        <td><input id="scheduled_time"
                                                class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded"
                                                type="number" name="scheduled_time_{{ $work->id }}"
                                                value="{{ $work->scheduled_time }}"></td>
                                        <td><input id="actual_time_{{ $work->id }}"
                                                class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded"
                                                type="number" name="actual_time_{{ $work->id }}"
                                                value="{{ $work->actual_time }}"></td>
                                        <td>
                                            <a href="{{ Route('work.edit', ['work' => $work]) }}">
                                                @if ($work->remark == '')
                                                    [編集]
                                                @else
                                                    {{ $work->remark }}
                                                @endif
                                            </a>
                                        </td>
                                        <td><a href="{{ Route('work.copy', ['work' => $work->id]) }}">コピー</a></td>
                                        <td>
                                            <a href="{{Route('work.delete',['work' => $work->id])}}">[削除]</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    @endforeach

                    <!-- Add JavaScript to handle the accordion behavior -->
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            // Get all accordion headers
                            const headers = document.querySelectorAll('.accordion-header');

                            headers.forEach(header => {
                                header.addEventListener('click', function() {
                                    // Toggle the visibility of the corresponding accordion content
                                    const content = header.nextElementSibling;
                                    if (content.style.display === 'none' || content.style.display === '') {
                                        content.style.display = 'block';
                                    } else {
                                        content.style.display = 'none';
                                    }
                                });
                            });
                        });
                    </script>

                    <br>
                    <div class="flex px-6 pb-4 border-b">
                        <div class="ml-auto">
                            <button type="submit"
                                class="py-2 px-3 text-xs text-white font-semibold bg-indigo-500 rounded-md">作業データ保存</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection
