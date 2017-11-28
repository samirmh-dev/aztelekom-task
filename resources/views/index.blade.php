@extends('layouts.master')

@section('content')
    <section class="py-5">
        @guest
            <a href="{{ route('login') }}">Daxil ol</a>
            <a href="{{ route('register') }}">Qeydiyyat</a>
        @endguest
        @auth
            @if(Auth::user()->checkadmin())
                    <a href="{{ route('admin.index') }}">Admin paneli</a><br>
            @endif
            <a href='' onclick="event.preventDefault();$(this).next('form').submit();">Çıxış</a>
            <form action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        @endauth

        <br><br>

        <h5>Links for produts: </h5>

        @foreach($products as $index=>$product)
            <a href="{{route('product_page',['id'=>$product['id']])}}">{{($index+1).')&nbsp;'.$product['title']}}</a>
            <br>
        @endforeach
    </section>
@endsection