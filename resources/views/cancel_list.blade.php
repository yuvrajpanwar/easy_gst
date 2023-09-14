@extends('layouts.app')

@section('title')

    Cancel Receipt List
    
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
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><i class="fa fa-list-alt"></i>Cancel Receipt List <div class="action pull-right">
                        <!--<a href="index.php?component=consignment&action=add" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>-->
                    </div>
                </h1>
            </div>
        </div>

        <div class="row">

            <div class="col-md-12">

                
                @if(session()->has('success'))
                    <div class="notification alert alert-success  alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                                <div>
                                    {!! session('success') !!}
                                </div>
                    </div>
                @endif

                <div class="dataTable_wrapper">
                    <div class="col-lg-12" style="margin-bottom: 25px;">
                        <form action="{{route('search_cancel_receipts')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="col-lg-2">
                                
                                <input class="text-input form-control datepicker" type="text" name="from_date"
                                    autocomplete="off" id="from_date" value="" placeholder="From Date" />

                            </div>
                            <div class="col-lg-2">
                                
                                <input class="text-input form-control datepicker" type="text" name="to_date"
                                    autocomplete="off" id="to_date" value="" placeholder="To Date" />
                                <input type="hidden" name="user_type" id="user_type" value="" />

                            </div>
                            <div class="col-lg-2">
                                <input class="btn col-md-8 btn-primary" id="final_done" type="submit" name="search"
                                    value="Search" />

                            </div>
                        </form>

                    </div>
                    <div class="form-group dataTables_filter">
                        <select name="distributer" id="distributer" name="user" class="form-control input-sm">
                            <option value="">User Type</option>

                            <option value="General">General</option>
                            <option value="Registered">Registered</option>

                        </select>
                    </div>
                    <div id="table_content">
                        <table class="table table-striped table-bordered" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>Invoice No.</th>
                                    <th style="width:150px;">Name</th>
                                    <th>No. Item</th>
                                    <th>Discount</th>
                                    <th>Amount</th>
                                    <th>MOD</th>
                                    <th>Invoice Date</th>
                                    <th style="width:200px;">Remark</th>
                                    <th>Invoice</th>
                                </tr>
                            </thead>
                            <tbody id="ebdy_content">
                                @forelse  ($data as $details)
                                <tr>
                                    <form action="" method="post">                 
                                        <td>{{$details->recipt_no}}</td>
                                        <td>{{$details->name}}</td>
                                        <td>{{$details->totalitem}}</td>
                                        <td>{{$details->discount}}</td>
                                        <td>{{$details->totalprice}}</td>
                                        <td>{{$details->payment_mode}}</td>
                                        <td>{{$details->invice_date}}</td>
                                        <td style="width:200px;">{{$details->order_remark}}</td>

                                        <td class="center">
                                                 <a href="{{ route('view_receipt', ['user_type' => $user_type, 'id' => $details->id]) }}"
                                                class="btn btn-primary" target="_blank" title="Details">View</a>
                                           
                                        </td>
                                       
                                    </form>
                                </tr>
                                        @empty
                                            
                                        @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>

        </div>
        
    </div>

@endsection   
   
@push('js')
      
  
    <!-- Core Scripts - Include with every page -->
    <script src="{{ asset('public/themes/admin/js/jquery-1.10.2.js') }}"></script>
    <script src="{{ asset('public/themes/admin/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/themes/admin/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('public/themes/admin/js/865ee126eb.js') }}"></script>
    <!-- Page-Level Plugin Scripts - Tables -->
    <script src="{{ asset('public/themes/admin/js/plugins/dataTables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('public/themes/admin/js/plugins/dataTables/dataTables.bootstrap.js') }}"></script>
    <!-- SB Admin Scripts - Include with every page -->
    <script src="{{ asset('public/themes/admin/js/sb-admin.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('#dataTables-example').dataTable({
                "bSort": false
            });

        });
    </script>

<script src="{{ asset('public/i-js/jquery-ui.js') }}"></script>
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
                    window.location.replace(`{{ route('cancel_list', ['user_type' => 'General']) }}`);
                }
                if (date_val == "Registered") {
                    window.location.replace(`{{ route('cancel_list', ['user_type' => 'Registered']) }}`);
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