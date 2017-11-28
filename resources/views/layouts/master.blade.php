<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @yield('custom-meta')
        <link rel="stylesheet" href="{{asset('src/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('src/font-awesome/css/font-awesome.css')}}">
        <link rel="stylesheet" href="{{asset('src/css/style.min.css')}}">
        @yield('custom-css')
    </head>
    <body>
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.10';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        @include('includes.header')
        @yield('content')
        @include('includes.footer')
        <script type="text/javascript" src="{{asset('src/js/jquery.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('src/js/bootstrap.bundle.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('src/js/script.js')}}"></script>
        <script
                type="text/javascript"
                async defer
                src="//assets.pinterest.com/js/pinit.js"
        ></script>
        @yield('custom-js')
    </body>
</html>