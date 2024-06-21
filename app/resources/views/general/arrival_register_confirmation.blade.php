<!--11入荷登録確認 -->
@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="text-center mb-3"><h3>入荷登録確認</h3>
            <div class="form-group">
                <label for="product">商品名</label>
                <p>{{ $product->name }}</p>
            </div>
            <div class="form-group">
                <label for="scheduled_date">入荷予定日</label>
                <p>{{ $validatedData['scheduled_date'] }}</p>
            </div>
            <div class="form-group">
                <label for="quantity">数量</label>
                <p>{{ $validatedData['quantity'] }}</p>
            </div>
            <div class="form-group">
                <label for="weight">重量</label>
                <p>{{ $validatedData['weight'] }}</p>
            </div>
            <form action="{{ route('arrival_list.complete') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-primary mb-3">確定</button>
            </form>
            <a href="{{ route('arrival_list.create') }}" class="btn btn-secondary">戻る</a>
        </div></div>
    </div>
</div>
@endsection
