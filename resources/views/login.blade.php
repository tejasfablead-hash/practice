<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ajax</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

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

          <div class=" d-flex align-items-center text-center my-4">
            <p id="message" class="text-center text-success fw-bold mx-3 mb-0"></p>


          </div>


          <div class="divider d-flex align-items-center my-4">
            <p class="text-center fw-bold mx-3 mb-0">Login</p>
          </div>
          <form method="post" id="loginform">
            @csrf

            <!-- Password input -->
               <div data-mdb-input-init class="form-outline mb-4 d-flex ">
              <div class="col-md-3"> <label class="form-label">Email :</label> </div>
              <div class="col-md-9"> <input type="email" value="{{ old('email') }}" name="email" class="form-control form-control-lg"
                  placeholder="Enter a valid email address" />
                <span class="error text-danger" id="email_error"></span>
              </div>
            </div>
            <!-- Password input -->
            <div data-mdb-input-init class="form-outline mb-3 d-flex ">
              <div class="col-md-3"> <label class="form-label">Password :</label> </div>
              <div class="col-md-9"><input type="password" name="password" class="form-control form-control-lg"
                  placeholder="Enter password" />
                <span class="error text-danger" id="password_error"></span>
              </div>
            </div>
            <p id="invalid" class=" text-danger   mb-0"></p>
                <div class="text-center text-lg-start mt-2 pt-2 d-flex">
              <div class="col-md-3"><label class="form-label-lg"></label> </div>
               <div class="col-md-9"><input type="submit" name="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg"
                style="padding-left: 2.5rem; padding-right: 2.5rem;" value="Login" />
            </div>
            </div>
              <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account ? <a href="{{route('register')}}"
                  class="link-danger">Register</a></p>
            </div>

          </form>
        </div>
      </div>
    </div>

  </section>
  <script src="https://code.jquery.com/jquery-3.7.1.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  <script src="{{ asset('ajax.js') }}"></script>
  <script>
    $(document).ready(function() {

      $('#loginform').submit(function(e) {
        e.preventDefault();
        var form = $('#loginform')[0];
        var formData = new FormData(form);
        $('._error').text('');
        var url = "{{ route('LoginPage') }}";

        makeAjaxRequest(url, 'POST', formData, function(response) {
            console.log('response', response);
            if (response.status == true) {
              $('#message').html(response.message)
               setTimeout(function() {
                        window.location.href = "/profile";
                    }, 2000);
            } else {
              $('#invalid').html(response.message);
            }
            $('#loginform')[0].reset();

          },
          function(error) {
            console.log('error : ', error);
          }
        );

      });

    });
  </script>

</body>

</html>