@extends('layout')
@section('container')
<div class="content">

    <div class="m-2">
        <section style="background-color: #f8f9fa;">
    <div class="container py-2">
        
        <!-- Header & Breadcrumb / Update Link -->
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="bg-white rounded-3 shadow-sm p-3 mb-4 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-muted">User Profile Overview</h5>
                    <a href="{{route('EditProfile',$data->id)}}" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-pencil-square me-1"></i> Update Profile
                    </a>
                </nav>
            </div>
        </div>

        <div class="row">
            <!-- Left Column: Avatar Card -->
            <div class="col-lg-4 mb-4 mb-lg-0">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <img src="{{asset('/storage/user/'.$data->image)}}" alt="avatar"
                            class="rounded-circle img-fluid shadow-sm mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                        <h5 class="mb-0 mt-2">{{$data->name}}</h5>
                        <p class="text-muted mb-0">{{$data->email}}</p>
                        <!-- Add a button if needed -->
                        <!-- <button type="button" class="btn btn-outline-primary btn-sm mt-3">Follow</button> -->
                    </div>
                </div>
            </div>
            
            <!-- Right Column: Details Card -->
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4 h-100">
                    <div class="card-header bg-light border-bottom">
                        <h6 class="mb-0 text-dark">Personal Information</h6>
                    </div>
                    <div class="card-body">
                        
                        <!-- Full Name Row -->
                        <div class="row py-2">
                            <div class="col-sm-3">
                                <p class="mb-0 text-muted">Full Name</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="mb-0 fw-bold text-dark">{{$data->name}}</p>
                            </div>
                        </div>
                        <hr class="my-0">
                        
                        <!-- Email Row -->
                        <div class="row py-2">
                            <div class="col-sm-3">
                                <p class="mb-0 text-muted">Email Address</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="mb-0 fw-bold text-dark">{{$data->email}}</p>
                            </div>
                        </div>
                        <hr class="my-0">
                        
                        <!-- Phone Row -->
                        <div class="row py-2">
                            <div class="col-sm-3">
                                <p class="mb-0 text-muted">Phone Number</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="mb-0 fw-bold text-dark">{{$data->phone}}</p>
                            </div>
                        </div>
                        
                        <!-- Add more fields here (Address, Gender, Country) -->
                        <!-- Example: -->
                         <hr class="my-0">
                    


                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    </div>
</div>

@endsection