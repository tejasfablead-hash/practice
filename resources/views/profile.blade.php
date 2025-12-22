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
                        </nav>
                    </div>
                </div>

                <div class="container py-5">
                    <div class="row g-4">
                        <!-- Sidebar: User Quick Profile -->
                        <div class="col-lg-4">
                            <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 1.25rem;">
                                <!-- Decorative Top Banner -->
                                <div class="bg-primary" style="height: 100px; background: linear-gradient(45deg, #4e73df 0%, #224abe 100%);"></div>

                                <div class="card-body text-center pt-0">
                                    <div class="mt-n5 position-relative">
                                        <img src="{{asset('/storage/user/'.$data->image)}}"
                                            alt="avatar"
                                            class="rounded-circle img-fluid border border-4 border-white shadow-sm"
                                            style="width: 120px; height: 120px; object-fit: cover; margin-top: -60px;">
                                    </div>

                                    <h5 class="mt-3 mb-1 text-capitalize fw-bold">{{$data->name}}</h5>
                                    <p class="text-muted small mb-4">
                                        <i class="bi bi-geo-alt-fill me-1"></i> Registered User
                                    </p>

                                    <div class="d-flex justify-content-center gap-2 mb-4">
                                        <a href="#" class="btn btn-light btn-sm rounded-pill px-3 border shadow-sm">
                                            <i class="bi bi-envelope me-1"></i> Message
                                        </a>
                                        <a href="{{route('EditProfile',$data->id)}}"><button class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm">
                                                <i class="bi bi-pencil me-1"></i> Edit Profile
                                            </button></a>
                                    </div>

                                    <div class="border-top pt-3 mt-3">
                                        <div class="row">
                                            <div class="col-6 border-end">
                                                <h6 class="mb-0 fw-bold">Joined</h6>
                                                <span class="text-muted small">{{ $data->created_at->format('M Y') }}</span>
                                            </div>
                                            <div class="col-6">
                                                <h6 class="mb-0 fw-bold">Status</h6>
                                                <span class="badge bg-success-soft text-success rounded-pill">Active</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Main Content: Detailed Info -->
                        <div class="col-lg-8">
                            <div class="card border-0 shadow-sm" style="border-radius: 1.25rem;">
                                <div class="card-header bg-white py-3 border-0 mt-2">
                                    <div class="d-flex align-items-center">
                                        <div class="icon-shape bg-primary-soft text-primary rounded-3 me-3 p-2">
                                            <i class="bi bi-person-lines-fill fs-4"></i>
                                        </div>
                                        <h5 class="mb-0 fw-bold">Account Overview</h5>
                                    </div>
                                </div>

                                <div class="card-body px-4 pb-4">
                                    <div class="row g-4">
                                        <!-- Full Name -->
                                        <div class="col-md-6">
                                            <div class="p-3 border rounded-3 bg-light-subtle">
                                                <label class="text-muted small text-uppercase fw-bold mb-1 d-block">Full Name</label>
                                                <span class="text-dark text-capitalize fw-semibold fs-6">{{$data->name}}</span>
                                            </div>
                                        </div>

                                        <!-- Email Address -->
                                        <div class="col-md-6">
                                            <div class="p-3 border rounded-3 bg-light-subtle">
                                                <label class="text-muted small text-uppercase fw-bold mb-1 d-block">Email Address</label>
                                                <span class="text-dark fw-semibold fs-6">{{$data->email}}</span>
                                            </div>
                                        </div>

                                        <!-- Phone Number -->
                                        <div class="col-md-6">
                                            <div class="p-3 border rounded-3 bg-light-subtle">
                                                <label class="text-muted small text-uppercase fw-bold mb-1 d-block">Phone Number</label>
                                                <span class="text-dark fw-semibold fs-6">{{$data->phone ?? 'Not Provided'}}</span>
                                            </div>
                                        </div>

                                        <!-- Location/Country (Placeholder) -->
                                        <div class="col-md-6">
                                            <div class="p-3 border rounded-3 bg-light-subtle">
                                                <label class="text-muted small text-uppercase fw-bold mb-1 d-block">Location</label>
                                                <span class="text-dark text-capitalize fw-semibold fs-6">India</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Security Alert Section -->
                                    <div class="mt-5 p-3 rounded-3 border-start border-4 border-warning bg-warning-soft">
                                        <div class="d-flex">
                                            <i class="bi bi-shield-lock-fill text-warning fs-4 me-3"></i>
                                            <div>
                                                <h6 class="mb-1 fw-bold">Privacy Tip</h6>
                                                <p class="mb-0 small text-muted">Keep your phone number and email updated to ensure account recovery works correctly.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

@endsection