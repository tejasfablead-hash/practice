@extends('layout')
@section('container')
<style>
    #match {
        height: 50px;
        width: 100%;
        padding-left: 15px;
        overflow: auto;
        color: #dc3545;
        background-color: wheat;
        align-content: center;
    }
     #success {
        height: 5%;
        width: 100%;
        padding-left: 15px;
        overflow: auto;
        color: #56dc35ff;
    }
</style>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<div class="content">

    <div class="container-fluid py-4">
        <div id="message" class="text-success"></div>
        <div class="card shadow-sm ">
            <div class="container-fluid mt-4">
                <div class="row">
                    <div class="col-12">
                        <div>
                            <div class="card-header bg-white py-3 d-flex flex-wrap justify-content-between align-items-center">
                                <!-- Title -->
                                <h5 class="mb-0 fw-bold text-dark">Manage Data</h5>
                                <div class="d-flex gap-2 mt-2 mt-md-0">
                                    <a href="{{route('form')}}" class="btn btn-primary btn-sm shadow-sm">
                                        <i class="bi bi-plus-lg me-1"></i> Add New Record
                                    </a>

                                    <a href="#" class="btn btn-secondary btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <i class="bi bi-upload me-1"></i> Upload CSV
                                    </a>
                                </div>
                            </div>
                            <!-- Optional: Add a card body for content below the header -->
                            <div class="card-body">
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Upload CSV</h1>
                                                <button type="button" class="btn-close reset" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form-control" id="csvform" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="formFile" class="form-label">Upload File : </label>
                                                        <input class="form-control" type="file" name="file" id="formFile">
                                                        <span class="text-danger error small" id="file_error"></span>

                                                    </div>
                                            </div>
                                            <div id="match" class="text-danger d-none"></div>  
                                                <div id="success" class="text-success d-none">
                                                 </div>

                                                <div class="modal-footer">

                                                    <button type="button" class="btn reset btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" name="submit" id="submitcsv" class="btn  btn-primary">Save changes</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>





                <div class="card-body">
                    <div class="table-responsive">
                        <table id="myTable" class="display table  table-hover align-middle w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Email</th>
                                    <th>City</th>
                                    <th>Country</th>
                                    <th>Gender</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="data-tbl">
                                <!-- AJAX Data will load here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="{{ asset('ajax.js') }}"></script>
<script>
    $(document).ready(function() {
        var url = "{{ route('display') }}";
        makeAjaxRequest(url, 'GET', null, function(response) {
            if (response.status === 'success') {
                var result = response.data;
                console.log('all data:', result);
                var op = "";
                var count = 1;

                if ($.fn.DataTable.isDataTable('#myTable')) {
                    $('#myTable').DataTable().clear().destroy();
                }

                $.each(result, function(index, row) {
                    if (row.image) {
                        var imagepath = row.image
                    } else {
                        var imagepath = '1766379113.png';
                    }

                    op += `<tr>
                            <td>${count++}</td>
                            <td class="text-capitalize">
                                <img src="/storage/upload/${imagepath}" height="30" width="30"> 
                             ${row.name}</td>
                            <td>${row.email}</td>
                            <td class="text-capitalize">${row.getcity.city_name}</td>
                            <td class="text-capitalize">${row.getcountry.country_name}</td>
                            <td class="text-capitalize">${row.gender}</td>
                            <td class="text-capitalize">
                                <a href="/edit/${row.id}" class="edit-btn btn btn-sm btn-success">edit</a> 
                                 <a href="#" class="del-btn btn btn-danger btn-sm" data-id="${row.id}">delete</a>
                            </td>
                        </tr>`;
                });
                $('#data-tbl').html(op);

                $('#myTable').DataTable({
                    "pageLength": 10,
                    "responsive": true,
                    "destroy": true, 
                    "language": {
                        "search": "_INPUT_",
                        "searchPlaceholder": "Search records..."
                    }
                });
            }
        }, function(error) {
            console.log('error : ', error);
        });


        $(document).on('click', '.del-btn', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let obj = $(this);
            var url = "/delete/" + id;

            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this imaginary file!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    cancelButtonText: "No",
                    confirmButtonText: "Yes",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(id) {
                    if (id) {
                        makeAjaxRequest(url, 'GET', null, function(response) {
                                console.log(response);
                                swal("Deleted!", "Your imaginary file has been archived.", "success");
                                $('#message').html(response.message);
                                setTimeout(function() {
                                    $('#message').hide();
                                }, 2000);
                                $(obj).parent().parent().remove();
                            },
                            function(error) {
                                console.log('error : ', error);
                            }
                        );
                    } else {
                        swal("Cancelled", "Your Record is safe.", "error");
                    }
                });
        });

        $('.reset').on('click', function() {
            $('#csvform')[0].reset();
            $('#match').addClass('d-none');
            $(".error").empty();
        });

        $('#csvform').submit(function(e) {
            e.preventDefault();

            var data = $('#csvform')[0];
            var formData = new FormData(data);
            $('._error').text('');
            $("#match").text('');
            var url = "{{route('csvstore')}}";

            if ($('#formFile').val() === '') {
                $('#file_error').text('* The file field is required.');
                return;
            } else {
                $('#file_error').text('');
            }

            makeAjaxRequest(url, 'POST', formData, function(response) {
                    $('#success').removeClass('d-none').html(response.message);
                    $('#csvform')[0].reset();
                    $(".error").empty();
                    setTimeout(function() {
                        window.location.href = "/view";
                    }, 2000);
                },
                function(xhr, status, error) {
                    $(".error").empty();
                    $("#match").empty();
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            
                            $('#match').removeClass('d-none').append('This ' + value.email + ' Already taken ' +'Please check csv file ' + '<br>');
                        });
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