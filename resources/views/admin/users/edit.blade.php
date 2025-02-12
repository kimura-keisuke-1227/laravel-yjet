@extends('layouts.admin')

@section('content')
    <section class="py-8">
        <h2>ユーザー編集</h2>
        <div class="container px-4 mx-auto">
            <div class="py-4 bg-white rounded">
                <form action="{{ Route('user.update', ['user' => $user->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="flex px-6 pb-4 border-b">
                        <h3 class="text-xl font-bold">ユーザ編集</h3>
                        <div class="ml-auto">
                            <button type="submit"
                                class="py-2 px-3 text-xs text-white font-semibold bg-indigo-500 rounded-md">登録</button>
                        </div>
                    </div>

                    <div class="pt-4 px-6">
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
                            <label class="block text-sm font-medium mb-2" for="name">名前</label>
                            <input id="name" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded"
                                type="text" name="name" value="{{ $user->name }}">
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium mb-2" for="email">メールアドレス</label>
                            <input id="email" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded"
                                type="email" name="email" value="{{ $user->email }}">
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
                                <th>顧客名</th>
                                <th>開始日</th>
                                <th>終了日</th>
                                <th>受注額</th>
                                <th>外注費</th>
                                <th>内部委託費</th>
                                <th>担当者収益</th>
                                <th>非表示</th>
                            </tr>
                            @foreach ($projects as $project)
                                <tr>
                                    {{-- <td>{{ $project -> project_id}}</td> --}}
                                    <td><a
                                            href="{{ Route('project.edit', ['project' => $project->project_id]) }}">{{ $project->project_name }}</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('customer.edit', ['customer' => $project->customer_id]) }}">
                                            {{ $project->customer_name }}
                                        </a>
                                    </td>
                                    <td>{{ $project->start_date }}</td>
                                    <td>{{ $project->end_date }}</td>
                                    <td>{{ number_format($project->amount) }}</td>
                                    <td>{{ number_format($project->outside) }}</td>
                                    <td>{{ number_format($project->inside) }}</td>
                                    <td>{{ number_format($project->amount - $project->inside - $project->outside) }}
                                    </td>
                                    <td>
                                        @if ($project->is_expire)
                                            非表示
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                        </table>
                    @endif

                </div>
            </div>
            <div class="py-4 bg-white rounded">
                <div class="flex px-6 pb-4 border-b">
                    <h3 class="text-xl font-bold">ヘルプ一覧</h3>
                </div>

                <div class="pt-4 px-6">
                    @if ($helps->isEmpty())
                        ヘルプ実績なし
                    @else
                        <table class='table table-striped'>
                            <tr>
                                {{-- <th>ID</th> --}}
                                <th>プロジェクト名</th>
                                <th>タスク名</th>
                                <th>依頼者</th>
                                <th>日付</th>
                                <th>売上</th>
                                <th>予定時間</th>
                                <th>実績時間</th>
                                <th>作業明細</th>
                            </tr>
                            @foreach ($helps as $help)
                                <tr>
                                    {{-- <td>{{ $project -> project_id}}</td> --}}
                                    <td><a
                                            href="{{ Route('project.edit', ['project' => $help->task->project->id]) }}">{{ $help->task->project->project_name }}</a>
                                    </td>
                                    </td>
                                    <td>{{ $help->task->task_name }}</td>
                                    <td><a
                                            href="{{ Route('user.edit', ['user' => $help->user_id]) }}">{{ $help->user->name }}</a>
                                    </td>
                                    <td>{{ $help->date }}</td>
                                    <td>{{ number_format($help->amount) }}</td>
                                    <td>{{ $help->scheduled_time }}</td>
                                    <td>{{ $help->actual_time }}</td>
                                    <td><a href="{{ route('work.edit', ['work' => $help->id]) }}">明細</a></td>
                                </tr>
                            @endforeach
                        </table>
                    @endif

                </div>
            </div>
        </div>
    </section>

@endsection
