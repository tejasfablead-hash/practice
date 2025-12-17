@extends('layout')
@section('container')

<div class="content">
    <div class="m-5">

        <h3>Update Data</h3>
        <br>
        <div id="message" style="color: green;"></div>
        <br>

        <form id="submitform" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 row">
                <input type="hidden" name="id" value="{{$single->id}}" class="form-control">
                <label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" name="name" value="{{$single->name}}" class="form-control">
                    <span class="error text-danger" id="name_error"></span>

                </div>
            </div>
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="email" name="email" value="{{$single->email}}" class="form-control">
                    <span class="error text-danger" id="email_error"></span>

                </div>

            </div>
            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Address</label>
                <div class="col-sm-6">
                    <input type="text" name="address" value="{{$single->address}}" class="form-control">
                    <span class="error text-danger" id="address_error"></span>

                </div>
            </div>


            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Country</label>
                <div class="col-sm-6">
                    <select class="form-control" name="country" id="country">

                        <option class="form-control" value="">Select....</option>
                        @foreach($country as $item)
                        <option class="form-control" value="{{$item->id}}" {{ (isset($single) && $single->country == $item->id) ? 'selected' : '' }}>{{$item->country_name}}</option>
                        @endforeach
                    </select>
                    <span class="error text-danger" id="country_error"></span>

                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">City</label>
                <div class="col-sm-6">
                    <select class="form-control" name="city" id="city">
                        <option class="form-control" value="{{$single->city}}">Select City....</option>
                    </select>
                    <span class="error text-danger" id="city_error"></span>

                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Gender</label>
                <div class="col-sm-6">
                    <select class="form-control" name="gender" id="">
                        <option class="form-control" value="male" {{ $single->gender === 'male' ? 'selected' : '' }}>Male</option>
                        <option class="form-control" value="female" {{ $single->gender === 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                    <span class="error text-danger" id="gender_error"></span>

                </div>
            </div>
            <div class="mb-3 row">
                <label for="" class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-6">
                    <input type="file" name="image" class="form-control"><br>
                    <span class="error text-danger" id="image_error"></span>

                    <img src="{{asset('/storage/upload/'.$single->image)}}" alt="img" height="50px" width="50x">

                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary form-control">Update</button>
                </div>
            </div>
        </form>

    </div>
    <br>
    <br>


</div>


<script src="https://code.jquery.com/jquery-3.7.1.js" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#submitform').submit(function(e) {


            e.preventDefault();
            var Data = $('#submitform')[0];
            $('._error').text();
            var formData = new FormData(Data);

            $.ajax({
                url: "{{ route('update') }}",
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    $('#message').html(response.message)
                    $('#submitform')[0].reset();
                    window.open('/view', '__self');
                    // view();
                },
                error: function(xhr, status, error) {
                    console.log('error : ', error);
                    $(".error").removeClass("text-danger").empty();
                    if (xhr.status === 422) {
                        $(".error").addClass("text-danger");
                        let errors = xhr.responseJSON.errors;
                        $.each(error, function(key, value) {
                            $('#' + key + '_error').text(value);
                        });
                    }
                }
            });

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