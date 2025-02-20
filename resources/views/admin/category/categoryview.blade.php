
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
                      <button class="text-right btn btn-primary btn-sm" onclick="openAddModal()">Add Category</button>
                    
                </div>
                <div id="categoryList">
                </div>
                <div class="modal fade" id="categoryModal" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close ml-auto" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" id="modalTitle">Add Category</h4>
                            </div>
                            <div class="modal-body">
                                <form id="categoryForm">
                                    <div class="form-group">
                                        <label for="categoryName text-left" >Category Name</label>
                                        <input type="text" class="form-control" id="categoryName" placeholder="Enter category name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="categoryDescription">Category Description</label>
                                        <textarea class="form-control" id="categoryDescription" rows="3" placeholder="Enter category description" required></textarea>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" form="categoryForm" id="saveCategoryBtn" class="btn btn-primary">Save Category</button>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                 <tbody>
                    @foreach ($categories as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->description}}</td>
                            <td>{{$item->status}}</td>
                            <td>
                              <button class="btn btn-primary" onclick="openEditModal({{ $item->id }}, '{{ $item->name }}', '{{ $item->description }}')">Edit</button>

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
  
  <script>
    let currentCategoryId = null;
    function openAddModal() {
        $('#categoryForm')[0].reset();
        $('#modalTitle').text('Add Category');
        $('#saveCategoryBtn').text('Save Category').off('click').on('click', saveCategory);
        currentCategoryId = null; // No category selected for editing
        $('#categoryModal').modal('show');
    }
    function openEditModal(categoryId, categoryName, categoryDescription) {
        $('#categoryName').val(categoryName);
        $('#categoryDescription').val(categoryDescription);
        $('#modalTitle').text('Edit Category');
        $('#saveCategoryBtn').text('Update Category').off('click').on('click', function () {
            updateCategory(categoryId);
        });
        currentCategoryId = categoryId;
        $('#categoryModal').modal('show');
    }
    function saveCategory() {
        const categoryName = $('#categoryName').val();
        const categoryDescription = $('#categoryDescription').val();

        $.ajax({
            url: '{{ route("categories.store") }}',
            method: 'POST',
            data: {
                name: categoryName,
                description: categoryDescription,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                console.log('Category added:', response);
                $('#categoryModal').modal('hide');
                // Reload or update your category list (if applicable)
            },
            error: function(error) {
                console.error('Error adding category:', error);
            }
        });
    }
    function updateCategory(categoryId) {
        const categoryName = $('#categoryName').val();
        const categoryDescription = $('#categoryDescription').val();

        $.ajax({
            url: `/categories/${categoryId}`,
            method: 'PUT',
            data: {
                name: categoryName,
                description: categoryDescription,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                console.log('Category updated:', response);
                $('#categoryModal').modal('hide');
                // Reload or update your category list (if applicable)
            },
            error: function(error) {
                console.error('Error updating category:', error);
            }
        });
    }
</script>
  
@endsection
