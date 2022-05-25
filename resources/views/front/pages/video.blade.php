@extends('front.layout.master')
@section('content')


<section class="pb-5 pt-3">
    <div class="container">
        <div class="row">
            
            <div class="col-md-12">

                <h1 class="text-left text-capitalize mb-5 text-md">
                    Video
                </h1>
                
                <p class="text-capitalize bredcrumb"><i class="fa fa-home mr-2"></i>
                    <a href="{{ route('frontHome') }}">beranda</a> / 
                    <a href="{{ route('frontVideo') }}">video</a> {{ isset($category_name) ? '/ '.$category_name : '' }}
                </p>
                <br />
                <ul class="nav_article_category ff-old-standart">
                    <li><a href="{{ route('frontVideoCategory', 'kecantikan') }}" class="active">kecantikan</a></li>
                    <li><a href="{{ route('frontVideoCategory', 'kesehatan') }}">kesehatan</a></li>
                </ul>
                <div class="col-md-3 sidebar_news">
                    @include('front.partials.tags')
                </div>
            </div>
            
            @if(isset($video) && !empty($video))
                @foreach($video as $key=> $video)
                    <div class="col-md-4 mb-3 mb-lg-5">
                        <a href="{{ route('frontVideoDetail', $video['slug']) }}">
                            <div class="hover hover-2 text-white rounded">
                                @if(isset($is_from_doctor_url))
                                <div class="doctor_profile">
                                    <img src="{{ $video['doctor_photo_url'] }}" alt="">
                                </div>
                                @endif
                                <img src="{{ $video['thumbnail_url'] }}" alt="{{ $video['title'] }}" class="">
                                <div class="hover-overlay"></div>
                                <div class="hover-2-content">
                                    <h3 class="hover-2-title text-uppercase font-weight-bold mb-0"> 
                                        <span class="font-weight-light ff-old-standart">{{ $video['category'] }} </span>
                                    </h3>
                                    <p class="hover-2-description text-uppercase mb-0 ff-old-standart">
                                        {{ $video['title'] }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
@stop


@section('scripts')
<script>

</script>

@stop