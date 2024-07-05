@foreach ($stocks as $stock)
<tr>
    <td>{{ $stock->product->name }}</td>
    <td>{{ $stock->quantity }}</td>
    <td>{{ $stock->weight }}</td>
    <td>
        <form action="{{ route('inventory.delete', $stock->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('本当に削除しますか？')">削除</button>
        </form>
    </td>
</tr>
@endforeach
