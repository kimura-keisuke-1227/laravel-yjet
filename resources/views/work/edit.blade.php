@extends('layouts.admin')

@section('content')
<section class="py-8">
    <h2>作業編集</h2>
    <div class="container px-4 mx-auto">
        <div class="py-4 bg-white rounded">
            <form action="{{Route('work.update',['work' => $work])}}" method="post" enctype="multipart/form-data">
                <h3>{{$work->task->project->project_name}}</h3>
                <h4>{{$work->task->task_name}}</h4>
                <hr>
                @csrf
                @method('PUT')
                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="category">発注者</label>
                        <div class="flex">
                            <select id="user_id" class="appearance-none block pl-4 pr-8 py-3 mb-2 text-sm bg-white border rounded" name="user_id">
                                <option value="0">
                                    未選択
                                </option>
                                @foreach($users as $user)
                                <option value="{{$user -> id}}"
                                    @if ($user -> id == $work->user_id)
                                        selected
                                    @endif
                                    >{{$user -> name}}</option>
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
                        <label class="block text-sm font-medium mb-2" for="category">作業者</label>
                        <div class="flex">
                            <select id="subcontractor" class="appearance-none block pl-4 pr-8 py-3 mb-2 text-sm bg-white border rounded" name="subcontractor_id">
                                <option value="0">
                                    未選択
                                </option>
                                @foreach($subcontractors as $subcontractor)
                                <option value="{{$subcontractor -> id}}"
                                    @if ($subcontractor -> id == $work->subcontractor_id)
                                        selected
                                    @endif
                                    >{{$subcontractor -> subcontractor_code}}_{{$subcontractor -> subcontractor_name}}</option>
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
                        <label class="block text-sm font-medium mb-2" for="title">作業日</label>
                        <input id="date" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded" type="date" name="date" value="{{$work->date}}"  max="2382-12-31">
                    </div>


                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="title">予定時間(分)</label>
                        <input id="scheduled_time" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded" type="number" name="scheduled_time" value="{{$work->scheduled_time}}">
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="title">実績時間(分)</label>
                        <input id="actual_time" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded" type="number" name="actual_time" value="{{$work->actual_time}}">
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="title">金額(円)</label>
                        <input id="amount" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded" type="number" name="amount" value="{{$work->amount}}">
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="title">メモ</label>
                        <textarea  rea id="remark" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded" name="remark" rows=10>{{$work->remark}}</textarea>
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

@endsection
