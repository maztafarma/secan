<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{ route('dashboard') }}" class="site_title"><i class="fa fa-home"></i> <span>SeCan Indonesia</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
            <!-- <img src="images/img.jpg" alt="..." class="img-circle profile_img"> -->
            </div>
            <div class="profile_info">
                
<!--tambahan untuk script sidebar cms ucapan setiap waktu -->              
            <script>
var Digital=new Date()
var hours=Digital.getHours()

//Silahkan sesuaikan dengan pesan yang Anda inginkan
if (hours>=5&&hours<=11) //pesan pagi hari (05.00-11.00)
document.write('<b>Selamat Pagi ! T {{ Auth::user()->name }}</b>')
else if (hours==12) //pesan siang hari (12.00-13.00)
document.write('<b>Selamat Siang dan Selamat Makan Siang!  {{ Auth::user()->name }}</b>')
else if (hours>=13&&hours<=17) //pesan sore hari(14.00-17.00)
document.write('<b>Selamat Sore ! {{ Auth::user()->name }}</b>')
else if (hours>=18&&hours<=20) //pesan petang hari (18.oo-20.00)
document.write('<b>Selamat Petang dan Selamat Bersantai-santai!  {{ Auth::user()->name }}</b>')
else if (hours>=21&&hours<=11) //pesan malam hari (21.00-23.00)
document.write('<b>Selamat Malam!  {{ Auth::user()->name }}</b>')
else //pesan malam mejelang pagi(00.00-04.00)
document.write('<b>Terima Kasih Sudah Sudah Berkunjung pada Malam hari ini!  {{ Auth::user()->name }}</b>')
//edit by http://www.masbugie.com
</script>    



<!--sampai sini -->

<!--ini original -->
            <!--<span>Welcome,</span>-->
            <!--<h2>{{ Auth::user()->name }}</h2>-->
<!--ini comment original-->
            
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li><a><i class="fa fa-home"></i> General <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('indexSeo') }}">Seo</a></li>
                            <li><a href="{{ route('indexBanner') }}">Banner</a></li>
                            <li><a href="{{ route('indexCategory') }}">Category</a></li>
                            <li><a href="{{ route('indexTag') }}">Tag</a></li>
                            <li><a href="{{ route('indexDoctor') }}">Doctor</a></li>
                            <li><a href="{{ route('indexNews') }}">Artikel</a></li>
                            <li><a href="{{ route('indexVideo') }}">Video</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->
    </div>
</div>

<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <nav class="nav navbar-nav">
            <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                        <!-- <img src="images/img.jpg" alt=""> -->
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out pull-right"></i>
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->