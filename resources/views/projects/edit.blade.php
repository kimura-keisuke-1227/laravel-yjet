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

                    @foreach ($project->tasks as $task)
                        <h3> < {{ $task->task_name }} ></h3>
                        <p><a href="{{Route('work.create',[ 'task' => $task -> id])}}">作業追加</a></p>
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
