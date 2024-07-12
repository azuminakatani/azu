<!--23入荷予定登録-->
@extends('layouts.layout')

@section('content')
<div class="container">
<div class="row justify-content-center mt-5">
<div class="text-center mb-3"><h2>入荷登録</h2></div>
<form action="{{ route('arrival_schedule.store') }}" method="POST">
        @csrf
        <div class="form-group mt-3">
            <label for="product">商品名</label>
            <select class="form-control" id="product" name="product_id">
                @foreach($products as $product)
                @php
                    $selected = session('arrival_registration.product_id') == $product->id ? 'selected' : '';
                @endphp
                <option value="{{ $product->id }}" {{ $selected }}>{{ $product->name }}</option>
                @endforeach
            </select>
            @error('product_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div> 
        <div class="form-group mt-3">
            <label for="scheduled_date">入荷予定日</label>
            <input type="date" class="form-control" id="scheduled_date" name="scheduled_date" value="{{ old('scheduled_date') ?: session('arrival_registration.scheduled_date') }}">
            @error('scheduled_date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mt-3">
            <label for="quantity">数量</label>
            <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity') ?: session('arrival_registration.quantity') }}">
            @error('quantity')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="text-center mt-3">
        <button type="submit" class="btn btn-primary">登録</button>
        <a href="{{ route('arrival_schedule') }}" class="btn btn-secondary">戻る</a></div>

    </form>
</div>
@endsection
