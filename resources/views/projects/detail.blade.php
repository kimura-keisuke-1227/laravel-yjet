@extends('layouts.admin')

@section('content')
<h2>プロジェクト詳細検索</h2>
<section class="py-8">
        <div class="container px-4 mx-auto">
            <div class="py-4 bg-white rounded">
                <form action="{{ Route('project_detail_search_execute') }}" method="post" enctype="multipart/form-data">
                    <!-- ▼▼▼▼エラーメッセージ▼▼▼▼ -->
                    @if ($errors->any())
                        <div class="mb-8 py-4 px-6 border border-red-300 bg-red-50 rounded">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="text-red-400">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <!-- ▲▲▲▲エラーメッセージ▲▲▲▲ -->
                    @csrf
                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="project_name">プロジェクト名</label>
                        <input id="project_name" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded"
                            type="text" name="project_name"
                            value="{{ old('project_name', $search_conditions['project_name'] ?? '') }}">
                    </div>

                    <!-- Grouping 担当者 and 顧客 -->
                    <div class="mb-6 flex flex-wrap -mx-2">
                        <div class="w-full md:w-1/2 px-2 mb-4 md:mb-0">
                            <label class="block text-sm font-medium mb-2" for="user_id">担当者</label>
                            <select id="user_id" class="block w-full pl-4 pr-8 py-3 mb-2 text-sm bg-white border rounded"
                                name="user_id">
                                <option value="0">未選択</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ old('user_id', $search_conditions['user_id'] ?? '') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-full md:w-1/2 px-2">
                            <label class="block text-sm font-medium mb-2" for="customer_id">顧客</label>
                            <select id="customer_id"
                                class="block w-full pl-4 pr-8 py-3 mb-2 text-sm bg-white border rounded" name="customer_id">
                                <option value="0">未選択</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}"
                                        {{ old('user_id', $search_conditions['customer_id'] ?? '') == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->customer_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Grouping 開始日 and 終了日 -->
                    <div class="mb-6 flex flex-wrap -mx-2">
                        <div class="w-full md:w-1/3 px-2 mb-4 md:mb-0">
                            <label class="block text-sm font-medium mb-2" for="search_date">日付</label>
                            <select id="search_date"
                                class="appearance-none block pl-4 pr-8 py-3 mb-2 text-sm bg-white border rounded"
                                name="search_date">
                                <option value="start_date"
                                    {{ isset($search_conditions['search_date']) && $search_conditions['search_date'] === 'start_date' ? 'selected' : '' }}>
                                    開始日</option>
                                <option value="end_date"
                                    {{ isset($search_conditions['search_date']) && $search_conditions['search_date'] === 'end_date' ? 'selected' : '' }}>
                                    終了日</option>
                            </select>
                        </div>
                        <div class="w-full md:w-1/3 px-2 mb-4 md:mb-0">
                            <label class="block text-sm font-medium mb-2" for="from_date">検索開始日</label>
                            <input id="from_date" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded"
                                type="date" name="from_date" max="2382-12-31"
                                value="{{ old('from_date', $search_conditions['from_date'] ?? '') }}">
                        </div>
                        <div class="w-full md:w-1/3 px-2">
                            <label class="block text-sm font-medium mb-2" for="to_date">検索終了日</label>
                            <input id="to_date" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded"
                                type="date" name="to_date" max="2382-12-31"
                                value="{{ old('to_date', $search_conditions['to_date'] ?? '') }}">
                        </div>
                    </div>

                    <div class="flex px-6 pb-4 border-b">
                        <div class="ml-auto">
                            <button type="submit"
                                class="py-2 px-3 text-xs text-white font-semibold bg-indigo-500 rounded-md">検索</button>
                        </div>
                    </div>
                </form>
            </div>
            <h3>検索結果</h3>
            <table class='table table-striped'>
                <tr>
                    <th>プロジェクト名</th>
                    <th>顧客</th>
                    <th>担当者</th>
                    <th>開始日</th>
                    <th>終了日</th>
                    <th>受注金額</th>
                    <th>外注費合計</th>
                    <th>内部委託費</th>
                    <th>会社利益</th>
                    <th></th>
                </tr>
                @foreach ($projects as $project)
                    <tr>
                        <td>{{ $project->project_name }}</td>
                        <td>
                            @if ($project->customer_id == 0)
                                未選択
                            @else
                                <a href="{{ Route('customer.edit', ['customer' => $project->customer_id]) }}">
                                    {{ $project->customer_name ? $project->customer_name : '顧客情報なし' }}
                                </a>
                            @endif
                        </td>
                        <td>
                            @if (!$project->user_id == 0)
                                <a href="{{ route('user.edit', ['user' => $project->user_id]) }}">
                                    {{ $project->user_name }}
                                </a>
                            @else
                                未選択
                            @endif
                        </td>
                        <td>{{ $project->start_date }}</td>
                        <td>{{ $project->end_date }}</td>
                        <td>{{ number_format($project->amount) }}</td>
                        <td>{{ number_format($project->outside) }}</td> <!-- 外注費合計 -->
                        <td>{{ number_format($project->inside) }}</td> <!-- 内部委託費合計 -->
                        <td>{{ number_format($project->profit) }}</td> <!-- 会社としての利益額 -->
                        <td>
                            <a href="{{ Route('project.edit', ['project' => $project->project_id]) }}">詳細・修正</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </section>
@endsection
