@extends('front.layout.master')
@section('content')

    <!-- Hero Section-->
    <!-- <section class="hero bg-cover bg-center" id="hero" style="background-image: url({{ asset('images/banner/home.png') }})"> -->
    <div class="row">
        @if(isset($home_sliders) && !empty($home_sliders))
        <div class="col-md-12 col-lg-12">
            <div id="jssor_1"
                style="position:relative;margin:0 auto;top:0px;left:0px;width:1600px;height:1024px;overflow:hidden;visibility:hidden;">
                <div data-u="slides"
                    style="cursor:default;position:relative;top:0px;left:0px;width:1600px;height:1024px;overflow:hidden;">
                    @foreach($home_sliders as $keySlider=> $slider)
                        <div>
                            <img data-u="image" style="opacity:0.8;" data-src="{{ $slider['image_url'] }}" alt="{{ $slider['title'] }}" />
                        </div>
                    @endforeach
                </div>
                <!-- Arrow Navigator -->
                <div data-u="arrowleft" class="jssora051" style="width:55px;height:55px;top:0px;left:25px;" data-autocenter="2"
                    data-scale="0.75" data-scale-left="0.75">
                    <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                        <polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
                    </svg>
                </div>
                <div data-u="arrowright" class="jssora051" style="width:55px;height:55px;top:0px;right:25px;"
                    data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
                    <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                        <polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
                    </svg>
                </div>
            </div>
        </div>
        @endif

    </div>
    <!-- About Section-->
    <section class="bg-cover bg-center" style="background-image: url({{ asset('images/bg_section_about_2.png') }})">
            
        <div class="container">
             <div class="row">
                <div class="col-md-12">
                <p class="about_deskription ff-inconsolata-med">
                Setiap orang ingin sehat dan tampil cantik. Tapi sayangnya masih banyak masyarakat tidak mendapatkan informasi secara tepat. Secan.id hadir untuk mencerdaskan masyarakat dengan memberikan informasi mengenai kesehatan dan kecantikan dari dokter yang ahli di bidangnya.
                        <br />
                        {{ trans('home.follow_at_link') }}<b><a href="https://www.instagram.com/infosehatdancantik.id/" target="__blank">@SeCanindonesia</a></b>
                    </p>
                </div>
                <div class="col-md-3">
                    <p class="about_link ml-4">
                        <a href="{{ route('frontAbout') }}">{{ trans('home.about_link') }}</a>
                    </p>
                </div>
                <div class="col-md-9">
                    <img src="{{ asset('images/section-2.png') }}" style="width: 100%" />
                </div>
                
            </div>
        </div>
    </section>

    <!-- Article Section-->
    <section class="bg-cover bg-center pt-5" style="background-image: url({{ asset('images/bg_home_section_news.png') }})">
        <div class="container-fluid">
            <div class="row" style="margin: 0 3em;">
                <div class="col-md-12">
                    <div class="col-md-8 m-auto">
                        <div class="container">
                            <p class="article_description ff-inconsolata-med">
                            Menyajikan berbagai informasi tentang kesehatan dan kecantikan yang disajikan secara padat dan ringkas. Telusuri dan temukan lebih banyak artikel menarik yang wajib diketahui.
                            </p>
                        </div>
                    </div>
                </div>
                @if(isset($home_news) && !empty($home_news))
                    @foreach($home_news as $keyNews=> $news)
                        <div class="col-md-3">
                            <p class="text-center" style="">
                                <img src="{{ $news['home_thumbnail_url'] }}" alt="{{ $news['title'] }}" style="width: 100%" />
                                <span class="article_category">
                                {{ $news['category'] }}
                                </span>
                                <a href="{{ route('frontNewsDetail', $news['slug']) }}">
                                    <h4 class="article_title text-center text-base ff-old-standart">{{ $news['title'] }}</h4>
                                </a>
                            </p>
                        </div>
                    @endforeach
                    <div class="col-md-3 artikel_circle_container">
                        <div class="circle_news">
                            <span class="">Blog dan artikel perawatan kulit, riasan dan yang diantaranya</span>
                            <h5 style="margin-top:1em;">
                                <a class="ff-old-standart" href="{{ route('frontNews') }}" >
                                    <u style="position: absolute;display: contents;">Lihat Artikel</u>
                                </a>
                            </h5>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Youtube Section -->
    <section class="pt-5 bg-cover bg-center" style="background-image: url({{ asset('images/bg_home_section_full_video.png') }})">
            
        <div class="container">
             <div class="row">
                <div class="col-md-12">
                    <p class="article_description ff-inconsolata-med">
                    Saksikan video dan treatment dari para dokter kesehatan dan kecantikan terpercaya. Dapatkan informasi dan solusi yang tepat mengenai kesehatan dan kecantikan dari tenaga yang ahli di bidangnya.
                        <br />
                        <br />
                        <b><a href="#subscribe">Berlangganan</a></b> untuk ikuti kontent mingguan tentang kesehatan dan kecantikan.
                    </p>
                </div>
                @if(isset($home_video) && !empty($home_video))
                    @foreach($home_video as $home_video)
                        <div class="col-md-4 mb-5">
                            
                            <p class="text-center">
                                <img src="{{ $home_video['home_thumbnail_url'] }}" alt="{{ $home_video['title'] }}" style="width: 100%" >
                                <span class="article_category">
                                    {{ $home_video['category'] }}
                                </span>
                            </p>
                            <h5 class="article_title text-center ff-old-standart">
                                <a href="{{ route('frontVideoDetail', $home_video['slug']) }}">
                                    {{ $home_video['title'] }}
                                </a>
                            </h5>
                                
                            
                        </div>
                    @endforeach
                @endif
                
            </div>
        </div>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">
                    
                    <iframe style="width: 100%;position: relative;z-index: 9;" height="565" src="https://www.youtube.com/embed/KZKwflR8cJo" ?REL=”0”&VQ=”HD1080” frameborder="0" allowfullscreen></iframe>
                    <div class="circle">
                        <span>Disini tempat video tentang tips dan olah kecantikan untuk kamu.</span>
                        <h5 style="margin-top:1em;">
                            <a href="{{ route('frontVideo') }}" >
                                Jelajahi Video
                            </a>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pb-5 pt-4 bg-cover bg-center" style="background-image: url({{ asset('images/bg_home_section_doctor.png') }})">
            
        <div class="container">
                <div class="row">
                <div class="col-md-12">
                    <p class="article_description ff-inconsolata-med">
                    Temukan jawaban yang tepat mengenai seputar kesehatan dan kecantikan dari para dokter terpercaya. Berbagai informasi dan solusi diberikan  secara objektif dan mudah dipahami. Simak artikel dan videonya.
                    </p>
                </div>
                <div class="col-md-3 col-sm-4">
                    
                    <p class="text-center" style="">
                        <img src="{{ asset('images/doctor/dokter_1.png') }}" style="width: 100%" />
                        
                    </p>
                </div>
                <div class="col-md-3 col-sm-4">
                    
                    <p class="text-center" style="">
                        <img src="{{ asset('images/doctor/dokter_2.png') }}" style="width: 100%" />
                        
                    </p>
                </div>
                <div class="col-md-3 col-sm-4">
                    
                    
                    <p class="text-center" style="">
                        <img src="{{ asset('images/doctor/dokter_3.png') }}" style="width: 100%" />
                        
                    </p>
                </div>
                <div class="col-md-3">
                    <div class="circle_bottom">
                        <span>Dokter-dokter yang berafiliasi dengan SeCan adalah terpercaya dan ahli.</span>
                        <h5 style="margin-top:1em;">
                            <a class="ff-old-standart" href="{{ route('frontDoctor') }}" >
                                <u style="position: absolute;display: contents;">Lihat Dokter</u>
                            </a>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="contact" class="pt-5 text-white bg-cover bg-center" style="background-image: url({{ asset('images/bg_home_section_contact.png') }})">
            
        <div class="container">
            <div class="row">
                <div class="col-md-6 contact_section">
                    <div class="container-fluid">
                    
                        <div class="card-body contact_description">
                            <p>
                                Hanya dengan saling menyapa, kita bisa tau banyak hal.
                            
                                <br/>
                                <br/>
                                <small>kontak@secan.id</small>
                            </p>
                            <form action="{{ route('storeContact') }}" method="POST" class="" id="form_contact" @submit.prevent>
                                <div class="form-group">
                                    <!-- <label class="form-control-label">Name</label> -->
                                    <input type="text" name="fullname" v-model="models.fullname" placeholder="Nama Lengkap" class="form-contact">
                                    <span class="text-error mt-2 d-block" id="field_fullname"></span>
                                </div>
                                <div class="form-group">       
                                    <!-- <label class="form-control-label">Email</label> -->
                                    <input type="email" name="email" v-model="models.email" placeholder="Email" class="form-contact">
                                    <span class="text-error mt-2 d-block" id="field_email"></span>
                                </div>
                                <div class="form-group">       
                                    <textarea class="form-contact" name="message" v-model="models.message" style="height: 200px" placeholder="Cerita Kamu"></textarea>
                                    <span class="text-error mt-2 d-block" id="field_message"></span>
                                </div>
                                <div class="form-group">   
                                    {{ csrf_field() }}	    
                                    <button type="submit" class="btn btn-submit-contact" @click="storeContact">Kirim</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 desktop_only">
                    <img src="{{ asset('images/Asset 07_img.png') }}" style="width: 100%" />
                </div>
            </div>
        </div>
    </section>
