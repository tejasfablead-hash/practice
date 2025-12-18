<!-- <div class="container " > -->
  
<header style="background-color: #bdb9b9ff;" class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3">
  <a href="{{route('Profile')}}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
    <svg class="bi me-2" width="40" height="32">
      <use xlink:href="#bootstrap"></use>
    </svg>
    <span class="fs-4 text-capitalize">Home</span>
  </a>


    <button id="logout" class="col-md-0 text-end btn btn-outline-primary me-5">Logout</button>
 
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