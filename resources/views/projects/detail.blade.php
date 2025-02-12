@extends('layouts.admin')

@section('content')
    <h2>プロジェクト作成</h2>
    <section class="py-8">
        <div class="container px-4 mx-auto">
            <div class="py-4 bg-white rounded">
                <form action="{{ Route('project.store') }}" method="post" enctype="multipart/form-data">
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
                        <label class="block text-sm font-medium mb-2" for="title">プロジェクト名</label>
                        <input id="project_name" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded"
                            type="text" name="project_name">
                    </div>
                    <label class="block text-sm font-medium mb-2" for="user_id">担当者</label>
                    <select id="user_id" class="appearance-none block pl-4 pr-8 py-3 mb-2 text-sm bg-white border rounded"
                        name="user_id">
                        <option value="0">未選択</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                    <label class="block text-sm font-medium mb-2" for="customer_id">顧客</label>
                    <select id="customer_id"
                        class="appearance-none block pl-4 pr-8 py-3 mb-2 text-sm bg-white border rounded"
                        name="customer_id">
                        <option value="0">未選択</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}">
                                {{ $customer->customer_code }}_{{ $customer->customer_name }}
                            </option>
                        @endforeach
                    </select>

                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="search_date">日付</label>
                        <select id="search_date"
                            class="appearance-none block pl-4 pr-8 py-3 mb-2 text-sm bg-white border rounded"
                            name="search_date">
                            <option value="start_date">開始日</option>
                            <option value="end_date" selected>終了日</option>
                        </select>
                        <input id="start_date" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded"
                            type="date" name="start_date" max="2382-12-31">
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="title">メモ</label>
                        <textarea rea id="remark" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded" name="remark" rows=10></textarea>
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
