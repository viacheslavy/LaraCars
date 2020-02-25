<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Fast & Retro - spécialiste des voitures américaines</title>
    <meta name="description" content="Passionné depuis plus de 20 ans, nous nous efforçons de trouver le véhicule qui vous convient. Spécialisé dans les voitures anciennes, américaines, muscle cars...">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->
    <link rel="stylesheet" href="{{ asset('fe_assets/css/styles.min.css') }}">
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-89864420-1', 'auto');
        ga('send', 'pageview');

    </script>

    <!-- Code Google de la balise de remarketing -->
    <!--
        ------------------------------------------------
        Les balises de remarketing ne peuvent pas être associées aux informations personnelles ou placées sur des pages liées aux catégories à caractère sensible. Pour comprendre et savoir comment configurer la balise, rendez-vous sur la page http://google.com/ads/remarketingsetup.
        ------------------------------------------------
    -->
    <script type="text/javascript">
    /* <![CDATA[ */
    var google_conversion_id = 868623742;
    var google_custom_params = window.google_tag_params;
    var google_remarketing_only = true;
    /* ]]> */
    </script>
    <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
    </script>
    <noscript>
    <div style="display:inline;">
    <img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/868623742/?guid=ON&amp;script=0"/>
    </div>
    </noscript>

</head>

<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<div class="container-fluid header">
    <div class="header-text text-center">
        <!-- <p><span>1<sup>er</sup></span> Importateur de V&eacute;hicules Am&eacute;ricains</p> -->
        <p><span>&nbsp;</span></p>
    </div>
    <div class="container">
        <div class="header-contact">
            <div class="col-xs-12 col-sm-6 header-contact-left">
                <a id="header-contact-id" href="{{ route('get.contact') }}"><img src="{{ asset('fe_assets/img/header-contact-hover.png') }}">
                <img src="{{ asset('/fe_assets') }}/img/header-contact.png" class="headerhover"></a>
                <a id="header-info-id" href="{{ route('get.contact') }}"><img src="{{ asset('fe_assets/img/header-info.png') }}">
                <img src="{{ asset('/fe_assets') }}/img/header-info-hover.png" class="headerhover"></a>
            </div>
            <div class="col-xs-12 col-sm-6 header-contact-right">
                <a href="#">
                    <span>Appelez-Nous<br></span>
                    <p>+33 1 80 89 45 45</p>
                </a>
            </div>
        </div>
    </div>
    <div class="header-pic"></div>
    <div class="header-logo"></div>
</div>
<div class="container header-question">
    <form action="{{ route('get.small.search') }}" method="">
        <div class="col-xs-12">
            <a href="#">Rechercher un v&eacute;hicule</a>
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="">
                <div class="input-group-btn">
                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                </div>
            </div>
        </div>
    </form>
</div>

<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="{{ route('get.home') }}">ACCUEIL</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Comment &Ccedil;a marche</a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('get.presentation') }}">Presentation</a></li>
                        <li><a href="{{ route('get.etape') }}">ETAPE PAR ETAPE</a></li>
                        <li><a href="{{ route('get.faq') }}">FAQ</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('get.index') }}">RECHERCHER UN VEHICULE</a></li>
                <li><a href="{{ route('get.guarantee') }}">NOS GARANTIES</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Temoignages</a>
                    <ul class="dropdown-menu">
                        
                        <li><a href="{{ route('get.testimonials') }}">TEMOIGNAGES ECRITS</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('get.contact') }}">CONTACTEZ-NOUS</a></li>
                @if (\Request::is('presentation'))  
                     <li><a href="{{ asset('ref/importateur-voitures-americaines.html') }}">Voiture</a></li>
                @endif
                @if (\Request::is('faq'))  
                     <li><a href="{{ asset('ref/4x4-americain-occasion.html') }}">Américain</a></li>
                @endif
                @if (\Request::is('etape'))  
                     <li><a href="{{ asset('ref/import-voiture-americaine.html') }}">Importation</a></li>
                @endif
                 @if (\Request::is('guarantee'))  
                     <li><a href="{{ asset('ref/cadillac-1960-a-vendre.html') }}">Véhicule</a></li>
                @endif
                @if (\Request::is('contact'))  
                     <li><a href="{{ asset('ref/chevrolet-camaro-ss-1967.html') }}">Voiture</a></li>
                @endif
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>


