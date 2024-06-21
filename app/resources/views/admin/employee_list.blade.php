<!--24一般社員一覧-->
@extends('layouts.layout')

@section('content')
<div class="container">
<div class="text-center mb-3"><h2>一般社員一覧</h2></div>
    <div class="search-box">
        <form action="" method="GET">
            <input type="text" name="keyword" placeholder="店舗ID・名前を入力" value="{{ request('keyword') }}">
            <button type="submit">検索</button>
        </form>
    </div>
    <div class="button-group">
        <button onclick="location.href=''">社員登録</button>
    </div>
    <div class="employee-list">
        <table class="table">
            <thead>
                <tr>
                    <th>店舗ID</th>
                    <th>名前</th>
                    <th>メールアドレス</th>
                    <th>削除</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $employee)
                <tr>
                    <td>{{ $employee->store_id }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->email }}</td>
                    <td><a href="{{ route('employees.delete', $employee->id) }}" onclick="return confirm('本当に削除しますか？')">削除</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
