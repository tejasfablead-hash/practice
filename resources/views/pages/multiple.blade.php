@extends('layout')
@section('container')
<style>

</style>
<div class="content">
    <div class="m-3">

        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="bg-white rounded-3 shadow-sm p-3 mb-4 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-muted">Multiple Add Form Overview</h5>
                    <a href="{{route('view')}}" class="btn btn-outline-secondary btn-sm">
                        Back
                    </a>
                </nav>
            </div>
        </div>
        <div class="container mt-3">
            <div id="message" class="text-success"></div>
            <div class="row justify-content-center">
                <div class="col-md-12 border p-4 shadow-sm rounded bg-white">
                    <h3 class="mb-4 ">Add Data</h3>

                    <!-- Success Message Alert -->

                    <form id="submitform" enctype="multipart/form-data">
                        @csrf
                        <!-- Basic Input -->
                        <div id="first" >
                            <div class="row field_wrapper">
                                <div class="col-6 mb-3">
                                    <label class="form-label">First Name</label>
                                    <input type="text" name="fname" id="fname" class="form-control">
                                    <span class="text-danger small error" id="name_error"></span>
                                </div>
                                <!-- Email Input -->
                                <div class="col-6 mb-3">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" name="lname" class="form-control">
                                    <span class="text-danger small error" id="email_error"></span>
                                </div>
                            </div>
                            <div class="row field_wrapper">
                                <div class="col-6 mb-3">
                                    <label class="form-label">DOB</label>
                                    <input type="date" name="dob" class="form-control">
                                    <span class="text-danger small error" id="dob_error"></span>
                                </div>
                                <!-- Email Input -->
                                <div class="col-6 mb-3">
                                    <label class="form-label">Phone</label>
                                    <input type="text" name="phone" class="form-control">
                                    <span class="text-danger small error" id="phone_error"></span>
                                </div>
                            </div>
                        </div>
                        <div id="second" class="d-none">
                            <div class="row field_wrapper">
                                <div class="col-6 mb-3">
                                    <label class="form-label">Country</label>
                                    <input type="text" name="country" class="form-control">
                                    <span class="text-danger small error" id="name_error"></span>
                                </div>
                                <!-- Email Input -->
                                <div class="col-6 mb-3">
                                    <label class="form-label">State</label>
                                    <input type="text" name="state" class="form-control">
                                    <span class="text-danger small error" id="state_error"></span>
                                </div>
                            </div>
                            <div class="row field_wrapper">
                                <div class="col-6 mb-3">
                                    <label class="form-label">City</label>
                                    <input type="text" name="city" class="form-control">
                                    <span class="text-danger small error" id="city_error"></span>
                                </div>
                                <!-- Email Input -->
                                <div class="col-6 mb-3">
                                    <label class="form-label">PinCode</label>
                                    <input type="text" name="pincode" class="form-control">
                                    <span class="text-danger small error" id="pincode_error"></span>
                                </div>
                            </div>
                        </div>
                        <div id="third" class="d-none">
                            <div class="row field_wrapper">
                                <div class="col-6 mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control">
                                    <span class="text-danger small error" id="email_error"></span>
                                </div>
                                <!-- Email Input -->
                                <div class="col-6 mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control">
                                    <span class="text-danger small error" id="password_error"></span>
                                </div>
                            </div>
                            <div class="row field_wrapper">
                                <div class="col-6 mb-3">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" name="password-coonfirmation" class="form-control">
                                    <span class="text-danger small error" id="password_error"></span>
                                </div>
                                <!-- Email Input -->
                                <div class="col-6 mb-3">
                                    <label class="form-label">PinCode</label>
                                    <input type="text" name="pincode" class="form-control">
                                    <span class="text-danger small error" id="pincode_error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <button type="button" class="btn btn-primary" id="next-form">Next</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {

           
            $('#next-form').on('click', function(e) {
                    if(isEmpty('#fname')){ 
                        // only alert selected file names
                        alert("these files already exist:"); 
                        }

                    $('#first').addClass('d-none');
                    $('#second').removeClass('d-none');
                });
        });
    </script>


    @endsection