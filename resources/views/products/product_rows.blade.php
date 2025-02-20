@foreach ($products as $item)
    <tr>
        <td>{{$item->id}}</td>
        <td><img src="{{ asset('products/'. $item->image) }}" style="width:100px" class="img-fluid" alt="Image"></td>
        <td>
            @php
                $text = $item->name;
                $maxLength = 80;
                $isLongText = strlen($text) > $maxLength;
            @endphp
            @if ($isLongText)
                <span class="preview-text">{{ substr($text, 0, $maxLength) }}...</span>
                <span class="full-text" style="display:none;">{{ $text }}</span>
                <a href="javascript:void(0)" class="read-more">Read More</a>
            @else
                <span class="full-text">{{ $text }}</span>
            @endif
        </td>
        <td>{{$item->description}}</td>
        <td>{{$item->price}}</td>
        <td>{{ $item->category ? $item->category->name : 'No category' }}</td>
        <td>{{$item->user->store_name}}</td>
        <td>
            @if (auth()->user()->id == $item->user_id)
                <a href="{{ route('product.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('product.destroy', $item->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                </form>
            @endif
        </td>
    </tr>
@endforeach
