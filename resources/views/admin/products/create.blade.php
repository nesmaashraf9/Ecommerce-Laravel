<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="/public">
    @include('admin.css')
    <style>
      .product-form {
        max-width: 800px;
        margin: 30px auto;
        padding: 30px;
        background: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
      }
      .form-group {
        margin-bottom: 1.5rem;
      }
    </style>
  </head>
  <body>
    <div class="container-scroller">
      @include('admin.sidebar')
      <div class="container-fluid page-body-wrapper">
        @include('admin.header')
        <div class="main-panel">
          <div class="content-wrapper">
            @if(session()->has('message'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif

            @if(session()->has('error'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session()->get('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif

            <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add New Product</h4>
                    <form class="forms-sample" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" required>
                      </div>
                      <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description" rows="3" required></textarea>
                      </div>
                      <div class="form-group">
                        <label>Category</label>
                        <select class="form-control" name="category" required>
                          @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" class="form-control" name="quantity" required>
                      </div>
                      <div class="form-group">
                        <label>Price</label>
                        <input type="number" step="0.01" class="form-control" name="price" required>
                      </div>
                      <div class="form-group">
                        <label>Discount Price (Optional)</label>
                        <input type="number" step="0.01" class="form-control" name="discount_price">
                      </div>
                      <div class="form-group">
                        <label>Image</label>
                        <input type="file" class="form-control" name="image" required>
                      </div>
                      <button type="submit" class="btn btn-primary mr-2">Submit</button>
                      <a href="{{ route('products.index') }}" class="btn btn-light">Cancel</a>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @include('admin.script')
  </body>
</html>