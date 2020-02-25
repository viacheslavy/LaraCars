@extends('layouts.app')

@section('slider')
    {{--<div class="container-fluid underheader text-center">--}}
        {{--<div class="container">--}}
            {{--<img src="{{ asset('fe_assets') }}/img/guarant-bigpic.png" class="img-responsive">--}}
        {{--</div>--}}
    {{--</div>--}}
@endsection

@section('content')

<div class="container-fluid page-head-parent">
    <div class="container">
        <div class="col-xs-12 col-lg-offset-1 col-lg-10 page-head">
            <p>Nos Garanties</p>
            <hr>
        </div>
    </div>
</div>

<div class="container-fluid page-guarant">
    <div class="container">
        <div class="col-xs-12 col-lg-offset-1 col-lg-10 guarant-top">
            <div class="col-xs-12 col-md-5 guarant-top-left">
                <img src="{{ asset('/fe_assets') }}/img/guarantee-car.png">
            </div>
            <div class="col-xs-12 col-md-7 guarant-right">
                <div class="guarant-right-head">
                    <img src="{{ asset('/fe_assets') }}/img/check.png">
                    <h2>Acceuil personnalis&eacute;</h2>
                </div>
                <p class="guarant-right-silver">Ensemble, et après un premier entretien téléphonique, plusieurs axes vous seront proposés en accord avec votre demande, ou vos objectifs :
                </p>
                <p>- Conseils techniques sur le véhicule, dynamisation de la recherche, conseils et suivi</p>
                <p>- Orientation sur le modele de vehicule</p>
                <p>- Proposition de prestations adaptées à votre besoin</p>
                <p>- Pour une démarche plus personnalisée, un accompagnement jusqu'à l'obtention de l'attestation de la FFVE ainsi que la carte grise française.</p>
            </div>


        </div>
        <div class="col-xs-12 guarant-top-bottom">
            <img src="{{ asset('/fe_assets') }}/img/guarantee-red.png">
            <p>- Pour une demarche plus personnalise, un accompagnement jusqu'a l'obtention de l'attestation de la FFVE ainsi que la carte grise francaise.</p>
        </div>

        <div class="col-xs-12 col-lg-offset-1 col-lg-10 guarant-bottom">
            <div class="col-xs-12 col-sm-6 guarant-bottom-one">
                <div class="guarant-bottom-one-head">
                    <h2><img src="{{ asset('/fe_assets') }}/img/check.png"> Tarif préférentiel</h2>
                </div>
                <p>Notre but est de vous faire bénéficier des tarifs les plus avantageux du marché. C'est la raison pour laquelle Fast & Retro vous met directement en relation, via nos annonces, avec le propriétaire aux États Unis. En supprimant les intermédiaires, le co&ucirc;t total de votre véhicule diminue.</p>
            </div>
            <div class="col-xs-12 col-sm-6 guarant-bottom-one">
                <div class="guarant-bottom-one-head">
                    <h2><img src="{{ asset('/fe_assets') }}/img/check.png"> Prises en charges des démarches administratives</h2>
                </div>
                <p>Les démarches administratives aux États Unis et en France sont assez lourdes. C'est pourquoi nous nous occupons de toutes ces démarches afin que l'acquisition de votre véhicule soit et demeure un plaisir.</p>
            </div>
            <div class="col-xs-12 col-sm-6 guarant-bottom-one">
                <div class="guarant-bottom-one-head">
                    <h2><img src="{{ asset('/fe_assets') }}/img/check.png"> Examen minutieux et contrôle qualité</h2>
                </div>
                <p>Une expertise minutieuse est effectuée sur l’ensemble de nos véhicules vendus. Un rapport détaillé de votre véhicule vous ai remis avant la finalisation de la vente. Cela vous garantie de n’avoir aucune surprise à l’arrivée de votre voiture de collection.</p>
            </div>
            <div class="col-xs-12 col-sm-6 guarant-bottom-one">
                <div class="guarant-bottom-one-head">
                    <h2><img src="{{ asset('/fe_assets') }}/img/check.png"> Sélection rigoureuse du véhicule</h2>
                </div>
                <p>Nous ne choisissons pas nos véhicules au hasard. Nous travaillons depuis des années avec des acteurs importants du marché américains. Tous nos véhicules sont triés sur le volet afin de vous permettre d'acheter les meilleurs véhicules sur le marché à des prix très compétitifs .</p>
            </div>
        </div>

        <div class="col-xs-12 guarant-red">
            <img src="{{ asset('/fe_assets') }}/img/guarantee-red.png">
            <div class="sidebar-divider">
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
            </div>
        </div>





        <div class="col-xs-12 col-lg-offset-1 col-lg-10">


            <div class="page-footer-car-child">
                <img src="{{ asset('/fe_assets') }}/img/page-footer-logo.png" class="page-footer-car-first">
                <img src="{{ asset('/fe_assets') }}/img/page-footer-car.png" class="page-footer-car-second">
            </div>
        </div>
    </div>
</div>
<div class="container blankspace">
    <p>&nbsp;</p>
</div>

@endsection