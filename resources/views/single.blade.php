@extends('layouts.app')

@section('content')

<!-- <link href='https://fonts.googleapis.com/css?family=Oswald:300' rel='stylesheet' type='text/css'> -->
<link rel="stylesheet" type="text/css" href="{{asset('fe_assets/css/custom.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('fe_assets/css/payment_css/normalize.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('fe_assets/css/payment_css/main.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('fe_assets/css/payment_css/grey.css')}}">
<style type="text/css">
    .load-modal{
            display:    none;
            position:   fixed;
            z-index:    1200;
            top:        0;
            left:       0;
            height:     100%;
            width:      100%;
            background: rgba( 255, 255, 255, .8 ) url('{{asset('/images/loader.gif')}}') 50% 50%  no-repeat;
        }
    body.loading{overflow: hidden;}
    body.loading .load-modal{display: block;}
    .res-btn{position: absolute;vertical-align: middle;float: right;right: 5%;top: 1.8%;border-radius: 6px;font-size: 18px;line-height: 1.33333;padding: 8px 25px;}
    .chcolor{background-color: #959490; border-color: #959490;}
    .appNom{display: block;}
    .label-color{color:red;}
    .disabled-res{pointer-events: none;cursor: default;}
</style>
<div class="container-fluid productsingle-parent">
    <div class="container productsingle">
        <div class="col-xs-12 col-sm-4 col-md-3 productsingle-sidebar-parent">
            <div class="productsingle-sidebar">
                <div class="productsingle-guarantee">
                    <div class="productsingle-guarantee-child">
                        <img src="{{ asset('fe_assets/img/guarantees.png') }}" class="productsingle-guarantee-img">
                            <p><img src="{{ asset('fe_assets/img/check.png') }}"> Accueil personnalis&eacute;</p>
                            <p>..........................</p>
                            <p><img src="{{ asset('fe_assets/img/check.png') }}"> Prix Int&eacute;ressant</p>
                            <p>..........................</p>
                            <p><img src="{{ asset('fe_assets/img/check.png') }}"> <span>Prise en charges <br>des contraintes administratives</span></p>
                            <p>..........................</p>
                            <p><img src="{{ asset('fe_assets/img/check.png') }}"> Examen minutieux <br>et contr&ocirc;le de qualite</p>
                            <p>..........................</p>
                            <p><img src="{{ asset('fe_assets/img/check.png') }}"> S&eacute;lection rigoureuse <br>du vehicule</p>
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
                <div class="productsingle-subscribe">
                    <img src="{{ asset('/fe_assets') }}/img/productsingle-left-subscribe.png">
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
            </div>
        </div>
        <div class="col-xs-12 col-sm-8 col-md-9 productsingle">
            <div class="productsingle-body">
                <div class="productsingle-head-parent">
                
                
                <div class="productsingle-head">
                    <h1>
                        <span>{{ $car->year }}</span><br>{{ $car->brand }} {{ $car->model }}
                        @if($car->status === 'booked') <h4 id="offer-tag"> réservé </h4>
                        @elseif($car->status === 'sold') <h4 id="offer-tag"> vendue </h4> @endif
                        <a id="paymentbtn" href="#" data-toggle="modal" data-target="#paymentstep1" class="btn btn-primary res-btn {{$car->status === 'booked' ? 'disabled chcolor' : ''}}">Réserver</a>
                    </h1>
                </div>
                <div class="productsingle-cost">
                    <img src="{{ asset('/fe_assets') }}/img/productsingle-red.png">
                    <div class="productsingle-cost-text">
                        <img src="{{ asset('/fe_assets') }}/img/productsingle-line.png">
                        <span>|</span>
                        <p>{{ number_format($car->price, 2, ',', '') }} &euro;</p>
                    </div>
                </div>



                    <?php $imageExists = 0;?>

                    @foreach($car->images as $image)
                        @if(\App\Http\Controllers\CarsFEController::checkRemoteFile($image->big) == 1)
                            <?php $imageExists = 1; ?>
                        @endif
                    @endforeach

                    @if($imageExists == 1)
<div class="productsingle-wrapbckg">


                <!-- slider -->
                <div class="row">
                    <div class="col-xs-12" id="slider">
                        <!-- Top part of the slider -->
                        <div class="row">
                            <div class="col-sm-12" id="carousel-bounding-box">
                                <div class="carousel slide" id="myCarousel2">
                                    <!-- Carousel items -->
                                    <div class="carousel-inner">
                                        <?php $i = 0; $featured = 0; ?>
                                        @foreach($car->images as $image)
                                            @if(\App\Http\Controllers\CarsFEController::checkRemoteFile(url($image->big)) == 1)
                                                <div class="@if($image->featured == 1) active @endif item" data-slide-number="{{ $i }}">
                                                    <span class='zoom'>
                                                        <div class="zoom-plugin">
                                                            <img  src="{{ url($image->big) }}"  style="width:100%;" class="zoomfull">
                                                            @if($car->status === 'sold')
                                                                <img src="{{ asset('/fe_assets') }}/img/vendu.png" class="single-v">
                                                            @endif
                                                            @if($car->status === 'booked')
                                                                <img src="{{ asset('/fe_assets') }}/img/single-reserve.png" class="single-v">
                                                            @endif
                                                        </div>    
                                                    </span>    
                                                </div>
                                            @endif
                                            <?php $i++; ?>
                                        @endforeach
                                    </div><!-- Carousel nav -->
                                    @if($car->status != 'booked' && $car->status != 'sold')
                                        <a class="left carousel-control" href="#myCarousel2" role="button" data-slide="prev" style="z-index: 0">
                                            <i class="fa fa-caret-left" aria-hidden="true"></i>
                                        </a>
                                        <a class="right carousel-control" href="#myCarousel2" role="button" data-slide="next" style="z-index: 0">
                                            <i class="fa fa-caret-right" aria-hidden="true"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div><!--/Slider-->
                @if($car->status != 'booked' && $car->status != 'sold')
                    <div class="row hidden-xs" id="slider-thumbs">
                        <!-- Bottom switcher of slider -->
                        <ul class="hide-bullets">
                            <?php $i = 0; ?>
                            @foreach($car->images as $image)
                                    @if(\App\Http\Controllers\CarsFEController::checkRemoteFile(url($image->medium)) == 1)
                                        <li class="col-sm-2">
                                            <a class="thumbnail" id="carousel-selector-{{ $i }}"><img src="{{ url($image->medium) }}"></a>
                                        </li>
                                    @endif
                                <?php $i++; ?>
                            @endforeach
                        </ul>
                    </div>
                @endif    


                
                
                </div>
                        @endif
</div>



                <div class="productsingle-body-q">
                    <a id="cl-ach" href="#" class=" @if($car->status == 'booked' || $car->status == 'sold') disabled-res @endif" data-toggle="modal" data-target="#modalAcheter"><img src="{{ asset('/fe_assets') }}/img/productsingle-acheter-hover.png">
                        <img src="{{ asset('/fe_assets') }}/img/productsingle-acheter.png" class="fhover">
                    </a>

                    <a id="cl-jesus" href="#" data-toggle="modal" data-target="#modalJesus" class=" @if($car->status == 'booked' || $car->status == 'sold') disabled-res @endif"><img src="{{ asset('/fe_assets') }}/img/productsingle-jesuis.png">
                        <img src="{{ asset('/fe_assets') }}/img/productsingle-jesuis-hover.png" class="fhover">
                    </a>

                    <a id="cl-quest" href="#" data-toggle="modal" data-target="#modalQuest" class=" @if($car->status == 'booked' || $car->status == 'sold') disabled-res @endif"><img src="{{ asset('/fe_assets') }}/img/productsingle-poser.png">
                        <img src="{{ asset('/fe_assets') }}/img/productsingle-poser-hover.png" class="fhover">
                    </a>

                    <a id="cl-expert" href="#" data-toggle="modal" data-target="#modalExpert" class=" @if($car->status == 'booked' || $car->status == 'sold') disabled-res @endif"><img src="{{ asset('/fe_assets') }}/img/productsingle-inspecter.png">
                        <img src="{{ asset('/fe_assets') }}/img/productsingle-inspecter-hover.png" class="fhover">
                    </a>

                </div>
                    <?php $desc = unserialize($car->specification); $brand = ''; $model = ''; $year = '';?>
                    @if (!empty($desc))
                        @foreach($desc as $key => $value)
                            <?php 
                                if($key == 'Make') $brand = $value; if($key == 'Model') $model = $value;
                                if($key == 'Year') $year = $value; 
                            ?>
                        @endforeach
                    @endif
                <div class="productsingle-body-footer">
                    <div class="col-xs-12 col-sm-6 col-md-5 productsingle-body-footer-left">
                        <p><span>Marque:</span> @if($car->brand){{ $car->brand }} @elseif($brand != '') {{ $brand }} @else Nous contacter @endif</p>
                        <hr>
                        <p><span>Mod&egrave;le:</span> @if($car->model){{ $car->model }} @elseif($model != '') {{ $model }} @else Nous contacter @endif</p>
                        <hr>
                        <p><span>Année:</span> @if($car->year){{ $car->year }} @elseif($year != '') {{ $year }} @else Nous contacter @endif</p>
                        <hr>
                        <p><span>Kilométrage:</span> @if($car->mileage){{ number_format((float) filter_var( $car->mileage, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION ) * 1.6) }}{{-- number_format(intval(intval(str_replace(',', "", $car->mileage)) * 1.6)) --}} km @else Nous contacter @endif</p>
                        @if($car->status ==='booked')
                            <hr>
                            <p><span>Status:</span> réservé</p>
                        @elseif($car->status === 'sold')
                            <hr>
                            <p><span>Status:</span> vendue</p>
                        @endif
                        <?php
                            $isInter = false; $isExter = false; $isTram = false; $isVIN = false; $isOption = false; $inter = ''; $exter = ''; $tram =''; $opt = ''; $cylinder = ''; $eng = ''; $pow = '';
                            if($car->specification != ' ' && !empty($car->specification && $car->specification != 's:0:"";')){
                                $data = @unserialize($car->specification);
                                if($car->specification != 's:0:"";'){
                                    if($data){
                                        $desc = unserialize($car->specification);
                                        foreach ($desc as $key => $value):
                            ?>
                                            @if($key == 'Exterior Color' || $key == 'Interior Color' || $key == 'Transmission' || $key == 'VIN (Vehicle Identification Number)' || $key == 'Options' || $key == 'Engine' || $key == 'Number of Cylinders' || $key == 'Power Options')
                                                @if($key == 'Exterior Color') 
                                                    @if($value && $value != '') 
                                                        @foreach($translate as $key2 => $value2)
                                                            <?php    if(strtolower($value) == strtolower($key2)): $isExter = true; $exter = $value2; ?>
                                                                    <!-- <hr><p><span>Couleur extérieure:</span> {{$value2}}</p> -->
                                                            <?php    endif; ?>
                                                        @endforeach
                                                        <?php if(!$isExter){ $isExter = true; $exter = $value; } ?>
                                                    @else <!-- <hr><p><span>Couleur extérieure:</span> Nous contacter</p>  -->@endif
                                                @endif
                                                @if($key == 'Interior Color') 
                                                    @if($value && $value != '')
                                                        @foreach($translate as $key1 => $value1)
                                                            <?php if(strtolower($value) == strtolower($key1)): $isInter = true; $inter = $value1; ?>
                                                                <!-- <hr><p><span>Couleur intérieure:</span> {{$value1}}</p> -->
                                                            <?php endif; ?>
                                                        @endforeach
                                                        <?php if(!$isInter){ $isInter = true; $inter = $value; } ?>
                                                    @else <!-- <hr><p><span>Couleur intérieure:</span> Nous contacter</p> --> @endif
                                                @endif
                                                @if($key == 'Transmission')
                                                    <?php $isTram = true; ?> 
                                                    @if($value && $value != '')
                                                        @foreach($translate as $key3 => $value3)
                                                            <?php if(strtolower($value) == strtolower($key3)): $isInter = true; $tram = $value3; ?>
                                                                <!-- <hr><p><span>{{$key}}:</span> {{$value}}</p> -->
                                                            <?php endif; ?>
                                                        @endforeach
                                                    @else <!-- <hr><p><span>Transmission:</span> Nous contacter</p> --> @endif
                                                @endif    
                                                @if($key == 'VIN (Vehicle Identification Number)') 
                                                    <?php $isVIN = true; ?>
                                                    @if($value && $value != '')<hr><p><span>{{$key}}:</span> {{$value}}</p>
                                                    @else <hr><p><span>{{$key}}:</span> Nous contacter</p> @endif
                                                @endif
                                                @if($key == 'Options')
                                                    <?php $isOption = true; ?>
                                                    @if($value && $value != '')
                                                        <?php $opt = $value; ?>
                                                        <!-- <hr><p><span>{{$key}}:</span> {{$value}}</p> -->
                                                    @else <!-- <hr><p><span>{{$key}}:</span> Nous contacter</p> --> @endif
                                                @endif
                                                @if($key == 'Number of Cylinders')
                                                    @if($value && $value != '')
                                                        <?php $cylinder = $value; ?>
                                                        <!-- <hr><p><span>{{$key}}:</span> {{$value}}</p> -->
                                                    @else <!-- <hr><p><span>{{$key}}:</span> Nous contacter</p> --> @endif
                                                @endif
                                                @if($key == 'Engine')
                                                    @if($value && $value != '')
                                                        <?php $eng = $value; ?>
                                                        <!-- <hr><p><span>{{$key}}:</span> {{$value}}</p> -->
                                                    @else <!-- <hr><p><span>{{$key}}:</span> Nous contacter</p> --> @endif
                                                @endif
                                                @if($key == 'Power Options')
                                                    @if($value && $value != '')
                                                        <?php $pow = $value; ?>
                                                        <!-- <hr><p><span>{{$key}}:</span> {{$value}}</p> -->
                                                    @else <!-- <hr><p><span>{{$key}}:</span> Nous contacter</p> --> @endif
                                                @endif
                                            @endif
                                        <?php
                                        endforeach;
                                    }
                                }
                            } ?>
                            <hr><p><span>Couleur extérieure:</span>@if($exter != '') {{ $exter }} @else Nous contacter @endif</p>
                            <hr><p><span>Couleur intérieure:</span>@if($inter != '') {{ $inter }} @else Nous contacter @endif</p>
                            <hr><p><span>Transmission:</span>@if($car->transmission =='automatic') Automatique @elseif($car->transmission =='manual') Manuelle @elseif($tram != '') {{ $tram }}  @else Nous contacter @endif</p>
                            <?php if($isVIN == false): ?>
                                <hr><p><span>VIN (Vehicle Identification Number):</span> Nous contacter</p>
                            <?php endif; ?>
                            <?php if($isOption == false): ?>
                                <!-- <hr><p><span>Options:</span> Nous contacter</p> -->
                            <?php endif; ?>
                        <hr><p><span>Moteur:</span>@if($car->engine) {{$car->engine}} @elseif($eng != '') {{ $eng }}  @else Nous contacter @endif</p>
                        <hr><p><span>Nombre de cylindres:</span>@if($cylinder != '') {{ $cylinder }} @else Nous contacter @endif</p>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-7">
                        <h4>Details:</h4>
                        <div class="productsingle-body-footer-right">
                            <!-- <p>Motorisation : @if($car->engine){{ $car->engine }}@else Nous contacter @endif</p> -->
                            <!-- <p>Transmission : @if($car->transmission){{ $car->transmission }}@else Nous contacter @endif</p> -->
                            <p>Référence: {{ $car->referenceID }}</p>
                            <p>Options:@if($opt != '') {{ $opt }} @else Nous contacter @endif @if($pow != '') , {{ $pow }} @endif</p>
                            <h4 style="margin-left: -9px;margin-top: 10px;">Description:</h4>
                            <!-- <?php if($car->description != ' ' && !empty($car->description && $car->description != 's:0:"";')): ?>
                                <p>
                                    <?php
                                        $data = @unserialize($car->description);
                                        if($car->description != 's:0:"";'){
                                            if($data){
                                                $desc = unserialize($car->description);
                                                echo implode("", $desc);
                                            }else{
                                                echo "".$car->description; 
                                            }  
                                        }  
                                    ?>
                                </p>
                            <?php endif; ?> -->
                            <p>Dossier photo et informations complémentaires sur demande, Le prix affiché s'entend Toutes Taxes   Comprises, Véhicule dédouané et mis à disposition en r&eacute;gion Parisienne sous quatre à six semaines,  Possibilité de livraison sécurisée à domicile.Passionné de voitures américaines, n'hésitez pas à nous contacter. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid productsingle-footer-parent">
    <div class="container productsingle-footer">
        <div class="productsingle-footer-head">
            <h2>VEHICULES SIMILAIRES</h2>
            <hr>
        </div>

        <?php
            $make = $car->brand;
            $similars = \App\Car::where('brand', 'LIKE', '%' . $make . '%')->where('id', '!=', $car->id)->take(10)->get();
            $i = 0;
        ?>

        {{--<div id="myCarousel2" class="carousel slide" data-ride="carousel">--}}
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
                                        @if(\App\Http\Controllers\CarsFEController::checkRemoteFile(url($image->medium)) == 1)
                                            <img src="{{ url($image->medium) }}">
                                        @else
                                            <img src="{{ asset('placeholder.jpg') }}" alt="">
                                        @endif

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
        {{--</div>--}}

        </div>


        {{--<div class="col-xs-12 pagenumber">--}}
            {{--<div class="pagenumber-child">--}}
                {{--<a href="#" class="pagenumber-active">1</a>--}}
                {{--<a href="#">2</a>--}}
                {{--<a href="#">3</a>--}}
                {{--<a href="#">4</a>--}}
                {{--<a href="#">5</a>--}}
                {{--<a href="#">6</a>--}}
                {{--<a href="#">7</a>--}}
                {{--<a href="#">8</a>--}}
                {{--<a href="#" class="pagenumber-right"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>
</div>

<div id="modalJesus" class="modal fade in" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><img src="{{ asset('fe_assets/img/closewindows.png') }}"></button>
                <div class="page-head-parent page-presentation-top">
                    <div class="page-head">
                        <p>{{ $car->brand }} {{ $car->model }} {{ $car->year }} </p>
                        <hr>
                        <h3>Réservez ce véhicule sans plus attendre !</h3>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="modal-left contact-content">
                    <div class="modal-acheter">
                        <p><span><i class="fa fa-caret-right" aria-hidden="true"></i></span> Nous r&eacute;aliserons alors pour vous les contr&ocirc;les d'usage afin de vous garantir une sécurité optimale de la transaction.</p>
                        <p><span><i class="fa fa-caret-right" aria-hidden="true"></i></span> Nous mandaterons un expert automobile à se rendre sur place pour inspecter le véhicule avant l'envoi des fonds.</p>
                        <p><span><i class="fa fa-caret-right" aria-hidden="true"></i></span> Nous vous représentons dans le cadre de la vente aux enchères dans les limites du cadre prélablement défini ensemble.</p>
                        <p><span><i class="fa fa-caret-right" aria-hidden="true"></i></span> Nos agents transitaires se chargeront d'organiser le transport de votre véhicule dans les meilleures conditions.</p>
                        <p class="modal-acheter-red"><span><i class="fa fa-caret-right" aria-hidden="true"></i></span> Notre service administratif se chargera de toutes les formalités pour votre plus grande tranquilité.</p>
                    </div>
                    <div class="sidebar-divider">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                    </div>
                    <p>Vous avez besoin d'un conseil, d'une estimation, d'informations complémentaires sur un véhicule ou vous souhaitez que nous trouvions pour vous un modèle bien précis ? En tant que passionnés de véhicules de collection et de voitures américaines, nous nous ferons le plus grand plaisir à traiter votre demande dans les meilleurs délais.</p>

                    <div class="contact-form">
                        <form id="modal4Form" action="{{ route('post.send.mail') }}" class="form-horizontal allForms putErrorsRed" method="post" onsubmit="checkCaptcha('recaptcha11')" data-parsley-validate="" novalidate="">
                            {{ csrf_field() }}
            <input type="hidden" name="isAdd" value="true">
                            <input type="hidden" name="ad_reference" value="{{ $car->referenceID }}">
                            <input type="hidden" name="title" value="{{ $car->title }}">
                            <input type="hidden" name="retro_link" value="{{ route('get.product', $car->id) }}">
                            <input type="hidden" name="original_url" value="{{ $car->original_url }}">
                            <input type="hidden" name="original_price" value="{{ $car->original_price }}">
                            <input type="hidden" name="price" value="{{ $car->price }} &euro;">

                            <fieldset>
                                <div class="col-xs-12 contact-c-inputs">
                                    <div class="form-group">
                                        <input id="name" name="name" type="text" class="form-control" placeholder="Nom *" data-parsley-required-message="Nom obligatoire" data-parsley-trigger="change focusout" required="">
                                    </div>
                                    <div class="form-group">
                                        <input id="lname" name="lname" type="text" class="form-control" placeholder="Prénom*" data-parsley-required-message="Prenom obligatoire" data-parsley-trigger="change focusout" required="">
                                    </div>
                                    <div class="form-group">
                                        <input id="lname" name="email" type="text" class="form-control" placeholder="Email *" data-parsley-required-message="E-mail obligatoire" data-parsley-trigger="change focusout" required="" data-parsley-type="email">
                                    </div>
                                    <div class="form-group">
                                        <input id="lname" name="phone" type="text" class="form-control" placeholder="Numéro de téléphone" data-parsley-required-message="T&eacute;l&eacute;phone requis" data-parsley-trigger="change focusout" required="">
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" name="message" rows="6" placeholder="Message*" data-parsley-required-message="Message obligatoire" data-parsley-trigger="change focusout" required=""></textarea>
                                    </div>

                                    <!-- <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <input class="form-control center-block" style="width: 33% !important;" type="text" placeholder="Entrez le texte.." name="validator" id="validator" size="4" />
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <img src="{{ route('get.captcha') }}" alt="CAPTCHA image" align="top" />
                                        </div>
                                    </div> -->

                                    <div class="form-group">
                                        <input type="hidden" name="captcha" id="recaptcha11"  value="">
                                        <div id="recaptcha1"></div>
                                        <!-- <div class="g-recaptcha" data-sitekey="6LexhBQUAAAAAAlcYzCUWn9bivnPg8rCvgd8RD-m" data-callback="myCallBack"></div> -->
                                    </div>

                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="">Recevoir la Newsletter Fast &amp; Retro</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button class="search-btn">Envoyer </button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
                <!-- <div class="modalright">
                    <div class="contact-sidebar">
                        <img src="{{ asset('fe_assets/img/product-single-modal-pic-1.png') }}">
                        <a href="#">showrooms</a>
                        <p><strong>Etats-Unis </strong>
                            <br>9903 Santa Monica Blvd
                            <br>Beverly Hills , CA, 90212
                            <br><span>310-400-2073</span>
                        </p>
                    </div>
                </div> -->
            </div>
        </div>

    </div>
</div>




<div id="modalAcheter" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><img src="{{ asset('fe_assets/img/closewindows.png') }}"></button>
                <div class="page-head-parent page-presentation-top">
                    <div class="page-head">
                        <p>{{ $car->brand }} {{ $car->model }} {{ $car->year }} </p>
                        <hr>
                        <h3>Le transport de votre v&eacute;hicule</h3>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="modal-left contact-content">
                    <div class="modal-acheter">
                        <p><span><i class="fa fa-caret-right" aria-hidden="true"></i></span> Nous r&eacute;aliserons alors pour vous les contr&ocirc;les d'usage afin de vous garantir une s&eacute;curit&eacute; optimale de la transaction.</p>
                        <p><span><i class="fa fa-caret-right" aria-hidden="true"></i></span> Nous mandaterons un expert automobile &agrave; se rendre sur place pour inspecter le v&eacute;hicule avant l'envoi des fonds.</p>
                        <p><span><i class="fa fa-caret-right" aria-hidden="true"></i></span> Nous vous repr&eacute;sentons dans le cadre de la vente aux ench&egrave;res dans les limites du cadre pr&eacute;lablement d&eacute;fini ensemble.</p>
                        <p><span><i class="fa fa-caret-right" aria-hidden="true"></i></span> Nos agents transitaires se chargeront d'organiser le transport de votre v&eacute;hicule dans les meilleures conditions.</p>
                        <p class="modal-acheter-red"><span><i class="fa fa-caret-right" aria-hidden="true"></i></span> Notre service administratif se chargera de toutes les formalit&eacute;s pour votre plus grande tranquilit&eacute;.</p>
                    </div>
                    <div class="sidebar-divider">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                    </div>
                    <p>Vous avez besoin d'un conseil, d'une estimation, d'informations compl&eacute;mentaires sur un v&eacute;hicule ou vous souhaitez que nous trouvions pour vous un mod&egrave;le bien pr&eacute;cis ? En tant que passionn&eacute;s de v&eacute;hicules de collection et de voitures am&eacute;ricaines, nous nous ferons le plus grand plaisir &agrave; traiter votre demande dans les meilleurs d&eacute;lais.</p>

                    <div class="contact-form">
                        <form id="modal1Form" action="{{ route('post.send.mail') }}" class="form-horizontal allForms putErrorsRed" onsubmit="checkCaptcha('recaptcha22')" method="post" data-parsley-validate="">
                            {{ csrf_field() }}
                <input type="hidden" name="isAdd" value="true">
                            <input type="hidden" name="ad_reference" value="{{ $car->referenceID }}">
                            <input type="hidden" name="title" value="{{ $car->title }}">
                            <input type="hidden" name="retro_link" value="{{ route('get.product', $car->id) }}">
                            <input type="hidden" name="original_url" value="{{ $car->original_url }}">
                            <input type="hidden" name="original_price" value="{{ $car->original_price }}">
                            <input type="hidden" name="price" value="{{ $car->price }} &euro;">

                            <fieldset>
                                <div class="col-xs-12 contact-c-inputs">
                                    <div class="form-group">
                                        <input id="name" name="name" type="text" class="form-control" placeholder="Nom *" data-parsley-required-message="Nom obligatoire" data-parsley-trigger="change focusout" required="">
                                    </div>
                                    <div class="form-group">
                                        <input id="lname" name="lname" type="text" class="form-control" placeholder="Pr&eacute;nom*" data-parsley-required-message="Prenom obligatoire" data-parsley-trigger="change focusout" required="">
                                    </div>
                                    <div class="form-group">
                                        <input id="lname" name="email" type="text" class="form-control" placeholder="Email *" data-parsley-required-message="E-mail obligatoire" data-parsley-trigger="change focusout" required="" data-parsley-type="email">
                                    </div>
                                    <div class="form-group">
                                        <input id="lname" name="phone" type="text" class="form-control" placeholder="Num&eacute;ro de t&eacute;l&eacute;phone" data-parsley-required-message="T&eacute;l&eacute;phone requis" data-parsley-trigger="change focusout" required="">
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" name="message" rows="6" placeholder="Message*" data-parsley-required-message="Message obligatoire" data-parsley-trigger="change focusout" required=""></textarea>
                                    </div>

                                    <!-- <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <input class="form-control center-block" style="width: 33% !important;" type="text" placeholder="Entrez le texte.." name="validator" id="validator" size="4" />
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <img src="{{ route('get.captcha') }}" alt="CAPTCHA image" align="top" />
                                        </div>
                                    </div> -->

                                    <div class="form-group">
                                        <input type="hidden" name="captcha" id="recaptcha22"  value="">
                                        <!-- <div class="g-recaptcha" data-sitekey="6LexhBQUAAAAAAlcYzCUWn9bivnPg8rCvgd8RD-m" data-callback="myCallBack"></div> -->
                                        <div id="recaptcha2"></div>
                                    </div>

                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="">Recevoir la Newsletter Fast &amp; Retro
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button class="search-btn">Envoyer </button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
                <!-- <div class="modalright">
                    <div class="contact-sidebar">
                        <img src="{{ asset('fe_assets/img/product-single-modal-pic-1.png') }}">
                        <a href="#">showrooms</a>
                        <p><strong>Etats-Unis </strong>
                            <br>9903 Santa Monica Blvd
                            <br>Beverly Hills , CA, 90212
                            <br><span>310-400-2073</span>
                        </p>
                    </div>
                </div> -->
            </div>
        </div>

    </div>
</div>


<!-- Modal -->
<div id="modalQuest" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><img src="{{ asset('fe_assets/img/closewindows.png') }}"></button>
                <div class="page-head-parent page-presentation-top">
                    <div class="page-head">
                        <p>{{ $car->brand }} {{ $car->model }} {{ $car->year }} </p>
                        <hr>
                        <h3>Posez une question</h3>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="modal-left contact-content">
                    <div class="sidebar-divider">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                    </div>

                    <div class="contact-form">
                        <form id="modal2Form" action="{{ route('post.send.mail') }}" class="form-horizontal allForms putErrorsRed" onsubmit="checkCaptcha('recaptcha33')" method="post" data-parsley-validate="">
                            {{ csrf_field() }}
                <input type="hidden" name="isAdd" value="true">
                <input type="hidden" name="ad_reference" value="{{ $car->referenceID }}">
                            <input type="hidden" name="title" value="{{ $car->title }}">
                            <input type="hidden" name="retro_link" value="{{ route('get.product', $car->id) }}">
                            <input type="hidden" name="original_url" value="{{ $car->original_url }}">
                            <input type="hidden" name="original_price" value="{{ $car->original_price }}">
                            <input type="hidden" name="price" value="{{ $car->price }} &euro;">

                            <fieldset>
                                <div class="col-xs-12 contact-c-inputs">

                                    <div class="form-group">
                                        <input id="name" name="name" type="text" class="form-control" placeholder="Nom *" data-parsley-required-message="Nom obligatoire" data-parsley-trigger="change focusout" required="">
                                    </div>
                                    <div class="form-group">
                                        <input id="lname" name="lname" type="text" class="form-control" placeholder="Pr&eacute;nom*" data-parsley-required-message="Prenom obligatoire" data-parsley-trigger="change focusout" required="">
                                    </div>
                                    <div class="form-group">
                                        <input id="lname" name="email" type="text" class="form-control" placeholder="Email *" data-parsley-required-message="E-mail obligatoire" data-parsley-trigger="change focusout" required="" data-parsley-type="email">
                                    </div>
                                    <div class="form-group">
                                        <input id="lname" name="phone" type="text" class="form-control" placeholder="Num&eacute;ro de t&eacute;l&eacute;phone" data-parsley-required-message="T&eacute;l&eacute;phone requis" data-parsley-trigger="change focusout" required="">
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" name="message" rows="6" placeholder="Message*" data-parsley-required-message="Message obligatoire" data-parsley-trigger="change focusout" required=""></textarea>
                                    </div>

                                    <!-- <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <input class="form-control center-block" style="width: 33% !important;" type="text" placeholder="Entrez le texte.." name="validator" id="validator" size="4" />
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <img src="{{ route('get.captcha') }}" alt="CAPTCHA image" align="top" />
                                        </div>
                                    </div> -->

                                    <div class="form-group">
                                        <input type="hidden" name="captcha" id="recaptcha33" value="">
                                        <!-- <div class="g-recaptcha" data-sitekey="6LexhBQUAAAAAAlcYzCUWn9bivnPg8rCvgd8RD-m" data-callback="correctCaptcha"></div> -->
                                        <div id="recaptcha3"></div>
                                    </div>

                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="">Recevoir la Newsletter Fast &amp; Retro</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button class="search-btn">Envoyer </button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
                <!-- <div class="modalright">
                    <div class="contact-sidebar">
                        <img src="{{ asset('fe_assets/img/product-single-modal-pic-1.png') }}">
                        <a href="#">showrooms</a>
                        <p><strong>Etats-Unis </strong>
                            <br>9903 Santa Monica Blvd
                            <br>Beverly Hills , CA, 90212
                            <br><span>310-400-2073</span>
                        </p>
                    </div>
                </div> -->
            </div>
        </div>

    </div>
</div>


<!-- Modal -->
<div id="modalExpert" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><img src="{{ asset('fe_assets/img/closewindows.png') }}"></button>
                <div class="page-head-parent page-presentation-top">
                    <div class="page-head">
                        <p>{{ $car->brand }} {{ $car->model }} {{ $car->year }} </p>
                        <hr>
                        <h3>Expertiser un v&eacute;hicule avant achat permet d'&eacute;viter les mauvaises surprises le jour de la livraison.</h3>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="modal-left contact-content">
                    <div class="modal-acheter">
                        <p><span><i class="fa fa-caret-right" aria-hidden="true"></i></span> Un rapport de 12 pages fournit les informations requises &agrave; une prise de d&eacute;cision en parfaite connaissance du bien achet&eacute;.</p>
                        <p><span><i class="fa fa-caret-right" aria-hidden="true"></i></span> De nombreuses photos d&eacute;taill&eacute;es accompagnent le rapport d'expertise permet tant de mettre en lumi&egrave;re la qualit&eacute; cosm&eacute;tique et m&eacute;canique du v&eacute;hicule.</p>
                        <p><span><i class="fa fa-caret-right" aria-hidden="true"></i></span> Ce service vous permet d'&eacute;conomiser bien plus qu'un billet d'avion et la perte de temps n&eacute;cessaire &agrave; une visite. </p>
                        <p><span><i class="fa fa-caret-right" aria-hidden="true"></i></span> De plus elle est r&eacute;alis&eacute;s par de v&eacute;ritables experts automobiles sp&eacute;cialistes des v&eacute;hicules de collection.</p>
                        <p><span><i class="fa fa-caret-right" aria-hidden="true"></i></span> Toutes les expertises sont r&eacute;alis&eacute;es par un organisme tiers, garant de l'ind&eacute;pendance et de l'objectivit&eacute; des rapports d&eacute;livr&eacute;s.</p>
                        <p class="modal-acheter-red"><span><i class="fa fa-caret-right" aria-hidden="true"></i></span> Cette &eacute;tape indispensable est factur&eacute;e 450 &euro; H.T. pour une expertise int&eacute;grale avec essai routier et dossier photo.</p>
                    </div>
                    <div class="sidebar-divider">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                    </div>
                    <p>Remplissez simplement le formulaire ci-apr&egrave;s et vous serez contact&eacute; par un conseiller qui organisera la venue d'un expert chez le vendeur du v&eacute;hicule que vous souhaitez acquerir.</p>

                    <div class="contact-form">
                        <form id="modal3Form" action="{{ route('post.send.mail') }}" class="form-horizontal allForms putErrorsRed" onsubmit="checkCaptcha('recaptcha44')" method="post" data-parsley-validate="">
                            {{ csrf_field() }}
                <input type="hidden" name="isAdd" value="true">
                            <input type="hidden" name="ad_reference" value="{{ $car->referenceID }}">
                            <input type="hidden" name="title" value="{{ $car->title }}">
                            <input type="hidden" name="retro_link" value="{{ route('get.product', $car->id) }}">
                            <input type="hidden" name="original_url" value="{{ $car->original_url }}">
                            <input type="hidden" name="original_price" value="{{ $car->original_price }}">
                            <input type="hidden" name="price" value="{{ $car->price }} &euro;">


                            <fieldset>
                                <div class="col-xs-12 contact-c-inputs">
                                    <div class="form-group">
                                        <input id="name" name="name" type="text" class="form-control" placeholder="Nom *" data-parsley-required-message="Nom obligatoire" data-parsley-trigger="change focusout" required="">
                                    </div>
                                    <div class="form-group">
                                        <input id="lname" name="lname" type="text" class="form-control" placeholder="Pr&eacute;nom*" data-parsley-required-message="Prenom obligatoire" data-parsley-trigger="change focusout" required="">
                                    </div>
                                    <div class="form-group">
                                        <input id="lname" name="email" type="text" class="form-control" placeholder="Email *" data-parsley-required-message="E-mail obligatoire" data-parsley-trigger="change focusout" required="" data-parsley-type="email">
                                    </div>
                                    <div class="form-group">
                                        <input id="lname" name="phone" type="text" class="form-control" placeholder="Num&eacute;ro de t&eacute;l&eacute;phone" data-parsley-required-message="T&eacute;l&eacute;phone requis" data-parsley-trigger="change focusout" required="">
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" name="message" rows="6" placeholder="Message*" data-parsley-required-message="Message obligatoire" data-parsley-trigger="change focusout" required=""></textarea>
                                    </div>

                                    <!-- <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <input class="form-control center-block" style="width: 33% !important;" type="text" placeholder="Entrez le texte.." name="validator" id="validator" size="4" />
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <img src="{{ route('get.captcha') }}" alt="CAPTCHA image" align="top" />
                                        </div>
                                    </div> -->

                                    <div class="form-group">
                                        <input type="hidden" name="captcha" id="recaptcha44" value="">
                                        <div class="g-recaptcha" data-sitekey="6LexhBQUAAAAAAlcYzCUWn9bivnPg8rCvgd8RD-m" data-callback="correctCaptcha"></div>
                                        <div id="recaptcha4"></div>
                                    </div>

                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="">Recevoir la Newsletter Fast &amp; Retro</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button class="search-btn">Envoyer </button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
                <!-- <div class="modalright">
                    <div class="contact-sidebar">
                        <img src="{{ asset('fe_assets/img/product-single-modal-pic-1.png') }}">
                        <a href="#">showrooms</a>
                        <p><strong>Etats-Unis </strong>
                            <br>9903 Santa Monica Blvd
                            <br>Beverly Hills , CA, 90212
                            <br><span>310-400-2073</span>
                        </p>
                    </div>
                </div> -->
            </div>
        </div>

    </div>
</div>

<!-- Main-Model -->
<div class="modal fade" id="paymentstep1" role="dialog">
    <!-- Popup1 -->
    <div class="container">
        <div class="modal-content col-md-12 col-sm-12 col-xs-offset-1 col-xs-11" style="margin:15px;">
            <!-- Header Part -->
            <div class="header-bg">
                <div class="tags">
                    <img src="{{asset('fe_assets/img/tag_pay.png')}}">
                    <h4 class="chevrolet">{{$car->title}}</h4>
                </div>
                <div class="closing"><a href="#" data-dismiss="modal"  class="cross">X</a></div>
            </div>
            <div id="tab1">
                <div class="tag-heading">
                    <div class="header-main">
                        <div class="header-position">
                            <div class="modal-header col-sm-12 col-xs-12">
                                <h3 class="heading-res">Reserver Mon vehicule</h3>
                                <div class="listing-number">
                                    <li>{{$car->title}}</li>
                                    @if(!empty($car->referenceID))
                                        <li><span class="ref">REF.</span> {{$car->referenceID}}</li>
                                    @endif
                                </div>
                            </div>
                            @if($car->images->count() <= 0)
                                <img src="{{asset('placeholder.jpg')}}" class="top-right-image">
                            @else
                                <img src="{{ url($car->images->first()->medium) }}" class="top-right-image">
                            @endif
                        </div>         
                        <div class="process col-md-12 col-lg-12"> 
                            <li class="active">
                                <p class="one active-red">1</p>
                                <span class="steps-text">Mon moyen de paiement</span>
                            </li>
                            <li><p class="two">2</p><span class="steps-text">Mes coordonnées</span>
                            </li>
                            <li><p class="three">3</p><span class="steps-text">L’historique de ma commande</span>
                            </li>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-12">
                    <h3 class="secure-text"><span><img src="{{asset('fe_assets/img/securels.png') }}" class="secure"></span>JE CHOISIS Mon Moyen de Paiement</h3>
                </div>
                <div class="modal-body col-md-12 col-lg-12">
                    <div class="col-md-12 col-lg-12">
                        <div class="box-heading text-center">
                            <h5 class="card-heading">CARTE BLEUE/ VISA/<br>MASTERCARD/ AMERICAN EXPRESS</h5>
                        </div>
                        <form action="#" id="formvalidate" name="payeezypayment" class="" method="post">
                            <div class="box">
                                <div id="errorlabelMsg">
                                    <h4 class="info row custom-heading msg" id="errormsg">dszfcsdc</h4>
                                </div>
                                <p class="chamb"><span class="error">*</span>Champs obligatoires</p>
                                <div class="">
                                    <label class="label-align">Montant à régler :</label>
                                        <span class="price" id="carPrice">2000,00 $</span>
                                </div>
                                          <div class="radio-wrapper test ">
                                        <div class="raido">
                                            <input type="radio" name="civility" value="mme" required="" checked="">&nbsp&nbsp
                                            <label> Mme</label>
                                        </div>
                                        <div class="raido second-ch">
                                            <input type="radio" name="civility" value="m" required="">&nbsp&nbsp
                                            <label> M.</label>
                                        </div>
                                        <span class="appCivility"></span>
                                    </div>
                                    <div class="form-grp  test">
                                        <label class="name-label">Nom <span class="error">*</span></label>
                                        <input type="text" name="name" class="form-custom" placeholder="Nom">
                                        <span class="appNom"></span>
                                    </div>
                                    <div class="form-grp form-right test ">
                                        <label class="family_name-label">Prénom  <span class="error">*</span></label>
                                        <input type="text" name="family_name" class="form-custom" placeholder="Prénom">
                                        <span class="appFam"></span>
                                    </div>
                                    <div class="image">
                                        <img src="{{ asset('fe_assets/img/paymentls.png') }}" class="payment">
                                    </div>
                                <!-- <div class="form-second form-group">
                                    <div class="form-grp">
                                        <label class="name-numer">Email <span class="error">*</span></label>
                                        <input type="email" name="email" class="form-custom form-width" placeholder="Email">
                                    </div>
                                </div> -->
                                <div class="form-second form-group">
                                    <div class="form-grp">
                                        <label class="name-numero">Numéro de votre carte <span class="error">*</span></label>
                                        <input type="text" name="card" class="form-custom form-width" placeholder="Numéro de votre carte">
                                    </div>
                                </div>
                                <div class="form-third form-group">
                                    <div class="form-grp">
                                        <label class="date">Date d’expiration <span class="error">*</span></label>
                                        <select  class="select-custom" name="month" required="">
                                            <option value="01">01</option>
                                            <option value="02">02</option>
                                            <option value="03">03</option>
                                            <option value="04">04</option>
                                            <option value="05">05</option>
                                            <option value="06">06</option>
                                            <option value="07">07</option>
                                            <option value="08">08</option>
                                            <option value="09">09</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                        </select>
                                        <!-- <input type="number" name="month" minlength="2" maxlength="2" class="form-custom" placeholder="Mois(MM)"> -->
                                    </div>
                                    <div class="form-grp form-right">
                                        <select class="select-custom" name="year" required="">
                                            {!! $currentYear = date('Y') !!}
                                            @for($i = $currentYear; $i < $currentYear + 50; $i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                        <!-- <input type="number" name="year" minlength="4" maxlength="4" id="payYear" class="form-custom" placeholder="Année(YYYY)"> -->
                                    </div>
                                </div>
                                <div class="form-second form-group">
                                    <div class="form-grp">
                                        <label class="Cryptogramme">Cryptogramme visuel <span class="error">*</span></label>
                                        <input type="text" name="cvv" class="form-custom card-enter" required="">
                                    </div>
                                </div>
                                <div class="form-second form-group">
                                    <div class="form-crypto">
                                        <p><img src="{{asset('fe_assets/img/crypto.png')}}" class="crypto-image"> Il s’agit des 3 derniers chiffres imprimés au dos de votre carte</p>
                                    </div>
                                </div>
                              </div> <!-- End box -->
                            <div class="checkboxicheck col-sm-12 col-xs-12">
                                <div class="checkbox-custom">
                                    <label id="checklabel">
                                        <input type="checkbox" name="chkterms" required="" checked=""> <span class="checkbox-text">J’accepte le paiement pour la réservation et l’inspection de mon véhicule</span>
                                    </label>
                                </div>
                                <div class="valider">
                                    <button class="validSubmit">VALIDER MON PAIEMENT</button>
                                </div>
                                <span id="appAccept"></span>
                            </div>
                        </form>
                    </div>
                    <!-- End modal body -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="para">
                            <p class="paragraphy">Fast & Retro met en oeuvre des traitements de données à caractère personnel, dont elle est responsable, ayant pour principales finalités, la création de votre compte, la gestion de la relation client et les prospects, la gestion et le suivi des commandes et livraisons, la mesure de la qualité et de votre satisfaction, le marketing relationnel, le marketing ciblé, l'envoi de communications commerciales adaptées et personnalisées en particulier sous forme de newsletter, et la personnalisation des offres. Les données collectées via ce formulaire sont obligatoires. En leur absence, votre compte ne pourra pas être créé, et les autres finalités poursuivies pourraient également en être affectées. Ces informations sont destinées aux services habilités de Fast & Retro, à ses éventuels sous-traitants, aux entités du groupe auquel appartient Fast & Retro ainsi qu'à ses partenaires contractuels et commerciaux à des fins d'amélioration de la relation client, de marketing ciblé, d'animation commerciale ou de prospection.</p>
                        </div>
                    </div>
                    <!-- Footer --> 
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12  text-center">
                        <h4 class="payment-text"><span><img src="{{asset('fe_assets/img/graysecure.png')}}" class="graysecure"></span>PAIEMENT SéCURISé</h4>
                        <img src="{{asset('fe_assets/img/paymenth.png')}}">
                        <h5 class="footer-at">© FAST & RETRO 2017 I INFORMATONS LéGALES</h5>
                    </div>
                    <!-- End footer -->
                </div>
            </div>
            <div id="tab2" style="display: none;">
                <div class="tag-heading">
                    <div class="header-main">
                        <div class="header-position">
                            <div class="modal-header col-sm-12 col-xs-12">
                                <h3 class="heading-res">Reserver Mon vehicule</h3>
                            </div>
                        </div>         
                        <div class="process col-md-12 col-lg-12"> 
                            <li>
                                <p class="one">1</p>
                                <span class="steps-text">Mon moyen de paiement</span>
                            </li>
                            <li class="active">
                                <p class="two active-red">2</p>
                                <span class="steps-text">Mes coordonnées</span>
                            </li>
                            <li>
                                <p class="three">3</p>
                                <span class="steps-text">L’historique de ma commande</span>
                            </li>
                        </div>
                    </div>
                </div>
                <section id="popup-second">
                    <div class="col-md-12 col-lg-12">
                        <h3 class="secure-text"><span><img src="{{asset('fe_assets/img/popup.png')}}" class="secure"></span>Mes coordonNées</h3>
                    </div>
                    <div class="modal-body col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        <div class="col-md-12 col-lg-12">
                            <form action="#" id="paymentOrder" name="paymentOrder" class="" method="post">
                                <div class="box box-poup-sec col-md-12 col-lg-12 col-sm-12 col-xs-12">
                                    <div id="errorlabelMsg2">
                                        <h4 class="info row custom-heading msg" id="errormsg2">dszfcsdc</h4>
                                    </div>
                                    <p><span class="error">*</span>Champs obligatoires</p>
                                    <div class="radio-check">
                                        <input id="occupation_type" value="professional" required="" type="radio" name="occupation_type">&nbsp&nbsp
                                        <label for="occupation_type">Professionnel</label>
                                    </div>
                                    <div class="radio-check test">
                                        <input id="occupation_type" value="particular" required="" type="radio" name="occupation_type">&nbsp&nbsp
                                        <label for="occupation_type">Particulier</label>
                                    </div>
                                    <p class="appOccupation"></p>
                                    <div class="radio-selection">
                                        <p class="label-in">Civilité <span class="error">*</span>:</p>
                                        <div class="radio-check">
                                            <input type="radio" name="civility" value="mme" required="">&nbsp&nbsp
                                            <label for="civility">Mme</label>
                                        </div>
                                        <div class="radio-check test">
                                            <input type="radio" name="civility" value="m" required="">&nbsp&nbsp
                                            <label for="civility">M.</label>
                                        </div>
                                    </div>
                                    <p class="appCivility"></p>
                                    <div class="left-group">
                                        <div class="form-gp form-group">
                                            <label class="name-block">Nom <span class="error">*</span></label>
                                            <input type="text" name="name" class="input-control" required="">
                                        </div>
                                        <div class="form-gp form-group">
                                            <label class="name-block">Prénom <span class="error">*</span></label>
                                            <input type="text" name="first_name" class="input-control" required="">
                                           <!-- <p class="label-change">Indiquez au moins un numéro de téléphone.</p> -->
                                        </div>
                                        <div class="form-gp form-group">
                                            <label class="name-block">Email<span class="error">*</span></label>
                                            <input type="text" name="email" class="input-control" required="">
                                            <p class="label-change">Indiquez au moins un numéro de téléphone.</p>
                                        </div>
                                        <div class="form-gp form-group">
                                            <label class="name-block">Téléphone mobile <span class="error">*</span></label>
                                            <input type="text" name="phone" class="input-control" required="">
                                        </div>
                                        <div class="form-gp form-group">
                                            <label class="name-block">Téléphone fixe </label>
                                            <input type="text" name="phone_fixed" class="input-control">
                                        </div>
                                    </div> <!-- Left end -->
                                    <div class="right-group">
                                        <div class="form-gp form-group">
                                            <label class="name-block">Adresse </label>
                                            <input type="text" name="address" class="input-control">
                                        </div>
                                        <div class="form-gp form-group">
                                            <label class="name-block">Complément d’adresse</label>
                                            <input type="text" name="additional_address" class="input-control">
                                        </div>
                                        <div class="form-gp form-group">
                                            <label class="code">Code postal <span class="error">*</span></label>
                                            
                                            <input type="text" name="zip_code" class="inline-control" required="">
                                            <input type="text" name="city" class="display-control" required="">
                                            <p class="appZip"> <p class="appCity"></p></p>
                                        </div>
                                        <div class="form-gp form-group">
                                            <div class="form-split">
                                                <label class="name-block">Bâtiment</label>
                                                <input type="text" name="building" class="control-split">
                                            </div>
                                            <div class="form-split">
                                                <label class="name-block">Escalier</label>
                                                <input type="text" name="staircase" class="control-split">
                                            </div>
                                            <div class="form-split">
                                                <label class="name-block">&Egrave;tage</label>
                                                <input type="text" name="floor" class="control-split">
                                            </div>
                                            <div class="form-split">
                                                <label class="name-block">Porte</label>
                                                <input type="text" name="door" class="control-split">
                                            </div>
                                        </div>
                                    </div> <!-- rigth end -->
                                    <div class="paragraphy-radio col-md-12 col-sm-12 col-xs-12">
                                        <p class="input-radio">J’accepte de recevoir les newsletters Fast & Retro afin d’être informé(e) des bons plans et informations utiles (1) <span class="error">*</span>
                                            <div class="radio-check">
                                                <input type="radio" name="newsletter" value="1" required="">&nbsp&nbsp
                                                <label>Oui</label>
                                            </div>
                                            <div class="radio-check test">
                                                <input type="radio" name="newsletter" value="0" required="">&nbsp&nbsp
                                                <label>Non</label>
                                            </div>
                                            <p class="appNewsletter"></p>
                                        </p>
                                        <p><sup>(1)</sup> En cochant “non”, vous recevrez tout de même les communications relatives à votre commande.</p>
                                    </div>
                                </div>
                                <div class="button-submit col-md-12 col-sm-12 col-xs-12">
                                    <button class="submit">SUIVANT<i class="fa fa-angle-right custom" ></i></button>
                                </div>
                            </form>
                        </div><!-- End second box -->
                        <!-- Footer --> 
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12  text-center">
                            <h5 class="footer-at">© FAST & RETRO 2017 I INFORMATONS LéGALES</h5>
                        </div>
                        <!-- End footer -->
                    </div>
                </section> 
            </div>
            <div id="tab3" style="display: none;">
                <div class="tag-heading">
                    <div class="header-main">
                        <div class="header-position">
                            <div class="modal-header col-sm-12 col-xs-12">
                               <h3 class="heading-res">Reserver Mon vehicule</h3>
                            </div>
                        </div>         
                        <div class="process col-md-12 col-lg-12"> 
                            <li>
                                <p class="one">1</p>
                                <span class="steps-text">Mon moyen de paiement</span>
                            </li>
                            <li>
                                <p class="two">2</p>
                                <span class="steps-text">Mes coordonnées</span>
                            </li>
                            <li class="active">
                                <p class="three active-red">3</p>
                                <span class="steps-text">L’historique de ma commande</span>
                            </li>
                        </div>
                    </div>
                </div>
                <div id="modalDiv">
                    <section id="popup2">
                        <div class="col-md-12 col-lg-12">
                            <h3 class="secure-text"><span><img src="{{asset('fe_assets/img/noted.png')}}" class="secure"></span>HISTORIQUE DE MA COMMANDE</h3>
                        </div>
                        <div class="modal-body col-md-12 col-lg-12">
                            <div class="col-md-12 col-lg-12">
                                <div class="box-heading text-center">
                                    <h4 class="green"><span><img src="{{asset('fe_assets/img/green.png')}}" class="secure"></span>FÉLICITATION, VOTRE RÉSERVATION A ÉTÉ ACCEPTÉE</h4>
                                </div>
                                <form action="">
                                    <div class="box col-md-12 col-lg-12">
                                        <h5 class="text-center un-mail">UN MAIL DE CONFIRMATION VOUS A ÉTÉ ENVOYÉ</h5>
                                        <div class="col-md-12 col-sm-12 border-car">
                                            <div class="col-md-2 detail-car">
                                                @if($car->images->count() <= 0)
                                                    <img src="{{asset('placeholder.jpg')}}" class="img-responsive">
                                                @else
                                                    <img src="{{ url($car->images->first()->medium) }}" class="img-responsive print-image">
                                                @endif
                                            </div>
                                            <div  class="col-md-3 un-list">
                                                <ul class="unorder-list">
                                                    <li>Marque:  <p>{{$car->brand}}</p></li>
                                                    <li>Modèle: <p>{{$car->model}}</p></li>
                                                    <li>Annee: <p>{{$car->year}}</p></li>
                                                    <li>Kilometrage: <p>@if($car->mileage){{ number_format((float) filter_var( $car->mileage, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION ) * 1.6) }}{{-- number_format(intval(intval(str_replace(',', "", $car->mileage)) * 1.6)) --}} km @else Nous contacter @endif</p></li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6 print-screen">
                                                <p class="detail">Details:</p>
                                                <ul class="car-sale">
                                                    <?php
                                                        $isInter = false; $isExter = false; $isTram = false; $isVIN = false; $isOption = false; $inter = ''; $exter = ''; $tram =''; $opt = ''; $cylinder = ''; $eng = ''; $pow = '';
                                                        if($car->specification != ' ' && !empty($car->specification && $car->specification != 's:0:"";')){
                                                            $data = @unserialize($car->specification);
                                                            if($car->specification != 's:0:"";'){
                                                                if($data){
                                                                    $desc = unserialize($car->specification);
                                                                    foreach($desc as $key => $value):
                                                    ?>
                                                                        @if($key == 'Exterior Color' || $key == 'Interior Color' || $key == 'Transmission' || $key == 'VIN (Vehicle Identification Number)' || $key == 'Options' || $key == 'Engine' || $key == 'Number of Cylinders' || $key == 'Power Options')
                                                                            @if($key == 'Exterior Color')
                                                                                @if($value && $value != '')
                                                                                    @foreach($translate as $key2 => $value2)
                                                                                        <?php if(strtolower($value) == strtolower($key2)): $isExter = true; $exter = $value2; ?>
                                                                                            <!-- <hr><p><span>Couleur extérieure:</span> {{$value2}}</p> -->
                                                                                        <?php endif; ?>
                                                                                    @endforeach
                                                                                @else <!-- <hr><p><span>Couleur extérieure:</span> Nous contacter</p>  -->
                                                                                @endif
                                                                            @endif
                                                                            @if($key == 'Interior Color') 
                                                                                @if($value && $value != '')
                                                                                    @foreach($translate as $key1 => $value1)
                                                                                        <?php if(strtolower($value) == strtolower($key1)): $isInter = true; $inter = $value1; ?>
                                                                                            <!-- <hr><p><span>Couleur intérieure:</span> {{$value1}}</p> -->
                                                                                        <?php endif; ?>
                                                                                    @endforeach
                                                                                @else <!-- <hr><p><span>Couleur intérieure:</span> Nous contacter</p> --> @endif
                                                                            @endif
                                                                            @if($key == 'Transmission')
                                                                                <?php $isTram = true; ?> 
                                                                                @if($value && $value != '')
                                                                                    @foreach($translate as $key3 => $value3)
                                                                                        <?php if(strtolower($value) == strtolower($key3)): $isInter = true; $tram = $value3; ?>
                                                                                            <!-- <hr><p><span>{{$key}}:</span> {{$value}}</p> -->
                                                                                        <?php endif; ?>
                                                                                    @endforeach
                                                                                @else <!-- <hr><p><span>Transmission:</span> Nous contacter</p> -->
                                                                                @endif
                                                                            @endif
                                                                            @if($key == 'VIN (Vehicle Identification Number)') 
                                                                                <?php $isVIN = true; ?>
                                                                                @if($value && $value != '')
                                                                                    <li>{{$key}}: <span>{{$value}}</span></li>
                                                                                @endif
                                                                            @endif
                                                                            @if($key == 'Options')
                                                                                <?php $isOption = true; ?>
                                                                                @if($value && $value != '')
                                                                                    <?php $opt = $value; ?>
                                                                                    <!-- <hr><p><span>{{$key}}:</span> {{$value}}</p> -->
                                                                                @else <!-- <hr><p><span>{{$key}}:</span> Nous contacter</p> -->
                                                                                @endif
                                                                            @endif
                                                                            @if($key == 'Number of Cylinders')
                                                                                @if($value && $value != '')
                                                                                    <?php $cylinder = $value; ?>
                                                                                    <!-- <hr><p><span>{{$key}}:</span> {{$value}}</p> -->
                                                                                @else <!-- <hr><p><span>{{$key}}:</span> Nous contacter</p> -->
                                                                                @endif
                                                                            @endif
                                                                            @if($key == 'Engine')
                                                                                @if($value && $value != '')
                                                                                    <?php $eng = $value; ?>
                                                                                    <!-- <hr><p><span>{{$key}}:</span> {{$value}}</p> -->
                                                                                @else <!-- <hr><p><span>{{$key}}:</span> Nous contacter</p> -->
                                                                                @endif
                                                                            @endif
                                                                            @if($key == 'Power Options')
                                                                                @if($value && $value != '')
                                                                                    <?php $pow = $value; ?>
                                                                                    <!-- <hr><p><span>{{$key}}:</span> {{$value}}</p> -->
                                                                                @else <!-- <hr><p><span>{{$key}}:</span> Nous contacter</p> -->
                                                                                @endif
                                                                            @endif
                                                                        @endif
                                                    <?php
                                                                    endforeach;
                                                                }
                                                            }
                                                        }
                                                    ?>
                                                    @if($exter != '') <li>Couleur extérieure: <span>{{ $exter }}</span></li> @endif
                                                    @if($inter != '') <li>Couleur intérieure: <span>{{ $inter }}</span></li> @endif
                                                    <li>Transmission: <span>@if($car->transmission =='automatic') Automatique @elseif($car->transmission =='manual') Manuelle @elseif($tram != '') {{ $tram }}  @else Nous contacter @endif</span></li>
                                                    <li>Motorisation: <span>{{ empty($car->engine) ? $eng : $car->engine }}</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card-details  col-md-12 col-sm-12">
                                            <ul class="deatil-view">
                                                <li>
                                                    <p class="card-width">Référence du véhicule :</p>
                                                    <span>{{$car->referenceID}}</span>
                                                </li>
                                                <li>
                                                    <p class="card-width">Accompte :</p>
                                                    <span id="paidPrice"></span>
                                                </li>
                                                <li>
                                                    <p class="card-width">Mode de paiement :</p>
                                                    <span id="card_name"></span>
                                                </li>
                                                <li>
                                                    <p class="card-width">Date :</p>
                                                    <span>{{date('m/d/Y')}}</span>
                                                </li>
                                            </ul>
                                            <p class="line-gap">Notre service administratif vous contactera afin de vous donner toutes les informations concernant le déroulement<br>de l’importation de votre véhicule.</p>
                                        </div>
                                        <div class="text-center">
                                            <button class="print-btn" type="button" id="btnPrint"><i><img src="{{asset('fe_assets/img/print.png')}}" class="print-icon"></i>IMPRIMER </button>
                                        </div>
                                    </div> <!-- End border -->
                                    <div class="text-center border-top col-md-12">
                                        <!-- <button class="btn-red">RETOURNER SUr LA PAGE D’ACCUEIL</button> -->
                                        <!-- <a class="btn btn-red" href="{{url('/')}}">RETOURNER SUr LA PAGE D’ACCUEIL</a> -->
                                        <button class="btn btn-red" id="reloadPage">FIN</button>
                                    </div>
                                </form>
                            </div> <!-- End box -->
                            <!-- Footer --> 
                            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12  text-center">
                                <h5 class="footer-at">© FAST & RETRO 2017 I INFORMATONS LéGALES</h5>
                            </div>
                            <!-- End footer -->
                        </div>
                    </section>
                </div>
            </div>
        </div>  
    <!-- end popup1 -->
    </div>
</div> <!-- End Of Main Model -->

<!-- Modal1 error-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-resize" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title errorlabel" id="exampleModalLabel" style="color: red;"></h5>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" id="closebtn" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="button" id="resend" class="btn btn-primary">OK</button>
            </div>
        </div>
    </div>
</div>

<div class="load-modal" id="ajax-loading"></div>
@endsection
@section('fotterjs')
    <script src='https://www.google.com/recaptcha/api.js?onload=myCallBack&render=explicit'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.1/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.1/additional-methods.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.1/localization/messages_fr.js"></script>
    <script  src="{{asset('fe_assets/js/icheck.min.js')}}"></script>
    <script  src="{{asset('fe_assets/js/printthis.js')}}"></script>
    <script>
        $.fn.serializeObject = function(){
            var o = {};
            var a = this.serializeArray();
            $.each(a, function(){
                if(o[this.name]){
                    if(!o[this.name].push){
                        o[this.name] = [o[this.name]];
                    }
                    o[this.name].push(this.value || '');
                }else{
                    o[this.name] = this.value || '';
                }
            });
            return o;
        };
        String.prototype.ucfirst = function(){
            return this.charAt(0).toUpperCase() + this.substr(1);
        };
        var recaptcha1, recaptcha2, recaptcha3, recaptcha4;
        var myCallBack = function() {
            //Render the recaptcha1 on the element with ID "recaptcha1"
            recaptcha1 = grecaptcha.render('recaptcha1', {
                'sitekey' : '6LexhBQUAAAAAAlcYzCUWn9bivnPg8rCvgd8RD-m', //Replace this with your Site key
                'theme' : 'light',
                callback: function(res){
                    document.getElementById("recaptcha11").value = res;  
                },
            });
            //Render the recaptcha2 on the element with ID "recaptcha2"
            recaptcha2 = grecaptcha.render('recaptcha2', {
                'sitekey' : '6LexhBQUAAAAAAlcYzCUWn9bivnPg8rCvgd8RD-m', //Replace this with your Site key
                callback: function(res){
                    document.getElementById("recaptcha22").value = res;    
                },
            });
            recaptcha3 = grecaptcha.render('recaptcha3', {
                'sitekey' : '6LexhBQUAAAAAAlcYzCUWn9bivnPg8rCvgd8RD-m', //Replace this with your Site key
                callback: function(res){
                    document.getElementById("recaptcha33").value = res;    
                },
            });
            recaptcha4 = grecaptcha.render('recaptcha4', {
                'sitekey' : '6LexhBQUAAAAAAlcYzCUWn9bivnPg8rCvgd8RD-m', //Replace this with your Site key
                callback: function(res){
                    document.getElementById("recaptcha44").value = res;    
                },
            });
        };
        function checkCaptcha(id){
            var val = document.getElementById(id).value;
            if(val && val != undefined){
                return true;
            }else{
                alert('Veuillez sélectionner captcha');
                event.preventDefault();
            } 
        }
        $('input').iCheck({
           checkboxClass: 'icheckbox_square-grey',
           radioClass: 'iradio_square-grey',
        });
        $("#btnPrint").click(function(){
            $("#modalDiv").printThis({ 
                debug: true,              
                importCSS: true,             
                importStyle: true,         
                printContainer: true,       
                loadCSS: "{{asset('fe_assets/css/payment_css/paymentPrint.css')}}", 
                pageTitle: "My Modal",             
                removeInline: false,        
                printDelay: 333,            
                header: null,             
                formValues: true          
            }); 
        });
        // $("#tab1").css({ display: "none", });
        // $("#tab2").css({ display: "block", });
        // $("#tab1").css({ display: "none", });
        // $("#tab3").css({ display: "block", });
        $('#paymentOrder').on('submit', function(event){
            event.preventDefault();
        }).validate({
            lang: 'fr',
            rules: {
                phone: {
                    required :true,
                    minlength: 9,
                    maxlength:12,
                    integer: true,
                },
                phone_fixed:{
                    minlength: 9,
                    maxlength:12,
                    integer: true,
                },
                zip_code:{
                    required :true,
                    minlength:5,
                    maxlength:5,
                    integer: true,
                },
                email: {
                    required: true,
                    email: true
                },
            }, 
            errorPlacement: function(error, element){
                if(element.attr("name") == 'occupation_type') error.appendTo('.appOccupation');
                else if(element.attr("name") == 'civility') error.appendTo('.appCivility');
                else if(element.attr("name") == 'newsletter') error.appendTo('.appNewsletter');
                else if(element.attr("name") == 'zip_code') error.appendTo('.appZip');
                else if(element.attr("name") == 'city') error.appendTo('.appCity');
                else error.insertAfter(element);
            },
            submitHandler: function(form, event){
                event.preventDefault();
                $('.modal-title').empty();
                var values = $('#paymentOrder').serializeObject();
                values['carId'] = "{{$car->id}}";
                values['orderId'] = order.id;
                $body.addClass("loading");
                $.ajax({
                    url: "{{url('/car/reserve/userDetails')}}",
                    data: values,
                    type: 'POST',
                    success: function(res){
                        order = res.order;
                        $("#card_name").html(order.card_name.ucfirst() + " * * * * * * * * * * * " + order.card);
                        $('#paidPrice').html(order.amount + ".00 $");
                        $('#errormsg').hide();
                        $body.removeClass("loading");
                        $("#tab2").css({ display: "none", });
                        $("#tab3").css({ display: "block", });
                    },
                    error: function(err){
                        var error = err.responseJSON.error;
                        $body.removeClass("loading");
                        $("#resend").hide();
                        $('#errormsg2').show();
                        $("#errormsg2").html(error.message);
                    },
                });
            },
        });

        var paid = false;
        var order;
        $('#myModal').modal({ show: false, });
        $('#successModal').modal({ show: false, });
        $body = $("body");
        $('#errormsg').hide();
        $('#errormsg2').hide();
        $('#errormsg3').hide();
        var tempAmount = 2000;
        var myFunction = function(amount, temp){
            $('.modal-title').empty();
            var values = $('#formvalidate').serializeObject();
            if(temp != undefined) tempAmount = temp;
            values['amount'] = tempAmount;
            if(amount != undefined) values['amount'] = amount;
            $body.addClass("loading");
            var errorCodes = ['invalid_card_number', 'invalid_exp_date', 'invalid_cvv',];
            values['carId'] = "{{$car->id}}";
            $.ajax({
                url: "{{url('/car/reserve')}}",
                data: values,
                type: 'POST',
                success: function(res){
                    order = res.order;
                    $('#errormsg').hide();
                    $body.removeClass("loading");
                    paid = true;
                    $("#tab1").css({ display: "none", });
                    $("#tab2").css({ display: "block", });
                    /*$('.modal-title').removeClass('errorlabel');
                    $("#resend").hide();
                    $("#closebtn").hide();
                    $('.modal-title').append("Félicitation ! Votre voiture est réservée");
                    $('#successModal').modal({ show: true, });
                    setTimeout(function(){ location.reload(); }, 3000);*/
                },
                error: function(error){
                    if(error.status == 405){
                        $body.removeClass("loading");
                        $("#resend").show();
                        $('#errormsg').hide();
                        $('.modal-title').append('Le montant est insuffisant vous souhaitez réserver par: 1000,00 $');
                        $('#myModal').modal({ show: true});
                    }else{
                        $body.removeClass("loading");
                        $("#resend").hide();
                        var errorLabel = '';
                        if(error.responseJSON.payment == 'authorize'){
                            if(error.responseJSON.Errorcode == '7') errorLabel = 'invalid_exp_date';
                            else if(error.responseJSON.Errorcode == 'E00003') errorLabel = 'invalid_cvv';
                            else errorLabel = 'invalid_card_number';
                        }else{ 
                            var errorJson = JSON.parse(error.responseJSON.httpStatus), errors = [];
                            for(var k in errorJson.messages){ errors.push(errorJson.messages[k].code); };
                            for(i = 0; i < errorCodes.length; i++){
                                if(jQuery.inArray(errorCodes[i], errors) !== -1){ errorLabel = errorCodes[i]; break; }
                            }
                        }    
                        /*if(errorLabel == 'invalid_card_number'){
                            $('.modal-title').append('Numéro de carte invalide');
                            $('#myModal').modal({ show: true});
                        }else */if(errorLabel == 'invalid_exp_date'){
                                    $('#errormsg').show();
                                    $("#errormsg").html("La date d'expiration n'est pas valide");
                        }else if(errorLabel == 'invalid_cvv'){
                            $('#errormsg').show();
                            $("#errormsg").html("CVV invalide");
                        }else{
                            $("#resend").show();
                            $('.modal-title').append("Nous n'arrivons pas à effectuer la transaction. Nous vous proposons de recommencer l'opération avec un montant inférieur de 1000,00 $.");
                            $('#myModal').modal({ show: true});
                            $('#errormsg').hide();
                        }
                    }
                },
            });
        }
        $('#formvalidate').on('submit', function(event){
            event.preventDefault();
        }).validate({
            lang: 'fr',
            error: function(label) {
                $(this).addClass("error");
            },
            rules: {
                name: "required",
                family_name: "required",
                chkterms: "required",
                card: {
                    required: true,
                    creditcard: true,
                    integer: true,
                }, 
                /*email: {
                    required: true,
                    email: true
                },*/
                month: {
                    required: true,
                    integer: true,
                },
                year: {
                    required: true,
                    integer: true,
                    min: function(){ return '{{date("Y")}}'; },
                },
                cvv: {
                    required: true,
                    integer: true,
                    minlength: 3,
                    maxlength:4,
                }
            },
            errorPlacement: function(error, element){
                if(element.attr("name") == 'name'){
                    $('.name-label').addClass('label-color');
                }else if(element.attr("name") == 'family_name'){
                    $('.family_name-label').addClass('label-color');
                }else if(element.attr("name") == 'chkterms') error.appendTo('#appAccept');
                else if(element.attr("name") == 'civility') error.appendTo('.appCivility');
                else error.insertAfter(element); 
            },
            messages: {
                email:{
                  email: "Veuillez entrer une adresse email valide",
                },
                cardholdername: "Veuillez entrer votre nom de titulaire de la carte bancaire",
                card: {
                    required : "Veuillez entrer votre numéro de carte bancaire",
                },
                exp_date: {
                    required: "Veuillez mettre une date d'expiration",
                    minlength: "Votre date d'expiration doit être de 4 chiffres"
                },
                cvv: {
                    required: "Veuillez fournir un cvv",
                    //minlength: "Your cvv must be at least 3 characters long"
                },
            },
            submitHandler: function(form, event){
                event.preventDefault();
                $('.name-label').removeClass('label-color');
                $('.family_name-label').removeClass('label-color');
                myFunction();
            }
        });
        $("#resend").click(function(){
            $("#amt-up").html("Montant total : 1000,00 $");
            $("#carPrice").html("1000,00 $");
            $('#myModal').modal('hide');
            //myFunction(1000, 1000);
            tempAmount = 1000; 
            setTimeout(function(){
                $body.addClass("modal-open");
            }, 1000);
        });
        $("#reloadPage").click(function(){
            window.location.reload();
        });
        $('#paymentstep1').on('hidden.bs.modal', function(){
            if(paid == true){
                window.location.reload();
            }
        });
    </script>
@endsection