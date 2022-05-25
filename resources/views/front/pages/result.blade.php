@extends('front.layout.master')
@section('content')


<section class="pb-5 pt-3">
    <div class="container">
        <div class="row">
            
            <div class="col-md-12">

                <h1 class="text-left text-capitalize mb-5 text-md">
                    Hasil Pencarian Untuk "{{ $result_title }}"
                </h1>
                
                <p class="text-capitalize bredcrumb"><i class="fa fa-home mr-2"></i>
                    <a href="{{ route('frontHome') }}">beranda</a> / pencarian / {{ $result_title }}
                </p>

                @if(empty($result['news']) && empty($result['video']))

                    <div class="row">
                        <div class="col-md-12 mb-3 mb-lg-5">
                            <h5 class="text-center text-capitalize mb-2 text-md">
                                Pencarian Tidak Ditemukan
                            </h5>
                        </div>
                    </div>
                @else
                
                    <div class="row">
                        @if(isset($result['news']) && !empty($result['news']))
                            <div class="col-md-12 mb-3 mb-lg-5">
                                <h5 class="text-left text-capitalize mb-2 ff-old-standart">
                                    Artikel ({{ count($result['news'])}})
                                </h5>
                                <hr />
                            </div>
                            @foreach($result['news'] as $news)
                                
                                <div class="col-md-4 mb-3 mb-lg-5">
                                    <img src="{{ $news['thumbnail_url'] }}" alt="{{ $news['title'] }}" class="full-width" />
                                    <p class="mt-3 mb-3 d-flex">
                                        <span class="float-left text-uppercase">{{ $news['category'] }}</span>
                                        <span class="float-right text-uppercase news_date">{{ $news['publish_date'] }}</span>
                                    </p>
                                    <h4 class="mt-4 mb-3 d-flex full-width ff-old-standart">{{ $news['title'] }}</h4>
                                    <p>
                                    {!! $news['content'] !!}
                                    </p>
                                    
                                    <p class="mt-5 ff-old-standart">
                                        <a href="{{ route('frontNewsDetail', $news['slug']) }}">Lebih Lanjut<i class="fa fa-arrow-alt-circle-right ml-3"></i></a>
                                    </p>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="row">
                        @if(isset($result['video']) && !empty($result['video']))
                            <div class="col-md-12 mb-3 mb-lg-5">
                                <h5 class="text-left text-capitalize mb-2 ff-old-standart">
                                    Video ({{ count($result['video'])}})
                                </h5>
                                <hr />
                            </div>
                            @foreach($result['video'] as $video)
                                <div class="col-md-4 mb-3 mb-lg-5">
                                    <a href="{{ route('frontVideoDetail', $video['slug']) }}">
                                        <div class="hover hover-2 text-white rounded">
                                            <img src="{{ $video['thumbnail_url'] }}" alt="{{ $video['title'] }}" class="">
                                            <div class="hover-overlay"></div>
                                            <div class="hover-2-content">
                                                <h4 class="hover-2-title text-uppercase font-weight-bold mb-0"> 
                                                    <span class="font-weight-light">{{ $video['category'] }} </span>
                                                </h4>
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
                @endif
            </div>
        </div>
    </div>
</section>
@stop


@section('scripts')
<script>

</script>

@stop