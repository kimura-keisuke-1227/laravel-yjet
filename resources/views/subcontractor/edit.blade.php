@extends('layouts.admin')

@section('content')
    <section class="py-8">
        <div class="container px-4 mx-auto">
            <div class="py-4 bg-white rounded">
                <form action="{{ Route('subcontractor.update',['subcontractor' => $subcontractor->id]) }}" method="post" enctype="multipart/form-data">
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
                        <label class="block text-sm font-medium mb-2" for="title">外注先名称</label>
                        <input id="subcontractor_name" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded"
                            type="text" name="subcontractor_name" value="{{$subcontractor->subcontractor_name}}">
                    </div>


                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="title">外注先コード</label>
                        <input id="subcontractor_code" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded"
                            type="text" name="subcontractor_code" value="{{$subcontractor->subcontractor_code}}">
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium mb-2" for="title">外注先略称</label>
                        <input id="subcontractor_abbreviation" class="block w-full px-4 py-3 mb-2 text-sm bg-white border rounded"
                            type="text" name="subcontractor_abbreviation" value="{{$subcontractor->subcontractor_abbreviation}}">
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
@endsection
