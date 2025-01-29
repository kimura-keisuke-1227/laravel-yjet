@extends('layouts.admin')

@section('content')
    <h2>レポート作成</h2>
    <section class="py-8">
        <div class="container px-4 mx-auto">
            <div class="py-4 bg-white rounded">
                <form action="{{ Route('report_headers.update', ['report_header' => $report_header->id]) }}" method="post"
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
                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="report_name">レポートコード</label>
                        <input id="report_name" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded"
                            type="text" name="report_name" value="{{ $report_header->report_code }}">
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="report_code">レポート名</label>
                        <input id="report_code" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded"
                            type="text" name="report_code" value="{{ $report_header->report_name }}">
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="remark">メモ</label>
                        <textarea id="remark" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded" name="remark" rows="10">{{ $report_header->remark }}</textarea>
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

        // もしstart_dateというinputがあれば、そこに設定
        const startDateInput = document.getElementById('start_date');
        if (startDateInput) {
            startDateInput.value = formattedDate;
        }
    </script>

@endsection
