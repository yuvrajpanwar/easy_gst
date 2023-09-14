@extends('layouts.app')

@section('title')
    Company Details
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
                <h1 class="page-header"><i class="fa fa-folder fa-fw"></i> Billing Address

                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-plus-circle fa-fw"></i> Update address
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">

                        <form id="form" action="{{ route('update_company_details')}}" method="post" enctype="multipart/form-data"
                            class="form-horizontal">
                            @csrf
                            <div class="form-group">
                                <label for="text1" class="control-label col-lg-4">Company Name</label>
                                <div class="col-lg-8">
                                    <input class="text-input form-control" name="title" value="" id="txttitle"
                                        type="text" /> (Ex. ABC Series)
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="text1" class="control-label col-lg-4">GST Number</label>
                                <div class="col-lg-8">
                                    <input class="text-input form-control" name="gst_num" value="" id="txttitle"
                                        type="text" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="text1" class="control-label col-lg-4">Company Address</label>
                                <div class="col-lg-8">
                                    <input class="text-input form-control" name="address" value="" id="txttitle"
                                        type="text" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="text1" class="control-label col-lg-4">City</label>
                                <div class="col-lg-8">
                                    <input class="text-input form-control" name="city" value="" id="txttitle"
                                        type="text" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="text1" class="control-label col-lg-4">State and Zipcode</label>
                                <div class="col-lg-8">
                                    <input class="text-input form-control" name="statezip" value="" id="txttitle"
                                        type="text" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="text1" class="control-label col-lg-4">Country</label>
                                <div class="col-lg-8">
                                    <input class="text-input form-control" name="country" value="" id="txttitle"
                                        type="text" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="text1" class="control-label col-lg-4">Phone</label>
                                <div class="col-lg-8">
                                    <input class="text-input form-control" name="phone" value="" id="txttitle"
                                        type="text" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="text1" class="control-label col-lg-4">Email Id</label>
                                <div class="col-lg-8">
                                    <input class="text-input form-control" name="email" value="" id="txttitle"
                                        type="text" />
                                </div>
                            </div>

                            <p>
                            <div class="col-lg-4"></div>
                            <input class="btn col-md-8 btn-primary" type="submit" name="add" value="Add" />
                            </p>
                        </form>
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

    <!-- Page-Level Demo Scripts - Dashboard - Use for reference -->

    <script>
        $(document).ready(function () {
            $('#dataTables-example').dataTable({
                "bSort": false
            });

        });
    </script>
    <script>
    </script>
    
    <script src="{{ asset('public/plugins//tinymce/tinymce.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/plugins/uploadify/jquery.uploadify.min.js') }}" type="text/javascript"></script>
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

    <script type="text/javascript">
        $(function () {
            var clickedOnce = false;
            $(".main_category").change(function () {
                var category_id = $(".main_category").val();
                var data = 'cat=' + category_id;
                if (category_id) {
                    $.ajax({
                        //this is the php file that processes the data and send mail
                        url: 'index.php?component=products&action=fetch_sub_category',
                        type: "POST",
                        data: data,
                        cache: false,
                        success: function (html) {
                            //alert(html);
                            if (html != "") {
                                $('#sub_category').html(html);

                            }

                        }
                    });//End Ajax
                }


            });

            $("#final_done").click(function () {

                if (clickedOnce) {
                    return false;
                }

                var name = $(".product_name").val();
                var price = $("#price").val();
                var proqty = $("#proqty").val();
                var cgst_tax = $("#cgst_tax").val();
                var sgst_tax = $("#sgst_tax").val();

                if (name == "") { alert("please provide Product Name"); return false; }
                else if (price == "") { alert("please provide Product Price"); return false; }
                else if (cgst_tax == "") { alert("please provide CGST"); return false; }
                else if (sgst_tax == "") { alert("please provide SGST"); return false; }

                clickedOnce = true;
                return true;
            });
        });
    </script>

    
@endpush