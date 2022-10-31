@extends('admin.layouts.master')

@section('content')
<div class="col-4 mt-5">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin#postupdate',$editPosts['post_id']) }}" method="post" enctype="multipart/form-data">
                @csrf
                <label>Post Title</label>
                <input type="text" name="postTitle" class="form-control" value="{{ old('postTitle',$editPosts['title']) }}">
                @error('postTitle')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <label class="mt-3">Description</label>
                <textarea name="PostDescription" cols="30" rows="5" class="form-control">{{ old('PostDescription',$editPosts['description']) }}</textarea>
                @error('PostDescription')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <label class="mt-3">Post Image</label> <br>
                @if ($editPosts['image'] != NULL)
                <img src="{{ asset('postImage/'.$editPosts['image']) }}" width="200px" >
                @else
                <img src="{{ asset('default.png') }}" width="200px">
                @endif
                <input type="file" name="postImage" class="form-control mt-2">
                <br>
                <label class="mt-3">Post Category</label>
                <select name="postCategory" class="form-control">
                    <option value="">Choose Category</option>
                    @foreach ($category as $item)
                        <option value="{{ $item['category_id'] }}" @if($item['category_id'] == $editPosts['category_id']) selected @endif>{{ $item['title'] }}</option>
                    @endforeach
                </select>
                @error('postCategory')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="d-grid mt-3 mb-2">
                    <button type="submit" class="btn btn-danger">Update Post</button>
                </div>
                <a href="{{ route('admin#post') }}" class="text-secondary" style="margin:0 130px">Go To Create <i class="fa-solid fa-arrow-right ms-1 mt-2"></i> </a>
            </form>
        </div>
    </div>
</div>
<div class="col-8 mt-5">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Category</h3>
        <div class="card-tools">
        <form action="" method="post">
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
              <th>Image</th>
              <th>Title</th>
              <th>Descriptiom</th>
              <th>Category ID</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($posts as $post)
            <tr>
                <td>{{ $post['post_id'] }}</td>
                <td>
                    @if ($post['image'] != NULL)
                    <img src="{{ asset('postImage/'.$post['image']) }}" width="100px" class="img-thumbnail">
                    @else
                    <img src="{{ asset('default.png') }}" width="100px" class="img-thumbnail">
                    @endif
                </td>
                <td>{{ $post['title'] }}</td>
                <td>{{ Str::words($post['description'], 3, '...') }}</td>
                <td>{{ $post['category_id'] }}</td>
                <td>
                  <a href="{{ route('admin#posteditpage',$post['post_id']) }}">
                    <i class="fas fa-edit text-dark mr-2"></i>
                  </a>
                  <a href="{{ route('admin#postdelete',$post['post_id']) }}">
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
