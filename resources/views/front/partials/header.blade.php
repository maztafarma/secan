<!-- navbar-->
<header class="header">
    <nav class="navbar navbar-expand-lg">
    
        <div class="container-fluid">
            {{--
            <div class="navbar-holder nav-language d-flex align-items-center justify-content-between">
                <ul class="desktop_only nav-menu list-unstyled flow-root flex-md-row align-items-md-center">
                    <!-- Languages dropdown    -->
                    <li class="nav-item dropdown right">
                        <a id="languages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link language dropdown-toggle">
                        @if (LaravelLocalization::getCurrentLocale() == 'en')    
                        <img src="{{ asset('images/flags/GB.png') }}" alt="{{ current(explode(' ', LaravelLocalization::getCurrentLocaleNative())) }}">
                        @else
                        <img src="{{ asset('images/flags/ID.png') }}" alt="{{ current(explode(' ', LaravelLocalization::getCurrentLocaleNative())) }}">
                        @endif
                        
                        <span class="d-none d-sm-inline-block">
                            {{ current(explode(' ', LaravelLocalization::getCurrentLocaleNative())) }}
                            </span>
                        </a>
                        <ul aria-labelledby="languages" class="dropdown-menu">
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $language)
                                <li>
                                    <a rel="nofollow" class="dropdown-item" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                        @if ($localeCode == 'en')
                                            <img src="{{ asset('images/flags/GB.png') }}" alt="{{ current(explode(' ', $language['native'])) }}" class="mr-2">
                                        @else
                                            <img src="{{ asset('images/flags/ID.png') }}" alt="{{ current(explode(' ', $language['native'])) }}" class="mr-2">
                                        @endif
                                        {{ current(explode(' ', $language['native'])) }}
                                    </a>
                                </li>

                            
                            @endforeach
                        </ul>
                    </li>
                    
                </ul>
            </div>
            --}}
            <!-- <div class="row"> -->
                <!-- <div class="col-md-3"> -->
                    <div class="d-flex navbar-brand">
                        <a href="{{ route('frontHome') }}">
                        <img id="logo-images" class="logo" src="{{ asset('images/logo.svg') }}">
                        </a>
                        
                    </div>
                <!-- </div> -->
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                        <i class="fas fa-bars"></i>
                    </button>
                <!-- <div class="col-md-9"> -->
                    
                    <!--  -->
                        
                    <!--  -->
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav m-auto ff-heebo-thin">
                            <li class="nav-item">
                                <form class="form-inline my-2 my-lg-0">
                                    <div class="form-search-icon-m full-width">
                                        <input type="text" class="form-search" placeholder="Cari" />
                                        <button class="btn my-2 my-sm-0" type="submit">
                                            <img src="{{ asset('images/search_icon.png') }}" />
                                        </button>
                                    </div>
                                </form>
                            </li>
                            <li class="nav-item"><a class="nav-link link-scroll" href="{{ route('frontHome') }}">Beranda </a></li>
                            <li class="nav-item"><a class="nav-link link-scroll" href="{{ route('frontAbout') }}">Tentang SeCan</a></li>
                            
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownArtikel" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Artikel
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownArtikel">
                                    <div class=" d-flex">
                                        <a class="dropdown-item" href="{{ route('frontNewsCategory', 'kesehatan') }}">Kesehatan</a>
                                        <a class="dropdown-item" href="{{ route('frontNewsCategory', 'kecantikan') }}">Kecantikan</a>
                                    </div>
                                    
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownDoctor" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Dokter
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownDoctor">
                                    <div class="">
                                        <a class="dropdown-item" href="{{ route('frontDoctor') }}">Direktori Dokter</a>
                                        <a class="dropdown-item" href="{{ route('frontDoctorArticle') }}">Artikel Dokter</a>
                                        <a class="dropdown-item" href="{{ route('frontDoctorVideo') }}">Video Dokter</a>
                                    </div>
                                    
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownVideo" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Video
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownVideo">
                                    <div class=" d-flex">
                                        <a class="dropdown-item" href="{{ route('frontVideoCategory', 'kesehatan') }}">Kesehatan</a>
                                        <a class="dropdown-item" href="{{ route('frontVideoCategory', 'kecantikan') }}">Kecantikan</a>
                                    </div>
                                    
                                </div>
                            </li>
                            <li class="nav-item"><a class="nav-link link-scroll" href="{{ route('frontHome') .'#contact' }}">Kontak</a>
                            </li>
                        </ul>
                        <form action="{{ route('frontSearch') }}" method="GET" class="form-inline my-2 my-lg-0">
                            <div class="form-search-icon ff-heebo-thin">
                                <input type="text" name="q" class="form-search" placeholder="Cari" />
                                <button class="btn my-2 my-sm-0" type="submit">
                                    <img src="{{ asset('images/search_icon.png') }}" />
                                </button>
                            </div>
                        </form>
                    </div>
                <!-- </div> -->
            <!-- </div> -->
        </div>
    </nav>
</header>
