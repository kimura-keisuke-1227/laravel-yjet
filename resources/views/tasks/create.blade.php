@extends('layouts.admin')

@section('content')
    <h2>タスク追加</h2>
    <section class="py-8">
        <div class="container px-4 mx-auto">
            <div class="py-4 bg-white rounded">
                <form action="{{ Route('task.store') }}" method="post" enctype="multipart/form-data">
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
                            type="text" name="task_name">
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="title">メモ</label>
                        <textarea  rea id="remark" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded" name="remark" rows=10></textarea>
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
    </section>

    <script>
        // 現在の日付を取得してフォーマット
        const today = new Date();
        const formattedDate = today.toISOString().split('T')[0]; // YYYY-MM-DD形式に変換

        // input要素に設定
        document.getElementById('start_date').value = formattedDate;
    </script>

@endsection
