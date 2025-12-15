@extends('layout')
@section('container')

<div class="content">
    <div class="m-4">

        <h3>Add Data</h3>
        <br>
        <div id="message" style="color: green;"></div>
        <br>

        <form id="submitform"  enctype="multipart/form-data">
            @csrf
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" name="name" class="form-control">
                    @error('name')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="email" name="email" class="form-control">
                    @error('email')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>

            </div>
            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Address</label>
                <div class="col-sm-6">
                    <input type="text" name="address" class="form-control">
                    @error('address')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">City</label>
                <div class="col-sm-6">
                    <input type="text" name="city" class="form-control">
                    @error('city')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Country</label>
                <div class="col-sm-6">
                    <input type="text" name="country" class="form-control">
                    @error('country')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
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
                    @error('gender')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <label for="" class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-6">
                    <input type="file" name="image" class="form-control">
                    @error('image')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
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

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('#submitform').submit(function(e) {

            e.preventDefault();
            var Data = $('#submitform')[0];

            var formData = new FormData(Data);

            //  console.log(formData);
            $.ajax({
                url: "{{ route('store') }}",
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    $('#message').html(response.message)
                    $('#submitform')[0].reset();
                    // view();
                },
                error: function(xhr, status, error) {
                    console.log('error : ', error);
                }
            });

        });

    });
</script>


<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>



@endsection