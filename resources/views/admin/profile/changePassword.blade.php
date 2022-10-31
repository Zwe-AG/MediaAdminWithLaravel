@extends('admin.layouts.master')

@section('content')
<div class="col-8 offset-3 mt-5">
    <div class="col-md-9">
      <div class="card">
        <div class="card-header p-2">
          <legend class="text-center">Change Password</legend>
        </div>
        <div class="card-body">
          <div class="tab-content">
            @if (session('updatePasswordSuccess'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('updatePasswordSuccess') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
            <div class="active tab-pane" id="activity">
              <form class="form-horizontal" action="{{ route('admin#changepassword') }}" method="POST" >
                @csrf
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Old Password</label>
                  <div class="col-sm-9">
                    <input type="password" name="oldPassword" class="form-control" placeholder="Old Password">
                    @error('oldPassword')
                    <div class="text-danger">{{ $message }}</div>
                   @enderror
                </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">New Password</label>
                    <div class="col-sm-9">
                      <input type="password" name="newPassword" class="form-control"  placeholder="New Password">
                      @error('newPassword')
                      <div class="text-danger">{{ $message }}</div>
                     @enderror
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Confirm Password</label>
                    <div class="col-sm-9">
                      <input type="password" name="confirmPassword" class="form-control"  placeholder="Confirm Password">
                      @error('confirmPassword')
                      <div class="text-danger">{{ $message }}</div>
                     @enderror
                    </div>
                  </div>
                <div class="form-group row">
                  <div class="offset-sm-10 col-sm-2">
                    <button type="submit" class="btn bg-dark text-white">Change</button>
                  </div>
                </div>
              </form>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
