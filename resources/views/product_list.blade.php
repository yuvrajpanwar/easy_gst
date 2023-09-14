@extends('layouts.app')

@section('title')

    Product List
    
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
                    <h1 class="page-header"><i class="fa fa-list-alt"></i> Product List <div class="action pull-right">
                            <a href="{{ route('add_product') }}" class="btn btn-primary"><i
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
                                    
                                    <th>Title</th>
                                    <th>HSN Code</th>
                                    <th>Price</th>
                                    <th>CGST %</th>
                                    <th>SGST %</th>
                                    <th>Option</th>
                                </tr>

                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr class="odd gradeX">  

                                            <td>{{$product->title}}</td>                                      
                                            <td>{{$product->hsn_code}}</td>
                                            <td>{{$product->price}}</td>
                                            <td>{{$product->cgst_tax}}</td>
                                            <td>{{$product->sgst_tax}}</td>
                                            <td class="center">
                                                <a href="{{route('edit_product',['id'=>$product->id])}}" class="btn btn-sm"
                                                    title="Edit"><i class="glyphicon glyphicon-pencil"></i></a>
                                                <a onclick="return confirm('Are you sure Delete?')"
                                                    href="{{route('delete_product',['id'=>$product->id])}}" class="btn btn-sm"
                                                    title="Delete"><i class="glyphicon glyphicon-remove"></i></a>
                                            </td>
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