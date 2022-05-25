@extends('front.layout.master')
@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12 pl-0 pr-0 pb-0">
        <div class="carousel">
            <div class="carousel-inner">
                <input class="carousel-open" type="radio" id="carousel-1" name="carousel" aria-hidden="true" hidden="" checked="checked">
                <div class="carousel-item-custom">
                    <img src="{{ asset('images/about/banner.jpg') }}">
                </div>
            </div>
        </div>
    </div>
</div>
<section class="pb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-center text-initial mb-5 ff-inconsolata-l about_title">
                    Wujudkan Impianmu Tampil Sehat dan Cantik
                </h4>
                <hr />
            </div>

            <div class="col-md-5 mr-5 col-sm-12 mt-5">
                <img src="{{ asset('images/about/section_1.png') }}" class="full-width" />
            </div>

            <div class="col-md-5 about_description">
                <h3>
                    Profil SeCan
                </h3>

                <p>
                
                Secan.id adalah media yang menyajikan informasi tentang kesehatan dan kecantikan yang diperoleh dan diolah dari dokter yang ahli di bidangnya.

                Secan.id didirikan pada Agustus 2020 dan diluncurkan pada Januari 2021. Secan.id menjadi wadah bagi dokter untuk mengedukasi masyarakat mengenai kesehatan dan kecantikan.
                </p>
                <br />
                <p>Ikuti kami di <a href="https://www.instagram.com/infosehatdancantik.id/" target="__blank"><b>@SeCanindonesia</b></a></p>
                <br/>
                <!--<h1 class="bottom_about_info">Mulai hari kita dengan percaya diri.</h1>-->
                <h1 class="bottom_about_info">Tingkatkan Performa Lebih Percaya Diri</h1>
                
            </div>
        </div>
    </div>
</section>
<section class="pt-5 pb-0">
    <div class="row">
        <div class="col-md-12">
            <img src="{{ asset('images/about/about_section_3.jpg') }}" class="full-width" />
        </div>
    </div>
</section>
<section class="pt-0">
    <div class="container">
        <div class="row">

            <div class="col-md-4 bg-dark text-white pt-5 pl-5 pr-5 pb-5 ff-old-standart">
                <p class="text-uppercase text-sm ff-heebo-regular">
                    Mari berkarya bersama kami
                </p>

                <p class="side_desc_bottom_left">
                    Anda juga mengangkat kecantikan Indonesia yang sehat?
                </p>

                <a href="" class="btn btn-dark text-center border side_desc_bottom_left_button">Hubungi Kami</a>
            </div>

            <div class="col-md-8">
                <img src="{{ asset('images/about/section_3.jpg') }}" class="full-width" />
            </div>
        </div>
    </div>
</section>

@stop