@yield('slider')


@yield('content')


@yield('similar')




<div class="container-fluid footer">
    <div class="container">
        <div class="col-xs-12 col-md-4 footer-one">
            <h2>CONSTRUCTEURS<br><span>Am&eacute;ricains</span></h2>
            <div class="footer-one-child">
                <img src="{{ asset('fe_assets/img/footer-pic-1.png') }}">
                <div class="footer-one-child-right">
                    <p><a href="{{ route('get.search') }}?brand=A M C">A M C</a></p>
                    <p><a href="{{ route('get.search') }}?brand=Buick">Buick</a></p>
                    <p><a href="{{ route('get.search') }}?brand=Lincoln">Lincoln</a></p>
                    <p><a href="{{ route('get.search') }}?brand=Cadillac">Cadillac</a></p>
                    <p><a href="{{ route('get.search') }}?brand=Mercury">Mercury</a></p>
                    <p><a href="{{ route('get.search') }}?brand=Chevrolet">Chevrolet</a></p>
                    <p><a href="{{ route('get.search') }}?brand=Oldsmobile">Oldsmobile</a></p>
                    <p><a href="{{ route('get.search') }}?brand=Chrysler">Chrysler</a></p>
                    <p><a href="{{ route('get.search') }}?brand=Packard">Packard</a></p>
                    <p><a href="{{ route('get.search') }}?brand=DeLorean">DeLorean</a></p>
                    <p><a href="{{ route('get.search') }}?brand=Plymouth">Plymouth</a></p>
                    <p><a href="{{ route('get.search') }}?brand=Dodge">Dodge</a></p>
                    <p><a href="{{ route('get.search') }}?brand=Pontiac">Pontiac</a></p>
                    <p><a href="{{ route('get.search') }}?brand=Ford">Ford</a></p>
                    <p><a href="{{ route('get.search') }}?brand=Shelby">Shelby ...</a></p>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-4 footer-one footer-middle">
            <h2>NOS MODELES<br><span>les plus populaires</span></h2>
            <div class="footer-one-child">
                <img src="{{ asset('fe_assets/img/footer-pic-2.png') }}">
                <div class="footer-one-child-right">
                    <p><a href="{{ route('get.search') }}?brand=Ford&model=Mustang">Ford Mustang</a></p>
                    <p><a href="{{ route('get.search') }}?brand=Chevrolet&model=Corvette">Chevrolet Corvette</a></p>
                    <p><a href="{{ route('get.search') }}?brand=Chevrolet&model=Camaro">Chevrolet Camaro</a></p>
                    <p><a href="{{ route('get.search') }}?brand=Jeep&model=CJ">Jeep CJ</a></p>
                    <p><a href="{{ route('get.search') }}?brand=Ford&model=Model A">Ford Model A</a></p>
                    <p><a href="{{ route('get.search') }}?brand=Chevrolet&model=Chevelle">Chevrolet Chevelle</a></p>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-4 footer-one footer-one-social">
            <h2>RETROUVEZ-NOUS<br><span>sur les r&eacute;seaux sociaux</span></h2>
            <div class="share-social">
                <a href="#" class="sfirst"><img src="{{ asset('fe_assets/img/social-gp.png') }}"></a>
                <a href="#" class="ssecond"><img src="{{ asset('fe_assets/img/social-fb.png') }}"></a>
                <a href="#" class="sthird"><img src="{{ asset('fe_assets/img/social-tw.png') }}"></a>
                <a href="#" class="sfourth"><img src="{{ asset('fe_assets/img/social-pin.png') }}"></a>
                <a href="#" class="sfivth"><img src="{{ asset('fe_assets/img/social-map.png') }}"></a>
                <a href="#" class="ssixth"><img src="{{ asset('fe_assets/img/social-li.png') }}"></a>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid ftr-menu">
    <div class="container">
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <i class="fa fa-star" aria-hidden="true"></i>
                <li><a href="{{ route('get.presentation') }}">Comment &Ccedil;a marche</a></li>
                <li><a href="{{ route('get.index') }}">RECHERCHER UN V&Egrave;HICULE</a></li>
                <li><a href="{{ route('get.guarantee') }}">NOS GARANTIES</a></li>
                <li><a href="{{ route('get.legals') }}">Mentions legales</a></li>

                <li><a href="{{ asset('sitemap.xml') }}">Plan du site</a></li>
                <li><a href="{{ route('get.contact') }}">CONTACTEZ-NOUS</a></li>
                <li><a href="{{ asset('ref/glossaire.html') }}">Glossary</a></li>
                @if (\Request::is('presentation'))  
                     <li><a href="{{ asset('ref/importateur-voitures-americaines.html') }}">Voiture</a></li>
                @endif
                @if (\Request::is('faq'))  
                     <li><a href="{{ asset('ref/4x4-americain-occasion.html') }}">Américain</a></li>
                @endif
                @if (\Request::is('etape'))  
                     <li><a href="{{ asset('ref/import-voiture-americaine.html') }}">Importation</a></li>
                @endif
                 @if (\Request::is('guarantee'))  
                     <li><a href="{{ asset('ref/cadillac-1960-a-vendre.html') }}">Véhicule</a></li>
                @endif
                @if (\Request::is('contact'))  
                     <li><a href="{{ asset('ref/chevrolet-camaro-ss-1967.html') }}">Voiture</a></li>
                @endif
                <i class="fa fa-star" aria-hidden="true"></i>
            </ul>
        </div>
    </div>
