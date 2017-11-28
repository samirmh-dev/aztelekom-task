@extends('layouts.admin')

@section('meta')
    <title>Mallar</title>
@endsection

@section('custom-css')
    <style type="text/css">
        td,th{
            vertical-align: middle!important;
        }
    </style>
@endsection

@section('content')
    <section class="py-3">
        <section>
            <a href="{{ route('product.create') }}"><button class="btn btn-primary"><i class="mr-1 fa fa-plus" aria-hidden="true"></i>Əlavə et</button></a>
        </section>
        <hr>
        <table class="table">
            <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Ad</th>
                <th scope="col">Kod</th>
                <th scope="col">Stokda</th>
                <th scope="col">Qiymet</th>
                <th scope="col">Keçid</th>
                <th scope="col">Dəyişdir</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $index=>$product)
                <tr>
                    <th scope="row">{{$index+1}}</th>
                    <td>{{ucfirst($product['title'])}}</td>
                    <td>#{{$product['code']}}</td>
                    <td>{{$product['stock']?'Var':'Yox'}}</td>
                    <td>${{ round($product['price'],2) }}</td>
                    <td><a href="{{route('product.show',['id'=>$product['id']])}}"><button class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i></button></a></td>
                    <td><a href="{{route('product.edit',['id'=>$product['id']])}}"><button class="btn btn-info"><i class="fa fa-pencil" aria-hidden="true"></i></button></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>
@endsection