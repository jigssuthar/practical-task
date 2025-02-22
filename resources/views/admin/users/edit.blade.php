
@extends('layouts.admin.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Update User #{{$User->id}}</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">User</li>
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
              <h3 class="card-title">Update User</h3>
      
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
                <form action="{{ route('admin.user.update', $User->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Name:</label>
                      <input type="text" class="form-control" value="{{$User->name}}" name="name" placeholder="Enter user name" required>
                    </div>
      
                    <div class="form-group">
                      <label>Email:</label>
                      <input type="email" name="email" value="{{$User->email}}" id="email"  class="form-control" placeholder="Enter email" required>
                    </div>
                  </div>
                  <!-- /.col -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputFile">Profile Image</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" name="profile_pic" class="custom-file-input" id="exampleInputFile" >
                          <img src="{{ asset('profile/'. $User->profile_pic) }}" alt="Product Image" style="width:100px;">

                          <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                      </div>
                    </div>
      
                    
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-12">
                      <div class="form-group">
                        <label>Store name:</label>
                      <input type="text" class="form-control" value="{{$User->store_name}}" name="store_name" placeholder="Enter store name" required>
                      </div>
                    </div>
                  </div>
      
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label>Description:</label>
                      <textarea class="form-control" id="" name="store_description">{{$User->store_description}}</textarea>
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