
<header class="p-3  border-bottom">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <!-- Brand Logo -->
    
            <!-- Navigation Links -->
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="{{route('view')}}" class="nav-link px-2 link-secondary">Home</a></li>
                <li><a href="#" class="nav-link px-2 link-dark"></a></li>
                <li><a href="#" class="nav-link px-2 link-dark"></a></li>
                <li><a href="#" class="nav-link px-2 link-dark"></a></li>
            </ul>


            <div class="dropdown text-end">

                    <!-- Logged In User View -->
                    <a href="#" class=" link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{asset('/storage/user/'.Auth::user()->image)}}" alt="{{ Auth::user()->name }}" width="32" height="32" class="rounded-circle">
                    </a>

                    <!-- <a href="{{ route('register') }}" class="btn btn-outline-primary">Sign-up</a> -->
           
                    <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                      <li><a class="dropdown-item" href="{{ route('Profile') }}">Profile</a></li>
                      <li><a class="dropdown-item" id="logout" href="#">Logout</a></li>
                       
                    </ul>
              
                    
            </div>
        </div>
    </div>
</header>


<!-- </div> -->
<script src="https://code.jquery.com/jquery-3.7.1.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

<script>
  $(document).ready(function() {


    $('#logout').on('click', function() {

      $.ajax({
        url: "{{route('userlogout')}}",
        type: "POST",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
          console.log(response.message);
            window.location.href = '/';
        
        },
        error: function(error) {
          console.log(error);
        }
      });
    });

  });
</script>