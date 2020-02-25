@extends('layouts.app')


@section('slider')

    <div class="container-fluid underheader text-center home-carousel">
        <div class="container">
            @if(Session::has('error'))
                <div class="alert alert-danger alert-dismissible">
                    <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button> {{ Session::get('error') }}
                </div>
            @endif
            @if(Session::has('message'))
                <div class="alert alert-success alert-dismissible">
                    <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button> {{ Session::get('message') }}
                </div>
            @endif


            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                    <li data-target="#myCarousel" data-slide-to="3"></li>
                    <li data-target="#myCarousel" data-slide-to="4"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <img src="{{ asset('fe_assets/img/home-slide-1.png') }}" alt="" class="img-responsive">
                    </div>

                    <div class="item">
                        <img src="{{ asset('fe_assets/img/home-slide-2.png') }}" alt="" class="img-responsive">
                    </div>

                    <div class="item">
                        <img src="{{ asset('fe_assets/img/home-slide-3.png') }}" alt="" class="img-responsive">
                    </div>

                    <div class="item">
                        <img src="{{ asset('fe_assets/img/home-slide-4.png') }}" alt="" class="img-responsive">
                    </div>
                    <div class="item">
                        <img src="{{ asset('fe_assets/img/home-slide-5.png') }}" alt="" class="img-responsive">
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('content')

    @include('layouts.search')


    <div class="container-fluid home">
        <div class="container productsingle">
            <div class="col-xs-12 col-sm-4 col-md-3 productsingle-sidebar-parent home-left">
<!--
                <div class="dropdown-brand">
                    <div class="dropdown">
                        <a href="#" type="button" data-toggle="dropdown"><img src="{{ asset('fe_assets/img/home-sidebar-brand.png') }}"></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Coming Soon</a></li>
                        </ul>
                    </div>
                </div>
                <div class="dropdown-brand">
                    <div class="dropdown">
                        <a href="#" type="button" data-toggle="dropdown"><img src="{{ asset('fe_assets/img/home-sidebar-year.png') }}"></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Coming Soon</a></li>
                        </ul>
                    </div>
                </div>
-->
                <div class="sidebar-dropdown">
                    <a href="{{ route('get.index') }}">
                        <img src="{{ asset('fe_assets/img/homerecardz.png') }}">
                    </a>
                </div>
                <div class="sidebar-divider">
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                </div>
                     
<!--
                <div class="sidebar-product">
                    <img src="{{ asset('fe_assets/img/home-sidebar-product.png') }}">
                    <hr>
                    <a href="#">
                        <img src="{{ asset('fe_assets/img/home-sidebar-product-pic.png') }}">
                    </a>
                    <h3><span>1950</span> Ford ........  <span>60 000 $</span></h3>
                    <a href="#" class="sidebar-product-btn">En Savoir Plus</a>
                </div>
