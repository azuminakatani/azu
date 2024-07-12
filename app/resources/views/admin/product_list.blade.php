<!--16商品一覧-->
@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
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
    <div class="text-reight mb-3">
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
<div class="scroll-to-top">
    <a id="scroll-to-top-link" href="#" onclick="scrollToTop();">TOP</a>
</div>

<style>
    .scroll-to-top {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 1000;
    }

    #scroll-to-top-link {
        display: none;
        padding: 10px 20px;
        background-color: rgba(0, 123, 255, 0.7);;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
    }

    #scroll-to-top-link:hover {
        background-color: #0056b3;
    }
</style>

<script>
    function scrollToTop() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    window.addEventListener('scroll', function() {
        var scrollButton = document.getElementById('scroll-to-top-link');
        if (window.scrollY > 100) {
            scrollButton.style.display = 'block';
        } else {
            scrollButton.style.display = 'none';
        }
    });
</script>

@endsection
