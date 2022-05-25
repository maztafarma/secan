@extends('front.layout.master')
@section('content')
<section class="bg-cover bg-center" style="min-height: 853px; background-image: url({{ asset('images/404-backgriund.jpeg') }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="notfound_info">
                    <h1>404</h1>
                    <p class="text-base">LAMAN BELUM DITEMUKAN</p>
                </div>
            </div>
        </div>
    </div>
</section>
@stop