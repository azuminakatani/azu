<!--17商品登録-->
@extends('layouts.layout')

@section('content')
<div class="container">
<div class="text-center mb-3"><h2>商品登録</h2></div>
    <form action="{{ route('products.register.post') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">商品名</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') ?: session('product_registration_data.name') }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="weight">重量</label>
            <input type="number" step="0.01" class="form-control @error('weight') is-invalid @enderror" id="weight" name="weight" value="{{ old('weight') ?: session('product_registration_data.weight') }}" required>
            @error('weight')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="image">写真追加</label>
            <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image" value="{{ old('image_url') ?: session('product_registration_data.image_url') }}">
            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            @if (Session::has('product_registration_data.image_url'))
            <img src="{{ Session::get('product_registration_data.image_url') }}" style="max-width: 100%; max-height: 200px;">
            @endif
        </div>
        <button type="submit" class="btn btn-primary">登録確認</button>
    </form>
    <a href="{{ route('product_list') }}" class="btn btn-secondary">戻る</a>
</div>
@endsection
