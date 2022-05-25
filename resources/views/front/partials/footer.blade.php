<!-- Footer-->
<footer>
    <div class="container text-center section-padding-y footer">
        <div class="row px-4">
            <div class="col-lg-3 mx-auto text-left">
                
                <!--
                <h6 class="text-uppercase mb-4 text-sm">Kontak </h6>
                <h4 class="text-base ff-old-standart">salam@secan.id</h4>-->

                <p class="center text-sm text-uppercase mt-5 ff-heebo-regular">
                    Ikuti Kabar Kami
                </p>

                <ul class="list-unstyled d-flex flex-md-row align-items-md-center">

                    <li class="m-3" style="margin-left: 0 !important">
                        <a href="https://www.youtube.com/watch?v=KZKwflR8cJo" taget="__blank">
                        <i class="fab fa-youtube"></i>
                        </a>
                    
                    </li>

                    <li class="m-3">
                        <a href="https://www.instagram.com/infosehatdancantik.id/" target="__blank">
                            <i class="fab fa-instagram"></i>
                        </a>
                    
                    </li>

                    <li class="m-3">
                        <a href="https://twitter.com/IndonesiaSecan">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                    
                    <li class="m-3">
                        <a href="https://www.facebook.com/Secan-Indonesia-106634738008475">
                            <i class="fab fa-facebook"></i>
                        </a>
                    </li>
                    
                    <li class="m-3">
                        <a href="https://www.linkedin.com/in/secan-indonesia-27390a204/">
                            <i class="fab fa-linkedin"></i>
                        </a>
                    
                    </li>
                    
                </ul>
            </div>
            <div class="col-lg-5 mx-auto">
                <ul class="address text-left">
                    <li class="mb-3 d-flex">
                        <i class="fas fa-home mr-4"> </i>Green Sedayu Biz Park DM 16 No.38 <br /> 
                        Jl. Daan Mogot Km 18, Kalideres Jakarta Barat
                    </li>
                    <li class="mb-3 d-flex">
                        <i class="fas fa-phone mr-4"> </i>
                        021-22527412, 021-22528429
                    </li>
                    <li class="mb-3 d-flex">
                        <i class="fas fa-mail-bulk mr-4"> </i>
                        info@secan.id
                    </li>
                </ul>
            </div>
            <div class="col-lg-4 mx-auto desktop_only" id="subscribe">
                <p class="text-sm text-uppercase mb-5 ff-heebo-regular">
                    Berlangganan
                </p>

                <form action="{{ route('storeSubscribe') }}" method="POST" id="form_subscribe" @submit.prevent>
                    <div class="form-group mb-4 d-flex">
                        <input type="text" name="fullname" v-model="models.fullname" placeholder="Nama Lengkap" class="form-subscribe">
                        
                    </div>
                    <span class="text-left pl-2 text-error mb-3 d-block" id="field_subscribe_fullname"></span>
                    <div class="form-group mb-4 d-flex">
                        <input type="email" name="email" v-model="models.email" placeholder="Email" class="form-subscribe">
                        
                    </div>
                    <span class="text-left pl-2 text-error mb-3 d-block" id="field_subscribe_email"></span>
                    <div class="form-group d-flex">      
                    {{ csrf_field() }}	  
                        <button type="submit" class="btn btn-dark p-3" @click="storeSubscribe">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</footer>


@section('scripts')


@stop