<!--22入荷予定一覧-->
@extends('layouts.layout')

@section('content')
<div class="container">
    <h1>入荷予定一覧</h1>
    <a href="" class="btn btn-primary">商品登録</a>

    
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
            @foreach ($incomingShipments as $incomingShipment)
            <tr>
                <td>{{ $incomingShipment->product->name }}</td>
                <td>{{ $incomingShipment->schedelud_date }}</td>
                <td>{{ $incomingShipment->quantity }}</td>
                <td>{{ $incomingShipment->weight }}</td>
                <td>
                    <!-- 削除ボタン -->
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
