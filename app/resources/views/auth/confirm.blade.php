<!--2新規登録確認-->
@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
        <div class="text-center mb-3"><h3>新規登録確認</h3></div>
                    <div class="text-center mb-3">
                        <p>ユーザー名: <strong>{{ $userData['name'] }}</strong></p>
                        <p>メールアドレス: <strong>{{ $userData['email'] }}</strong></p>
                        <p>パスワード: <strong>{{ $userData['password'] }}</strong></p>
                    <form action="{{ route('register.complete') }}" method="post" >
                    <input type="hidden" name="name" value="{{ $userData['name'] }}">
                    <input type="hidden" name="email" value="{{ $userData['email'] }}">
                    <input type="hidden" name="password" value="{{ $userData['password'] }}">
                    @csrf
                        <button type="submit" class="btn btn-primary mb-3">登録</button>
                    </form>
                    <a href="{{ route('register') }}">戻る</a>
                </div>
        </div>
    </div>
</div>
@endsection
