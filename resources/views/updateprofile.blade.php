@extends('layout')
@section('container')
<div class="content">

    <div class="m-5">
        <section style="background-color: #f8f9fa;">
            <div class="container py-2">

                <!-- Breadcrumb Row -->
                <div class="row">
                    <div class="col">
                        <nav aria-label="breadcrumb" class="bg-white rounded-3 shadow-sm p-3 mb-4">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{route('Profile')}}" class="text-decoration-none">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Update Profile</li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <!-- Message Alert -->
                <div id="message" class="text text-success mb-4 "></div>





                <div class="row">
                    <!-- Left Side: Current Image Card -->
                    <div class="col-lg-4">
                        <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 1.25rem;">
                            <!-- Decorative Top Banner -->
                            <div class="bg-primary" style="height: 100px; background: linear-gradient(45deg, #4e73df 0%, #224abe 100%);"></div>

                            <div class="card-body text-center pt-0">
                                <div class="mt-n5 position-relative">
                                    <img src="{{asset('/storage/user/'.$single->image)}}"
                                        alt="avatar"
                                        class="rounded-circle img-fluid border border-4 border-white shadow-sm"
                                        style="width: 120px; height: 120px; object-fit: cover; margin-top: -60px;">
                                </div>

                                <h5 class="mt-3 mb-1 text-capitalize fw-bold">{{$single->name}}</h5>
                                <p class="text-muted small mb-4">
                                    <i class="bi bi-geo-alt-fill me-1"></i> Registered User
                                </p>

                                <div class="border-top pt-3 mt-3">
                                    <div class="row">
                                        <div class="col-6 border-end">
                                            <h6 class="mb-0 fw-bold">Joined</h6>
                                            <span class="text-muted small">{{ $single->created_at->format('M Y') }}</span>
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

                    <!-- Right Side: Edit Form Card -->
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

                            <form id="updateform" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" id="id" value="{{$single->id}}">
                                <div class="card-body px-4 pb-4">
                                    <div class="row g-4">
                                        <!-- Full Name -->
                                        <div class="col-md-6">
                                            <div class="p-3 border rounded-3 bg-light-subtle">
                                                <label class="text-muted small text-uppercase fw-bold mb-1 d-block">Full Name</label>
                                                <input type="text" name="name" value="{{$single->name}}" class="form-control" placeholder="Enter name">
                                                <span class="error text-danger small" id="name_error"></span>
                                            </div>
                                        </div>

                                        <!-- Email Address -->
                                        <div class="col-md-6">
                                            <div class="p-3 border rounded-3 bg-light-subtle">
                                                <label class="text-muted small text-uppercase fw-bold mb-1 d-block">Email Address</label>
                                                <input type="email" name="email" value="{{$single->email}}" class="form-control" placeholder="example@mail.com">
                                                <span class="error text-danger small" id="email_error"></span>
                                            </div>
                                        </div>

                                        <!-- Phone Number -->
                                        <div class="col-md-6">
                                            <div class="p-3 border rounded-3 bg-light-subtle">
                                                <label class="text-muted small text-uppercase fw-bold mb-1 d-block">Phone Number</label>
                                                <input type="text" name="phone" value="{{$single->phone}}" class="form-control" placeholder="example@mail.com">
                                                <span class="error text-danger small" id="phone_error"></span>
                                            </div>
                                        </div>

                                        <!-- Location/Country (Placeholder) -->
                                        <div class="col-md-6">
                                            <div class="p-3 border rounded-3 bg-light-subtle">
                                                <label class="text-muted small text-uppercase fw-bold mb-1 d-block">Image</label>
                                                <div class="col-sm-12">
                                                    <input type="file" name="image" class="form-control">
                                                    <span class="error text-danger small" id="image_error"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary px-4 py-2 shadow-sm">
                                        Update
                                    </button>
                                </div>
                        </div>
                        </form>


                    </div>
                </div>
            </div>
        </section>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.7.1.js" crossorigin="anonymous"></script>
<script src="{{ asset('ajax.js') }}"></script>
<script>
    $(document).ready(function() {


        $('#updateform').submit(function(e) {

            e.preventDefault();
            var Data = $('#updateform')[0];
            var formData = new FormData(Data);
            $('._error').text();
            var url = "{{ route('UpdateProfile') }}";

            makeAjaxRequest(url, 'POST', formData, function(response) {
                    console.log(response);
                    $('#message').html(response.message);
                    $('.error').hide();
                    setTimeout(function() {
                        window.location.href = "/profile";
                    }, 2000);

                },
                function(error) {
                    console.log('error : ', error);
                }
            );

        });
    });
</script>

@endsection