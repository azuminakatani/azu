<!--14全店舗一覧-->
@extends('layouts.layout')

@section('content')
    <div class="container">
    <div class="text-center mb-3"><h2>全店舗一覧</h2></div>
        <form action="{{ route('store.search') }}" method="GET" class="mb-3">
            <div class="form-group">
                <input type="text" class="form-control" id="search" placeholder="店舗名で検索" name="search" value="{{ request()->input('search') }}">
            </div>
            <button type="submit" class="btn btn-primary">検索</button>
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th>詳細</th>
                    <th>店舗名</th>
                    <th>ID</th>    
                </tr>
            </thead>
            <tbody>
            @foreach ($stores as $store)
                <tr>
                    <td><a href="{{ route('admin.stocks', $store->id) }}">詳細</a></td>
                    <td>{{ $store->name }}</td>
                    <td>{{ $store->id }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

