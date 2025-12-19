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
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-white py-3">
                                <h6 class="mb-0 fw-bold">Profile Picture</h6>
                            </div>
                            <div class="card-body text-center">
                                <img src="{{asset('/storage/user/'.$single->image)}}"
                                    alt="avatar"
                                    class="rounded-circle img-fluid shadow-sm mb-3"
                                    style="width: 150px; height: 150px; object-fit: cover; border: 3px solid #eee;">
                                <p class="text-muted small">Current Avatar</p>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side: Edit Form Card -->
                    <div class="col-lg-8">
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-white py-3">
                                <h6 class="mb-0 fw-bold">Account Settings</h6>
                            </div>
                            <div class="card-body p-4">
                                <form id="updateform" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" id="id" value="{{$single->id}}">

                                    <!-- Name Row -->
                                    <div class="row mb-3 align-items-center">
                                        <label class="col-sm-3 col-form-label fw-bold text-secondary">Full Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="name" value="{{$single->name}}" class="form-control" placeholder="Enter name">
                                            <span class="error text-danger small" id="name_error"></span>
                                        </div>
                                    </div>

                                    <hr class="text-light">

                                    <!-- Email Row -->
                                    <div class="row mb-3 align-items-center">
                                        <label class="col-sm-3 col-form-label fw-bold text-secondary">Email</label>
                                        <div class="col-sm-9">
                                            <input type="email" name="email" value="{{$single->email}}" class="form-control" placeholder="example@mail.com">
                                            <span class="error text-danger small" id="email_error"></span>
                                        </div>
                                    </div>

                                    <hr class="text-light">

                                    <!-- Phone Row -->
                                    <div class="row mb-3 align-items-center">
                                        <label class="col-sm-3 col-form-label fw-bold text-secondary">Phone</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="phone" value="{{$single->phone}}" class="form-control" placeholder="Phone number">
                                            <span class="error text-danger small" id="phone_error"></span>
                                        </div>
                                    </div>

                                    <hr class="text-light">

                                    <!-- File Upload Row -->
                                    <div class="row mb-4 align-items-center">
                                        <label class="col-sm-3 col-form-label fw-bold text-secondary">Upload New Image</label>
                                        <div class="col-sm-9">
                                            <input type="file" name="image" class="form-control">
                                            <span class="error text-danger small" id="image_error"></span>
                                        </div>
                                    </div>

                                    <!-- Action Buttons Row -->
                                    <div class="row">
                                        <div class="col-sm-9 offset-sm-3">
                                            <button type="submit" class="btn btn-primary px-4 py-2 shadow-sm">
                                                Update
                                            </button>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
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
                    setTimeout(function() {
                        window.location.href = "/profile";
                    }, 2000);
                    
                },
                function(error) {
                    console.log('error : ', error);
                }
            );

            // $.ajax({
            //     url: "{{ route('UpdateProfile') }}",
            //     method: 'POST',
            //     data: formData,
            //     contentType: false,
            //     processData: false,
            //     success: function(response) {
            //         console.log(response);
            //         $('#message').html(response.message)
            //         window.open('/profile', '__self');
            //         // view();
            //     },
            //     error: function(xhr, status, error) {
            //         console.log('error : ', error);
            //         $(".error").removeClass("text-danger").empty();
            //         if (xhr.status === 422) {
            //             $(".error").addClass("text-danger");
            //             let errors = xhr.responseJSON.errors;
            //             $.each(error, function(key, value) {
            //                 $('#' + key + '_error').text(value);
            //             });
            //         }
            //     }
            // });

        });
    });
</script>

@endsection