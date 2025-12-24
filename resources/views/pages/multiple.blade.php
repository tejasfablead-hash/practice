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

                </nav>
            </div>
        </div>
        <div id="message" class="text-success"></div>
        <div class="container mt-3">
            <div id="message" class="text-success"></div>
            <div class="row justify-content-center">
                <div class="col-md-12 border p-4 shadow-sm rounded bg-white">
                    <h3 class="mb-4 ">Add Data</h3>

                    <!-- Success Message Alert -->

                    <form id="submitform" enctype="multipart/form-data">
                        @csrf
                        <!-- Basic Input -->
                        <div id="first">
                            <div class="row field_wrapper">
                                <div class="col-6 mb-3">
                                    <label class="form-label">First Name</label>
                                    <input type="text" name="fname" id="fname" class="form-control">
                                    <span class="text-danger small error" id="fname_error"></span>
                                </div>
                                <!-- Email Input -->
                                <div class="col-6 mb-3">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" name="lname" id="lname" class="form-control">
                                    <span class="text-danger small error" id="lname_error"></span>
                                </div>
                            </div>
                            <div class="row field_wrapper">
                                <div class="col-6 mb-3">
                                    <label class="form-label">DOB</label>
                                    <input type="date" name="dob" id="dob" class="form-control">
                                    <span class="text-danger small error" id="dob_error"></span>
                                </div>
                                <!-- Email Input -->
                                <div class="col-6 mb-3">
                                    <label class="form-label">Phone</label>
                                    <input type="text" name="phone" id="phone" class="form-control">
                                    <span class="text-danger small error" id="phone_error"></span>
                                </div>
                            </div>
                        </div>
                        <div id="second" class="d-none">
                            <div class="row field_wrapper">
                                <div class="col-6 mb-3">
                                    <label class="form-label">Country</label>
                                    <select class="form-select" name="country" id="country">
                                        <option value="">Select...</option>
                                        @foreach($country as $item)
                                        <option value="{{$item->id}}">{{$item->country_name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger small error" id="country_error"></span>
                                </div>
                                <!-- Email Input -->
                                <div class="col-6 mb-3">
                                    <label class="form-label">State</label>
                                    <input type="text" name="state" id="state" class="form-control">
                                    <span class="text-danger small error" id="state_error"></span>
                                </div>
                            </div>
                            <div class="row field_wrapper">
                                <div class="col-6 mb-3">
                                    <label class="form-label">City</label>
                                    <select class="form-select" name="city" id="city">
                                        <option value="">Select City...</option>
                                    </select>
                                    <span class="text-danger small error" id="city_error"></span>
                                </div>
                                <!-- Email Input -->
                                <div class="col-6 mb-3">
                                    <label class="form-label">PinCode</label>
                                    <input type="text" name="pincode" id="pincode" class="form-control">
                                    <span class="text-danger small error" id="pincode_error"></span>
                                </div>
                            </div>
                        </div>
                        <div id="third" class="d-none">
                            <div class="row field_wrapper">
                                <div class="col-6 mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" id="email" class="form-control">
                                    <span class="text-danger small error" id="email_error"></span>
                                </div>
                                <!-- Email Input -->
                                <div class="col-6 mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="password" id="password" class="form-control">
                                    <span class="text-danger small error" id="password_error"></span>
                                </div>
                            </div>
                            <div class="row field_wrapper">
                                <div class="col-6 mb-3">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" name="password_confirmation" id="password-confirm" class="form-control">
                                    <span class="text-danger small error" id="password_error"></span>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10"></div>
                            <div class="col-md-2 "> <button type="button" class="btn btn-secondary d-none" id="prevBtn">Back</button>
                                <button type="button" class="btn btn-primary " id="nextBtn">Next</button>
                                <button type="submit" name="submit" class="btn btn-success d-none " id="submitBtn">Submit</button>
                            </div>
                        </div>
                    </form>

                    <div id="all-error" class="col-md-4 text-danger">

                    </div>
                </div>
            </div>
        </div>



    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="{{ asset('ajax.js') }}"></script>
    <script>
        $(document).ready(function() {

            $('#country').on('change', function() {

                var country_id = $(this).val();
                if (country_id) {
                    $.ajax({
                        url: '{{url("/getcity/")}}/' + country_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            $('#city').empty();
                            console.log('city', response);
                            $.each(response, function(key, value) {
                                $('#city').append('<option value="' + key + '">' + value + '</option>');
                            });
                        }
                    });
                } else {
                    $('#city').empty().append('<option value=" "> select city </option>');

                }
            });


            let step = 1;

            function showStep(step) {
                $('#first, #second, #third').addClass('d-none');


                if (step === 1) {
                    $('#first').removeClass('d-none');
                    $('#prevBtn').addClass('d-none');
                    $('#submitBtn').addClass('d-none');
                    $('#nextBtn').removeClass('d-none');
                }

                if (step === 2) {
                    $('#second').removeClass('d-none');
                    $('#prevBtn').removeClass('d-none');
                    $('#submitBtn').addClass('d-none');
                    $('#nextBtn').removeClass('d-none');
                }

                if (step === 3) {
                    $('#third').removeClass('d-none');
                    $('#prevBtn').removeClass('d-none');
                    $('#nextBtn').addClass('d-none');
                    $('#submitBtn').removeClass('d-none');
                }
            }


            $('#nextBtn').click(function() {

                if (step === 1 && $('#first')) {
                    if ($('#fname').val() === '') {
                        $('#fname_error').text('* First name is required');
                        return;
                    } else {
                        $('#fname_error').text('');
                    }
                } else {
                    $('#fname_error').text('');
                    $('#lname_error').text('');
                    $('#phone_error').text('');
                }
                if (step === 1 && $('#lname').val() === '') {
                    if ($('#lname').val() === '') {
                        $('#lname_error').text('* Last name is required');
                        return;
                    } else {
                        $('#lname_error').text('');
                    }
                } else {
                    $('#fname_error').text('');
                    $('#lname_error').text('');
                    $('#phone_error').text('');
                }
                if (step === 1 && $('#phone').val() === '') {
                    if ($('#phone').val() === '') {
                        $('#phone_error').text('* phone is required');
                        return;
                    } else {
                        $('#phone_error').text('');
                    }
                } else {
                    $('#fname_error').text('');
                    $('#lname_error').text('');
                    $('#phone_error').text('');
                }
                if (step === 2 && $('#second')) {
                    if ($('#country').val() === '') {
                        $('#country_error').text('* Country is required');
                        return;
                    } else {
                        $('#country_error').text('');
                    }
                } else {
                    $('#country_error').text('');
                    $('#city_error').text('');
                    $('#state_error').text('');
                }
                if (step === 2 && $('#state').val() === '') {
                    if ($('#state').val() === '') {
                        $('#state_error').text('* State is required');
                        return;
                    } else {
                        $('#state_error').text('');
                    }
                } else {
                    $('#country_error').text('');
                    $('#city_error').text('');
                    $('#state_error').text('');
                }
                if (step === 2 && $('#city').val() === '') {
                    if ($('#city').val() === '') {
                        $('#city_error').text('* City is required');
                        return;
                    } else {
                        $('#city_error').text('');
                    }
                } else {
                    $('#country_error').text('');
                    $('#city_error').text('');
                    $('#state_error').text('');
                }
                if (step === 3 && $('#third')) {
                    if ($('#email').val() === '') {
                        $('#email_error').text('* Email is required');
                        return;
                    } else {
                        $('#email_error').text('');
                    }
                } else {
                    $('#email_error').text('');
                    $('#password_error').text('');
                }
                if (step === 3 && $('#password').val() === '') {
                    if ($('#password').val() === '') {
                        $('#password_error').text('* Password is required');
                        return;
                    } else {
                        $('#password_error').text('');
                    }
                } else {
                    $('#email_error').text('');
                    $('#password_error').text('');
                }
                step++;
                showStep(step);
            });

            $('#submitform').submit(function(e) {
                e.preventDefault();
                var data = $('#submitform')[0];
                var formData = new FormData(data);
                $('._error').text('');
                var url = "{{route('add-multifield')}}";

                makeAjaxRequest(url, 'POST', formData, function(response) {
                        $('#message').html(response.message);
                        $('#submitform')[0].reset();
                        $(".error").empty();
                        $('#all-error').empty();
                        setTimeout(function() {
                            window.location.href = "/multifield";
                            $('#message').hide();
                        }, 2000);

                    },
                    function(xhr, status, error) {
                        // console.log('error : ', error);
                        $('.error').empty();
                        $('#all-error').empty();
                        if (xhr.status === 422) {
                            $(".error").addClass("text-danger");
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $('#all-error').append(value + '<br>');
                            });
                        }

                    }
                );

            });

            $('#prevBtn').click(function() {
                step--;
                showStep(step);
            });

        });
    </script>



    @endsection