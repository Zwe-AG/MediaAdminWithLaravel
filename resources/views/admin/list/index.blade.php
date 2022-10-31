@extends('admin.layouts.master')

@section('content')
<div class="col-12 mt-5">
    <div class="col-5">
        @if (session('deleteSuccess'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('deleteSuccess') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
    </div>
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Admin List</h3>
        <div class="card-tools">
          <form action="{{ route('admin#listsearch') }}" method="POST">
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
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Address</th>
              <th>Gender</th>
              <th>Date</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($userData as $user)
            <tr>
                <td>{{ $user['id'] }}</td>
                <td>{{ $user['name'] }}</td>
                <td>{{ $user['email'] }}</td>
                <td>{{ $user['phone'] }}</td>
                <td>{{ $user['address'] }}</td>
                <td>{{ $user['gender'] }}</td>
                <td>{{ date('d/m/Y',strtotime($user['created_at'])) }}</td>
                <td>
                    @if ($user['id'] == Auth::user()->id)

                    @else
                    <a href="{{ route('admin#delete',$user['id']) }}">
                        <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button>
                    </a>
                    @endif
                    {{-- <a @if(count($userData) == 1 ) href="#" @else href="{{ route('admin#delete',$user['id']) }}" @endif>
                        <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button>
                    </a> --}}
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
