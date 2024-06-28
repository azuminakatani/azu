<!--14全店舗一覧-->
@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="text-center mb-3"><h2>全店舗一覧</h2></div>
    <form action="{{ route('store.search') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" class="form-control" placeholder="店舗名で検索" name="search" value="{{ request()->input('search') }}">
        <div class="input-group-append">
            <button type="submit" class="btn btn-outline-secondary">検索</button>
        </div>
    </div>
    </form>
        <table class="table">
            <thead>
                <tr>
                    <th>詳細</th>
                    <th>店舗名</th>
                    <th>ID</th>    
                </tr>
            </thead>
            <tbody>
            @foreach ($stores as $store)
                <tr>
                    <td><a href="{{ route('admin.stocks', $store->id) }}">詳細</a></td>
                    <td>{{ $store->name }}</td>
                    <td>{{ $store->id }}</td>
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

