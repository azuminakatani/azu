<!--14全店舗一覧-->
@extends('layouts.layout')

@section('content')
    <div class="container">
        <h1>全店舗一覧</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>店舗名</th>
                    <th>ID</th>
                    <th>詳細</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($stores as $store)
                <tr>
                    <td>{{ $store->name }}</td>
                    <td>{{ $store->id }}</td>
                    <td><a href="">詳細</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
