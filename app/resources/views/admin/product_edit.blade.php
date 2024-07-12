<!--19商品編集-->
@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
    <div class="text-center mb-3"><h2>商品編集</h2></div>
    <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">商品名</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $product->name) }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="weight">重量</label>
            <input type="number" step="0.01" class="form-control @error('weight') is-invalid @enderror" id="weight" name="weight" value="{{ old('weight', $product->weight) }}" required>
            @error('weight')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="image">写真</label>
            @if($product->image_url)
                <img src="{{ $product->image_url }}" style="max-width: 200px; max-height: 200px; display: block; margin-bottom: 10px;">
            @else
                <p>No Image Available</p>
            @endif
            <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image">
            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="delete_image">
                <input type="checkbox" id="delete_image" name="delete_image"> 写真を削除
            </label>
        </div>
        <button type="submit" class="btn btn-primary">更新</button>
        <a href="{{ route('product_list') }}" class="btn btn-secondary">戻る</a>
    </form>
</div>
@endsection