</div>
<div class="container-fluid copyright">
    <div class="col-xs-12 text-center">
        <p>2017 &copy; Copyright Fast & Retro</p>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog op-modal">
        <!-- Modal content-->
        <div class="modal-content op-content">
            <button type="button" class="close" data-dismiss="modal" style="color:#fff;font-size:50px;position:absolute;top:-25px;right:-5px;color:red;opacity:1;">
                <img src="{{ asset('fe_assets/img/close-pop.png') }}" style="max-width:25px;">
            </button>
            <form id="contact_model1" action="{{ route('post.send_contact') }}" class="form-horizontal" method="post">
                {{ csrf_field() }}
                <input type="email" name="email" placeholder="EMAIL" required="" class="input-custom">
                <button class="sub-btn" type="submit"></button>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModalConfirm" role="dialog">
    <div class="modal-dialog op-modal">
        <!-- Modal content-->
        <div class="modal-content op-content" id="confirm-content">
            <button type="button" class="close" data-dismiss="modal" style="color:#fff;font-size:50px;position:absolute;top:-25px;right:-5px;color:red;opacity:1;">
                <img src="{{ asset('fe_assets/img/close-pop.png') }}" style="max-width:25px;">
            </button>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<script>
    window.jQuery || document.write('<script src="{{ asset('fe_assets/js/vendor/jquery-1.12.0.min.js') }}"><\/script>')
