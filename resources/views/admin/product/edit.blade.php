
@extends('layouts.admin.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Update Product</h1>
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
          <!-- SELECT2 EXAMPLE -->
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">Update Products</h3>
      
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Product Name</label>
                      <input type="text" class="form-control" value="{{$product->name}}" name="name" placeholder="Enter Product name" required>
                    </div>
      
                    <div class="form-group">
                      <label>Product Price</label>
                      <input type="number" name="price" value="{{$product->price}}" id="price" step="0.01" class="form-control" placeholder="Enter product price" required>
                    </div>
                  </div>
                  <!-- /.col -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputFile">Product Image</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" name="image" class="custom-file-input" id="exampleInputFile" required>
                          <img src="{{ asset('products/'. $product->image) }}" alt="Product Image" style="width:100px;">

                          <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                      </div>
                    </div>
      
                    <div class="form-group">
                      <label>Category</label>
                      <select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" name="category_id" required>
                        <option selected="selected" disabled>Choose Category</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                        
                      </select>
                    </div>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
      
      
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label>Description</label>
                      <textarea class="form-control" id="" name="description">{{$product->description}}</textarea>
                    </div>
                  </div>
                </div>
      
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Add Product</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
      
    <!-- /.content -->
  </div>

@endsection