<div style='background-color:red;text-align:center;'> <br /><br />This license is going to expire on
    <strong>2023-08-30</strong>, Please contact service provider to continue using the software.
</div>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @stack('meta')

    <title>@yield('title', 'Laravel App')</title>


    <link href="themes/admin/css/bootstrap.min.css" rel="stylesheet">

    <link href="themes/admin/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
    <link href="themes/admin/css/plugins/timeline/timeline.css" rel="stylesheet">

    <link href="themes/admin/css/sb-admin.css" rel="stylesheet">
    <link href="themes/admin/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="i-css/jquery-ui.css">

    @stack('css')

</head>

<body>

    @include('layouts.nav')
    
    <main> 
        @yield('content')
    </main>

    <script src="js/jquery-2.2.3.min.js"></script>
    @stack('js')

</body>
</html>
