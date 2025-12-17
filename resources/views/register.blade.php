<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ajax</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <!-- <link  href="{{asset('public/style')}}"> -->
  <style>
    .divider:after,
    .divider:before {
      content: "";
      flex: 1;
      height: 1px;
      background: #eee;
    }

    .h-custom {
      height: calc(100% - 73px);
    }

    @media (max-width: 450px) {
      .h-custom {
        height: 100%;
      }
    }
  </style>
</head>

<body>
  <section class="vh-100">
    <div class="container-fluid h-custom">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-9 col-lg-6 col-xl-5">
          <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
            class="img-fluid" alt="Sample image">
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
          <div class="fw-bold text-success mx-3 mb-0 d-flex align-items-center text-center my-4" id="message">
           
          </div>
          <div class="divider d-flex align-items-center my-4">
            <p class="text-center fw-bold mx-3 mb-0">Registration</p>
          </div>
          <form id="cmxform" method="post" enctype="multipart/form-data">
            @csrf
            <!-- Name input -->
            <div data-mdb-input-init class="form-outline mb-4">
              <input type="text" name="name" class="form-control form-control-lg"
                placeholder="Enter a valid username" />
              <span class="error text-danger" id="name_error"></span>
            </div>
            <!-- Email input -->
            <div data-mdb-input-init class="form-outline mb-4">
              <input type="email" name="email" class="form-control form-control-lg"
                placeholder="Enter a valid email address" />
              <span class="error text-danger" id="email_error"></span>
            </div>

            <!-- Password input -->
            <div data-mdb-input-init class="form-outline mb-3">
              <input type="password" name="password" class="form-control form-control-lg"
                placeholder="Enter password" />
              <span class="error text-danger" id="password_error"></span>
            </div>

            <div data-mdb-input-init class="form-outline mb-4">
              <input type="text" name="phone" class="form-control form-control-lg"
                placeholder="Enter a valid phonenumber" />
              <span class="error text-danger" id="phone_error"></span>
            </div>

            <div data-mdb-input-init class="form-outline mb-4">
              <input type="file" name="image" class="form-control form-control-lg" />
            <span class="error text-danger" id="image_error"></span>
            </div>

            <div class="text-center text-lg-start mt-4 pt-2">
              <input type="submit" name="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg"
                style="padding-left: 2.5rem; padding-right: 2.5rem;" value="Register" />
            </div>

          </form>
          <p class="small fw-bold mt-2 pt-1 mb-0">Do have an account? <a href="{{route('login')}}"
              class="link-danger">login</a></p>

        </div>
      </div>
    </div>
    <div
      class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
      <!-- Copyright -->
      <div class="text-white mb-3 mb-md-0">
        Copyright © 2020. All rights reserved.
      </div>
      <!-- Copyright -->


    </div>
  </section>
  <script src="https://code.jquery.com/jquery-3.7.1.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

  <script>
    $(document).ready(function() {

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $('#cmxform').submit(function(e) {

        e.preventDefault();
        var form = $('#cmxform')[0];
        var formData = new FormData(form);
         $('._error').text('');
        $.ajax({
          url: "{{ route('RegisterPage') }}",
          method: 'POST',
          data: formData,
          processData: false,
          contentType: false,

          success: function(response) {
            console.log('response', response);
            $('#message').html(response.message);
            $('#cmxform')[0].reset();
            window.open('/', '__self');
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
</body>

</html>