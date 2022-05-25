@extends('front.layout.master')
@section('content')


<section class="pb-5 pt-3">
    <div class="container">
        <div class="row">
            
            <div class="col-md-12">

                <h1 class="text-left text-capitalize mb-5 text-md">
                    Video
                </h1>
                
                <p class="text-capitalize bredcrumb">
                    <i class="fa fa-home mr-2"></i>
                    <a href="{{ route('frontHome') }}">beranda</a> / 
                    <a href="{{ route('frontVideo') }}">video</a> /
                    <a href="{{ route('frontVideoCategory', $detail['category_slug']) }}">{{ $detail['category'] }}</a> /
                    {{ $detail['title'] }}
                </p>
                
            </div>

            <div class="col-md-9 mb-5">
                <h1 class="text-base mobile_only">
                {{ $detail['title'] }}
                </h1>
                <iframe class="full-width" height="515" src="{{ $detail['youtube_url'] }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <!-- <video src="https://www.youtube.com/watch?v=fEOIBToGmF0" class="full-width"></video> -->
            </div>

            <div class="col-md-3 mb-5">
                <div class="">
                    <h1 class="video_title desktop_only">
                    {{ $detail['title'] }}
                    </h1>
                    <table>
                        <tbody>
                            <tr>
                                <th class="pt-3 pr-3 pb-1">Kategori</th><td class="pt-3 pl-3 pb-1">{{ $detail['category'] }}</td>
                            </tr>
                            <!-- <tr>
                                <th class="pt-3 pr-3 pb-1">Tag</th><td class="pt-3 pl-3 pb-1">CANTIK  KULIT</td>
                            </tr> -->
                            <tr>
                                <th class="pt-3 pr-3 pb-1">Tanggal</th><td class="pt-3 pl-3 pb-1">{{ $detail['publish_date'] }}</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                
                    @include('front.partials.tags')

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-12">
                <div class="news_navigate desktop_only p-3">
                    
                    <div class="flex vend">
                        <div class="row d-flex between">
                            <div class="d-flex">
                                @if(isset($prev) && !empty($prev))
                                    <img src="{{ $prev['home_thumbnail_url'] }}" alt="{{ $prev['title'] }}" width="150" class="img-prev" />
                                    <p class="ml-3 mt-3 mb-3 text-center text-capitaize">
                                        <a href="{{ route('frontVideoDetail', $prev['slug']) }}">Sebelumnya</a>
                                    </p>
                                @endif
                            </div>
                            <div class="d-flex">
                                @if(isset($next) && !empty($next))
                                    <p class="mr-3 mt-3 mb-3 text-center text-capitaize">
                                        <a href="{{ route('frontVideoDetail', $next['slug']) }}">Selanjutnya</a>
                                    </p>
                                    <img src="{{ $next['home_thumbnail_url'] }}" alt="{{ $next['title'] }}" width="150" class="img-prev" />
                                @endif
                            </div>
                        </div>
                    </div>
                    
                </div>
                @if(isset($related) && !empty($related))
                    
                    <div class="related_news_title desktop_only mt-5">
                        <h3 class="text-center mb-2 mt-2 text-md">Artikel Terkait</h3>
                        <div class="row mt-4">
                            @foreach($related as $relatedDesktop)
                                
                                <div class="col-md-3">
                                    <img src="{{ $relatedDesktop['home_thumbnail_url'] }}" alt="{{ $relatedDesktop['title'] }}" class="full-width" />
                                    <p class="mt-3 mb-3 ">
                                        <span class="text-uppercase text-sm">{{ $relatedDesktop['category'] }}</span>
                                    </p>
                                    <a href="{{ route('frontVideoDetail', $next['slug']) }}">
                                        <h3 class="mt-3 text-base">{{ $relatedDesktop['title'] }}.</h3>
                                    </a>
                                </div>
                                
                            @endforeach
                        </div>
                    </div>

                    <div class="related_news mobile_only mb-3">
                        <div class="flex vend">
                            <h1 class="text-left mb-3 mt-2 text-md">Artikel Terkait</h1>
                            <div class="row d-flex between">

                                @foreach($related as $relatedMobile)
                                    <div class="d-flex ml-3 mt-3">
                                        
                                        <img src="{{ $relatedMobile['home_thumbnail_url'] }}" alt="{{ $relatedMobile['title'] }}" width="150" class="" />
                                        <p class="m-3 text-justify text-capitaize text-sm" style="line-hight: 1.6">
                                            <a href="{{ $relatedMobile['slug'] }}" class="d-flex">    
                                                {{ $relatedMobile['title'] }}
                                            </a>
                                        </p>
                                        
                                    </div>
                                @endforeach
                                
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@stop