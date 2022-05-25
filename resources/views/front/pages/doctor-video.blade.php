@extends('front.layout.master')
@section('content')


<section class="pb-5 pt-3">
    <div class="container">
        <div class="row">
            
            <div class="col-md-12">

                <h1 class="text-left text-capitalize mb-5 text-md">
                    Video
                </h1>
                
                <p><i class="fa fa-home mr-2"></i>beranda / doctor / video</p>
                <br />
                
                @include('front.partials.menu-doctor')

                <div class="row">
                    <div class="col-md-9">
                        <div class="row">
                        <div class="col-md-4 mb-3 mb-lg-5">
                        <a href="{{ route('frontVideoDetail','test') }}">
                            <div class="hover hover-2 text-white rounded">
                                <img src="{{ asset('images/video/video_1png.png') }}" alt="" class="">
                                <div class="hover-overlay"></div>
                                <div class="hover-2-content">
                                    <h3 class="hover-2-title text-uppercase font-weight-bold mb-0"> 
                                        <span class="font-weight-light">KESEHATAN </span>
                                    </h3>
                                    <p class="hover-2-description text-uppercase mb-0">Kesehatan Kulit Wajah Tetap Terjaga Ketika Era Adaptasi Kebuasaan Baru</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4 mb-3 mb-lg-5">
                    <a href="{{ route('frontVideoDetail','test') }}">
                        <div class="hover hover-2 text-white rounded">
                            <img src="{{ asset('images/video/video_2png.png') }}" alt="" class="">
                            <div class="hover-overlay"></div>
                            <div class="hover-2-content">
                                <h3 class="hover-2-title text-uppercase font-weight-bold mb-0"> 
                                    <span class="font-weight-light">KESEHATAN </span>
                                </h3>
                                <p class="hover-2-description text-uppercase mb-0">Kesehatan Kulit Wajah Tetap Terjaga Ketika Era Adaptasi Kebuasaan Baru</p>
                            </div>
                        </div>
                        </a>
                    </div>

                    <div class="col-md-4 mb-3 mb-lg-5">
                    <a href="{{ route('frontVideoDetail','test') }}">
                        <div class="hover hover-2 text-white rounded">
                            <img src="{{ asset('images/video/video_3png.png') }}" alt="" class="">
                            <div class="hover-overlay"></div>
                            <div class="hover-2-content">
                                <h3 class="hover-2-title text-uppercase font-weight-bold mb-0"> 
                                    <span class="font-weight-light">KESEHATAN </span>
                                </h3>
                                <p class="hover-2-description text-uppercase mb-0">Kesehatan Kulit Wajah Tetap Terjaga Ketika Era Adaptasi Kebuasaan Baru</p>
                            </div>
                        </div>
                        </a>
                    </div>

                    <div class="col-md-4 mb-3 mb-lg-5">
                    <a href="{{ route('frontVideoDetail','test') }}">
                        <div class="hover hover-2 text-white rounded">
                            <img src="{{ asset('images/video/video_4png.png') }}" alt="" class="">
                            <div class="hover-overlay"></div>
                            <div class="hover-2-content">
                                <h3 class="hover-2-title text-uppercase font-weight-bold mb-0"> 
                                    <span class="font-weight-light">KESEHATAN </span>
                                </h3>
                                <p class="hover-2-description text-uppercase mb-0">Kesehatan Kulit Wajah Tetap Terjaga Ketika Era Adaptasi Kebuasaan Baru</p>
                            </div>
                        </div>
                        </a>
                    </div>

                    <div class="col-md-4 mb-3 mb-lg-5">
                    <a href="{{ route('frontVideoDetail','test') }}">
                        <div class="hover hover-2 text-white rounded">
                            <img src="{{ asset('images/video/video_5png.png') }}" alt="" class="">
                            <div class="hover-overlay"></div>
                            <div class="hover-2-content">
                                <h3 class="hover-2-title text-uppercase font-weight-bold mb-0"> 
                                    <span class="font-weight-light">KESEHATAN </span>
                                </h3>
                                <p class="hover-2-description text-uppercase mb-0">Kesehatan Kulit Wajah Tetap Terjaga Ketika Era Adaptasi Kebuasaan Baru</p>
                            </div>
                        </div>
                        </a>
                    </div>

                    <div class="col-md-4 mb-3 mb-lg-5">
                    <a href="{{ route('frontVideoDetail','test') }}">
                        <div class="hover hover-2 text-white rounded">
                            <img src="{{ asset('images/video/video_6png.png') }}" alt="" class="">
                            <div class="hover-overlay"></div>
                            <div class="hover-2-content">
                                <h3 class="hover-2-title text-uppercase font-weight-bold mb-0"> 
                                    <span class="font-weight-light">KESEHATAN </span>
                                </h3>
                                <p class="hover-2-description text-uppercase mb-0">Kesehatan Kulit Wajah Tetap Terjaga Ketika Era Adaptasi Kebuasaan Baru</p>
                            </div>
                        </div>
                        </a>
                    </div>
                        </div>
                    </div>
                    <div class="col-md-3">
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
            
            
        </div>
    </div>
</section>
@stop


@section('scripts')
<script>

</script>

@stop