<!--22入荷予定一覧-->
@extends('layouts.layout')

@section('content')
<div class="container">
    <h1 class="text-center mb-4">入荷予定一覧</h1>
    <div class="col-md-4 text-right">
        <a href="{{ route('arrival_schedule.create') }}" class="btn btn-primary">入荷登録画面へ</a>
    </div>
    <div class="search-box">
    <form action="{{ route('arrival_schedule.search') }}" method="GET" class="form-inline">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="start_date" class="mr-2">始めの日付:</label>
                    <input type="date" id="start_date" name="start_date" class="form-control" value="{{ $start_date ?? '' }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="end_date" class="mr-2">終わりの日付:</label>
                    <input type="date" id="end_date" name="end_date" class="form-control" value="{{ $end_date ?? '' }}">
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="商品名" name="keyword" value="{{ $keyword ?? '' }}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-outline-secondary">検索</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
    <div class="row justify-content-center">
        <table class="table col-md-8">
            <thead>
                <tr>
                    <th class="text-center">商品名</th>
                    <th class="text-center">入荷予定日</th>
                    <th class="text-center">数量</th>
                    <th class="text-center">重量</th>
                    <th class="text-center">確定</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($incomingShipments as $incomingShipment)
                <tr>
                    <td class="text-center">{{ $incomingShipment->product->name }}</td>
                    <td class="text-center">{{ $incomingShipment->scheduled_date }}</td>
                    <td class="text-center">{{ $incomingShipment->quantity }}</td>
                    <td class="text-center">{{ $incomingShipment->weight }}</td>
                    <td class="text-center">
                    <a href="{{ route('arrival_schedule.confirm', $incomingShipment->id) }}" class="btn btn-success"
                    onclick="return confirm('この入荷を確定しますか？')">確定</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
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

