<!--24一般社員一覧-->
@extends('layouts.layout')

@section('content')
<div class="container">
<div class="text-center mb-3"><h2>一般社員一覧</h2></div>
<div class="search-box mb-3">
    <form action="{{ route('employee_list.search') }}" method="GET">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="店舗IDor名前を入力" name="keyword" value="{{ request('keyword') }}">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">検索</button>
            </div>
        </div>
    </form>
</div>
    <div class="button-group">
        <a href="{{ route('employees.create') }}" class="btn btn-primary">社員登録</a>
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
                    <td>
                        <form action="{{ route('employees.delete', $employee->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link">削除</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="scroll-to-top">
    <a id="scroll-to-top-link" href="#" onclick="scrollToTop();">TOP</a>
</div>

<style>
    .scroll-to-top {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 1000;
    }

    #scroll-to-top-link {
        display: none;
        padding: 10px 20px;
        background-color: rgba(0, 123, 255, 0.7);;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
    }

    #scroll-to-top-link:hover {
        background-color: #0056b3;
    }
</style>

<script>
    function scrollToTop() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    window.addEventListener('scroll', function() {
        var scrollButton = document.getElementById('scroll-to-top-link');
        if (window.scrollY > 100) {
            scrollButton.style.display = 'block';
        } else {
            scrollButton.style.display = 'none';
        }
    });
</script>

@endsection
