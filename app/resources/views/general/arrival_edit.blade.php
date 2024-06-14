<!--12入荷予定詳細-->
@extends('layouts.layout')

@section('content')
<div class="container">
    <h1>入荷詳細</h1>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="product">商品名</label>
                <input type="text" class="form-control" id="product" value="{{ $incomingShipment->product->name }}" readonly>
            </div>
            <div class="form-group">
                <label for="scheduled_date">入荷予定日</label>
                <input type="text" class="form-control" id="scheduled_date" value="{{ $incomingShipment->scheduled_date }}" readonly>
            </div>
            <div class="form-group">
                <label for="quantity">数量</label>
                <input type="text" class="form-control" id="quantity" value="{{ $incomingShipment->quantity }}" readonly>
            </div>
            <div class="form-group">
                <label for="weight">重量</label>
                <input type="text" class="form-control" id="weight" value="{{ $incomingShipment->weight }}" readonly>
            </div>
            <a href="{{ route('incoming_shipments.edit', $incomingShipment->id) }}" class="btn btn-primary">編集</a>
            <form action="{{ route('incoming_shipments.destroy', $incomingShipment->id) }}" method="POST" style="display: inline-block;">
                @csrf
                @method('DELETE')
                <a href="{{ route('arrival_list.delete', $incomingShipment->id) }}" class="btn btn-danger" onclick="return confirm('この入荷予定を削除してもよろしいですか？')">削除</a>                </td>
            </form>
            <a href="{{ route('arrival_list') }}" class="btn btn-secondary">戻る</a>
        </div>
    </div>
</div>
@endsection
