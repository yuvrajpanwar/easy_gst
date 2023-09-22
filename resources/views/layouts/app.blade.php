
@if (warning()) 

    <div style='background-color:red;text-align:center;color:white;'> <br /><br />This license is going to expire on
        <strong>2023-09-30</strong>, Please contact service provider to continue using the software.
    </div>

@endif
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @stack('meta')

    <title>@yield('title', 'Laravel App')</title>


    <link href="{{asset('public/themes/admin/css/bootstrap.min.css')}}"  rel="stylesheet">

    <link href='{{ asset("public/themes/admin/css/plugins/morris/morris-0.4.3.min.css") }}'  rel="stylesheet">
    <link href='{{ asset("public/themes/admin/css/plugins/timeline/timeline.css") }}'  rel="stylesheet">

    <link href='{{ asset("public/themes/admin/css/sb-admin.css") }}'  rel="stylesheet">
    <link href='{{ asset("public/themes/admin/css/style.css") }}'  rel="stylesheet">
    <link rel="stylesheet" href='{{ asset("public/i-css/jquery-ui.css") }}' >

    @stack('css')

</head>

<body>

    @include('layouts.nav')
    
    <main> 
        @yield('content')
    </main>

    <script src="{{asset('public/js/jquery-2.2.3.min.js')}}"></script>

    <script src="{{asset('public/themes/admin/js/jquery-1.10.2.js')}}"></script>
    <script src="{{asset('public/themes/admin/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/themes/admin/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
    <script src="{{asset('public/themes/admin/js/865ee126eb.js')}}"></script>    
    <script src="{{asset('public/themes/admin/js/plugins/dataTables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('public/themes/admin/js/plugins/dataTables/dataTables.bootstrap.js')}}"></script>  
    <script src="{{asset('public/themes/admin/js/sb-admin.js')}}"></script>
    <script src="{{asset('public/plugins//tinymce/tinymce.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/plugins/uploadify/jquery.uploadify.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('public/i-js/jquery-ui.js') }}"></script>
    

    @stack('js')

</body>
</html>
