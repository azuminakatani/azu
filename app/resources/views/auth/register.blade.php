<!--2新規登録-->
@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="text-center mb-3"><h3>新規登録</h3></div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $message)
                                <p>{{ $message }}</p>
                            @endforeach
                        </div>
                    @endif
                    <form action="{{ route('register.confirm') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name">ユーザー名</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') ?: session('registration_data.name') }}" />
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">メールアドレス</label>
                            <input type="text" class="form-control" id="email" name="email" value="{{ old('email')?: session('registration_data.email')  }}" />
                        </div>
                        <div class="form-group mb-3">
                            <label for="password">パスワード</label>
                            <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="password-confirm">パスワード（確認）</label>
                            <input type="password" class="form-control" id="password-confirm" name="password_confirmation">
                        </div>
                        <div class="text-center mb-3">
                        <form action="{{ route('register.confirm') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-primary">入力確認</button>
                        </form>
                        </div>
                        <div class="text-center">
                            <a href="{{ route('login') }}">戻る</a>
                        </div>
                    </form>
                </div>
        </div>
    </div>
</div>
@endsection
