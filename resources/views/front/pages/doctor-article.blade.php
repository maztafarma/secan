@extends('front.layout.master')
@section('content')


<section class="pb-5 pt-3">
    <div class="container">
        <div class="row">
            
            <div class="col-md-12">

                <h1 class="text-left text-capitalize mb-5 text-md">
                    Dokter
                </h1>
                
                <p><i class="fa fa-home mr-2"></i>beranda / dokter / artikel</p>
                <br />
                @include('front.partials.menu-doctor')
            </div>
            
            <div class="col-md-10 mb-3 mb-lg-5">
                <div class="grid js-masonry" data-masonry='{ "itemSelector": ".grid-item", "columnWidth": 300 }'>
                    <div class="grid-item m-3">
                        <img src="{{ asset('images/news/thumb_1.png') }}" style="height:120px" class="full-width" />
                        <h3 class="mt-3 text-base">Dr. Dina S Rini, Sp.KK</h3>
                        <p class="flow-root mt-3 mb-3 text-capitalize">
                            <span class="float-left">kecantikan</span>
                            <span class="float-right">05/01/2020</span>
                        </p>
                        <h1 class="text-base text-uppercase">Riasan tanpa riasan? ini dia.</h1>
                        <p class="mt-3 mb-3 text-capitalize text-justify">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                        when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                        </p>
                        <p class="mt-5">
                            <a href="{{ route('frontNewsDetail', 'test') }}">Lebih Lanjut<i class="fa fa-arrow-alt-circle-right ml-3"></i></a>
                        </p>
                    </div>

                    <div class="grid-item m-3">
                        <img src="{{ asset('images/news/thumb_2.png') }}" style="height:120px" class="full-width" />
                        <h3 class="mt-3 text-base">Dr. Dina S Rini, Sp.KK</h3>
                        <p class="flow-root mt-3 mb-3 text-capitalize">
                            <span class="float-left">kecantikan</span>
                            <span class="float-right">05/01/2020</span>
                        </p>
                        <h1 class="text-base text-uppercase">Riasan tanpa riasan? ini dia.</h1>
                        <p class="mt-3 mb-3 text-capitalize text-justify">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                        </p>
                        <p class="mt-5">
                            <a href="{{ route('frontNewsDetail', 'test') }}">Lebih Lanjut<i class="fa fa-arrow-alt-circle-right ml-3"></i></a>
                        </p>
                    </div>

                    <div class="grid-item m-3">
                        <img src="{{ asset('images/news/thumb_3.png') }}" style="height:120px" class="full-width" />
                        <h3 class="mt-3 text-base">Dr. Dina S Rini, Sp.KK</h3>
                        <p class="flow-root mt-3 mb-3 text-capitalize">
                            <span class="float-left">kecantikan</span>
                            <span class="float-right">05/01/2020</span>
                        </p>
                        <h1 class="text-base text-uppercase">Riasan tanpa riasan? ini dia.</h1>
                        <p class="mt-3 mb-3 text-capitalize text-justify">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                        when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                        </p>
                        <p class="mt-5">
                            <a href="{{ route('frontNewsDetail', 'test') }}">Lebih Lanjut<i class="fa fa-arrow-alt-circle-right ml-3"></i></a>
                        </p>
                    </div>

                    <div class="grid-item m-3">
                        <img src="{{ asset('images/news/thumb_1.png') }}" style="height:120px" class="full-width" />
                        <h3 class="mt-3 text-base">Dr. Dina S Rini, Sp.KK</h3>
                        <p class="flow-root mt-3 mb-3 text-capitalize">
                            <span class="float-left">kecantikan</span>
                            <span class="float-right">05/01/2020</span>
                        </p>
                        <h1 class="text-base text-uppercase">Riasan tanpa riasan? ini dia.</h1>
                        <p class="mt-3 mb-3 text-capitalize text-justify">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                        when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                        </p>
                        <p class="mt-5">
                            <a href="{{ route('frontNewsDetail', 'test') }}">Lebih Lanjut<i class="fa fa-arrow-alt-circle-right ml-3"></i></a>
                        </p>
                    </div>

                    <div class="grid-item m-3">
                        <img src="{{ asset('images/news/thumb_2.png') }}" style="height:120px" class="full-width" />
                        <h3 class="mt-3 text-base">Dr. Dina S Rini, Sp.KK</h3>
                        <p class="flow-root mt-3 mb-3 text-capitalize">
                            <span class="float-left">kecantikan</span>
                            <span class="float-right">05/01/2020</span>
                        </p>
                        <h1 class="text-base text-uppercase">Riasan tanpa riasan? ini dia.</h1>
                        <p class="mt-3 mb-3 text-capitalize text-justify">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                        </p>
                        <p class="mt-5">
                            <a href="{{ route('frontNewsDetail', 'test') }}">Lebih Lanjut<i class="fa fa-arrow-alt-circle-right ml-3"></i></a>
                        </p>
                    </div>

                    <div class="grid-item m-3">
                        <img src="{{ asset('images/news/thumb_2.png') }}" style="height:120px" class="full-width" />
                        <h3 class="mt-3 text-base">Dr. Dina S Rini, Sp.KK</h3>
                        <p class="flow-root mt-3 mb-3 text-capitalize">
                            <span class="float-left">kecantikan</span>
                            <span class="float-right">05/01/2020</span>
                        </p>
                        <h1 class="text-base text-uppercase">Riasan tanpa riasan? ini dia.</h1>
                        <p class="mt-3 mb-3 text-capitalize text-justify">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                        </p>
                        <p class="mt-5">
                            <a href="{{ route('frontNewsDetail', 'test') }}">Lebih Lanjut<i class="fa fa-arrow-alt-circle-right ml-3"></i></a>
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-2 mb-3 mb-lg-5">
                <div class="mb-5">
                    <p class="text-uppercase text-left mb-3">
                        <h6>URUTKAN</h6>
                    </p>
                    <select class="form-control">
                        <option>Nama A - Z</option>
                        <option>Dokter Kecantikan</option>
                        <option>Dokter Kesehatan</option>
                        <option>Area</option>
                    </select>
                </div>
                
            </div>

        </div>
    </div>
</section>
@stop


@section('scripts')
<script>

</script>

@stop