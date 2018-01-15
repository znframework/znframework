<header class="header navbar-fixed-top">
    <!-- Navbar -->
    <nav class="navbar" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="menu-container">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="toggle-icon"></span>
                </button>

                <!-- Logo -->
                <div class="logo">
                    <a class="logo-wrap" href="{{URL::site()}}">
                        <img class="logo-img logo-img-main" src="img/logo.png" alt="Asentus Logo">
                        <img class="logo-img logo-img-active" src="img/logo-dark.png" alt="Asentus Logo">
                    </a>
                </div>
                <!-- End Logo -->
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse nav-collapse">
                <div class="menu-container">
                    <ul class="navbar-nav navbar-nav-right">
					@foreach( $menus as $key => $val ):
					<li class="nav-item"><a class="nav-item-child nav-item-hover active" href="{{URL::site($key)}}">{{$val}}</a></li>
					@endforeach:
                    </ul>
                </div>
            </div>
            <!-- End Navbar Collapse -->
        </div>
    </nav>
    <!-- Navbar -->
</header>