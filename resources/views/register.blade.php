<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ajax</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

</head>

<body>


  <!-- Section: Design Block -->
  <section class="text-center text-lg-start">
    <style>
      .cascading-right {
        margin-right: -50px;
      }

      @media (max-width: 991.98px) {
        .cascading-right {
          margin-right: 0;
        }
      }
    </style>

    <!-- Jumbotron -->
    <div class="container py-2">
      <div class="row g-0 align-items-center">
        <div class="col-lg-6 mb-5 mb-lg-0">
          <div class="card cascading-right bg-body-tertiary" style="
            backdrop-filter: blur(30px);
            ">

            <div class="card-body p-5 shadow-5 text-center">
              <div class="fw-bold text-success mx-3 mb-0 d-flex align-items-center text-center my-1" id="message">
              </div>
              <h2 class="fw-bold mb-5">Sign up now</h2>
              <form id="cmxform" enctype="multipart/form-data">
                @csrf
                <!-- Name input -->
                <div class="row">
                  <div class="col-md-6">
                    <div data-mdb-input-init class="form-outline mb-4 d-flex row ">
                      <div class="col-md-0"> <label class="form-label">Name :</label></div>
                      <div class="col-md-12"><input type="text" name="name" class="form-control form-control-lg"
                          placeholder="Enter a valid username" />
                        <span class="error text-danger" id="name_error"></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6"> <!-- Email input -->
                    <div data-mdb-input-init class="form-outline mb-4 d-flex row ">
                      <div class="col-md-0"> <label class="form-label">Email :</label> </div>
                      <div class="col-md-12"> <input type="email" name="email" class="form-control form-control-lg"
                          placeholder="Enter a valid email address" />
                        <span class="error text-danger" id="email_error"></span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <!-- Password input -->
                    <div data-mdb-input-init class="form-outline mb-3 d-flex row">
                      <div class="col-md-0"> <label class="form-label">Password :</label> </div>
                      <div class="col-md-12"><input type="password" name="password" class="form-control form-control-lg"
                          placeholder="Enter password" />
                        <span class="error text-danger" id="password_error"></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <!--Confirm  Password input -->
                    <div data-mdb-input-init class="form-outline mb-3 d-flex row">
                      <div class="col-md-0"> <label class="form-label">Confirm Password :</label> </div>
                      <div class="col-md-12"><input type="password" name="password_confirmation" id="password-confirm" class="form-control form-control-lg"
                          placeholder="Enter confirm password" />
                        <span class="error text-danger" id="password_error"></span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div data-mdb-input-init class="form-outline mb-3 d-flex row">
                      <div class="col-md-0"> <label class="form-label">Mobile :</label> </div>
                      <div class="col-md-12"><input type="text" name="phone" class="form-control form-control-lg"
                          placeholder="Enter a valid phonenumber" />
                        <span class="error text-danger" id="phone_error"></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div data-mdb-input-init class="form-outline mb-3 d-flex row">
                      <div class="col-md-0"><label class="form-label">Image :</label> </div>
                      <div class="col-md-12"> <input type="file" name="image" class="form-control form-control-lg" />
                        <span class="error text-danger" id="image_error"></span>
                      </div>
                    </div>
                  </div>
                </div>

                <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary  btn-lg btn-block mb-2">
                  Sign up
                </button>
              </form>
              <p class="small fw-bold mt-2 pt-1 mb-0">Do you have an account ? <a href="{{route('login')}}"
                  class="link-primary">Login</a></p>
            </div>
          </div>
        </div>

        <div class="col-lg-6 mb-5 mb-lg-0">
          <img src="https://mdbootstrap.com/img/new/ecommerce/vertical/004.jpg" class="w-100 rounded-4 shadow-4"
            alt="" />
        </div>
      </div>
    </div>
    <!-- Jumbotron -->
  </section>
  <!-- Section: Design Block -->
  <script src="https://code.jquery.com/jquery-3.7.1.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  <script src="{{ asset('ajax.js') }}"></script>
  <script>
    $(document).ready(function() {

      $('#cmxform').submit(function(e) {
        e.preventDefault();
        var form = $('#cmxform')[0];
        var formData = new FormData(form);
        $('._error').text('');
        var url = "{{ route('RegisterPage') }}";

        makeAjaxRequest(url, 'POST', formData, function(response) {
            console.log('response', response);
            $('#message').html(response.message);
            $('#cmxform')[0].reset();
            $(".error").empty();
            setTimeout(function() {
              window.location.href = "/";
            }, 2000);

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