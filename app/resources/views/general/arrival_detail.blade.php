<!--13入荷予定編集-->
@extends('layouts.layout')

@section('content')
<div class="container">
    <h1>入荷編集</h1>

    <form action="{{ route('incoming_shipments.update', $incomingShipment->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="product">商品名</label>
            <select class="form-control" id="product" name="product_id">
                @foreach($products as $product)
                    <option value="{{ $product->id }}" @if($product->id === $incomingShipment->product_id) selected @endif>{{ $product->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="scheduled_date">入荷予定日</label>
            <input type="date" class="form-control" id="scheduled_date" name="scheduled_date" value="{{ $incomingShipment->scheduled_date }}">
        </div>
        <div class="form-group">
            <label for="quantity">数量</label>
            <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $incomingShipment->quantity }}">
        </div>
        <div class="form-group">
            <label for="weight">重量</label>
            <input type="number" step="0.01" class="form-control" id="weight" name="weight" value="{{ $incomingShipment->weight }}">
        </div>
        <button type="submit" class="btn btn-primary">登録</button>
        <a href="" class="btn btn-secondary">戻る</a>
    </form>
</div>
@endsection