@stop

@section('scripts')

<script src="{{ asset('js/jssor.slider-28.0.0.min.js') }}" type="text/javascript"></script>

<script type="text/javascript">
    window.jssor_1_slider_init = function() {

        var jssor_1_SlideoTransitions = [
            [{b:-1,d:1,ls:0.5},{b:0,d:1000,y:5,e:{y:6}}],
            [{b:-1,d:1,ls:0.5},{b:200,d:1000,y:25,e:{y:6}}],
            [{b:-1,d:1,ls:0.5},{b:400,d:1000,y:45,e:{y:6}}],
            [{b:-1,d:1,ls:0.5},{b:600,d:1000,y:65,e:{y:6}}],
            [{b:-1,d:1,ls:0.5},{b:800,d:1000,y:85,e:{y:6}}],
            [{b:-1,d:1,ls:0.5},{b:500,d:1000,y:195,e:{y:6}}],
            [{b:0,d:2000,y:30,e:{y:3}}],
            [{b:-1,d:1,rY:-15,tZ:100},{b:0,d:1500,y:30,o:1,e:{y:3}}],
            [{b:-1,d:1,rY:-15,tZ:-100},{b:0,d:1500,y:100,o:0.8,e:{y:3}}],
            [{b:500,d:1500,o:1}],
            [{b:0,d:1000,y:380,e:{y:6}}],
            [{b:300,d:1000,x:80,e:{x:6}}],
            [{b:300,d:1000,x:330,e:{x:6}}],
            [{b:-1,d:1,r:-110,sX:5,sY:5},{b:0,d:2000,o:1,r:-20,sX:1,sY:1,e:{o:6,r:6,sX:6,sY:6}}],
            [{b:0,d:600,x:150,o:0.5,e:{x:6}}],
            [{b:0,d:600,x:1140,o:0.6,e:{x:6}}],
            [{b:-1,d:1,sX:5,sY:5},{b:600,d:600,o:1,sX:1,sY:1,e:{sX:3,sY:3}}]
        ];

        var jssor_1_options = {
            $AutoPlay: 1,
            $LazyLoading: 1,
            $CaptionSliderOptions: {
            $Class: $JssorCaptionSlideo$,
            $Transitions: jssor_1_SlideoTransitions
            },
            $ArrowNavigatorOptions: {
            $Class: $JssorArrowNavigator$
            },
            $BulletNavigatorOptions: {
            $Class: $JssorBulletNavigator$,
            $SpacingX: 20,
            $SpacingY: 20
            }
        };

        var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

        /*#region responsive code begin*/

        var MAX_WIDTH = 3000;

        function ScaleSlider() {
            var containerElement = jssor_1_slider.$Elmt.parentNode;
            var containerWidth = containerElement.clientWidth;

            if (containerWidth) {

                var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

                jssor_1_slider.$ScaleWidth(expectedWidth);
            }
            else {
                window.setTimeout(ScaleSlider, 30);
            }
        }

        ScaleSlider();

        $Jssor$.$AddEvent(window, "load", ScaleSlider);
        $Jssor$.$AddEvent(window, "resize", ScaleSlider);
        $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
        /*#endregion responsive code end*/
    };
