@extends('layout')
@section('container')
<div class="content">

    <div class="m-3">

        <h3>Manage Data</h3>
        <br>
        <div class="m-1">
            <table id="myTable" class="display">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>NAME</th>
                        <th>EMAIL</th>
                        <th>ADDRESS</th>
                        <th>CITY</th>
                        <th>COUNTRY</th>
                        <th>GENDER</th>
                        <th>IMAGE</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody id="data-tbl">

                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.js" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {

        view();

        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });

        function view() {
            $.ajax({
                url: "{{ route('display') }}",
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        var result = response.data;
                        console.log(result);
                        var op = "";
                        var count = 1;
                        $.each(response.data, function(index, row) {
                            op += `<tr>
                            <td>${count++}</td>
                            <td>${row.name}</td>
                            <td>${row.email}</td>
                            <td>${row.address}</td>
                            <td>${row.getcity.city_name}</td>
                            <td>${row.getcountry.country_name}</td>
                            <td>${row.gender}</td>
                            <td>
                                <img src="/storage/upload/${row.image}" height="20" width="20">
                            </td>
                            <td>
                                <a href="/edit/${row.id}" class="edit-btn btn btn-sm btn-success">edit</a> 
                                 <a href="#" class="del-btn btn btn-danger btn-sm" data-id="${row.id}">delete</a>
                            </td>
                        </tr>`;
                        });

                        $('#data-tbl').html(op);
                    }

                },
                error: function(xhr, status, error) {
                    console.log('error : ', error);
                }
            })
        }


    });
</script>
<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click', '.del-btn', function(e) {

            let id = $(this).data('id');

            if (confirm("Are you sure you want to delete this record?")) {
                $.ajax({
                    url: "/delete/" + id,
                    method: 'GET',
                    success: function(response) {
                        console.log(response);
                        window.open('/view', '__self');
                    },
                    error: function(xhr, status, error) {
                        console.log('error : ', error);
                    }
                });
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>


@endsection