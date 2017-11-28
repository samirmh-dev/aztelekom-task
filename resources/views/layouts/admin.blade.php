<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('meta')
    <link rel="stylesheet" href="{{asset('src/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('src/font-awesome/css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('src/css/admin.min.css')}}">
    @yield('custom-css')
</head>
<body>
<section id="solpanel">
    <section id="logo">
        <a href="{{route('admin.index')}}">bonfire</a>
        <section id="hamburgermenyusu">
            <span></span>
            <span></span>
            <span></span>
        </section>
    </section>
    <ul id="menyu">
        <li><a href="{{route('kateqoriyalar.index')}}"><i class="fa fa-list-alt" aria-hidden="true"></i>Kateqoriyalar</a></li>
        <li><a href="{{route('alt-kateqoriyalar.index')}}"><i class="fa fa-list-alt" aria-hidden="true"></i>Alt-Kateqoriyalar</a></li>
        <li><a href="{{route('product.index')}}"><i class="fa fa-dropbox" aria-hidden="true"></i>Mallar</a></li>
    </ul>
</section>
<section id="sagpanel">
    <section id="basliq">
        <section style="display: flex; align-items:center;">
            <a href="{{route('index')}}" ><i class="fa fa-home " aria-hidden="true"></i> Səhifəyə qayıt</a>
        </section>
        <a onclick="event.preventDefault();$(this).next('form').submit();"><i class="fa fa-sign-out" aria-hidden="true"></i>Çıxış</a>
        <form action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </section>
    @yield('content')
</section>
    <script type="text/javascript" src="{{asset('src/js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('src/js/bootstrap.bundle.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('src/js/admin.js')}}"></script>
    @yield('custom-js')
</body>
</html>