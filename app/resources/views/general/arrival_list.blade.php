<!--9入荷予定一覧-->
@extends('layouts.layout')

@section('content')
<div class="container">
    <h1>入荷予定一覧</h1>
    <a href="{{ route('product.create') }}" class="btn btn-primary">商品登録</a>

    <form action="{{ route('incoming_shipments.search') }}" method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-3 mb-3">
                <input type="date" class="form-control" placeholder="開始日" name="start_date">
            </div>
            <div class="col-md-3 mb-3">
                <input type="date" class="form-control" placeholder="終了日" name="end_date">
            </div>
            <div class="col-md-3 mb-3">
                <input type="text" class="form-control" placeholder="商品名を入力してください" name="keyword">
            </div>
            <div class="col-md-3 mb-3">
                <button type="submit" class="btn btn-primary">検索</button>
            </div>
        </div>
    </form>
    <table class="table">
        <thead>
            <tr>
                <th>商品名</th>
                <th>入荷予定日</th>
                <th>数量</th>
                <th>重量</th>
                <th>詳細</th>
                <th>削除</th>
            </tr>
        </thead>
        <tbody>
            @foreach($incomingShipments as $shipment)
                <tr>
                    <td><a href="{{ route('incoming_shipments.show', $shipment->id) }}">詳細</a></td>
                    <td>{{ $shipment->product->name }}</td>
                    <td>{{ $shipment->scheduled_date }}</td>
                    <td>{{ $shipment->quantity }}</td>
                    <td>{{ $shipment->weight }}</td>
                    <td><a href="{{ route('incoming_shipments.delete', $shipment->id) }}">削除</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
