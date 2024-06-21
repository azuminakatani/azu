<!--15各店舗在庫一覧-->
@extends('layouts.layout')

@section('content')
    <div class="container">
    <div class="text-center mb-3"><h2>{{ $store->name }}在庫一覧</h2></div>
    <div class="col-md-8">
            <form action="{{ route('admin.stocks', $store->id) }}" method="GET" class="form-inline">
                @csrf
                <div class="form-group mr-3">
                    <input type="text" id="keyword" name="keyword" placeholder="商品名で検索" class="form-control" value="{{ $keyword ?? '' }}">
                </div>
                <button type="submit" class="btn btn-primary">検索</button>
            </form>
        </div>
    <table class="table">
            <thead>
                <tr>
                    <th>商品</th>
                    <th>数量</th>
                    <th>重量</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($stocks as $stock)
                <tr>
                    <td>{{ $stock->product->name }}</td>
                    <td>{{ $stock->quantity }}</td>
                    <td>{{ $stock->weight }}</td>
                </tr>
                @endforeach
                <a href="{{ route('all_stores_list') }}" class="btn btn-secondary">全店舗一覧に戻る</a>
            </tbody>
        </table>
    </div>
@endsection
