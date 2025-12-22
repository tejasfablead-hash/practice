@extends('layout')
@section('container')

<div class="content">
    <div class="m-3">
           <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="bg-white rounded-3 shadow-sm p-3 mb-4 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-muted">User Update Form Overview</h5>
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
                    <h3 class="mb-4">Update Data</h3>


                    <form id="submitform" enctype="multipart/form-data">
                        @csrf
                        <!-- Hidden ID for Update -->
                        <input type="hidden" name="id" value="{{$single->id}}">

                        <!-- Name Input -->
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" id="name" value="{{$single->name}}" class="form-control" placeholder="Enter name">
                                <span class="text-danger small error" id="name_error"></span>
                            </div>


                            <!-- Email Input -->
                            <div class="col-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" id="email" value="{{$single->email}}"  class="form-control" placeholder="name@example.com">
                                <span class="text-danger small error" id="email_error"></span>
                            </div>
                        </div>


                        <!-- Two-Column Row for Country/City -->
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="form-label">Country</label>
                                <select class="form-select" name="country" id="country">
                                    <option value="">Select...</option>
                                    @foreach($country as $item)
                                    <option value="{{$item->id}}" {{ (isset($single) && $single->country == $item->id) ? 'selected' : '' }}>
                                        {{$item->country_name}}
                                    </option>
                                    @endforeach
                                </select>
                                <span class="text-danger error small" id="country_error"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label">City</label>
                                <select class="form-select" name="city" id="city">
                                    <option value="{{$single->city}}">Select City....</option>
                                </select>
                                <span class="text-danger error small" id="city_error"></span>
                            </div>
                        </div>
                        <!-- Address Input -->


                        <!-- Gender & Image -->
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="form-label">Gender</label>
                                <select class="form-select" name="gender">
                                    <option value="male" {{ $single->gender === 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ $single->gender === 'female' ? 'selected' : '' }}>Female</option>
                                </select>
                                <span class="text-danger error small" id="gender_error"></span>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="row">
                                    <div class="col-10">
                                        <label class="form-label">Profile Image</label>
                                        <input type="file" name="image" class="form-control">
                                         <span class="text-danger error small" id="image_error"></span>
                                    </div>
                                    <div class="col-2 mb-2">
                                        <div class="mt-3">
                                            <img src="{{asset('/storage/upload/'.$single->image)}}" alt="img" height="50px" width="50px" class="border rounded">
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" value="{{$single->address}}" class="form-control" placeholder="Street address">
                            <span class="text-danger error small" id="address_error"></span>
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.js" crossorigin="anonymous"></script>
    <script src="{{ asset('ajax.js') }}"></script>
    <script>
        $(document).ready(function() {

            $('#submitform').submit(function(e) {
                e.preventDefault();
                var Data = $('#submitform')[0];
                var formData = new FormData(Data);
                var url = "{{ route('update') }}";
                $('._error').text('');

                makeAjaxRequest(url, 'POST', formData, function(response) {
                        console.log(response);
                        $('#message').html(response.message)
                        $('#submitform')[0].reset();
                        setTimeout(function() {
                            window.location.href = "/view";
                        }, 2000);
                    },
                    function(error) {
                        console.log('error : ', error);
                 
                    }
                );

            });


            $('#country').on('change', function() {

                var country_id = $(this).val();
                var city_id = $('#city').val();
                if (country_id) {
                    $.ajax({
                        url: '{{url("/getcity/")}}/' + country_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            $('#city').empty();
                            $.each(response, function(key, value) {
                                var isSelected = (key == city_id) ? 'selected' : '';
                                $('#city').append('<option value="' + key + '" ' + isSelected + '>' + value + '</option>');
                            });
                        }
                    });
                } else {
                    $('#city').empty().append('<option value=" "> select city </option>');

                }
            });

        });

        document.addEventListener("DOMContentLoaded", function(e) {
            var country_id = $('#country').val();
            var city_id = $('#city').val();
            if (country_id) {
                $.ajax({
                    url: '{{url("/getcity/")}}/' + country_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        $('#city').empty();
                        $.each(response, function(key, value) {
                            var isSelected = (key == city_id) ? 'selected' : '';
                            $('#city').append('<option value="' + key + '" ' + isSelected + '>' + value + '</option>');
                        });
                    }
                });
            } else {
                $('#city').empty().append('<option value=" "> select city </option>');

            }
        });
    </script>


    @endsection