<!--23入荷登録確認-->
@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="text-center mb-3"><h2>入荷登録確認</h2></div>
    <div class="row">
        <div class="text-center mb-3">
            <form action="{{ route('arrival_schedule.complete') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="product">商品名</label>
                    <p>{{ $product->name }}</p>
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                </div>
                <div class="form-group">
                    <label for="scheduled_date">入荷予定日</label>
                    <p>{{ $validatedData['scheduled_date'] }}</p>
                    <input type="hidden" name="scheduled_date" value="{{ $validatedData['scheduled_date'] }}">
                </div>
                <div class="form-group">
                    <label for="quantity">数量</label>
                    <p>{{ $validatedData['quantity'] }}</p>
                    <input type="hidden" name="quantity" value="{{ $validatedData['quantity'] }}">
                </div>
                <div class="form-group">
                    <label for="weight">重量</label>
                    <p>{{ $validatedData['weight'] }}</p>
                    <input type="hidden" name="weight" value="{{ $validatedData['weight'] }}">
                </div>
                <button type="submit" class="btn btn-primary">確定</button>
            </form>
            <a href="{{ route('arrival_schedule.create') }}" class="btn btn-secondary">戻る</a>
        </div>
    </div>
</div>
@endsection
