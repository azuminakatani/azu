<!--9入荷予定一覧-->
@extends('layouts.layout')

@section('content')
<div class="container">
    <h1>入荷予定一覧</h1>
    <div class="mb-3">
        <form action="{{ route('arrival_list.search') }}" method="GET" class="form-inline">
        @csrf
            <label for="start_date" class="mr-2">始めの日付:</label>
            <input type="date" id="start_date" name="start_date" class="form-control mr-3"value="{{ $start_date ?? '' }}">>
            <label for="end_date" class="mr-2">終わりの日付:</label>
            <input type="date" id="end_date" name="end_date" class="form-control mr-3" value="{{ $end_date ?? '' }}">
            <input type="text" class="form-control mr-3" placeholder="商品名" name="keyword" value="{{ $keyword ?? '' }}">
            <button type="submit" class="btn btn-primary mr-3">検索</button>
        </form>
        <a href="{{ route('arrival_list.create') }}" class="btn btn-primary">入荷登録画面へ</a>
    </div>
    
    <table class="table">
        <thead>
            <tr>
                <th>商品名</th>
                <th>入荷予定日</th>
                <th>数量</th>
                <th>重量</th>
                <th>詳細</th>
                <th>確定</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($incomingShipments as $incomingShipment)
            <tr>
                <td>{{ $incomingShipment->product->name }}</td>
                <td>{{ $incomingShipment->scheduled_date }}</td>
                <td>{{ $incomingShipment->quantity }}</td>
                <td>{{ $incomingShipment->weight }}</td>
                <td>
                    <a href="{{ route('arrival_list.show', $incomingShipment->id) }}">詳細</a>
                </td>
                <td></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