-->
                <div class="sidebar-product-one-parent">
                    <div class="sidebar-product">
                    <img src="{{ asset('fe_assets/img/home-sidebar-product.png') }}">
                    <hr>
                </div>

                 @if ( !empty($car) )

                    <div class="product-one sidebar-product-one" style="height: 315px;">
                        <div style="height: 170px; overflow: hidden">

                       
                            @if($car->images->count() != 0)
                                @foreach($car->images as $image)

                                    <img src="{{ $image->medium }}">
                                    <?php break; ?>

                                @endforeach
                            @else
                                <img src="{{ asset('placeholder.jpg') }}" alt="">
                            @endif

                        </div>

                        <div class="product-one-text">
                            <div class="product-one-left">
                                <?php
                                $title = str_replace("Details about", "", $car->title);
                                if(strpos($car->title, 'Details about') !== false) {
                                    $title = substr($title, 5);
                                }
                                ?>

                                <h2>{{ $title }}</h2>
                            </div>
                            <div class="product-one-right">
                                <span>

                                    <?php

                                    $convertedPrice = str_replace(",", "", $car->price);

                                    $finalPrice = $convertedPrice;

                                    $setting = \App\Setting::where('enabled', '1');
                                    $addOnPrice = 0;

                                    if($setting->count()) {
                                        $setting = $setting->first();
                                        if($setting->percentage != 0) {
                                            $addOnPrice = ($finalPrice * $setting->percentage) / 100;
                                        } else if($setting->fixed_rate != 0) {
                                            $addOnPrice = $setting->fixed_rate;
                                        }
                                    }

                                    $finalPrice += $addOnPrice;

                                    $ostatak = $finalPrice % 1000;

                                    $finalPrice = $finalPrice - $ostatak + 1000;



                                    ?>

                                    <!-- {{ number_format($finalPrice, 2, ',', '') }} &euro; -->
                                    {{ number_format($car->price, 2, ',', '') }} &euro;
                                </span>
                            </div>
                            <a href="{{ route('get.product', $car->id) }}">
                                <p><i class="fa fa-caret-right" aria-hidden="true"></i> Voir d&eacute;tails</p>
                            </a>
                        </div>
                    </div>

                          @endif
                

                    </div>



                <div class="sidebar-divider">
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                </div>


                <div class="productsingle-sidebar">
                    <div class="productsingle-guarantee">
                        <div class="productsingle-guarantee-child">
                            <img src="{{ asset('fe_assets/img/guarantees.png') }}" class="productsingle-guarantee-img">
                            <p><img src="{{ asset('fe_assets/img/check.png') }}"> Accueil personnalis&eacute;</p>
                            <p>..........................</p>
                            <p><img src="{{ asset('fe_assets/img/check.png') }}"> Prix int&eacute;ressant</p>
                            <p>..........................</p>
                            <p><img src="{{ asset('fe_assets/img/check.png') }}"> <span>Prise en charge <br>des contraintes administratives</span></p>
                            <p>..........................</p>
                            <p><img src="{{ asset('fe_assets/img/check.png') }}"> Examen minutieux <br>et contr&ocirc;le de qualit&eacute;</p>
                            <p>..........................</p>
                            <p><img src="{{ asset('fe_assets/img/check.png') }}"> S&eacute;lection rigoureuse <br>du v&eacute;hicule</p>
                            <p>..........................</p>
                            <img src="{{ asset('fe_assets/img/productsingle-guranatees-logo.png') }}">
                        </div>
                    </div>
                    <div class="sidebar-divider">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-6 home-middle-parent">
                <div class="home-middle">
                    <img src="{{ asset('fe_assets/img/home-headline.png') }}">
                    <p>Fast &amp; Retro vous offre une large sélection de voitures américaines classiques, de collection et muscle cars.<br><br> Nous avons plus de 1000 annonces pour des voitures classiques et de collection, parmi les marques les plus populaires. <br><br> Chaque véhicule provenant de notre réseau est entièrement inspecté par un expert indépendant avant achat et livraison. Votre véhicule vous est donc livré après un contrôle technique et avec tous les documents nécessaires en règle. <br><br> Fast & Retro privilégie des relations durables avec des entreprises de distribution automobile, les mieux notées à travers le monde afin de vous assurer une livraison rapide et fiable de votre véhicule de collection. <br><br> Nous travaillons directement avec les compagnies maritimes pour s’assurer que toutes les formalités administratives et logistiques soient gérées directement, avec un coût minime et sans tracas pour vous.</p>
                    <h2>Notre charte de qualité </h2>
                    <p>Fast &amp; Retro fournit une garantie de qualité sur toutes les voitures à vendre. Les véhicules subissent une inspection minutieuse réalisée par une équipe de mécaniciens hautement qualifiés. <br><br>Nous offrons seulement le meilleur des muscle cars, voitures classiques et hot rods ; c’est pourquoi nous embauchons un inspecteur indépendant avant d’acheter votre véhicule. <br><br>En outre, nous nous engageons à fournir un service de qualité supérieur à nos clients. Notre équipe de passionnés est disponible pour répondre au mieux à toutes vos questions. 
                        <span>The Fast &amp; Retro Team</span> </p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-3 home-right">
                <div class="productsingle-subscribe">
                    <img src="{{ asset('fe_assets/img/productsingle-left-subscribe.png') }}">
                    <img src="{{ asset('fe_assets/img/home-sidebar-subscribe.png') }}">
                    <div class="subscribe-bckg">
                        <h2>Cr&eacute;ez un compte en <span>3</span> clics</h2>
                        @include('layouts.subscribe')
                    </div>
                </div>
                <div class="sidebar-divider">
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                </div>
                <div class="sidebar-calendar">
                    <a href="#" data-toggle="modal" data-target="#modalCalendar"><img src="{{ asset('fe_assets/img/home-sidebar-calendar.png') }}"></a>
                    <p><a href="#" data-toggle="modal" data-target="#modalCalendar">Cliquez ici</a> pour t&eacute;l&eacute;charger notre calendrier au format PDF.</p>
                </div>
                <div class="sidebar-divider">
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('similar')

    <div class="container-fluid productsingle-footer-parent home-footer">
        <img src="{{ asset('fe_assets/img/home-retro-logo.png') }}" class="home-footer-logo">
        <div class="container productsingle-footer">
            <div class="productsingle-footer-head">
                <h2>NoS Derniers Arrivages</h2>
                <hr>
            </div>

            <?php $i = 0; ?>

            <div class="carousel-inner2" role="listbox">

                @foreach($similars as $similar)

                    <div class="productsingle-footer-one slide">
                        <a href="{{ route('get.product', $similar->id) }}">
                            <?php
                            $title = str_replace("Details about", "", $similar->title);
                            if(strpos($similar->title, 'Details about') !== false) {
                                $title = substr($title, 5);
                            }
                            ?>

                            <p>{{ substr($title, 0, 27) }} ...</p>
                        </a>
                        <div style="max-height: 146px; overflow: hidden">
                            <?php $featuredImage = 0; ?>
                            @if($similar->images->count() != 0)
                                @foreach($similar->images as $image)

                                    @if($image->featured == 1)
                                        <img src="{{ $image->medium }}">
                                        <?php $featuredImage = 1; ?>
                                        <?php break; ?>
                                    @endif

                                @endforeach

                                @if($featuredImage == 0)
                                    <img src="{{ asset('placeholder.jpg') }}" alt="">
                                @endif
                            @else
                                <img src="{{ asset('placeholder.jpg') }}" alt="">
                            @endif
                        </div>
                        <a href="{{ route('get.product', $similar->id) }}" class="search-btn">En savoir plus</a>
                    </div>

                    <?php $i++; ?>
                @endforeach
            </div>


        </div>
    </div>
