<header>
    <section class="w-100 text-center py-2" id="basliq">
        <section class="container">
            <span class="text-uppercase">start selling your products or buy them from anywhere!</span>
            <span class="pull-right" id="bagla">&times;</span>
        </section>
    </section>

   <section class="w-100">
       <section class="container py-5 d-flex align-items-center">
           <section id="currency" class="col-md  pl-0">
                <span class="d-flex align-items-center">
                    <span>
                        <img class="pr-2" src="{{asset('src/images/usd.png')}}" alt="USA">
                        <span class="pr-2">USA</span>
                        <i class="fa fa-caret-down" aria-hidden="true"></i>
                    </span>
                </span>
               <ul class="m-0 py-1 pl-0">
                   <li class="px-3">
                       <a href="#" class="text-dark">
                        <span class="d-flex align-items-center">
                            <img class="mr-2" src="{{asset('src/images/azn.png')}}" alt="USA">
                            <span class="">AZN</span>
                        </span>
                       </a>
                   </li>
                   <li class="px-3">
                       <a href="#" class="text-dark">
                        <span class="d-flex align-items-center">
                            <img class="mr-2" src="{{asset('src/images/rub.png')}}" alt="USA">
                            <span class="">RUB</span>
                        </span>
                       </a>
                   </li>
                   <li class="px-3">
                       <a href="#" class="text-dark">
                        <span class="d-flex align-items-center">
                            <img class="mr-2" src="{{asset('src/images/try.png')}}" alt="USA">
                            <span class="">TRY</span>
                        </span>
                       </a>
                   </li>
               </ul>
           </section>
           <section id="logo" class="col-md text-center">BONFIRE</section>
           <section id="cart" class="col-md d-flex justify-content-end pr-0">
               <button class="py-2 px-4">
                   CART ({{ Cart::count() }})
               </button>
               <section style="{{ Cart::count()?'':'display:none' }}">
                   <section>
                       @php $item_index=0 @endphp
                       @foreach ( Cart::content()->toArray() as $index=>$item )
                           @php ++$item_index; @endphp
                           @if($item_index>3)
                               <a href="#" class="d-flex justify-content-center w-100 py-2 font-weight-bold" style="background-color: #D9E1E6;color:#868f93;">View all</a>
                               @break
                           @endif
                           <section class="cart-item d-flex px-4 py-3">
                               <section class="d-flex justify-content-center align-items-center px-2">
                                   <img class="d-block" style="width: 70px;height: auto;" src="{{ asset('src/images/thumbnail/'.$item['options']['image']) }}" alt="{{ $item['options']['image'] }}">
                               </section>
                               <section class="d-flex flex-column px-2 justify-content-between">
                                   <b class="mb-1">{{ ucfirst(str_limit($item['name'], $limit = 20, $end = '...')) }}</b>
                                   <span class="d-flex align-items-center mb-1"><b class="mr-1">Color:</b><span style="background-color: #{{ $item['options']['reng'] }}; width: 20px;height:15px;display: block"></span></span>
                                   <span class="mb-1"><b>Size:</b> {{ $item['options']['olcu'] }}</span>
                                   <span class="mb-1"><b>QTY:</b> x{{ $item['qty'] }}</span>
                                   <span class=""><b>Total price:</b> ${{ $item['qty']*$item['price'] }}</span>
                               </section>
                           </section>
                       @endforeach
                   </section>
               </section>
           </section>
       </section>
       <hr class="m-0">
   </section>


    <section class="w-100">
        <section class="container d-flex align-items-center" style="height: 64px">
            <section class="col-1 pl-0" id="hamburger-menyu-ikonu">
                <span>
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </section>
            <nav class="col text-center">
                <ul class="m-0 pl-0 d-flex justify-content-center">
                    <li class="px-3">
                        <a href="#">HOME</a>
                    </li>
                    @foreach(Kateqoriyalar::kateqoriyalar_hamisi() as $kateqoriya)
                        @if($kateqoriya['alt_kateqoriya'])
                            <li class="px-3 altkateqoriyali">
                                <a>{{mb_strtoupper($kateqoriya['ad'])}}<i class="fa fa-caret-down ml-2" aria-hidden="true"></i></a>
                                <section>
                                    <ul class="pl-0 m-0 py-1 mt-1">
                                        @foreach(AltKateqoriyalar::alt_kateqoriyalar_by_id($kateqoriya['id']) as $alt_kateqoriya)
                                            <li class="px-4 py-1 text-center "><a href="{{$alt_kateqoriya['slug']}}">{{$alt_kateqoriya['ad']}}</a></li>
                                        @endforeach
                                    </ul>
                                </section>
                            </li>
                        @else
                            <li class="px-3">
                                <a href="{{ $kateqoriya['slug'] }}">{{mb_strtoupper($kateqoriya['ad'])}}</a>
                            </li>
                        @endif
                    @endforeach
                    <li class="px-3">
                        <a href="#">LOOKBOOK</a>
                    </li>
                    <li class="px-3">
                        <a href="#">ABOUT</a>
                    </li>
                    <li class="px-3">
                        <a href="#">BLOG</a>
                    </li>
                </ul>
            </nav>
            <section class="col-1 d-flex justify-content-end pr-0" id="wish-search">
                <span class="py-1 pr-3">
                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                </span>
                <span class="py-1 pl-3">
                    <form action="#"><input name="axtaris" type="text" placeholder="Type here and press Enter"></form>
                    <i class="fa fa-search" aria-hidden="true"></i>
                </span>
            </section>
        </section>
        <hr class="m-0">
    </section>
</header>