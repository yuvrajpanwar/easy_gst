@extends('layouts.app')

@section('title')

    Sale Report
    
@endsection

@push('css')
   
        <style>
            .label {
                margin: 0 20px 0 10px;

                padding: 3px 5px 2px;
                background-color: #F66;
            }

        </style>

@endpush

@section('content')

    <div id="page-wrapper" style="display: inline-block;">
        <div>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><i class="fa fa-list-alt" aria-hidden="true"></i> Sale Reports <div
                            class="action pull-right">
                        </div>
                    </h1>
                </div>
            </div>
            <div class="row">

                <div class="col-md-12">



                    <div class="dataTable_wrapper col-md-12">
                        <div class="col-lg-12" style="margin-bottom: 25px;">
                            <form action="{{route('search_sale_report')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="col-lg-2">
                                    <label for="From date">From date</label>
                                    <input class="text-input form-control datepicker" type="text" name="from_date"
                                        autocomplete="off" id="from_date" value="{{$from_date}}" placeholder="From Date">

                                </div>
                                <div class="col-lg-2">
                                    <label for="to date">To date</label>
                                    <input class="text-input form-control datepicker" type="text" name="to_date"
                                        autocomplete="off" id="to_date" value="{{$to_date}}" placeholder="To Date">


                                </div>
                                <div class="col-lg-2">
                                    <input class="btn col-md-8 btn-primary" id="final_done" type="submit" name="search"
                                        value="Search" style="margin-top: 25px">

                                </div>
                            </form>
                        </div>


                        <div id="table_content">

                            <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline" role="grid">
                                
                                <table class="table table-striped table-bordered dataTable no-footer" id="dataTables-example"
                                    style="font-size: 13px;" aria-describedby="dataTables-example_info">
                                    <thead>
                                        <tr role="row">
                                            <th style="vertical-align: top; width: 44px;" rowspan="1" colspan="1">Invoice Date
                                            </th>
                                            <th style="vertical-align: top; width: 44px;" rowspan="1" colspan="1">Invoice No.
                                            </th>
                                            <th style="vertical-align: top; width: 34px;" rowspan="1" colspan="1">Name</th>
                                            <th style="vertical-align: top; width: 16px;" rowspan="1" colspan="1">SV</th>

                                            @foreach ($products as $product)    
                                                <th style="vertical-align: top; width: 16px;" rowspan="1" colspan="1">{{$product->title}}</th>           
                                            @endforeach

                                            <th style="vertical-align: top; width: 26px;" rowspan="1" colspan="1">5% GST</th>
                                            <th style="vertical-align: top; width: 26px;" rowspan="1" colspan="1">18% GST</th>
                                            <th style="vertical-align: top; width: 55px;" rowspan="1" colspan="1">Discount</th>
                                            <th style="vertical-align: top; width: 48px;" rowspan="1" colspan="1">Total Amount
                                            </th>

                                        </tr>

                                    
                                        

                                    </thead>
                                    <tbody >


                                        @foreach ($merged_data as $row)
                                            
                                            
                                            <tr role="row">
                                                <td style="vertical-align: top; width: 44px;" rowspan="1" colspan="1">{{$row->invice_date}}
                                                </td>
                                                <td style="vertical-align: top; width: 44px;" rowspan="1" colspan="1">{{$row->recipt_no}}
                                                </td>
                                                <td style="vertical-align: top; width: 34px;" rowspan="1" colspan="1">{{$row->name}}</td>
                                                <td style="vertical-align: top; width: 16px;" rowspan="1" colspan="1">{{$row->sv_number}}</td>

                                                @foreach ($products as $product)    
                                                    <td style="vertical-align: top; width: 16px;" rowspan="1" colspan="1">{{is_order($product->id,$merged_order_products[$row->recipt_no])}}</td>           
                                                @endforeach

                                                <td style="vertical-align: top; width: 26px;" rowspan="1" colspan="1">{{is_5gst($merged_order_products[$row->recipt_no])}}</td>
                                                <td style="vertical-align: top; width: 26px;" rowspan="1" colspan="1">{{is_18gst($merged_order_products[$row->recipt_no])}}</td>
                                                <td style="vertical-align: top; width: 55px;" rowspan="1" colspan="1">{{$row->discount}}</td>
                                                <td style="vertical-align: top; width: 48px;" rowspan="1" colspan="1">{{$row->totalprice - $row->discount}}
                                                </td>

                                            </tr>

                                        @endforeach


                                    
                                    </tbody>
                                </table>

                                
                            </div>

                            <button class="btn btn-primary" id="download_excel">Download Excel</button>
                            <form action="{{route('report_export')}}" id="hiddenForm" style="display: none;" method="POST">
                                @csrf
                                <input type="text" id="hiddenField1" name="from_date">
                                <input type="text" id="hiddenField2" name="to_date">
                            </form>
                        </div>


                    </div>


                </div>

            </div>
        </div>
    </div>

@endsection    
   
@push('js')
      

    <script>
        $(document).ready(function () {
            $('#dataTables-example').dataTable({
                "bSort": false
            });

        });
    </script>

    <script>
    $(function () {
        $(".datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
    });
    </script>
    <script>

    $(function () {

        $("#distributer").change(function () {
           
            var date_val = $("#distributer").val();
            
            $("#user_type").val(date_val);
            var start_date = $("#from_date").val();
            var to_date = $("#to_date").val();
            if (start_date == "" && to_date == "") {
                if (date_val == "General") {
                    window.location.replace(`{{ route('receipt_list', ['user_type' => 'General']) }}`);
                }
                if (date_val == "Registered") {
                    window.location.replace(`{{ route('receipt_list', ['user_type' => 'Registered']) }}`);
                }
  
            }

        });


        // Search validation.................................	
        $("#final_done").click(function () {

            var start_date = $("#from_date").val();
            var to_date = $("#to_date").val();
            var type = $("#distributer").val();

            if (start_date == "") { alert("please provide From Date"); return false; }
            else if (to_date == "") { alert("please provide To Date"); return false; }
            else if (type == "") { alert("please Select User Type"); return false; }


        });

        //Excel download validation
        $("#download_excel").click(function () {

            var start_date = $("#from_date").val();
            var to_date = $("#to_date").val();

            if (start_date == "") { alert("please provide From Date"); return false; }
            else if (to_date == "") { alert("please provide To Date"); return false; }
            if(start_date!="" && to_date!=""){
                var hiddenField1 = document.getElementById('hiddenField1');
                var hiddenField2 = document.getElementById('hiddenField2');
    
                hiddenField1.value = start_date;
                hiddenField2.value = to_date;
                document.getElementById('hiddenForm').submit();
            }
        });

        $('#table_content').on('click', '.delete', function () {
            var result = confirm("Confirm to Cancel Order?");
            if (result == true) {
                return true;
            }
            else {
                return false;
            }
        });

    });
    </script>
@endpush