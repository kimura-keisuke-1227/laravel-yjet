@extends('layouts.admin')

@section('content')
<section class="py-8">
    <div class="container px-4 mx-auto">
        <div class="py-4 bg-white rounded">
            <form action="{{Route('work.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="category">タスク</label>
                        <div class="flex">
                            <select id="task_id" class="appearance-none block pl-4 pr-8 py-3 mb-2 text-sm bg-white border rounded" name="task_id">
                                <option value="1">プロジェクト1</option>
                                <option value="2">プロジェクト2</option>
                                <option value="3">プロジェクト3</option>
                                <option value="4">プロジェクト4</option>
                            </select>
                            <div class="pointer-events-none transform -translate-x-full flex items-center px-2 text-gray-500">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="category">担当者</label>
                        <div class="flex">
                            <select id="out_source_id" class="appearance-none block pl-4 pr-8 py-3 mb-2 text-sm bg-white border rounded" name="out_source_id">
                                <option value="1">担当者1</option>
                                <option value="2">担当者2</option>
                                <option value="3">担当者3</option>
                                <option value="4">担当者4</option>
                            </select>
                            <div class="pointer-events-none transform -translate-x-full flex items-center px-2 text-gray-500">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="title">作業日</label>
                        <input id="date" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded" type="date" name="date" value="0">
                    </div>


                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="title">予定時間(分)</label>
                        <input id="scheduled_time" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded" type="number" name="scheduled_time" value="0">
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="title">実績時間(分)</label>
                        <input id="actual_time" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded" type="number" name="actual_time" value="0">
                    </div>

                    <div class="flex px-6 pb-4 border-b">
                        <div class="ml-auto">
                            <button type="submit" class="py-2 px-3 text-xs text-white font-semibold bg-indigo-500 rounded-md">保存</button>
                        </div>
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
    document.getElementById('date').value = formattedDate;
</script>

@endsection
