@extends('admin.layouts.master')

@section('content')
<div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title ">Trend Post - <span class="text-danger">{{ count($trendPosts) }}</span> </h3>
        <div class="card-tools">
          <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

            <div class="input-group-append">
              <button type="submit" class="btn btn-default">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap text-center">
          <thead>
            <tr>
              <th>ID</th>
              <th>Image</th>
              <th>Title</th>
              <th>Description</th>
              <th>View Count</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($trendPosts as $trendPost)
            <tr>
                <td>{{ $trendPost['post_id'] }}</td>
                <td>
                    @if ($trendPost['image'] == null)
                        <img src="{{  asset('default.png') }}" width="100px">
                    @else
                        <img src="{{  asset('postImage/'.$trendPost['image']) }}" width="100px">
                    @endif
                </td>
                <td>{{ $trendPost['title'] }}</td>
                <td>{{ Str::words($trendPost['description'], 3, '...') }}</td>
                <td> <i class="fa-solid fa-eye me-2"></i> {{ $trendPost['post_count'] }}</td>
                <td>
                  <a href="{{ route('admin#trendpostedetail',$trendPost['post_id']) }}">
                    <i class="fas fa-edit text-dark"></i>
                  </a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    {{-- {{ $trendPosts->links() }} --}}
  </div>
@endsection
