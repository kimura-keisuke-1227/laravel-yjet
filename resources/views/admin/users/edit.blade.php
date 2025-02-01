@extends('layouts.admin')

@section('content')
<section class="py-8">
    <h2>ユーザー編集</h2>
    <div class="container px-4 mx-auto">
        <div class="py-4 bg-white rounded">
            <form action="{{Route("user.update",['user' => $user->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="flex px-6 pb-4 border-b">
                    <h3 class="text-xl font-bold">ユーザ編集</h3>
                    <div class="ml-auto">
                        <button type="submit" class="py-2 px-3 text-xs text-white font-semibold bg-indigo-500 rounded-md">登録</button>
                    </div>
                </div>

                <div class="pt-4 px-6">
                    <!-- ▼▼▼▼エラーメッセージ▼▼▼▼　-->
                    @if($errors->any())
                        <div class="mb-8 py-4 px-6 border border-red-300 bg-red-50 rounded">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li class="text-red-400">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <!-- ▲▲▲▲エラーメッセージ▲▲▲▲　-->

                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="name">名前</label>
                        <input id="name" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded" type="text" name="name" value="{{$user->name}}">
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="email">メールアドレス</label>
                        <input id="email" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded" type="email" name="email" value="{{$user->email}}">
                    </div>

                </div>
            </form>
        </div>
    </div>
    <div class="container px-4 mx-auto">
        <div class="py-4 bg-white rounded">
                <div class="flex px-6 pb-4 border-b">
                    <h3 class="text-xl font-bold">担当プロジェクト一覧</h3>
                </div>

                <div class="pt-4 px-6">
                    @if ($projects->isEmpty())
                        担当プロジェクトなし
                    @else
                    <table class='table table-striped'>
                        <tr>
                            {{-- <th>ID</th> --}}
                            <th>プロジェクト名</th>
                            <th>開始日</th>
                            <th>終了日</th>
                            <th>受注額</th>
                            <th>外注費</th>
                            <th>非表示</th>
                            <th></th>
                            <th></th>
                        </tr>
                        @foreach ($projects as $project)
                            <tr>
                                {{-- <td>{{ $project -> project_id}}</td> --}}
                                <td>{{ $project -> project_name }}</td>
                                <td>{{ $project -> start_date }}</td>
                                <td>{{ $project -> end_date }}</td>
                                <td>{{ $project -> amount }}</td>
                                <td>{{ $project -> total_work_amount }}</td>
                                <td>@if ($project->is_expire)
                                        非表示
                                @endif</td>
                                <td><td><a href="{{Route('project.edit',[ 'project' => $project -> project_id])}}">詳細・修正</a></td></td>
                            </tr>
                        @endforeach
                    </table>
                    @endif

                </div>
        </div>
    </div>
</section>

<script>
    // 画像プレビュー
    document.getElementById('image').addEventListener('change', e => {
        const previewImageNode = document.getElementById('previewImage')
        const fileReader = new FileReader()
        fileReader.onload = () => previewImageNode.src = fileReader.result
        if (e.target.files.length > 0) {
            fileReader.readAsDataURL(e.target.files[0])
        } else {
            previewImageNode.src = previewImageNode.dataset.noimage
        }
    })
</script>
@endsection
