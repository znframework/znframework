<footer class="footer">
                <!-- Links -->
    <div class="footer-seperator">
        <div class="content-lg container">
            <div class="row">
                

                <div class="col-sm-2 sm-margin-b-50">
                    <!-- List -->
                    <ul class="list-unstyled footer-list">
                        @foreach( $menus as $key => $val ):
                        <li class="footer-list-item"><a class="footer-list-link" href="{{URL::site($key)}}">{{$val}}</a></li>
                        @endforeach:
                    </ul>
                    <!-- End List -->
                </div>
                <div class="col-sm-4 sm-margin-b-30">
                    <!-- List -->
                    <ul class="list-unstyled footer-list">
                        @foreach( $socials as $key => $val ):
                        <li class="footer-list-item"><a class="footer-list-link" href="{{$key}}">{{$val}}</a></li>
                        @endforeach:
                    </ul>
                    <!-- End List -->
                </div>
    

                <div class="col-sm-5 sm-margin-b-30">
                    <h2 class="color-white">Send Us A Note</h2>
                    <input type="text" class="form-control footer-input margin-b-20" placeholder="Name" required>
                    <input type="email" class="form-control footer-input margin-b-20" placeholder="Email" required>
                    <input type="text" class="form-control footer-input margin-b-20" placeholder="Phone" required>
                    <textarea class="form-control footer-input margin-b-30" rows="6" placeholder="Message" required></textarea>
                    <button type="submit" class="btn-theme btn-theme-sm btn-base-bg text-uppercase">Submit</button>
                </div>
            </div>
            <!--// end row -->
        </div>
    </div>
    <!-- End Links -->

    <!-- Copyright -->
    <div class="content container">
        <div class="row">
            <div class="col-xs-6">
                <img class="footer-logo" src="img/logo.png" alt="Asentus Logo">
            </div>
            <div class="col-xs-6 text-right">
                <p class="margin-b-0"><a class="color-base fweight-700" href="https://www.znframework.com/">ZN Framework</a> &raquo; PHP Web Framework</p>
            </div>
        </div>
        <!--// end row -->
    </div>
    <!-- End Copyright -->
</footer>
<!--========== END FOOTER ==========-->

<!-- Back To Top -->
<a href="javascript:void(0);" class="js-back-to-top back-to-top">Top</a>

<script src="vendor/jquery.min.js" type="text/javascript"></script>
<script src="vendor/jquery-migrate.min.js" type="text/javascript"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

<!-- PAGE LEVEL PLUGINS -->
<script src="vendor/jquery.easing.js" type="text/javascript"></script>
<script src="vendor/jquery.back-to-top.js" type="text/javascript"></script>
<script src="vendor/jquery.smooth-scroll.js" type="text/javascript"></script>
<script src="vendor/jquery.wow.min.js" type="text/javascript"></script>
<script src="vendor/swiper/js/swiper.jquery.min.js" type="text/javascript"></script>
<script src="vendor/masonry/jquery.masonry.pkgd.min.js" type="text/javascript"></script>
<script src="vendor/masonry/imagesloaded.pkgd.min.js" type="text/javascript"></script>
<script src="vendor/jquery.parallax.min.js" type="text/javascript"></script>

<!-- PAGE LEVEL SCRIPTS -->
<script src="js/layout.min.js" type="text/javascript"></script>
<script src="js/components/wow.min.js" type="text/javascript"></script>
<script src="js/components/swiper.min.js" type="text/javascript"></script>
<script src="js/components/masonry.min.js" type="text/javascript"></script>

@foreach( $scripts ?? [] as $script ):
    {[ $pre = IS::url($script) === false ? URL::base(THEMES_DIR) : NULL ]}
    <script src="{{$pre.$script}}" type="text/javascript"></script>
@endforeach: