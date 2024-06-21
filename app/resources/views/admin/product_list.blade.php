<!--16商品一覧-->
@extends('layouts.layout')

@section('content')
<div class="container">
<div class="text-center mb-3"><h2>商品一覧</h2></div>
    <div class="search-box mb-3">
        <form action="{{ route('products.search') }}" method="GET">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="商品名で検索" name="keyword" value="{{ $keyword ?? '' }}">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">検索</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-4 text-right">
        <a href="{{ route('products.register') }}" class="btn btn-primary">商品登録画面へ</a>
    </div>
    <div class="row">
        @foreach($products as $product)
        <div class="col-md-4 mb-4">
            <div class="product-item border border-dark rounded p-3">
                <div class="product-details">
                    <p>商品名: {{ $product->name }}</p>
                    <p>重量: {{ $product->weight }} kg</p>
                </div>
                <div class="product-image">
                    @if($product->image_url)
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-fluid">
                    @else
                    <p>No Image Available</p>
                    @endif
                </div>
                <div class="product-actions mt-3 d-flex justify-content-between">
                    <a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary">編集</a>

                    <form action="{{ route('product.delete', $product->id) }}" method="POST" onsubmit="return confirm('商品 {{ $product->name }} を削除してもよろしいですか？')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">削除</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
