@extends('layout')
@section('container')
<style>
    
</style>
<div class="content">
    <div class="m-3">

      <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="bg-white rounded-3 shadow-sm p-3 mb-4 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-muted">User Add Form Overview</h5>
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
                   <div class="row">
                <div class="col-6 mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter name">
                    <span class="text-danger small error" id="name_error"></span>
                </div>

                <!-- Email Input -->
                <div class="col-6 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="name@example.com">
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
                            <option value="{{$item->id}}">{{$item->country_name}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger error small" id="country_error"></span>
                    </div>
                    <div class="col-6 mb-3">
                        <label class="form-label">City</label>
                        <select class="form-select" name="city" id="city">
                            <option value="">Select City...</option>
                        </select>
                        <span class="text-danger error small" id="city_error"></span>
                    </div>
                </div>

                <!-- Gender & Image -->
                <div class="row">
                    <div class="col-6 mb-3">
                        <label class="form-label">Gender</label>
                        <select class="form-select" name="gender">
                            <option value="">Select...</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        <span class="text-danger error small" id="gender_error"></span>
                    </div>
                    <div class="col-6 mb-3">
                        <label class="form-label">Profile Image</label>
                        <input type="file" name="image" class="form-control">
                        <span class="text-danger error small" id="image_error"></span>
                    </div>
                </div>
                <!-- Address Input -->
                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <input type="text" name="address" class="form-control" placeholder="Street address">
                    <span class="text-danger error small" id="address_error"></span>
                </div>

                <!-- Submit Button -->
                
                    <button type="submit" class="btn btn-primary ">Submit</button>
               
            </form>
        </div>
    </div>
</div>



</div>


<script src="https://code.jquery.com/jquery-3.7.1.js" crossorigin="anonymous"></script>
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
                        console.log('city',response);
                        $.each(response, function(key, value) {
                            $('#city').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
            } else {
                $('#city').empty().append('<option value=" "> select city </option>');

            }
        });

        $('#submitform').submit(function(e) {
            e.preventDefault();
            var Data = $('#submitform')[0];
            var formData = new FormData(Data);
            $('._error').text('');
            var url = "{{ route('store') }}";
            makeAjaxRequest( url,'POST', formData, function(response) {
                    $('#message').html(response.message);
                    $('#submitform')[0].reset();
                       $(".error").empty();
                    setTimeout(function() {
                        window.location.href = "/view";
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