@extends('layouts.admin')

@section('meta')
    <title>Yeni alt kateqoriya</title>
@endsection

@section('custom-css')
    <style type="text/css">
        button[type=submit]{
            font-weight: 500;
            font-size: 1.1rem;
        }
    </style>
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
        })
    </script>
@endsection

@section('content')
    <section class="py-3">
        <form action="{{ route('alt-kateqoriyalar.store') }}" method="post">
            {{csrf_field()}}
            <section class="form-group">
                <label for="ad">Alt kateqoriya adı</label>
                <input maxlength="30" name="ad" value="{{ old('ad') }}" required type="text" class="form-control" id="ad" aria-describedby="adHelp" placeholder="Kateqoriya adı yazın">
                <small id="adHelp" class="form-text text-muted">
                    @if ($errors->has('ad'))
                        <b class="text-danger">{{ $errors->first('ad') }}</b>
                    @else
                        Maksimum 30 simvol.
                    @endif
                </small>
            </section>

            <section class="form-group">
                <label for="link">Alt kateqoriya linki</label>
                <input maxlength="20" name="slug" value="{{ old('slug') }}" required type="text" class="form-control" id="link" aria-describedby="linkHelp" placeholder="Kateqoriya linki yazın">
                <small id="linkHelp" class="form-text text-muted">
                    @if ($errors->has('slug'))
                        <b class="text-danger">{{ $errors->first('slug') }}</b>
                    @else
                        Maksimum 20 simvol. Uyğun olmayan simvollar avtomatik silinəcək.
                    @endif
                </small>
            </section>

            <section class="form-group">
                <label for="ust_kateqoriya">Hansı kateqoriyaya aid olacaq?</label>
                <select class="custom-select w-100" id="ust_kateqoriya" name="ust_kateqoriya" required>
                    <option {{ old('ust_kateqoriya')?:'selected' }} disabled value="">Üst kateqoriya seçin</option>
                    @foreach($kateqoriyalar as $kateqoriya)
                        @if($kateqoriya['id']==old('ust_kateqoriya'))
                            <option selected value="{{ $kateqoriya['id'] }}">{{ ucfirst($kateqoriya['ad']) }}</option>
                        @else
                            <option value="{{ $kateqoriya['id'] }}">{{ ucfirst($kateqoriya['ad']) }}</option>
                        @endif
                    @endforeach
                </select>
            </section>

            <button type="submit" class="btn btn-success mt-3 w-100">Əlavə et</button>
        </form>
    </section>
@endsection