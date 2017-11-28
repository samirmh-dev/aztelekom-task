@extends('layouts.admin')

@section('meta')
    <title>Kateqoriya dəyişdirilməsi - {{ucfirst($kateqoriya_details['ad'])}}</title>
@endsection

@section('custom-js')
    <script type="text/javascript">
        //linkin deyisdirilmesi
        $.fn.link_duzelt=function(){
            var herifler={
                "ı":"i",
                "I":"i",
                "ə":"e",
                "Ə":"e",
                "ş":"s",
                "Ş":"s",
                "ö":"o",
                "Ö":"o",
                "ü":"u",
                "Ü":"u",
                "ç":"c",
                "Ç":"c",
                "ğ":"g",
                "Ğ":"g"
            };
            var yeni_link=$(this).val().trim().toLowerCase();
            yeni_link=$.map(yeni_link.split(''),function (str) {
                return herifler[str] || str;
            }).join('');
            yeni_link=yeni_link.replace(/[^A-Za-z0-9 ]/g,'').replace(/\s/g,'_');
            return yeni_link;
        };

        $('input[name=slug]').on('keyup',function(){
            $(this).val($(this).link_duzelt());
        });

        $('.edit-btn').click(function () {
            $(this).parent('label').next('input').attr('disabled',false);
        });
    </script>
@endsection

@section('content')
    <section class="py-3">
        <section>
            <form action="{{ route('kateqoriyalar.destroy',['id'=>$kat_id]) }}" method="POST">
                {{csrf_field()}}
                {{method_field('DELETE')}}
                <button class="btn btn-danger"><i class="mr-1 fa fa-times-circle" aria-hidden="true"></i>Sil</button>
            </form>
        </section>
        <hr>
        <form action="{{ route('kateqoriyalar.update',['id'=>$kat_id]) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <section class="form-group">
                <label for="ad">Kateqoriya adı <button type="button" class="btn btn-secondary edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></button></label>
                <input maxlength="30" {{ old('ad')?'':'disabled' }} value="{{ old('ad')?old('ad'):$kateqoriya_details['ad'] }}" name="ad" required type="text" class="form-control" id="ad" aria-describedby="adHelp" placeholder="Kateqoriya adı yazın">
                <small id="adHelp" class="form-text text-muted">
                    @if ($errors->has('ad'))
                        <b class="text-danger">{{ $errors->first('ad') }}</b>
                    @else
                        Maksimum 30 simvol.
                    @endif
                </small>
            </section>

            <section class="form-group">
                <label for="link">Kateqoriya linki <button type="button" class="btn btn-secondary edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></button></label>
                <input maxlength="20" {{ old('slug')?'':'disabled' }} value="{{ old('slug')?old('slug'):$kateqoriya_details['slug'] }}" name="slug" required type="text" class="form-control" id="link" aria-describedby="linkHelp" placeholder="Kateqoriya linki yazın">
                <small id="linkHelp" class="form-text text-muted">
                    @if ($errors->has('slug'))
                        <b class="text-danger">{{ $errors->first('slug') }}</b>
                    @else
                        Maksimum 20 simvol. Uyğun olmayan simvollar avtomatik silinəcək.
                    @endif
                </small>
            </section>

            <section class="form-group">
                <label class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
                    <input type="checkbox" name="alt_kateqoriya" {{ $kateqoriya_details['alt_kateqoriya']?'checked':'' }} class="custom-control-input">
                    <span class="custom-control-indicator"></span>
                    <span class="custom-control-description">Alt kateqoriya olacaq</span>
                </label>
            </section>

            <button type="submit" class="btn btn-success mt-3 w-100">Dəyişdir</button>
        </form>
    </section>
@endsection