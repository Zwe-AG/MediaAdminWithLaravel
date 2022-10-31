@extends('admin.layouts.master')

@section('content')
<!-- MAIN CONTENT-->
<div class="main-content mt-5">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-lg-6 offset-3">
                <div class="card" style="width: 600px;">
                    <div class="card-header">
                        <div class="card-title">
                            <i class="fa-solid fa-arrow-left text-dark" style="font-size:23px;margin-right:180px" onclick="history.back()"></i>
                            <span class="fs-5">Post Details</span>
                        </div>
                    </div>
                    <div>
                         @if ($posts['image'] == null)
                            <img src="{{ asset('default.png') }}" alt="">
                         @else
                            <img src="{{ asset('postImage/'.$posts['image']) }}" width="100%">
                         @endif
                    </div>
                    <div class="card-body">
                      <h4 class="card-title fs-4">Description</h4>
                      <p class="card-text">{{ Str::words($posts['description'], 20 , '...') }}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">Title - {{ $posts['title'] }}</li>
                      <li class="list-group-item">Date - {{ date('j-F-Y',strtotime($posts['created_at'])) }}</li>
                    </ul>
                  </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection
