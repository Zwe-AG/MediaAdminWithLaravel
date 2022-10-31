@extends('admin.layouts.master')

@section('content')
<div class="col-4 mt-5">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin#categorycreate') }}" method="post">
                @csrf
                <label>Category Title</label>
                <input type="text" name="categoryTitle" class="form-control">
                @error('categoryTitle')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <label class="mt-3">Description</label>
                <textarea name="categoryDescription" cols="30" rows="5" class="form-control"></textarea>
                @error('categoryDescription')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="d-grid mt-3">
                    <button type="submit" class="btn btn-danger">Create Category</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-8 mt-5">
         @if (session('deleteSuccess'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('deleteSuccess') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Category</h3>
        <div class="card-tools">
        <form action="{{ route('admin#categorylistsearch') }}" method="post">
            @csrf
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="Searchkey" class="form-control float-right" placeholder="Search">
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
        </form>
        </div>
      </div>
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap text-center">
          <thead>
            <tr>
              <th>ID</th>
              <th>Category Title</th>
              <th>Category Descriptiom</th>
              <th>Date</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($categories as $category)
            <tr>
                <td>{{ $category['category_id'] }}</td>
                <td>{{ $category['title'] }}</td>
                <td>{{ Str::words($category['description'], 5, '...') }}</td>
                <td>{{ date('d/m/Y',strtotime($category['created_at'])) }}</td>
                <td>
                  <a href="{{ route('admin#categoryeditpage',$category['category_id']) }}">
                    <i class="fas fa-edit text-dark mr-2"></i>
                  </a>
                  <a href="{{ route('admin#categorydelete',$category['category_id']) }}">
                    <i class="fas fa-trash-alt text-dark"></i>
                  </a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