</script>
<script src="{{ asset('fe_assets/js/javascripts.min.js') }}"></script>
@yield('fotterjs')
<script>
    function getParameterByName(name, url){
        if(!url) url = window.location.href;
        name = name.replace(/[\[\]]/g, "\\$&");
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    }
    jQuery(document).ready(function($) {
        $('#myModal1').on('hidden.bs.modal', function(){
            $.cookie('is_contacted', 'present', { path: '/' });
        });
        if(getParameterByName('show') == 'confirm'){
            $('#myModalConfirm').modal('show');
            var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname;
            window.history.pushState({ path: newurl, }, '', newurl);
        }
        var cookieValue = $.cookie('is_contacted');
        if(cookieValue == null){
            setTimeout(function(){
                $('#myModal1').modal('show');
            }, 6000);
        }
        $("#contact_model1").submit(function(e) {
            // document.cookie = "contact=contact; expires=Thu, 18 Dec 2013 12:00:00 UTC; path=/";
            $.cookie('is_contacted', 'present', {
                path: '/'
            });
         });

        $('#myCarousel2').carousel({
            interval: false
        });

        $('#carousel-text').html($('#slide-content-0').html());

        //Handles the carousel thumbnails
        $('[id^=carousel-selector-]').click( function(){
            var id = this.id.substr(this.id.lastIndexOf("-") + 1);
            var id = parseInt(id);
            $('#myCarousel2').carousel(id);
        });


        // When the carousel slides, auto update the text
        $('#myCarousel2').on('slid.bs.carousel', function (e) {
            var id = $('.item.active').data('slide-number');
            $('#carousel-text').html($('#slide-content-'+id).html());
        });


      /*  $(".zoomImage").elevateZoom({
            zoomType	: "lens",
            lensShape : "round",
            lensSize    : 300
        });*/

        $(document).ready(function(){
            $('.zoom').zoom(); 
            $('.zoomfull').wrap('<span style="display:block"></span>').css('display', 'block').parent().zoom();
        });

        var form = $('#modal1Form');
        ajaxFormSubmit(form);

        var form2 = $("#modal2Form");
        ajaxFormSubmit(form2);

        var form3 = $("#modal3Form");
        ajaxFormSubmit(form3);

        var form4 = $("#modal4Form");
        ajaxFormSubmit(form4);



        var subsForm = $("#subscribeForm");

        subsForm.submit(function(e) {
            e.preventDefault();

            subsForm.parsley().validate();

            if (subsForm.parsley().isValid()) {

                $.ajax({
                    type: "POST",
                    url: subsForm.attr( 'action' ),
                    data: subsForm.serialize(),
                    success: function( response ) {
                        $('#subscribeModalAlert').modal('show');
                        $(".modal-backdrop.in").hide();
                    }
                });
            }
        });


        $("#subscribeForm2").submit(function(e) {
            e.preventDefault();

            $("#subscribeForm2").parsley().validate();

            if ($("#subscribeForm2").parsley().isValid()) {

                $.ajax({
                    type: "POST",
                    url: $("#subscribeForm2").attr( 'action' ),
                    data: $("#subscribeForm2").serialize(),
                    success: function( response ) {
                        $("#closeMeLol").trigger('click');
                        $('#subscribeModalAlert').modal('show');
                        $(".modal-backdrop.in").hide();
                    }
                });
            }
        });

        $('#myCarousel2').carousel({
            interval: 1000
        });



    });

     $(document).ready(function(e){
        $('.carousel-inner2').bxSlider({
            slideWidth: 300,
            minSlides: 1,
            speed: 2000,
            maxSlides: 5,
            moveSlides: 1,
            slideMargin: 0,
            controls: false,
            autoHover: true,
            pause: 0,
            auto:true,
            autoStart: true
        });
    });



   
    function ajaxFormSubmit(form) {
        form.submit(function(e) {
            e.preventDefault();

            $(".removeMeInit").remove();
            var formID = form.attr('id');

            form.parsley().validate();

            if (form.parsley().isValid()) {
                $("#" + formID + " button").hide();

                $.ajax({
                    type: "POST",
                    url: form.attr( 'action' ),
                    data: form.serialize(),
                    success: function( response ) {
                        form.append("<div class='alert alert-success removeMeInit'>" + response + "</div>");
                    }
                });
            }


        });
    }
</script>

<style>
    .hide-bullets {
        list-style:none;
        margin-left: -40px;
        margin-top:20px;
    }
</style>
<script>
    jQuery(document).ready(function($) {
        $(".allForms").parsley()
    });
</script>
</body>
</html>