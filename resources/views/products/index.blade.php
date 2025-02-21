<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Product') }}
            </h2>
            @if (auth()->user()->hasRole('customer') || auth()->user()->hasRole('admin'))
                @php
                    $user = auth()->user();
                @endphp

                @if ($user->store_name === null)
                    <!-- Display an alert to the user -->
                    <div class="alert alert-warning">
                        <strong>Warning:</strong> Please fill in your store details first before you can add a product.
                    </div>
                    <div>
                        <a href="{{ route('store.index') }}" class="bg-yellow-500 text-white py-2 px-4 rounded hover:bg-yellow-600">
                            Fill Store Details
                        </a>
                    </div>
                @else
                    <!-- If store name is not null, show the Add Product button -->
                    <div>
                        <a href="{{ route('product.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                            Add Product
                        </a>
                    </div>
                @endif
            @endif

        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="card-body">
                        @if (auth()->user()->hasRole('customer') || auth()->user()->hasRole('admin'))
                        <!-- Search Form -->
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <input type="text" id="productName" class="form-control" placeholder="Search by Product Name">
                            </div>
                            <div class="col-md-4">
                                <select id="categorySelect" class="form-control">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button id="searchBtn" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                        
                        <table class="example1 table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                              <th>No</th>
                              <th>Image</th>
                              <th>Name</th>
                              <th>Description</th>
                              <th>Price</th>
                              <th>Category</th>
                              <th>Store name</th>
                              <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="productTableBody">
                                @foreach ($product as $item)
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
                            </tbody>
                        </table>
                        
                        <!-- Add AJAX script here -->
                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script>
                            $(document).ready(function () {
                                // Event listener for the search button
                                $('#searchBtn').click(function () {
                                    var productName = $('#productName').val();
                                    var categoryId = $('#categorySelect').val();
                        
                                    // Perform AJAX request
                                    $.ajax({
                                        url: "{{ route('product.search') }}", // Define your search route
                                        method: 'GET',
                                        data: {
                                            productName: productName,
                                            categoryId: categoryId
                                        },
                                        success: function(response) {
                                            // Clear the current table body
                                            $('#productTableBody').html(response);
                        
                                            // Optional: Handle any success actions or notifications
                                        },
                                        error: function(xhr, status, error) {
                                            console.error("Error during AJAX request:", error);
                                        }
                                    });
                                });
                            });
                        </script>
                        
                        @else
                           Welcome
                        @endif
                    
                        
                      </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<!-- Add Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script>
     $(function () {
    $("#example1").DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
     
    });
 
  });
</script>