<!--16商品情報一覧-->
@extends('layouts.layout')

@section('content')
<div class="container">
    <h2>商品情報一覧</h2>
    <div class="search-box">
        <form action="" method="GET">
            <input type="text" name="keyword" placeholder="商品名を入力">
            <button type="submit">検索</button>
        </form>
    </div>
    <div class="button-group">
        <button onclick="location.href=''">商品登録</button>
    </div>
    <div class="product-list">
        @foreach($products as $product)
        <div class="product-item">
            <div class="product-details">
                <p>商品名: {{ $product->name }}</p>
                <p>重量: {{ $product->weight }} kg</p>
            </div>
            <div class="product-image">
                @if($product->image_url)
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                @else
                <p>No Image Available</p>
                @endif
            </div>
            <div class="product-actions">
                <button onclick="location.href=''">編集</button>
                <button onclick="confirmDelete('{{ $product->name }}', '{{ route('product.delete', $product->id) }}')">削除</button>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script>
    function confirmDelete(productName, deleteUrl) {
        if (confirm('商品 "' + productName + '" を削除してもよろしいですか？')) {
            // 削除リンクにリダイレクト
            window.location.href = deleteUrl;
        }
    }
</script>

@endsection
