@extends('layout')
@section('container')

<div class="content">
    <div class="m-5">

        <h3>Add Data</h3>
        <br>
        <div id="message" style="color: green;"></div>
        <br>

        <form id="submitform" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" name="name" id="name" class="form-control">
                    <span class="error text-danger" id="name_error"></span>

                </div>
            </div>
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="email" name="email" id="email" class="form-control">
                    <span class="error text-danger" id="email_error"></span>
                </div>

            </div>
            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Address</label>
                <div class="col-sm-6">
                    <input type="text" name="address" class="form-control">
                    <span class="error text-danger" id="address_error"></span>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Country</label>
                <div class="col-sm-6">
                    <select class="form-control" name="country" id="country">
                        <option class="form-control" value="">Select....</option>
                        @foreach($country as $item)
                        <option class="form-control" value="{{$item->id}}">{{$item->country_name}}</option>
                        @endforeach
                    </select>
                    <span class="error text-danger" id="country_error"></span>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">City</label>
                <div class="col-sm-6">
                    <select class="form-control" name="city" id="city">
                        <option class="form-control" value="">Select City....</option>
                    </select>
                    <span class="error text-danger" id="city_error"></span>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Gender</label>
                <div class="col-sm-6">
                    <select class="form-control" name="gender" id="">

                        <option class="form-control" value="">Select....</option>
                        <option class="form-control" value="male">Male</option>
                        <option class="form-control" value="female">Female</option>
                    </select>
                    <span class="error text-danger" id="gender_error"></span>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="" class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-6">
                    <input type="file" name="image" class="form-control">
                    <span class="error text-danger" id="image_error"></span>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary form-control">Submit</button>
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


        $('#country').on('change', function() {

            var country_id = $(this).val();
            if (country_id) {
                $.ajax({
                    url: '{{url("/getcity/")}}/' + country_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        $('#city').empty();
                        $.each(response, function(key, value) {
                            $('#city').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
            } else {
                $('#city').empty().append('<option value=" "> select city </option>');

            }
        });


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('#submitform').submit(function(e) {

            e.preventDefault();
            var Data = $('#submitform')[0];

            var formData = new FormData(Data);
            $('._error').text('');

            $.ajax({
                url: "{{ route('store') }}",
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);

                    $('#message').html(response.message);
                    $('#submitform')[0].reset();
                    window.open('/view', '__self');
                    // view();
                },
                error: function(xhr, status, error) {
                    $(".error").empty();
                    if (xhr.status === 422) {
                        $(".error").addClass("text-danger");
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('#' + key + '_error').text(value);
                        });

                    }
                    console.log('error : ', error);
                }

            });

        });

    });
</script>


@endsection