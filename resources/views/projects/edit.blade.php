@extends('layouts.admin')

@section('content')
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
                        <label class="block text-sm font-medium mb-2" for="title">プロジェクト名</label>
                        <input id="project_name" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded"
                            type="text" name="project_name" value="{{ $project->project_name }}">
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="title"> 開始日</label>
                        <input id="start_date" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded"
                            type="date" name="start_date" value="{{ $project->start_date }}">
                    </div>


                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="title"> 終了日</label>
                        <input id="end_date" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded"
                            type="date" name="end_date" value="{{ $project->end_date }}">
                    </div>

                    <div class="flex px-6 pb-4 border-b">
                        <div class="ml-auto">
                            <button type="submit"
                                class="py-2 px-3 text-xs text-white font-semibold bg-indigo-500 rounded-md">保存</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <hr>
        <h2>[タスク]</h2>
        <a href="{{Route('task.create',[ 'project' => $project ])}}">タスク追加</a>
        <div class="container px-4 mx-auto">
            <div class="py-4 bg-white rounded">
                <form action="{{ Route('work.update', ['project' => $project]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('POST')
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

                    @foreach ($project->tasks as $task)
                        <h3> < {{ $task->task_name }} ></h3>
                        <p><a href="{{Route('work.create',[ 'task' => $task -> id])}}">作業追加</a></p>
                        <hr>
                        <table class='table table-striped'>
                            <tr>
                                <th>ID</th>
                                <th>作業者</th>
                                <th>日付</th>
                                <th>予定時間(分)</th>
                                <th>実際時間(分)</th>
                                <th>メモ</th>
                            </tr>
                        @foreach ($task->works as $work)
                            <tr>
                                <td>{{ $work -> id}}</td>
                                <td>
                                    <select id="subcontractor" class="appearance-none block pl-4 pr-8 py-3 mb-2 text-sm bg-white border rounded" name="subcontractor_id_{{ $work->id }}">
                                        <option value="0">
                                            未選択
                                        </option>
                                        @foreach($subcontractors as $subcontractor)
                                        <option value="{{$subcontractor -> id}}"
                                            @if ($subcontractor -> id == $work->out_source_id)
                                                selected
                                            @endif
                                            >{{$subcontractor -> subcontractor_name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input id="date" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded" type="date" name="date_{{ $work->id }}" value="{{$work->date}}"></td>
                                <td><input id="actual_time" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded" type="number" name="scheduled_time_{{ $work->id }}" value="{{$work->scheduled_time}}"></td>
                                <td><input id="actual_time" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded" type="number" name="actual_time_{{ $work->id }}" value="{{$work->actual_time}}"></td>
                                <td>
                                    <a href="">
                                        @if ($work->remark =='')
                                            [編集]
                                        @else
                                            {{$work->remark}}
                                        @endif

                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </table>
                    @endforeach
                    <br>
                    <div class="flex px-6 pb-4 border-b">
                        <div class="ml-auto">
                            <button type="submit"
                                class="py-2 px-3 text-xs text-white font-semibold bg-indigo-500 rounded-md">保存</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection
