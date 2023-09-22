@extends('layouts.app')

@section('title')

    Available Stock
    
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
                    <h1 class="page-header"><i class="fa fa-list-alt"></i> Available Stock <div class="action pull-right">
                            <a href="{{ route('add_stock') }}" class="btn btn-primary"><i
                                    class="fa fa-plus"></i> Add New</a>
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

                    <div class="table-responsive">

                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>

                                <tr>
                                    
                                    <th>Product Name</th>
                                    <th>Available Stock</th>

                                </tr>

                            </thead>
                            <tbody>
                                @foreach ($stock as $data)
                                    <tr class="odd gradeX">  

                                            <td> {{$data->title}} </td>                                      
                                            <td> {{$data->gmqty}} </td>
                                    </tr> 
                                @endforeach   

                            </tbody>
                        </table>

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