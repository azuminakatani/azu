<!--15各店舗在庫一覧-->
@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
    <div class="text-center mb-3"><h2>{{ $store->name }}在庫一覧</h2></div>
        <form action="{{ route('admin.stocks', $store->id) }}" method="GET" class="form-inline">
                @csrf    
                <div class="input-group">
                    <input type="text" id="keyword" name="keyword" placeholder="商品名で検索" class="form-control" value="{{ $keyword ?? '' }}">
                <div class="input-group-append">
                <button type="submit" class="btn btn-outline-secondary">検索</button>
                </div></div>
            </form>
    <div class="text-reight mt-3">
        <a href="{{ route('all_stores_list') }}" class="btn btn-secondary">全店舗一覧に戻る</a></div>
        <table class="table col-md-8 table-striped">
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
            </tbody>
        </table>
    </div></div>
    
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
