<!--25一般社員登録-->
@extends('layouts.layout')

@section('content')
<div class="container">
<div class="row justify-content-center mt-5">
    <div class="text-center mb-3"><h2>社員登録</h2></div>
    <form action="{{ route('employees.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="store_id">店舗ID</label>
            <input type="text" class="form-control" id="store_id" name="store_id"  value="{{ old('store_id') ?: session('employee_registration.store_id') }}">
            @error('store_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mt-3">
            <label for="name">名前</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') ?: session('employee_registration.name') }}">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mt-3">
            <label for="email">メールアドレス</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') ?: session('employee_registration.email')}}">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mt-3">
            <label for="password">パスワード</label>
            <input type="password" class="form-control" id="password" name="password">
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="text-center mt-3">
        <button type="submit" class="btn btn-primary">登録</button>
        <a href="{{ route('employee_list') }}" class="btn btn-secondary">戻る</a></div>
    </form>
</div>
@endsection
