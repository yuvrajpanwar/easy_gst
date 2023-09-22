@extends('layouts.app')

@section('title')
    Add Stock
@endsection

  
@push('css')
        
    <style>
        .label {
            margin: 0 20px 0 10px;
            padding: 3px 5px 2px;
            background-color: #F66;
        }
    </style> 

    <link href="{{ asset('public/themes/admin/css/chosen.min.css')}} " rel="stylesheet">

@endpush

@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><i class="fa fa-plus-square"></i> Add Stock
                    <div class="action pull-right">
                        <a href="{{route('available_stock')}}" class="btn btn-primary btn-small"><i
                                class="fa fa-list"></i> List </a>
                    </div>
                </h1>
            </div>
        </div>
        <form id="form" action="{{route('create_stock')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
            @csrf
            <div class="row">
                <div class="col-md-9">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-plus-circle fa-fw"></i> Add Level
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                            <div class="form-group">
                                <div class="col-md-9">
                                    <label>Product</label>
                                    <select data-placeholder="Choose a country..." name="prid" id="prid"
                                        class="form-control chosen-select">
                                        <option selected disabled value="">Choose Product Name</option>

                                        @foreach ($products as $product)
                                            <option value="{{$product->id}}">{{$product->title}}</option>
                                        @endforeach

                                    </select>
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-4">
                                    <label>Invoice No.</label>
                                    <input type="text" class="form-control" name="in_number" id="in_number" />
                                </div>
                                <div class="col-lg-4">
                                    <label>Invoice Date</label>
                                    <input type="text" class="form-control datepicker" name="invoice_date"
                                        id="invoice_date" value=""/>
                                </div>
                                <div class="col-lg-4">
                                    <label>Party Name</label>
                                    <input type="text" class="form-control" name="name" id="name" />
                                </div>
                            </div>
                            <div class="form-group">

                                <div class="col-lg-2">
                                    <label>Qty</label>
                                    <input type="number" class="form-control" name="gmqty" id="gmqty" />
                                </div>
                                <div class="col-lg-2">
                                    <label>Unit</label>
                                    <select name="unit" class="form-control">
                                        <option value="QTY">QTY</option>

                                    </select>
                                </div>
                                <div class="col-lg-2">
  
                                    <input type="hidden" class="form-control" name="base_qty" />
                                </div>

                            </div>




                            <div class="form-group">


                            </div>

                            <p>
                            <div class="col-lg-4"></div>
                            <input class="btn col-md-8 btn-primary" type="submit" id="final_done" name="add"
                                value="Add" />
                            </p>

                        </div>
                    </div>

                </div>

            </div>
        </form>

    </div>


@endsection     

@push('js')


    <script src="{{ asset('public/themes/admin/js/chosen.jquery.js') }}"></script>
    <script
        type="text/javascript"> $(function () { $(".chosen-select").chosen({ no_results_text: "Oops, nothing found!" }); });
    </script>


    
    <link rel="stylesheet" type="text/css" href="{{ asset('public/plugins/uploadify/uploadify.css') }}">
    <script>
        $('#mediaModel').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this);
            $('#file_upload').uploadify({
                'formData': {
                    'timestamp': '',
                    'token': '6b79a77180e9ec3a7ca351ebe54641a2'
                },
                'swf': 'plugins/uploadify/uploadify.swf',
                'uploader': 'plugins/uploadify/uploadmedia.php',
                'onUploadSuccess': function (file, data, response) {
                    modal.find('#mediafiles').prepend(data);
                }
            });
            $.ajax({
                type: "POST",
                url: "plugins/media/load.php",
                data: {}
            })
                .done(function (msg) {
                    modal.find('#mediafiles').html(msg);
                });
        });

        $('#mediafiles').on('click', '.media-img', function (event) {
            var name = $(this).data("name");
            tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '<img src="' + name + '" />');
            $('#mediaModel').modal('hide')
        });
        tinymce.init({
            selector: "textarea#elm1",
            theme: "modern",
            width: '100%',
            height: 300,
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template paste textcolor"
            ],
            content_css: "css/content.css",
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
            style_formats: [
                { title: 'Bold text', inline: 'b' },
                { title: 'Red text', inline: 'span', styles: { color: '#ff0000' } },
                { title: 'Red header', block: 'h1', styles: { color: '#ff0000' } },
                { title: 'Example 1', inline: 'span', classes: 'example1' },
                { title: 'Example 2', inline: 'span', classes: 'example2' },
                { title: 'Table styles' },
                { title: 'Table row 1', selector: 'tr', classes: 'tablerow1' }
            ],
            convert_urls: false
        }); 
    </script>

    <script>


        $(function () {

            var clickedOnce = false;

            $("#final_done").click(function () {

                if (clickedOnce) {
                    return false;
                }

                var invoice_date = $("#invoice_date").val();
                var product = $("#prid option:selected").val();
                var invoice_nember = $("#in_number").val();
                var name = $("#name").val();
                var qty = $("#gmqty").val();
                console.log(product);
                if (product == "") {

                    alert("Please select product");
                    return false;

                }
                else if (invoice_nember == "") {
                    alert("please Provide Invoice Number");
                    return false;
                }
                else if (invoice_date == "") {
                    alert("please Select Invoice Date");
                    return false;
                }
                else if (name == "") {
                    alert("please Provide Vendor Name");
                    return false;
                }
                else if (qty == "") {
                    alert("please Provide Product Quantity");
                    return false;
                }

                clickedOnce = true;
                return true;

            });




        });

    </script>

    <script>
        $( function() {
            
        $( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
        
        
        } );
    </script>



    
@endpush