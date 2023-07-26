<!DOCTYPE html>
<html>
    <head>
        <title>Laravel-crud@yield('title')</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
    </head>
    <body>
        <h1>User Profile Application</h1>
        {{-- @section('sidebar')
            This is the master sidebar. --}}
        @show
 
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>