
@extends('layouts.admin.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Product</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Product Details</h3>
                <div align="right">
                    <a class="btn btn-primary btn-sm" href="{{route('products.create')}}">Add Product</a>
                </div>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Created By</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                 <tbody>
                    @foreach ($product as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td> 
                                <img src="{{ asset('products/'. $item->image) }}" style="width:100px" class="img-fluid" alt="Image">
                            </td>
                            <td>
                                @php
                                    $text = $item->name;
                                    $maxLength = 80; 
                                    $isLongText = strlen($text) > $maxLength; 
                                @endphp
                                @if ($isLongText)
                                    <!-- Show preview text -->
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
                            
                            <td>{{$item->user->name}}</td>
                            <td>
                                <a href="{{ route('admin.products.edit', $item->id) }}" class="btn btn-warning">Edit</a>

                                <form action="{{ route('admin.products.destroy', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                 </tbody>
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection