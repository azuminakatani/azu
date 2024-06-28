<!--7パスワード再設定完了-->
@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('パスワード再設定完了') }}</div>

                <div class="card-body">
                    <p>パスワードの再設定が完了しました。</p>
                    <p><a href="{{ route('login') }}">ログイン画面へ</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
