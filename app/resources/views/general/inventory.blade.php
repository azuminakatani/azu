<!--8自店舗在庫一覧 -->
@extends('layouts.layout')

@section('content')
<div class="container">
<div class="row justify-content-center mt-5">
    <div class="text-center mb-3">
        <h2>在庫一覧</h2>
    </div>
    <form action="{{ route('inventory.search') }}" method="GET">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="商品名で検索" name="keyword" value="{{ isset($keyword) ? $keyword : old('keyword') }}">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">検索</button>
            </div>
        </div>
    </form>
    <table class="table col-md-8 table-striped" id="stock-table">
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
                <form action="{{ route('inventory.delete', $stock->id) }}" method="POST" class="delete-form">
                @csrf
                @method('DELETE')
                <button type="submit">削除</button>
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
        background-color: rgba(0, 123, 255, 0.7);
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
    }
    #scroll-to-top-link:hover {
        background-color: #0056B3;
    }
</style>
<script>
    var page = 1;
    var isLoading = false;
    var lastPageReached = false;
    
    document.addEventListener('DOMContentLoaded', function() {
        // イベントデリゲーションを使用して削除ボタンにイベントリスナーを追加
        document.getElementById('stock-table').addEventListener('submit', function(event) {
            if (event.target && event.target.classList.contains('delete-form')) {
                event.preventDefault();
                deleteStock(event, event.target);
            }
        });
        window.addEventListener('scroll', function() {
            var scrollButton = document.getElementById('scroll-to-top-link');
            if (!scrollButton) return;
            if (window.scrollY > 100) {
                scrollButton.style.display = 'block';
            } else {
                scrollButton.style.display = 'none';
            }
            if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 200) {
                loadMore();
            }
        });
    });
    function scrollToTop() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function loadMore() { // 追加のデータを読み込む関数
        if (isLoading || lastPageReached) return;
        isLoading = true;
        page++;
        var url = "{{ route('inventory.infinite-scroll') }}?page=" + page;// データを取得するURLを構築
        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'// リクエストがAjaxであることを示すヘッダーを追加
            }
        })
        .then(response => response.json())// レスポンスをJSON形式で解析
        .then(data => {
            isLoading = false;

            // 取得したデータが正常であり、ストックデータが存在する場合はテーブルに行を追加
            if (data && data.stocks && data.stocks.data && data.stocks.data.length > 0) {
                var tbody = document.getElementById('stock-table').getElementsByTagName('tbody')[0];
                var lastIndex = tbody.children.length;
                data.stocks.data.forEach(stock => {
                    var productName = stock.product ? stock.product.name : 'Unknown Product';// 商品名を取得
                    var deleteUrl = "{{ route('inventory.delete', ':id') }}".replace(':id', stock.id);// 削除するURLを生成
                    var row = `
                        <tr>
                            <td>${productName}</td>
                            <td>${stock.quantity}</td>
                            <td>${stock.weight}</td>
                            <td>
                                <form class="delete-form" action="${deleteUrl}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">削除</button>
                                </form>
                            </td>
                        </tr>
                    `;
                    tbody.insertAdjacentHTML('beforeend', row);// テーブルの最後に行を追加
                });
                var newScrollTop = tbody.children[lastIndex] ? tbody.children[lastIndex].offsetTop : 0;
                window.scrollTo({ top: newScrollTop, behavior: 'smooth' });
            } else {
                lastPageReached = true;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            isLoading = false;
        });
    }
    
    function deleteStock(event, form) { // ストックデータを削除する関数
        if (!confirm('本当に削除しますか？')) {
            return;
        }
        fetch(form.action, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',// JSON形式のデータを送信することを示すヘッダー
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                _method: 'DELETE',
                _token: '{{ csrf_token() }}'
            })
        })
        .then(response => {
            if (response.ok) {
                form.closest('tr').remove(); // 削除が成功した場合は該当する行をテーブルから削除
            } else {
                throw new Error('削除に失敗しました。');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('削除に失敗しました。');
        });
    }
</script>
@endsection









