@extends('layouts.admin')

@section('meta')
    <title>Alt kateqoriya dəyişdirilməsi - {{ucfirst($alt_kateqoriya_details['ad'])}}</title>
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

        $('.edit-btn:not(.select-button)').click(function () {
            $(this).parent('label').next('input').attr('disabled',false);
        });

        $('.select-button').click(function () {
            $(this).parent('label').next('select').attr('disabled',false);
        });
    </script>
@endsection

@section('content')
    <section class="py-3">
        <section>
            <form action="{{ route('alt-kateqoriyalar.destroy',['id'=>$alt_kat_id]) }}" method="POST">
                {{csrf_field()}}
                {{method_field('DELETE')}}
                <button class="btn btn-danger"><i class="mr-1 fa fa-times-circle" aria-hidden="true"></i>Sil</button>
            </form>
        </section>
        <hr>
        <form action="{{ route('alt-kateqoriyalar.update',['id'=>$alt_kat_id]) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <section class="form-group">
                <label for="ad">Alt kateqoriya adı <button type="button" class="btn btn-secondary edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></button></label>
                <input maxlength="30" {{ old('ad')?'':'disabled' }} value="{{ old('ad')?old('ad'):$alt_kateqoriya_details['ad'] }}" name="ad" required type="text" class="form-control" id="ad" aria-describedby="adHelp" placeholder="Alt kateqoriya adı yazın">
                <small id="adHelp" class="form-text text-muted">
                    @if ($errors->has('ad'))
                        <b class="text-danger">{{ $errors->first('ad') }}</b>
                    @else
                        Maksimum 30 simvol.
                    @endif
                </small>
            </section>

            <section class="form-group">
                <label for="link">Alt kateqoriya linki <button type="button" class="btn btn-secondary edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></button></label>
                <input maxlength="20" {{ old('slug')?'':'disabled' }} value="{{ old('slug')?old('slug'):$alt_kateqoriya_details['slug'] }}" name="slug" required type="text" class="form-control" id="link" aria-describedby="linkHelp" placeholder="Alt kateqoriya linki yazın">
                <small id="linkHelp" class="form-text text-muted">
                    @if ($errors->has('slug'))
                        <b class="text-danger">{{ $errors->first('slug') }}</b>
                    @else
                        Maksimum 20 simvol. Uyğun olmayan simvollar avtomatik silinəcək.
                    @endif
                </small>
            </section>

            <section class="form-group">
                <label for="ust_kateqoriya">Hansı kateqoriyaya aid olacaq? <button type="button" class="select-button btn btn-secondary edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i></button></label>
                <select class="custom-select w-100" disabled id="ust_kateqoriya" name="ust_kateqoriya" required>
                    @foreach($kateqoriyalar as $index=>$kateqoriya)
                        @if(old('ust_kateqoriya'))
                            @if($kateqoriya['id']==old('ust_kateqoriya'))
                                <option selected value="{{ $kateqoriya['id'] }}">{{ ucfirst($kateqoriya['ad']) }}</option>
                            @else
                                <option value="{{ $kateqoriya['id'] }}">{{ ucfirst($kateqoriya['ad']) }}</option>
                            @endif
                        @else
                            @if($kateqoriya['id']==$alt_kateqoriya_details['foreign_kateqoriya_id'])
                                <option selected value="{{ $kateqoriya['id'] }}">{{ ucfirst($kateqoriya['ad']) }}</option>
                            @else
                                <option value="{{ $kateqoriya['id'] }}">{{ ucfirst($kateqoriya['ad']) }}</option>
                            @endif
                        @endif
                    @endforeach
                </select>
            </section>
            <button type="submit" class="btn btn-success mt-3 w-100">Dəyişdir</button>
        </form>
    </section>
@endsection