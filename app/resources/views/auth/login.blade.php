<!--1ログイン-->
@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="text-center mb-3"><h3>ログイン</h3></div>
            <div class="card-body">
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="email">メールアドレス</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" />
                    </div>
                    <div class="form-group mb-3">
                        <label for="password">パスワード</label>
                        <input type="password" class="form-control" id="password" name="password" />
                    </div>
                    <div class="text-center mb-3">
                        <a href="{{ route('password.request') }}">パスワードの変更はこちらから</a>
                    </div>
                    <div class="text-center mb-3">
                        <button type="submit" class="btn btn-primary">ログイン</button>
                    </div>
                    <div class="text-center">
                        <a href="{{ route('register') }}">新規登録はこちら</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection