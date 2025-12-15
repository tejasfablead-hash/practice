@extends('layout')
@section('container')
<div class="content">

    <div class="m-4">

        <h3>Manage Data</h3>
        <br>
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
            <tbody id="data-id">
                @php
                $count=1;
                @endphp
                @foreach($data as $item)
                <tr>
                    <td>{{$count++}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->address}}</td>
                    <td>{{$item->city}}</td>
                    <td>{{$item->country}}</td>
                    <td>{{$item->gender}}</td>
                    <td><img src="{{asset('/storage/upload/'.$item->image)}}" height="20px" width="20px"></td>
                    <td><a href="">edit</a>  <a href="">delete</a></td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.js" crossorigin="anonymous"></script>

<!-- <script>
    $(document).ready(function() {

        view();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function view() {
            $.ajax({
                url: "{{ route('display') }}",
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        var result = response.data;
                        // var path = "http://127.0.0.1:8000/storage/upload/";
                        var op = "";
                        var count = 1;
                        $.each(result, function(inx, row) {
                            op += "<tr>";
                            op += "<td>" + count++ + "</td>";
                            op += "<td>" + row.name + "</td>";
                            op += "<td>" + row.email + "</td>";
                            op += "<td>" + row.address + "</td>";
                            op += "<td>" + row.city + "</td>";
                            op += "<td>" + row.country + "</td>";
                            op += "<td>" + row.gender + "</td>";
                            op += "<td>" + row.image + "</td>";
                            // op += "<td>" + "<img src="path + row.image">" + "</td>";
                            op += "<td>" + `<a>edit</a>  <a>delete</a>` + "</td>";
                            op += "</tr>";
                        });
                        $('#data-id').html(op);
                    }

                },
                error: function(xhr, status, error) {
                    cnsole.log('error : ', error);
                }
            })
        }


    });
</script> -->


<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>


@endsection