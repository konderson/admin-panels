<!DOCTYPE html>
<html lang="en">
<head>
    <title>Matrix Admin</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{asset('css/frontend_css/bootstrap.min.css')}}" />

    <link rel="stylesheet" href="{{asset('css/frontend_css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/frontend_css/bootstrap-responsive.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/frontend_css/fullcalendar.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/frontend_css/matrix-style.css')}}" />
    <link rel="stylesheet" href="{{asset('css/frontend_css/matrix-media.css')}}" />
    <link rel="stylesheet" href="{{asset('css/frontend_css/select2.css')}}" />
    <link rel="stylesheet" href="{{asset('css/frontend_css/uniform.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css "/>

     <link href=" {{asset('font-awesome/css/font-awesome.css')}}" rel="stylesheet" />

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
</head>
<body>

@include('admin_layout.header')

@include('admin_layout.sidebar')

@yield('content')

@include('admin_layout.footer')

<script src="{{asset('js/frontend_js/jquery.min.js')}}"></script>
<script src="{{asset('js/frontend_js/jquery.ui.custom.js')}}"></script>
<script src="{{asset('js/frontend_js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/frontend_js/jquery.uniform.js')}}"></script>
<script src="{{asset('js/frontend_js/select2.min.js')}}"></script>
<script src="{{asset('js/frontend_js/jquery.validate.js')}}"></script>
<script src="{{asset('js/frontend_js/matrix.js')}}"></script>
<script src="{{asset('js/frontend_js/matrix.form_validation.js')}}"></script>
<script src="{{asset('js/frontend_js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/frontend_js/matrix.tables.js')}}"></script>
<script src="{{asset('js/frontend_js/AlertSweet.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>

<script type="text/javascript">
    // This function is called from the pop-up menus to transfer to
    // a different page. Ignore if the value returned is a null string:
    function goPage (newURL) {

        // if url is empty, skip the menu dividers and reset the menu selection to default
        if (newURL != "") {

            // if url is "-", it is this page -- reset the menu:
            if (newURL == "-" ) {
                resetMenu();
            }
            // else, send page to designated URL
            else {
                document.location.href = newURL;
            }
        }
    }

    // resets the menu selection upon entry to this page:
    function resetMenu() {
        document.gomenu.selector.selectedIndex = 2;
    }
</script>
</body>
</html>
