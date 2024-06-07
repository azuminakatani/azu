<!--5パスワード再設定-->
@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
                <div class="text-center mb-3"><h3>パスワード再設定</h3></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="email">メールアドレス</label>
                            <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" />
                        </div>

                        <div class="form-group">
                            <div class="text-center mb-3">
                                <button type="submit" class="btn btn-primary">パスワードリセットリンクを送信</button>
                            </div>
                        </div>
                    </form>
                    <div class="text-center">
                        <a href="{{ route('login') }}">戻る</a>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