<div id="modalCalendar" class="modal fade in" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" id="closeMeLol"><img src="{{ asset('fe_assets/img/closewindows.png') }}"></button>
            </div>
            <div class="modal-body">
                <div class="modal-calendar">
                    <img src="{{ asset('fe_assets/img/home-sidebar-calendar.png') }}">
                    <div class="sidebar-divider">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                    </div>

                    <div class="contact-form">
                        <form id="subscribeForm2" action="{{ route('post.add.customer') }}" class="form-horizontal allForms putErrorsRed" method="post" data-parsley-validate="" novalidate="">
                            {{ csrf_field() }}
                            <fieldset>
                                <div class="col-xs-12 contact-c-inputs">
                                    <div class="form-group">
                                        <input id="name" name="name" type="text" class="form-control" placeholder="Nom *" data-parsley-required-message="Nom obligatoire" data-parsley-trigger="change focusout" required="">
                                    </div>
                                    <div class="form-group">
                                        <input id="lname" name="email" type="text" class="form-control" placeholder="Email *" data-parsley-required-message="E-mail obligatoire" data-parsley-trigger="change focusout" required="" data-parsley-type="email">
                                    </div>
                                    <div class="form-group">
                                        <input id="lname" name="phone" type="number" class="form-control" placeholder="T&eacute;l&eacute;phone *" data-parsley-required-message="T&eacute;l&eacute;phone requis" data-parsley-trigger="change focusout" required="">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="search-btn">Envoyer </button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection