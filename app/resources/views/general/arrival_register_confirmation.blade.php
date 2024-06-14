<!--11入荷登録確認-->
@extends('layouts.layout')

@section('content')
<div class="container">
    <h1>入荷登録確認</h1>

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
            <form action="{{ route('arrival_list.store') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">登録</button>
            </form>
            <a href="" class="btn btn-secondary">戻る</a>
        </div>
    </div>
</div>
@endsection
