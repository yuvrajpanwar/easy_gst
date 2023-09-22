@extends('layouts.app')

@section('title')

    General Report
    
@endsection

@push('css')
   
        <style>
            .label {
                margin: 0 20px 0 10px;

                padding: 3px 5px 2px;
                background-color: #F66;
            }
        </style>
        <style>
            .comman_box
            {
                color:white; text-align: center; margin-bottom:50px; height:120px; padding: 20px; 
            }
        </style>

@endpush

@section('content')
        
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>Reports <div
                        class="action pull-right">

                    </div>
                </h1>
            </div>
        </div>
        <div class="row">

            <div class="col-md-12">



                <div class="dataTable_wrapper">

                    <div id="table_content">
                        <div class="col-lg-12">

                            <div class="col-lg-12">

                                <div class="col-lg-12 comman_box" style="background: #27a9e3;">
                                    <h3>Sale(Today) : {{$sale_today}}</h3>
                                </div>

                                <div class="col-lg-12 comman_box" style="background: #2255a4;">
                                    <h3>Sale(This Month) : {{$sale_this_month}}</h3>
                                </div>

                                <div class="col-lg-12 comman_box" style="background: #f74d4d;">
                                    <h3>Sale(Till Date) : {{$sale_till_date}}</h3>
                                </div>

                            </div>

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

        $(document).ready(function () {
            $('body').on("click", ".switch-input", function () {
                var bin = 0;
                if ($(this).is(':checked')) {
                    bin = 1;
                }
                $.ajax({
                    url: "index.php?component=products&action=active",
                    type: "POST",
                    data: { id: $(this).data("id"), value: bin },
                    success: function (result) {
                       
                    },
                    error: function () {
                        
                    }
                });
            });

        });

    </script>

@endpush