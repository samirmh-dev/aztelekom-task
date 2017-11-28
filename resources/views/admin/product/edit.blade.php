@extends('layouts.admin')

@section('meta')
    <title>Dəyişdir</title>
@endsection

@section('custom-css')
    <link rel="stylesheet" href="{{asset('src/css/jquery.tag-editor.css')}}">
    <style type="text/css">
        button[type=submit]{
            font-weight: 500;
            font-size: 1.1rem;
        }
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        textarea{
            resize: none;
        }
        .c-color-swatch {
            display: flex;
            /*width: 100%;*/
            table-layout: fixed;
        }
        .c-color-swatch__item {
            display: table-cell;
            height: 29px;
            line-height: 29px;
            text-align: center;
            user-select: none;
            position: relative;
            transition: transform .25s;
            width: calc(100% / 10);
            margin-bottom:0;
            z-index: 2
        }
        .c-color-swatch__item:hover {
            z-index: 3;
            transform: scale(1.3);
        }
        input[type=checkbox]{
            position: absolute;
        }
        .c-color-swatch [type="checkbox"]:checked + label:after {
            content: '\f00c';
            font-size: 9px;
            vertical-align: top;
            color: #fff;
            font-family: FontAwesome;
        }
        .custom-file-control:before {
            content: "Choose file";
        }
        .custom-file-control:empty::after {
            content: attr(data-before);
            width: calc(100% - 60px);
            height: 20px;
            display: block;
            overflow: hidden;
        }
        #sekiller > section {
            margin-bottom: .5rem;
        }
        #sekiller > section a{
            text-decoration: underline;
            font-weight:bold;
            cursor: pointer;
        }

        img{
            width: 65%;
            height: auto;
        }
    </style>
@endsection

@section('custom-js')
    <script type="text/javascript" src="{{asset('src/js/jquery.caret.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('src/js/jquery.tag-editor.min.js')}}"></script>
    <script type="text/javascript">
        $('#tags').tagEditor({
            initialTags: [
                @if(old('tags_hidden'))
                    @foreach(explode(',',old('tags_hidden')) as $tags)
                        '{{$tags}}',
                    @endforeach
                @else
                    @foreach($product_details['tags'] as $tag)
                        '{{$tag['tag']}}',
                    @endforeach
                @endif
            ],
            placeholder: 'Tags',
            onChange: function(field, editor, tags) {
                $.each(tags,function (index,value) {
                    $('input[name=tags_hidden]').val((tags.length ? tags.join(',') : '----'));
                });
            },
            beforeTagDelete: function(field, editor, tags, val) {
                var input = $('input[name=tags_hidden]');
                var _tags=input.val();
                _tags=_tags.replace(val, '');
                input.val(_tags);
            }
        });


        $('#size').tagEditor({
            initialTags: [
                @if(old('size_hidden'))
                    @foreach(explode(',',old('size_hidden')) as $olcu)
                        '{{$olcu}}',
                    @endforeach
                @else
                    @foreach($product_details['sizes'] as $size)
                        '{{$size['olcu']}}',
                    @endforeach
                @endif
            ],
            placeholder: 'Sizes',
            onChange: function(field, editor, tags) {
                $.each(tags,function (index,value) {
                    $('input[name=size_hidden]').val((tags.length ? tags.join(',') : '----'));
                });
            },
            beforeTagDelete: function(field, editor, tags, val) {
                var input = $('input[name=size_hidden]');
                var _tags=input.val();
                _tags=_tags.replace(val, '');
                input.val(_tags);
            }
        });

        //bazada olan kateqoriyanin avtomatik secilmesi
        $('select[name=kateqoriya] option[value={{ $product_details['kateqoriya'] }}]').attr('selected','selected');

        $(document).ready(function () {
            //bazadan olan renglerin avtomatik secilmesi
            @foreach($product_details['colors'] as $color)
                $('input[type=checkbox][value={{ $color['reng'] }}]').attr('checked','checked');
            @endforeach
        });



        $(function(){

            var requiredCheckboxes = $(':checkbox[required]:not(.custom-control-input)');

            //bazadan goturulen renglerin yerlesdirilmesinden sonra required`lerin silinmesi ucun.
            //altda eyni emeliyyati change eventi ucunde yazmisam. Eger yeni reng secilse ve ya movcud reng silinse ise dusecek
            if(requiredCheckboxes.is(':checked')) {
                requiredCheckboxes.removeAttr('required');
            }

            else {
                requiredCheckboxes.attr('required', 'required');
            }

            requiredCheckboxes.change(function(){

                if(requiredCheckboxes.is(':checked')) {
                    requiredCheckboxes.removeAttr('required');
                }

                else {
                    requiredCheckboxes.attr('required', 'required');
                }
            });

        });


        var image_index={{count($product_details['photos'])}};
        var new_input;

        $('button.add_image').click(function () {
            new_input=' <section class="col-md-6">\n' +
                '<label for="">'+ ++image_index +') <a onclick="remove_input(this)">Sil &times;</a></label>\n' +
                '<label class="custom-file col-12">\n' +
                '<input type="file" id="file" onchange="passport_file_changed(this)" required name="sekil[]" class="custom-file-input">\n' +
                '<span class="custom-file-control" data-before="No file choosen"></span>\n' +
                '</label>\n' +
                '</section>';

            $(this).parent('section').next('section').append(new_input);
        });

        function remove_input(e){
            $(e).parent('label').parent('section').remove();
        }

        function passport_file_changed(e){
            $(e).next('span').attr('data-before',$(e).prop('files')[0]['name']);
        }

        $('.image-sil').click(function () {
            $('form').append('<input type="hidden" name="silinecek[]" value="'+$(this).data('image-title')+'">');
            $(this).parent('section').remove();
            image_index--;
            if(image_index==0){
                $('button.add_image').trigger('click').parent('section').next('section').find('a').remove();
            }
        });
    </script>
