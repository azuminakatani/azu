<!--3新規登録完了-->
@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="text-center mb-3"><h3>新規登録完了しました</h3></div>
            <div class="text-center mb-3">
                <a href="{{ route('login') }}" class="btn btn-primary mb-3">ログイン画面へ</a>
            </div>
        </div>
    </div>
</div>
@endsection
