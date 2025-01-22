@extends('layouts.admin')

@section('content')
<section class="py-8">
    <div class="container px-4 mx-auto">
        <div class="py-4 bg-white rounded">
            <form action="{{Route('work.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-6">
                    <label class="block text-sm font-medium mb-2" for="title">プロジェクト名</label>
                    <input id="project_name" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded" type="text" name="project_name">
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium mb-2" for="title"> 開始日</label>
                    <input id="date" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded" type="date" name="start_date">
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
