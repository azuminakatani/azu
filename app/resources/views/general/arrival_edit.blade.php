<!--12入荷予定詳細-->
@extends('layouts.layout')

@section('content')
<div class="container">
<div class="row justify-content-center mt-5">
<div class="text-center mb-3"><h2>入荷詳細</h2></div>
            <div class="text-center mb-3"><strong>商品名:</strong> {{ $incomingShipment->product->name }}</div>  
            <div class="text-center mb-3"><strong>入荷予定日:</strong> {{ $incomingShipment->scheduled_date }}</div>
            <div class="text-center mb-3"><strong>数量:</strong> {{ $incomingShipment->quantity }}</div>
            <div class="text-center mb-3"><strong>重量:</strong> {{ $incomingShipment->weight }}</div>    
        <div class="text-center">
            <a href="{{ route('arrival_edit', $incomingShipment->id) }}" class="btn btn-primary">編集</a>
                <form action="{{ route('arrival_delete', $incomingShipment->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('この入荷予定を削除してもよろしいですか？')">削除</button>
                </form>
            <a href="{{ route('arrival_list') }}" class="btn btn-secondary">戻る</a>
        </div>
    </div>
</div>
@endsection

