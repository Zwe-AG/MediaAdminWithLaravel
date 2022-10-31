@extends('admin.layouts.master')

@section('content')
<div class="col-8 offset-3 mt-5">
    <div class="col-md-9">
      <div class="card">
        <div class="card-header p-2">
          <legend class="text-center">Admin Profile</legend>
        </div>
        <div class="card-body">
          <div class="tab-content">
            @if (session('updateAdminProfileSuccess'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Hey Bro!!!</strong> {{ session('updateAdminProfileSuccess') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
            <div class="active tab-pane" id="activity">
              <form class="form-horizontal" action="{{ route('admin#profileupdate') }}" method="POST">
                @csrf
                <div class="form-group row">
                  <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" name="adminName" class="form-control" id="inputName" placeholder="Name" value="{{ old('adminName',$userInfo->name) }}">
                    @error('adminName')
                    <div class="text-danger ms-5">{{ $message }}</div>
                @enderror
                </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input type="email" name="adminEmail" class="form-control" id="inputEmail" placeholder="Email" value="{{ old('adminEmail',$userInfo->email) }}">
                    @error('adminEmail')
                    <div class="text-danger">{{ $message }}</div>
                   @enderror
                </div>
                </div>
                <div class="form-group row">
                    <label for="inputPhone" class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-10">
                      <input type="number" name="adminPhone" class="form-control" id="inputPhone" placeholder="Phone" value="{{ $userInfo->phone }}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputAddress" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                      <textarea name="adminAddress" id="inputAddress" cols="30" rows="5" class="form-control" id="inputAddress" placeholder="Address">{{  $userInfo->address  }}</textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputGender" class="col-sm-2 col-form-label">Gender</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="adminGender">
                        <option value="empty">Choose Gender</option>
                        <option value="male" @if($userInfo->gender == 'male') selected @endif>Male</option>
                        <option value="female" @if($userInfo->gender == 'female') selected @endif>Female</option>
                      </select>
                    </div>
                  </div>

                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
                    <a href="{{ route('admin#changepasswordpage') }}">Change Password</a>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn bg-dark text-white">Update</button>
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
