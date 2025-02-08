@extends('layouts.admin')

@section('title', '顧客')

@section('content')
<h2>顧客一覧</h2>
    <div class="container">
        <a href="{{Route('customer.create')}}">customer顧客登録</a>
        <table class='table table-striped'>
            <tr>
                <th>ID</th>
                <th>顧客コード</th>
                <th>顧客名</th>
                <th></th>
            </tr>
            @foreach ($customers as $customer)
                <tr>
                    <td>{{ $customer -> id}}</td>
                    <td>{{ $customer -> customer_code }}</td>
                    <td>{{ $customer -> customer_name }}</td>
                    <td><a href="{{Route('customer.edit',[ 'customer' => $customer])}}">詳細・修正</a></td>

                </tr>
            @endforeach
        </table>
    </div>
@endsection
