@if(isset($tags) && !empty($tags))
    <br/>
    <div class="news_tag">
        <p class="text-uppercase text-left mb-3">
            <h6 class="ff-old-standart">TAG</h6>
        </p>
        <p class="text-sm text-uppercase text-left mb-3">
            @foreach($tags as $tags)
            @if(Request::segment(1) == 'artikel')
            <a href="{{ route('frontNewsTag', $tags['slug']) }}">{{ $tags['title'] }} ({{$tags['total']}})</a>
            @elseif(Request::segment(1) == 'video')
            <a href="{{ route('frontVideoTag', $tags['slug']) }}">{{ $tags['title'] }} ({{$tags['total']}})</a>
            @endif
            @endforeach
        </p>
    </div>

@endif