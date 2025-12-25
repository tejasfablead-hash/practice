@extends('layout')
@section('container')
<style>
    #progressbar {
        margin-bottom: 30px;
        overflow: hidden;
        counter-reset: step;
        display: flex;
        justify-content: space-between;
        padding-left: 0;
    }

    #progressbar li {
        list-style-type: none;
        width: 25%;
        position: relative;
        text-align: center;
        font-weight: 500;
        color: #6c757d;
    }

    #progressbar li:before {
        content: counter(step);
        counter-increment: step;
        width: 35px;
        height: 35px;
        line-height: 35px;
        display: block;
        background: #dee2e6;
        border-radius: 50%;
        margin: 0 auto 10px auto;
        color: #000;
    }

    #progressbar li:after {
        content: '';
        position: absolute;
        width: 100%;
        height: 3px;
        background: #dee2e6;
        top: 16px;
        left: -50%;
        z-index: -1;
    }

    #progressbar li:first-child:after {
        content: none;
    }

    #progressbar li.active {
        color: #198754;
    }

    #progressbar li.active:before {
        background: #198754;
        color: white;
    }

    #progressbar li.active+li:after {
        background: #198754;
    }
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
                    <!-- <h3 class="mb-4 text-center ">Fill all Input field and go to next step</h3> -->

                    <form id="submitform" enctype="multipart/form-data">

                        <ul id="progressbar" class="mb-4">
                            <li class="active" id="account"><strong>Account</strong></li>
                            <li id="personal"><strong>Address</strong></li>
                            <li id="payment"><strong>Payment</strong></li>
                            <li id="confirm"><strong>Finish</strong></li>
                        </ul>

                        @csrf
                        <div id="first">
                            <div class="row field_wrapper">
                                <div class="col-6 mb-3">
                                    <label class="form-label">First Name</label>
                                    <input type="text" name="fname" id="fname" class="form-control">
                                    <span class="text-danger small error" id="fname_error"></span>
                                </div>
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
                                    <label class="form-label">Bank Name</label>
                                    <input type="text" name="bankname" id="bankname" class="form-control">
                                    <span class="text-danger small error" id="bankname_error"></span>
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="form-label">Branch Name</label>
                                    <input type="text" name="branchname" id="branchname" class="form-control">
                                    <span class="text-danger small error" id="branchname_error"></span>
                                </div>
                            </div>
                            <div class="row field_wrapper">
                                <div class="col-6 mb-3">
                                    <label class="form-label">IFSC</label>
                                    <input type="text" name="ifsc" id="ifsc" class="form-control">
                                    <span class="text-danger small error" id="ifsc_error"></span>
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="form-label">Balance</label>
                                    <input type="text" name="balance" id="balance" class="form-control">
                                    <span class="text-danger small error" id="balance_error"></span>
                                </div>
                            </div>
                        </div>
                        <div id="fourth" class="d-none">
                            <div class="row field_wrapper">
                                <div class="col-6 mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" id="email" class="form-control">
                                    <span class="text-danger small error" id="email_error"></span>
                                </div>
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
            const steps = ['account', 'personal', 'payment', 'confirm'];


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
            showStep(step);

            function showStep(step) {
                $('#first, #second, #third, #fourth').addClass('d-none');

                $('#prevBtn').toggleClass('d-none', step === 1);
                $('#nextBtn').toggleClass('d-none', step === 4);
                $('#submitBtn').toggleClass('d-none', step !== 4);

                if (step === 1) $('#first').removeClass('d-none');
                if (step === 2) $('#second').removeClass('d-none');
                if (step === 3) $('#third').removeClass('d-none');
                if (step === 4) $('#fourth').removeClass('d-none');


                updateStepBar(step);
            }

            function updateStepBar(step) {
                $('#progressbar li').removeClass('active');

                for (let i = 0; i < step; i++) {
                    $('#' + steps[i]).addClass('active');
                }
            }



            $('#nextBtn').click(function() {

                $('.error').text('');

                if (step === 1) {
                    if (!$('#fname').val()) return $('#fname_error').text('* First name required');
                    if (!$('#lname').val()) return $('#lname_error').text('* Last name required');
                    if (!$('#phone').val()) return $('#phone_error').text('* Phone required');
                }

                if (step === 2) {
                    if (!$('#country').val()) return $('#country_error').text('* Country required');
                    if (!$('#state').val()) return $('#state_error').text('* State required');
                    if (!$('#city').val()) return $('#city_error').text('* City required');
                }

                if (step === 3) {
                    if (!$('#bankname').val()) return $('#bankname_error').text('* Bank name required');
                    if (!$('#branchname').val()) return $('#branchname_error').text('* Branch required');
                    if (!$('#ifsc').val()) return $('#ifsc_error').text('* IFSC required');
                    if (!$('#balance').val()) return $('#balance_error').text('* Balance required');
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