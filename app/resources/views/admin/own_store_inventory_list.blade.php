<!--20自店舗在庫一覧-->
@extends('layouts.layout')

@section('content')
    <div class="container">
    <div class="text-center mb-3"><h2>自店舗在庫一覧</h2></div>
    <form action="{{ route('own.inventory.search') }}" method="GET">
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="商品名で検索" name="keyword">
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
                    <form action="{{ route('own.inventory.delete', $stock->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('本当に削除しますか？')">削除</button>
                        </form> 
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
