@extends('layouts.app')
@section('slider')
    <div class="container-fluid underheader text-center">
        <div class="container">
            <img src="{{ asset('fe_assets') }}/img/underheader-img.png" class="img-responsive">
        </div>
    </div>
@endsection


@section('content')
    <style>
        .disabled-res{pointer-events: none;cursor: default;}
    </style>
    <link rel="stylesheet" type="text/css" href="{{asset('fe_assets/css/custom.css')}}">

    @include('layouts.search')

    <div class="container-fluid products">
        <div class="container">


        @if (!empty($cars))

            @foreach($cars as $car)
                <div class="col-xs-12 col-sm-6 col-md-3 product-one-parent">
                    <div class="product-one" style="height: 315px;">
                        <div class="tag-background" style="min-height: 170px;max-height:170px; overflow: hidden;position:relative;">
                            <?php $featuredImage = 0; ?>
                            @if($car->images->count() != 0)
                                @foreach($car->images as $image)
                                    @if($image->featured == 1)
                                        @if(\App\Http\Controllers\CarsFEController::checkRemoteFile(url($image->medium)) == 1)
                                            <img src="{{ url($image->medium) }}" style="min-height:170px;">
                                        @else
                                            <img src="{{ asset('placeholder.jpg') }}" alt="">
                                        @endif
                                        <?php $featuredImage = 1; ?>
                                        <?php break; ?>
                                    @endif
                                @endforeach
                                @if($featuredImage == 0)
                                    <img src="{{ asset('placeholder.jpg') }}" alt="" style="min-height:170px;">
                                @endif
                            @else
                                <img src="{{ asset('placeholder.jpg') }}" alt="" style="min-height:170px;">
                            @endif
                             @if($car->status === 'sold')
                                <img src="{{ asset('/fe_assets') }}/img/vendu.png" style="width: 50%;/* top: 63px; */position: absolute;right: -28px;max-height: 170px;overflow: hidden;bottom: -16px;">
                            @endif
                            @if($car->status === 'booked')
                                <img src="{{ asset('/fe_assets') }}/img/single-reserve.png" style="width: 50%;/* top: 63px; */position: absolute;right: -28px;max-height: 170px;overflow: hidden;bottom: -16px;">
                            @endif
                            <!-- @if($car->status === 'booked')
                                <h4 id="offer-tag"> réservé </h4>
                            @elseif($car->status === 'sold')
                                <h4 id="offer-tag"> vendue </h4>
                            @endif -->
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
                                        } else if($setting->id == 1) {
                                            $percentage = \App\Http\Controllers\GlobalPercentageSettingsController::getRangePercentageSingle($finalPrice);

                                            $addOnPrice = ($finalPrice * $percentage) / 100;
                                        }
                                    }

                                    $finalPrice += $addOnPrice;
                                    $finalPrice = round($finalPrice);

                                    $ostatak = $finalPrice % 100;

                                    $finalPrice = $finalPrice - $ostatak + 100;

                                    ?>

                                    <!-- {{ number_format($finalPrice, 2, ',', '') }} &euro; -->
                                    {{ number_format($car->price, 2, ',', '') }} &euro;
                                </span>
                            </div>
                                <a href="{{ route('get.product', $car->id) }}" class="@if($car->status == 'booked' || $car->status == 'sold') disabled-res @endif">
                                    <p><i class="fa fa-caret-right" aria-hidden="true"></i> Voir d&eacute;tails</p>
                                </a>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="col-xs-12 pagenumber">

                @if(\Request::all())
                    {{ $cars->appends([
                        'brand' => \Request::get('brand'),
                        'model' => \Request::get('model'),
                        'year1'  => \Request::get('year1'),
                        'year2'  => \Request::get('year2'),
                        'sortby' => \Request::get('sortby'),
                        'search' => \Request::get('search'),
                        ])->links() }}
                @else
                    {{ $cars->links() }}
                @endif

                @endif

            </div>
        </div>
    </div>

    <div class="container-fluid above-footer">
        <div class="container">
            <div class="col-xs-12">
                <h1>DEVENEZ MEMBRE!</h1>
                <hr>
                <h3>Envie de nous rejoindre?</h3>
            </div>
            <div class="col-xs-12 col-sm-7">

                <div class="above-footer-text">
                    <img src="{{ asset('fe_assets') }}/img/subscribe-img.png">
                    <div class="above-footer-text-right">
                        <h4>Vos bénéfices:</h4>
                        <p>. Acc&egrave;s exclusif à nos 200+ produits</p>
                        <p>. Email d’alerte sur vos v&eacute;hicules préférés</p>
                        <p>. Email d’alerte sur les plus belles affaires</p>
                        <p>. De nombreux autres avantages à venir</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-5">
                <div class="above-footer-subscribe">
                    <div class="subscribe-bckg">
                        <h2>Créez un Compte en <span>3</span> clics</h2>
                        @include('layouts.subscribe')
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
