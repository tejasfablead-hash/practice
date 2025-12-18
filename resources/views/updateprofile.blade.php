@extends('layout')
@section('container')
<div class="content">

    <div class="m-5">
        <section style="background-color: #eee;">
            <div class="container py-5">
                <div class="row">
                    <div class="col">
                        <nav aria-label="breadcrumb" class="bg-body-tertiary rounded-3 p-3 mb-4">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">Home</li>
                                <li class="breadcrumb-item" aria-current="page">User Profile</li>
                            </ol>

                        </nav>
                    </div>
                </div>
                <div id="message" style="color: green;"></div>
                <br>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card mb-4">
                            <div class="card-body text-center">
                                <form id='updateform' enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3 row">
                                        <input type="hidden" name="id" id="id" value="{{$single->id}}" class="form-control">
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
                                        <label for="staticEmail" class="col-sm-2 col-form-label">phone</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="phone" value="{{$single->phone}}" class="form-control">
                                            <span class="error text-danger" id="phone_error"></span>

                                        </div>

                                    </div>
                                    <div class="mb-3 row">
                                        <label for="" class="col-sm-2 col-form-label">Image</label>
                                        <div class="col-sm-6">
                                            <input type="file" name="image" class="form-control"><br>
                                            <span class="error text-danger" id="image_error"></span>
                                            <div class="mb-3 row">
                                                <div class="col-sm-6">
                                                    <img src="{{asset('/storage/user/'.$single->image)}}" class="rounded-circle img-fluid" style="width: 150px;" alt="img">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-2">
                                            <input type="submit" name="submit" class="btn btn-primary form-control" value="Update" />
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
<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#updateform').submit(function(e) {

            e.preventDefault();
            var Data = $('#updateform')[0];
            var formData = new FormData(Data);
            $('._error').text();
            $.ajax({
                url: "{{ route('UpdateProfile') }}",
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    $('#message').html(response.message)
                    window.open('/profile', '__self');
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
    });
</script>

@endsection