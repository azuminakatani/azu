<!--26一般社員登録確認-->
@extends('layouts.layout')

@section('content')
<div class="container">
<div class="row justify-content-center mt-5">
    <div class="text-center mb-3"><h2>一般社員登録確認</h2></div>
    <div class="text-center mb-3">
    <div>
        <p>店舗ID: {{ $validatedData['store_id'] }}</p>
        <p>名前: {{ $validatedData['name'] }}</p>
        <p>メールアドレス: {{ $validatedData['email'] }}</p>
    </div></div>
    <div class="text-center mt-3">
    <form action="{{ route('employees.complete') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">登録完了</button>
    </form>    
    <div class="text-center mt-3">
        <a href="{{ route('employees.create') }}" class="btn btn-secondary">戻る</a></div>
@endsection
