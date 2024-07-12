<!--1ログイン-->
@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="text-center mb-3"><h2>ログイン</h2></div>
            <div class="card-body">
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="email">メールアドレス</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" />
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="password">パスワード</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" />
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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
