@extends('layouts.master')

@section('custom-meta')
    <title>{{ ucfirst($product_details['title']) }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('custom-js')
    <script type="text/javascript" src="{{ asset('src/js/owl.carousel.min.js') }}"></script>
    <script type="text/javascript">

        $('#alert-rate').hide();

        $('.owl-carousel#original').owlCarousel({
            loop:false,
            margin:10,
            nav:false,
            dots:false,
            responsive:{
                0:{
                    items:1
                }
            }
        });
        $('.owl-carousel#thumbnail').owlCarousel({
            loop:false,
            margin:10,
            nav:false,
            dots:false,
            responsive:{
                0:{
                    items:4
                }
            }
        });

        $(document).ready(function(){
            $('#stars li').on('mouseover', function(){
                var onStar = parseInt($(this).data('value'), 10);

                $(this).parent().children('li.star').each(function(e){
                    if (e < onStar) {
                        $(this).addClass('hover');
                    }
                    else {
                        $(this).removeClass('hover');
                    }
                });
            }).on('mouseout', function(){
                $(this).parent().children('li.star').each(function(e){
                    $(this).removeClass('hover');
                });
            });
        });


        function responseMessage(msg) {
            $('.success-box').fadeIn(200);
            $('.success-box div.text-message').html("<span>" + msg + "</span>");
        }

        $('<div class="quantity-nav"><div class="quantity-button quantity-up"><i style="color:#E8E8E8" class="fa fa-caret-up" aria-hidden="true"></i></div><div class="quantity-button quantity-down"><i style="color:#E8E8E8" class="fa fa-caret-down" aria-hidden="true"></i></div></div>').insertAfter('.quantity input');
        $('.quantity').each(function() {
            var spinner = $(this),
                input = spinner.find('input[type="number"]'),
                btnUp = spinner.find('.quantity-up'),
                btnDown = spinner.find('.quantity-down'),
                min = input.attr('min'),
                max = input.attr('max');

            btnUp.click(function() {
                var oldValue = parseFloat(input.val());
                if (oldValue >= max) {
                    var newVal = oldValue;
                } else {
                    var newVal = oldValue + 1;
                }
                spinner.find("input").val(newVal);
                spinner.find("input").trigger("change");
            });

            btnDown.click(function() {
                var oldValue = parseFloat(input.val());
                if (oldValue <= min) {
                    var newVal = oldValue;
                } else {
                    var newVal = oldValue - 1;
                }
                spinner.find("input").val(newVal);
                spinner.find("input").trigger("change");
            });

        });

        function reset_form(){
            $('select').val("");
            $('input[type=number]').val(1);
        }

        $('#towishlist').click(function () {
            var icon=$('#wish-search').find('>span:nth-of-type(1)').find('i');
            if(icon.hasClass('fa-heart-o')){
                icon.removeClass('fa-heart-o').addClass('fa-heart');
            }else{
                icon.removeClass('fa-heart').addClass('fa-heart-o');
            }
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var avarage_rating={{ $product_details['avarage_rating'] }}

        function stars_set(){
            for(var i=1;i<=avarage_rating;i++){
                $('.star[data-value='+i+']').addClass('selected');
            }
        };

        stars_set();

        $('.star').click(function () {
            $.post('{{ route('add-rating') }}',{rating: $(this).data('value'),product: '{{ $product_details['id'] }}'},function(data,status){
                if(status=='success'){
                    $('#review-say').html(data[1]);
                    avarage_rating=data[0];
                    stars_set();
                    $("#alert-rate").fadeTo(2000, 500).slideUp(500, function(){
                        $("#alert-rate").slideUp(500);
                    });
                }else{
                    alert('Failed!');
                }
            }).fail(function() {
                alert( "Error!" );
            })
        });
    </script>
@endsection

@section('custom-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('src/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/css/owl.theme.default.min.css') }}">
    <style type="text/css">
        .rengli{
            color: #4992e4;
        }
        #sag a{
            text-decoration: none;
            color: #4992e4;
        }
        .rating-stars ul {
            list-style-type:none;
            padding:0;

            -moz-user-select:none;
            -webkit-user-select:none;
        }
        .rating-stars ul > li.star {
            display:inline-block;

        }
        .rating-stars ul > li.star > i.fa {
            font-size:1em;
            color:#ccc;
            width:14.8594px;
        }
        .rating-stars ul > li.star.hover > i.fa {
            color:#FFCC36;
        }
        .rating-stars ul > li.star.selected > i.fa {
            color:#FF912C;
        }
        .rating-stars > span:nth-of-type(1){
            border-right:1.5px solid;
        }
        .rating-stars > span:nth-of-type(1)+span{
            text-decoration: underline;
            font-weight:bold;
        }
        .quantity {
            position: relative;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button
        {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number]
        {
            -moz-appearance: textfield;
        }

        .quantity input {
            width: 72px;
            height: 38px;
            line-height: 1.65;
            float: left;
            display: block;
            padding: 0;
            margin: 0;
            padding-left:20px;
            border: 1px solid #eee;
        }

        .quantity input:focus {
            outline: 0;
        }

        .quantity-nav {
            float: left;
            position: relative;
            height: 38px;
        }

        .quantity-button {
            position: relative;
            cursor: pointer;
            border-left: 1px solid #eee;
            width: 20px;
            text-align: center;
            color: #333;
            font-size: 13px;
            font-family: "Trebuchet MS", Helvetica, sans-serif !important;
            line-height: 1.7;
            -webkit-transform: translateX(-100%);
            transform: translateX(-100%);
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            -o-user-select: none;
            user-select: none;
        }

        .quantity-button.quantity-up {
            position: absolute;
            height: 50%;
            top: 0;
            border-bottom: 1px solid #eee;
        }

        .quantity-button.quantity-down {
            position: absolute;
            bottom: -1px;
            height: 50%;
        }

        #twitter-widget-0{
            margin-right: .5rem;
        }
    </style>
@endsection

@section('content')
    <div class="alert alert-success alert-dismissible fade show px-5" id="alert-rate" style="position:fixed;bottom:25px;right:25px;display: none;z-index:100" role="alert">
        Rating added!
        <button type="button" class="close" style="line-height: .80;" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @if(Session::has('status') && session('status'))
        <section class="d-flex justify-content-center" style="position:fixed; top:25px;width: 100vw;z-index: 2;">

            <div class="alert alert-success alert-dismissible fade show px-5" style="position:relative;" role="alert">
                Added to Cart! You can check with Cart button.
                <button type="button" class="close" style="line-height: .80;" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </section>
    @endif
    <section class="container" style="position:relative;z-index: 1">
        <section class="row py-5 ">
            <section class="col-md-6 d-flex flex-column position-relative">
                <div class="owl-carousel owl-theme" id="original">
                    @foreach($product_details['photos'] as $index=>$photo)
                        <div class="item" data-hash="{{ $index }}">
                            <img src="{{ asset('src/images/original/'.$photo['fayl']) }}" alt="{{ $photo['fayl'] }}">
                        </div>    
                    @endforeach
                </div>
                <div class="owl-carousel owl-theme mt-3" id="thumbnail">
                    @foreach($product_details['photos'] as $index=>$photo)
                        <div class="item">
                            <a href="#{{ $index }}">
                                <img  src="{{ asset('src/images/thumbnail/'.$photo['fayl']) }}" alt="{{ $photo['fayl'] }}">
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>
            <section class="col-md-6 pr-0" id="sag" >
                <section class="col font-weight-bold">
                    <i class="fa fa-angle-left font-weight-bold" aria-hidden="true"></i> Back to
                    @php
                        $kateqoriya=explode('_',$product_details['kateqoriya']);
                    @endphp
                    @if(isset($kateqoriya[1]))
                        <a href="#" class="text-">{{ ucfirst(Kateqoriyalar::kateqoriya_adi($kateqoriya[0])) }}</a>/<a href="#" class="text-">{{ ucfirst(AltKateqoriyalar::alt_kateqoriya_adi($kateqoriya[1])) }}</a>
                    @else
                        <a href="#" class="text-">{{ ucfirst(Kateqoriyalar::kateqoriya_adi($kateqoriya[0])) }}</a>
                    @endif
                </section>
                <section class="col mt-4">
                    <h2 class="">{{ ucfirst($product_details['title']) }}</h2>
                </section>
                <section class="col mt-3 rating-stars d-flex">
                    <ul id='stars' class="mr-3 mb-0">
                        <li class='star' title='Poor' data-value='1'>
                            <i class='fa fa-star fa-fw'></i>
                        </li>
                        <li class='star' title='Fair' data-value='2'>
                            <i class='fa fa-star fa-fw'></i>
                        </li>
                        <li class='star' title='Good' data-value='3'>
                            <i class='fa fa-star fa-fw'></i>
                        </li>
                        <li class='star' title='Excellent' data-value='4'>
                            <i class='fa fa-star fa-fw'></i>
                        </li>
                        <li class='star' title='WOW!!!' data-value='5'>
                            <i class='fa fa-star fa-fw'></i>
                        </li>
                    </ul>
                    <span class="pr-3 mr-3"><span id="review-say">{{ $product_details['rating_say'] }}</span> review(s)</span>
                    <span>ADD A REVIEW</span>
                </section>
                <section class="col mt-4 rengli font-weight-bold" style="font-size: 1.8rem">
                    ${{ sprintf("%0.2f",$product_details['price']) }}
                </section>
                <section class="col mt-4" style="font-weight: 500">
                    Availability: {!! $product_details['stock']?'<span class="rengli">In stock</span>':'<span class="text-danger">Out of stock</span>' !!}
                </section>
                <section class="col" style="font-weight: 500">
                    Product code: <span class="rengli">#{{ $product_details['code']}}</span>
                </section>
                <section class="col" style="font-weight: 500">
                    Tags: <span class="rengli">
                    @foreach($product_details['tags'] as $tag)
                        @if ($tag == end($product_details['tags']))
                            <a href="#">{{ ucfirst($tag['tag']) }}</a>
                        @else
                            <a href="#">{{ ucfirst($tag['tag']) }}</a>,
                        @endif
                    @endforeach
                    </span>
                </section>
                <section class="col mt-4" style="font-weight: 500">
                    <p style="color:#555;white-space: pre-wrap;">{!! ucfirst($product_details['description']) !!}</p>
                </section>

                <section class="col mt-5 d-flex" style="font-weight: 500">
                    <form action="{{ route('add-to-cart') }}" method="post" id="cart_form" class="w-100 d-flex">
                        {{csrf_field()}}
                        <input type="hidden" name="image" value="{{ $product_details['photos'][0]['fayl'] }}">
                        <input type="hidden" name="name" value="{{ $product_details['title'] }}">
                        <input type="hidden" name="price" value="{{ $product_details['price'] }}">
                        <input type="hidden" name="id" value="{{ $product_details['id'] }}">
                        <section class="col-md-5 pl-0">
                            <section class="d-flex flex-column">
                                <label for="color">COLOR</label>
                                <select required class="custom-select col-12" name="color" id="color" style="border-radius: 0;border: 1px solid #E1E1E1;">
                                    <option selected value="" disabled>Select color</option>
                                    @foreach($product_details['colors'] as $color)
                                        <option style="background-color: #{{$color['reng']}};color: white" value="{{ $color['reng'] }}">{{$color['reng']}}</option>
                                    @endforeach
                                </select>
                            </section>
                        </section>
                        <section class="col-md-5 ">
                            <section class="d-flex flex-column">
                                <label for="size">SIZE</label>
                                <select required class="custom-select col-12" name="size" id="size" style="border-radius: 0;border: 1px solid #E1E1E1;">
                                    <option selected value="" disabled>Select size</option>
                                    @foreach($product_details['sizes'] as $size)
                                        <option value="{{ $size['olcu'] }}">{{ $size['olcu'] }}</option>
                                    @endforeach
                                </select>
                            </section>
                        </section>
                        <section class="col-md-2 pr-0">
                            <section class="d-flex flex-column">
                                <label for="size">QTY</label>
                                <section class="quantity">
                                    <input type="number" name="qty" min="1" max="9" step="1" value="1">
                                </section>
                            </section>
                        </section>
                    </form>
                </section>

                <section class="col mt-4">
                    <a style="text-decoration: underline;cursor:pointer;color:#212529;font-weight: bold;" onclick="reset_form()">CLEAR SELECTION</a>
                </section>

                <section class="col mt-5 d-flex mb-5">
                    <section class="col-md-6 pl-0">
                        <button type="submit" id="tocart" form="cart_form" class="w-100 py-3" style="background-color: black;color:white;border:1px solid transparent;cursor:pointer;outline:none;font-weight: 500">ADD TO CART</button>
                    </section>
                    <section class="col-md-6 pr-0">
                        <button type="button" class="w-100 py-3" id="towishlist" style="background-color: white;color:black;border:1px solid #E1E1E1;cursor:pointer;outline:none;font-weight: 500"><i class="fa fa-heart-o mr-2" aria-hidden="true"></i>ADD TO WISHLIST</button>
                    </section>
                </section>
                <hr>
                <section class="d-flex justify-content-between align-items-center">
                    <span style="font-weight: bold;">SHARE THIS</span>
                    <section class="d-flex align-items-center justify-content-around">
                        <div class="fb-like d-flex align-items-center mr-2" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button" data-action="like" data-size="small" data-show-faces="false" data-share="false"></div>

                        <div class="fb-share-button d-flex align-items-center mr-2" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Share</a></div>

                        <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button d-flex align-items-center" data-show-count="false">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

                        <a href="https://www.pinterest.com/pin/create/button/" data-pin-do="buttonBookmark" class="ml-2">
                        </a>
                    </section>
                </section>
                <hr>
            </section>
        </section>
    </section>
@endsection