</script>
<script type="text/javascript">jssor_1_slider_init();
    </script>
<script>
    var contact = new Vue({
        el: "#contact",
        data: {
            models: {
                fullname: '',
                email: '',
                message: ''
            }
        },

        methods: {

            storeContact: function() {

                try {

                    var vm = this;

                    var optForm = {
                        dataType: "json",
                        beforeSerialize: function (form, options) {
                            // showLoading()
                        },
                        beforeSend: function () {
                            vm.clearErrorMessage();

                        },
                        success: function (response) {
                            if (response.status == false) {
                                if (response.is_error_form_validation) {

                                    var message_validation = []
                                    $.each(response.message, function (key, value) {

                                        $('input[name="' + key.replace('.', '_') + '"]').focus();
                                        $('#field_' + key.replace('.', '_')).text(value)
                                    });


                                } else {
                                    notify('Error!', response.message, 'error');

                                }
                            } else {

                                vm.clearErrorMessage();
                                vm.resetForm()
                                notify('Success!', 'Submit contact berhasil, terimaksih.', 'success');

                            }
                        },
                        complete: function (response) {
                            // hideLoading()
                        }

                    };
                    $("#form_contact").ajaxForm(optForm);
                    $("#form_contact").submit();
                    
                } catch (error) {
                    
                }
            },

            clearErrorMessage: function() {
                $('.text-error').text('')
            },

            resetForm: function() {
                this.models = {
                    fullname: '',
                    email: '',
                    message: ''
                }
            }
        }
            
    });
</script>
@stop