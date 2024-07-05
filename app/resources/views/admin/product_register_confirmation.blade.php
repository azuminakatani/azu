<!--18商品登録確認-->
@extends('layouts.layout')

@section('content')
<div class="container">
<div class="text-center mb-3"><h2>商品登録確認</h2></div>
    <div class="row">
        <div class="text-center mb-3">
                <label for="name">商品名</label>
                <p>{{ $validatedData['name'] }}</p>
                <label for="weight">重量</label>
                <p>{{ $validatedData['weight'] }}</p>
                <label for="image">画像プレビュー</label>
                @if (Session::has('product_registration_data.image_url') && Session::get('product_registration_data.image_url'))
                <img src="{{ Session::get('product_registration_data.image_url') }}" style="max-width: 100%; max-height: 200px;" />
                @else
                <p>No Image Uploaded</p>
                @endif
            <form action="{{ route('products.register.confirm') }}" method="POST">
                @csrf
                <input type="hidden" name="name" value="{{ $validatedData['name'] }}">
                <input type="hidden" name="weight" value="{{ $validatedData['weight'] }}">
                <input type="hidden" name="image_url" value="{{ Session::get('product_registration_data.image_url', '') }}">
                
                <button type="submit" class="btn btn-primary">登録</button>
                <a href="{{ route('products.register') }}" class="btn btn-secondary">戻る</a>
            </form>
        </div>
    </div>
</div>
@endsection

