<!--13入荷予定編集-->
@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="text-center mb-3"><h2>入荷編集</h2></div>
    <form action="{{ route('arrival_update', $incomingShipment->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="product">商品名</label>
            <select class="form-control" id="product" name="product_id">
                @foreach($products as $product)
                    <option value="{{ $product->id }}" @if($product->id === $incomingShipment->product_id) selected @endif>{{ $product->name }}</option>
                @endforeach
            </select>
            @error('product_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="scheduled_date">入荷予定日</label>
            <input type="date" class="form-control" id="scheduled_date" name="scheduled_date" value="{{ $incomingShipment->scheduled_date }}">
            @error('scheduled_date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="quantity">数量</label>
            <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $incomingShipment->quantity }}">
            @error('quantity')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="weight">重量</label>
            <input type="number" step="0.01" class="form-control" id="weight" name="weight" value="{{ $incomingShipment->weight }}">
            @error('weight')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">登録</button>
        <a href="{{ route('arrival_list.show', $incomingShipment->id) }}" class="btn btn-secondary">戻る</a>
    </form>
</div>
@endsection
