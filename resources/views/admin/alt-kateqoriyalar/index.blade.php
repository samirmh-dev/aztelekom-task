@extends('layouts.admin')

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
            <a href="{{ route('alt-kateqoriyalar.create') }}"><button class="btn btn-primary"><i class="mr-1 fa fa-plus" aria-hidden="true"></i>Əlavə et</button></a>
        </section>
        <hr>
        <table class="table">
            <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Ad</th>
                <th scope="col">Link</th>
                <th scope="col">Üst Kat.</th>
                <th scope="col">Yaradılıb</th>
                <th scope="col">Dəyişdir</th>
            </tr>
            </thead>
            <tbody>
            @foreach($alt_kateqoriyalar as $index=>$alt_kateqoriya)
                <tr>
                    <th scope="row">{{$index+1}}</th>
                    <td>{{ucfirst($alt_kateqoriya['ad'])}}</td>
                    <td>/{{$alt_kateqoriya['slug']}}</td>
                    {{-- app.php ye elave edilib --}}
                    <td>{{ucfirst(Kateqoriyalar::kateqoriya_adi($alt_kateqoriya['foreign_kateqoriya_id']))}}</td>
                    <td>{{date('M j Y H:i', strtotime($alt_kateqoriya['created_at']))}}</td>
                    <td><a href="{{route('alt-kateqoriyalar.edit',['id'=>$alt_kateqoriya['id']])}}"><button class="btn btn-info"><i class="fa fa-pencil" aria-hidden="true"></i></button></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>
@endsection