@endsection

@section('content')
    @php
        $tags_hidden='';
        foreach($product_details['tags'] as $tag){
            $tags_hidden.=$tag['tag'].',';
        }

        $tags_hidden=rtrim($tags_hidden,',');


        $size_hidden='';
        foreach($product_details['sizes'] as $size){
            $size_hidden.=$size['olcu'].',';
        }

        $size_hidden=rtrim($size_hidden,',');
    @endphp
    <section>
        <button type="button" onclick="$(this).next('form').submit();" class="btn btn-danger mt-3"><i class="fa fa-times mr-2" aria-hidden="true"></i>Sil</button>
        <form action="{{route('product.destroy',['id'=>$product_details['id']])}}" method="POST">
            {{csrf_field()}}
            {{method_field('DELETE')}}
        </form>
    </section>
    <hr>
    <section class="py-3">
        <form action="{{ route('product.update',['id'=>$product_details['id']]) }}" method="post" enctype='multipart/form-data'>
            {{csrf_field()}}
            {{method_field('PUT')}}
            <input type="hidden" name="tags_hidden" value="{{old('tags_hidden')?old('tags_hidden'):$tags_hidden}}">
            <input type="hidden" name="size_hidden" value="{{old('size_hidden')?old('tags_hidden'):$size_hidden}}">

            <section class="form-group">
                <label for="title">Title</label>
                <input maxlength="20" name="title" value="{{ old('title')?old('title'):$product_details['title'] }}" required type="text" class="form-control" id="title" aria-describedby="titleHelp" placeholder="Title">
                <small id="titleHelp" class="form-text text-muted">
                    @if ($errors->has('title'))
                        <b class="text-danger">{{ $errors->first('title') }}</b>
                    @else
                        Maksimum 20 simvol.
                    @endif
                </small>
            </section>

            <section class="row">
                <section class="form-group col-md">
                    <label for="price">Price</label>
                    <input maxlength="20" name="price" value="{{ old('price')?old('price'):$product_details['price'] }}" required type="number" class="form-control" id="price" aria-describedby="priceHelp" min="0" placeholder="Price" step="any">
                    <small id="priceHelp" class="form-text text-muted">
                        @if ($errors->has('price'))
                            <b class="text-danger">{{ $errors->first('price') }}</b>
                        @else
                            Malın qiymətini yazın.
                        @endif
                    </small>
                </section>

                <section class="row align-items-center">
                    <section class="form-group col-md-6">
                        <label for="title">Code</label>
                        <input maxlength="20" name="code" value="{{ old('code')?old('code'):$product_details['code'] }}" required type="text" class="form-control" id="code" aria-describedby="codeHelp" placeholder="Code">
                        <small id="codeHelp" class="form-text text-muted">
                            @if ($errors->has('code'))
                                <b class="text-danger">{{ $errors->first('code') }}</b>
                            @else
                                Maksimum 20 simvol.
                            @endif
                        </small>
                    </section>
                    <section class="form-group col-md-6">
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" {{$product_details['stock']?'checked':''}} name="stokda" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">Stokda var?</span>
                        </label>
                    </section>
                </section>
            </section>

            <section class="form-group">
                <label for="description">Description</label>
                <textarea name="description" rows="5" required class="form-control" id="description" aria-describedby="descriptionHelp" placeholder="Description">{{ old('description')?old('description'):$product_details['description'] }}</textarea>
                <small id="descriptionHelp" class="form-text text-muted">
                    @if ($errors->has('description'))
                        <b class="text-danger">{{ $errors->first('description') }}</b>
                    @else
                        Mal haqında məlumat.
                    @endif
                </small>
            </section>

            <section class="row">
                <section class="form-group col-md">
                    <label for="tags">Tags</label>
                    <textarea  required class="form-control" id="tags" aria-describedby="tagsHelp" placeholder="Tags"></textarea>
                    <small id="tagsHelp" class="form-text text-muted">
                        @if ($errors->has('tags_hidden'))
                            <b class="text-danger">{{ $errors->first('tags_hidden') }}</b>
                        @else
                            Teqlər
                        @endif
                    </small>
                </section>

                <section class="form-group col-md">
                    <label for="kateqoriya">Kateqoriya</label>
                    <select name="kateqoriya" required class="form-control" id="kateqoriya" aria-describedby="kateqoriyaHelp">
                        <option value="" selected disabled>Kateqoriya seçin</option>
                        @foreach(Kateqoriyalar::kateqoriyalar_hamisi() as $kateqoriya)
                            @if($kateqoriya['alt_kateqoriya'])
                                <optgroup label="{{ ucfirst($kateqoriya['ad']) }}">
                                    @foreach(AltKateqoriyalar::alt_kateqoriyalar_by_id($kateqoriya['id']) as $alt_kateqoriya)
                                        <option value="{{ $kateqoriya['id'] }}_{{$alt_kateqoriya['id']}}">&nbsp;&nbsp;&nbsp;{{ ucfirst($alt_kateqoriya['ad']) }}</option>
                                    @endforeach
                                </optgroup>
                            @else
                                <option value="{{ $kateqoriya['id'] }}">{{ ucfirst($kateqoriya['ad']) }}</option>
                            @endif
                        @endforeach
                    </select>
                    <small id="kateqoriyaHelp" class="form-text text-muted">
                        @if ($errors->has('kateqoriya'))
                            <b class="text-danger">{{ $errors->first('kateqoriya') }}</b>
                        @else
                            Malın kateqoriyası.
                        @endif
                    </small>
                </section>
            </section>


            <section class="row">
                <section class="c-color-swatch form-group col-md d-flex flex-column">
                    <label for="">Color</label>
                    <section class="d-flex align-items-center">
                        <input type="checkbox" required name="color[]" value="F9ED69" id="color-F9ED69"/>
                        <label class="c-color-swatch__item" for="color-F9ED69" style="background: #F9ED69"></label>

                        <input type="checkbox" required name="color[]" value="F08A5D" id="color-F08A5D"/>
                        <label class="c-color-swatch__item" for="color-F08A5D" style="background: #F08A5D"></label>

                        <input type="checkbox" required name="color[]" value="B83B5E" id="color-B83B5E"/>
                        <label class="c-color-swatch__item" for="color-B83B5E" style="background: #B83B5E"></label>

                        <input type="checkbox" required name="color[]" value="6A2C70" id="color-6A2C70"/>
                        <label class="c-color-swatch__item" for="color-6A2C70" style="background: #6A2C70"></label>

                        <input type="checkbox" required name="color[]" value="2B3964" id="color-2B3964"/>
                        <label class="c-color-swatch__item" for="color-2B3964" style="background: #2B3964"></label>

                        <input type="checkbox" required name="color[]" value="3482AA" id="color-3482AA"/>
                        <label class="c-color-swatch__item" for="color-3482AA" style="background: #3482AA"></label>

                        <input type="checkbox" required name="color[]" value="6DB3B5" id="color-6DB3B5"/>
                        <label class="c-color-swatch__item" for="color-6DB3B5" style="background: #6DB3B5"></label>

                        <input type="checkbox" required name="color[]" value="477D7F" id="color-477D7F"/>
                        <label class="c-color-swatch__item" for="color-477D7F" style="background: #477D7F"></label>

                        <input type="checkbox" required name="color[]" value="1F5357" id="color-1F5357"/>
                        <label class="c-color-swatch__item" for="color-1F5357" style="background: #1F5357"></label>

                        <input type="checkbox" required name="color[]" value="64BD97" id="color-64BD97"/>
                        <label class="c-color-swatch__item" for="color-64BD97" style="background: #64BD97"></label>
                    </section>
                    <small id="kateqoriyaHelp" class="form-text text-muted">
                        @if ($errors->has('color'))
                            <b class="text-danger">{{ $errors->first('color') }}</b>
                        @else
                            Malın rəngləri
                        @endif
                    </small>
                </section>
                <section class="form-group col-md">
                    <section class="form-group">
                        <label for="size">Size</label>
                        <textarea required class="form-control" id="size" aria-describedby="sizeHelp" placeholder="Size"></textarea>
                        <small id="sizeHelp" class="form-text text-muted">
                            @if ($errors->has('size_hidden'))
                                <b class="text-danger">{{ $errors->first('size_hidden') }}</b>
                            @else
                                Ölçülər
                            @endif
                        </small>
                    </section>
                </section>
            </section>


            <section class="row flex-column" id="sekiller">
                <section class="col-12 mb-3">
                    <button type="button" class="btn btn-secondary add_image">Add image</button>
                </section>
                <section class="w-100 d-flex flex-wrap">
                    @foreach($product_details['photos'] as $sekil)
                        <section class="col-md-6 d-flex flex-column justify-content-start align-items-center">
                            <img src="{{ asset('src/images/original/'.$sekil['fayl']) }}" alt="{{ $sekil['fayl'] }}">
                            <button type="button" class="btn btn-danger mt-3 image-sil" data-image-title="{{ $sekil['fayl'] }}"><i class="fa fa-times mr-2" aria-hidden="true"></i>Sil</button>
                        </section>
                    @endforeach
                </section>

            </section>

            <button type="submit" class="btn btn-success mt-5 w-100">Dəyişdir</button>
        </form>
    </section>
@endsection