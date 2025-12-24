@extends('layout')
@section('container')
<style>

</style>
<div class="content">
    <div class="m-3">

        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="bg-white rounded-3 shadow-sm p-3 mb-4 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-muted">Multiple Add Form Overview</h5>

                </nav>
            </div>
        </div>
        <div id="message" class="text-success"></div>
        <div class="container mt-3">
            <div id="message" class="text-success"></div>
            <div class="row justify-content-center">
                <div class="col-md-12 border p-4 shadow-sm rounded bg-white">
                    <h3 class="mb-4 ">Add Data</h3>

                    <!-- Success Message Alert -->

                    <form id="submitform" enctype="multipart/form-data">
                        @csrf
                        <!-- Basic Input -->
                        <div class="field_wrap">
                            <div class="row">
                                <div class="col-md-5 mb-3">
                                    <label class="form-label">Product</label>
                                    <input type="text" name="product[]" class="form-control product">
                                    <span class="text-danger small producterror" id="product_error"></span>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label class="form-label">Qty</label>
                                    <input type="number" name="qty[]" class="form-control qty">
                                    <span class="text-danger small qtyerror" id="qty_error"></span>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label class="form-label">Price</label>
                                    <input type="text" name="price[]" class="form-control price">
                                    <span class="text-danger small priceerror" id="price_error"></span>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label class="form-label">Total</label>
                                    <input type="text" name="total[]" class="form-control total" readonly>
                                    <span class="text-danger small totalerror" id="total_error"></span>
                                </div>
                                <div class="col-md-1">
                                    <label class="form-label"></label><br>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus-circle mt-3 addbtn" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>



    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="{{ asset('ajax.js') }}"></script>
    <script>
        $(document).ready(function() {
         
            function calculateRow(row) {
                let qty = parseFloat(row.find('.qty').val()) || 0;
                let price = parseFloat(row.find('.price').val()) || 0;
                row.find('.total').val(qty * price);
            }

            $(document).on('input', '.qty, .price', function() {
                let row = $(this).closest('.row');
                calculateRow(row);
            });


            var x = 1;
            var max = 10;
            var add = $('.addbtn');
            var wrap = $('.field_wrap');
            var field = `<div class=" remove row mt-2">
                <div class="col-md-5 ">
                    <input type="text" name="product[${x}]" id="name" class="product form-control" placeholder="Product">
                    <span class="text-danger small producterror" id="product_error"></span>
                </div>
                <div class="col-md-2">
                    <input type="number" name="qty[${x}]" id="qty" class="qty form-control" placeholder="Qty">     
                    <span class="text-danger small qtyerror" id="qty_error"></span>

                </div>
                <div class="col-md-2">
                    <input type="text" name="price[${x}]" id="price" class="price form-control" placeholder="Price"> 
                     <span class="text-danger small priceerror" id="price_error"></span>                       
                </div>
                <div class="col-md-2">
                    <input type="text" name="total[${x}]" id="total" class="total form-control" placeholder="Total">    
                    <span class="text-danger small totalerror" id="total_error"></span>                 
                </div>
                <div class="col-md-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="red" class="bi bi-dash-circle  removebtn" viewBox="0 0 16 16" style="cursor:pointer">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                        <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8"/>
                    </svg>
                </div>   
            </div>`;

            $('.addbtn').click(function() {
                if (x < max) {
                    let Isvalue = true;
                    if ($('.product').val() === '') {
                        $('.producterror').text('Product is required');
                        Isvalue = false;
                    } else {
                        $('.producterror').text('');
                    }
                    if ($('.qty').val() === '') {
                        $('.qtyerror').text('Qty is required');
                        Isvalue = false;
                    } else {
                        $('.qtyerror').text('');
                    }
                    if ($('.price').val() === '') {
                        $('.priceerror').text('Price is required');
                        Isvalue = false;
                    } else {
                        $('.priceerror').text('');
                    }

                    if (!Isvalue) {
                        return;
                    }

                    let valid = true;
                    let lastRow = $('.remove').last();

                    lastRow.find('.product, .qty, .price').each(function() {
                        if ($(this).val().trim() === '') {
                            let fieldName = $(this).attr('id');
                            $(this).next('span').text(fieldName + ' is required');
                            valid = false;
                            cal();
                        } else {
                            $(this).next('span').text('');
                        }
                    });

                    if (!valid) return;

                    x++;
                    $(wrap).append(field);


                } else {
                    alert('A maximum of ' + max + ' fields are allowed to be added. ');

                }
            });

            $(wrap).on('click', '.removebtn', function(e) {
                e.preventDefault();
                $(this).closest('.remove').remove();
                x--;
            });


        });
    </script>



    @endsection