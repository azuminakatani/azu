<!--8自店舗在庫一覧-->

@extends('layouts.layout')

@section('content')
    <div class="container">
    <div class="text-center mb-3"><h2>在庫一覧</h2></div>
        <form action="{{ route('inventory.search') }}" method="GET">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="商品名で検索" name="keyword"  value="{{ isset($keyword) ? $keyword : old('keyword') }}">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">検索</button>
                </div>
            </div>
        </form>
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
                @foreach ($stocks as $stock)
                <tr>
                    <td>{{ $stock->product->name }}</td>
                    <td>{{ $stock->quantity }}</td>
                    <td>{{ $stock->weight }}</td>
                    <td>
                    <form action="{{ route('inventory.delete', $stock->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a href="{{ route('inventory.delete', $stock->id) }}" onclick="return confirm('本当に削除しますか？')">削除</a>                    
                    </form>          
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
