@extends('layout')
@section('container')

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<div class="content">

    <div class="container-fluid py-4">
        <div id="message" class="text-success"></div>
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold text-dark">Manage Data</h5>
                <a href="{{route('form')}}" class="btn btn-primary btn-sm shadow-sm">
                    <i class="bi bi-plus-lg me-1"></i> Add New Record
                </a>
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
                    op += `<tr>
                            <td>${count++}</td>
                            <td class="text-capitalize">
                                <img src="/storage/upload/${row.image}" height="30" width="30"> 
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
                    "destroy": true, // Safety flag
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
               function(id){
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
    });
</script>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>


@endsection