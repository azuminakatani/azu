@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>在庫一覧</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>商品</th>
                    <th>数量</th>
                    <th>重量</th>
                    <th>削除</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stocks as $stock)
                    <tr>
                        <td>{{ $stock->product->name }}</td>
                        <td>{{ $stock->quantity }}</td>
                        <td>{{ $stock->weight }}</td>
                        <td><a href="#">削除</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
