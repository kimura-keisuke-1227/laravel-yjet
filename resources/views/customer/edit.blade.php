@extends('layouts.admin')

@section('content')
    <h2>顧客情報編集</h2>
    <section class="py-8">
        <div class="container px-4 mx-auto">
            <div class="py-4 bg-white rounded">
                <form action="{{ Route('customer.update', ['customer' => $customer]) }}" method="post"
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
                        <label class="block text-sm font-medium mb-2" for="customer_name">顧客名称</label>
                        <input id="customer_name" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded"
                            type="text" name="customer_name"
                            value="{{ old('customer_name', $customer->customer_name ?? '') }}">
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="customer_official_name">顧客公式名称</label>
                        <input id="customer_official_name"
                            class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded" type="text"
                            name="customer_official_name"
                            value="{{ old('customer_official_name', $customer->customer_official_name ?? '') }}">
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="customer_code">顧客コード</label>
                        <input id="customer_code" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded"
                            type="text" name="customer_code"
                            value="{{ old('customer_code', $customer->customer_code ?? '') }}">
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="bTRANSFER_MONT">振込予定月</label>
                        <input id="bTRANSFER_MONT" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded"
                            type="number" name="bTRANSFER_MONT"
                            value="{{ old('bTRANSFER_MONT', $customer->bTRANSFER_MONT ?? '') }}" min="1"
                            max="12" placeholder="1〜12" />
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="bTRANSFER_DAY">振込予定日(毎月◯日)</label>
                        <input id="bTRANSFER_DAY" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded"
                            type="number" name="bTRANSFER_DAY"
                            value="{{ old('bTRANSFER_DAY', $customer->bTRANSFER_DAY ?? '') }}" min="1" max="31"
                            placeholder="1〜31" />
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


    <div class="py-4 bg-white rounded">
        <div class="flex px-6 pb-4 border-b">
            <h3 class="text-xl font-bold">受注プロジェクト一覧</h3>
        </div>

        <div class="pt-4 px-6">
            @if ($projects->isEmpty())
                受注プロジェクトなし
            @else
                <table class='table table-striped'>
                    <tr>
                        {{-- <th>ID</th> --}}
                        <th>プロジェクト名</th>
                        <th>担当者</th>
                        <th>開始日</th>
                        <th>終了日</th>
                        <th>受注額</th>
                        <th>外注費</th>
                        <th>収益</th>
                        <th>非表示</th>
                    </tr>
                    @foreach ($projects as $project)
                        <tr>
                            {{-- <td>{{ $project -> project_id}}</td> --}}
                            <td><a
                                    href="{{ Route('project.edit', ['project' => $project->project_id]) }}">{{ $project->project_name }}</a>
                            </td>
                            <td>
                                @if ($project->user_id == 0)
                                    担当者未選択
                                @else
                                    <a href="{{Route('user.edit',['user'=>$project->user_id])}}">{{ $project->user_name }}</a>
                                @endif
                            </td>
                            <td>{{ $project->start_date }}</td>
                            <td>{{ $project->end_date }}</td>
                            <td>{{ number_format($project->amount) }}</td>
                            <td>{{ number_format($project->outside) }}</td>
                            <td>{{ number_format($project->amount - $project->outside) }}</td>
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
    <script>
        // 現在の日付を取得してフォーマット
        const today = new Date();
        const formattedDate = today.toISOString().split('T')[0]; // YYYY-MM-DD形式に変換

        // input要素に設定
        document.getElementById('start_date').value = formattedDate;
    </script>

@endsection
