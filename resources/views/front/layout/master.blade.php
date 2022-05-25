<!DOCTYPE html>
<html>
<head>
    @include('front.partials.meta') 
    <!-- css -->    
    <link rel="stylesheet" href="{{ asset('css/secan_plugins.css') }}">

	<link rel="icon" type="image/png" href="{{ asset('images/favicon-32x32.png') }}">
	
    <!-- PNotify -->
    <link href="{{ asset('js/external/Pnotify/dist/pnotify.css') }}" rel="stylesheet">
    <link href="{{ asset('js/external/Pnotify/dist/pnotify.buttons.css') }}" rel="stylesheet">
    <link href="{{ asset('js/external/Pnotify/dist/pnotify.nonblock.css') }}" rel="stylesheet">
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-38845024-11"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-38845024-11');
	</script>-->
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-MP2PNYWS59"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-MP2PNYWS59');
</script>
	
	
	
</head>

<body class="@yield('body-class','')" id="body">		
	@include('front.partials.header') 
	
	<!-- content -->
	@yield('content')

	@include('front.partials.footer')
</body>

<!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<!-- main -->
<script src="{{ asset('js/secan_plugins.js')}}"></script>
<script>
	
    var appDomain = {!! json_encode(env('APP_URL')) !!}
    
    function removeLoader()
    {
        $(".loader").fadeOut("slow");
    }
    $('body').append('<div class="loader"><img src="{{ asset('images/logo.svg') }}" /></div>');
    $(window).on('load', function(){
        setTimeout(removeLoader, 2000); //wait for page load PLUS two seconds.
    });
</script>
<!-- <script src='https://www.google.com/recaptcha/api.js'></script> -->
@yield('scripts')

<!-- PNotify -->
<script src="{{ asset('js/external/Pnotify/dist/pnotify.js') }}" defer></script>
<script src="{{ asset('js/external/Pnotify/dist/pnotify.buttons.js') }}" defer></script>
<script src="{{ asset('js/external/Pnotify/dist/pnotify.nonblock.js') }}" defer></script>

<script>
    var subscribe = new Vue({
        el: "#subscribe",
        data: {
            models: {
                fullname: '',
                email: '',
            }
        },

        methods: {

            storeSubscribe: function() {

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
                                        $('#field_subscribe_' + key.replace('.', '_')).text(value)
                                    });


                                } else {
                                    notify('Error!', response.message, 'error');

                                }
                            } else {

                                vm.clearErrorMessage();
                                vm.resetForm()
                                notify('Success!', 'Subscribe berhasil, terimaksih.', 'success');

                            }
                        },
                        complete: function (response) {
                            // hideLoading()
                        }

                    };
                    $("#form_subscribe").ajaxForm(optForm);
                    $("#form_subscribe").submit();
                    
                } catch (error) {
                    
                }
            },

            clearErrorMessage: function() {
                $('.text-error').text('')
            },

            resetForm: function() {
                this.models = {
                    fullname: '',
                    email: ''
                }
            }
        }
            
    });
</script>
</html>