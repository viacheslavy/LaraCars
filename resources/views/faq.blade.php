@extends('layouts.app')

@section('slider')
    {{--<div class="container-fluid underheader text-center">--}}
        {{--<div class="container">--}}
            {{--<img src="{{ asset('fe_assets') }}/img/page-faq-bigpic.png" class="img-responsive">--}}
        {{--</div>--}}
    {{--</div>--}}
@endsection

@section('content')

<div class="container-fluid page-head-parent">
    <div class="container">
        <div class="col-xs-12 col-lg-offset-1 col-lg-10 page-head">
            <p>COMMENT CA MARCHE  - FAQ </p>
            <hr>
        </div>
    </div>
</div>

<div class="container-fluid page-faq">
    <div class="container">

        <div class="col-xs-12 col-lg-offset-1 col-lg-10 page-faq-one">
            <div class="page-faq-left">
                <img src="{{ asset('/fe_assets') }}/img/faq-1.png">
            </div>
            <div class="page-faq-right">
                <h2>Quel est le co&ucirc;t du transport de mon v&eacute;hicule ?</h2>
                <p>Les prix indiqu&eacute;s sur notre site internet inclus le transport.</p>
            </div>
        </div>
        <div class="col-xs-12 col-lg-offset-1 col-lg-10 page-faq-one">
            <div class="page-faq-left">
                <img src="{{ asset('/fe_assets') }}/img/faq-2.png">
            </div>
            <div class="page-faq-right">
                <h2>Vais-je devoir payer des taxe &agrave; l'arriv&eacute;e de mon v&eacute;hicule de collection en France ? Lesquelles ?</h2>
                <p>Oui, vous devrez vous acquitter de la TVA sur les v&eacute;hicules de collection soit 5,5%. Cependant, nous affichons nos tarifs sur le site en TTC, de fait elle viendra en d&eacute;duction lors du paiement de votre v&eacute;hicule.</p>
            </div>
        </div>
        <div class="col-xs-12 col-lg-offset-1 col-lg-10 page-faq-one">
            <div class="page-faq-left">
                <img src="{{ asset('/fe_assets') }}/img/faq-3.png">
            </div>
            <div class="page-faq-right">
                <h2>Dois-je verser un acompte pour r&eacute;server mon v&eacute;hicule ?</h2>
                <p>Oui, tous les vendeurs aux &Eacute;tats Unis demandent un acompte pour pouvoir r&eacute;server un v&eacute;hicule. Il est de l'ordre de 2000 euros.</p>
            </div>
        </div>
        <div class="col-xs-12 col-lg-offset-1 col-lg-10 page-faq-one page-faq-one-yellow">
            <div class="page-faq-left">
                <img src="{{ asset('/fe_assets') }}/img/faq-yellow.png">
            </div>
            <div class="page-faq-right">
                <h2>Sous quels d&eacute;lais vais-je recevoir ma voiture ?</h2>
                <p>Le d&eacute;lai moyen est de l'ordre de 3 &agrave; 4 semaines.</p>
            </div>
        </div>
        <div class="col-xs-12 col-lg-offset-1 col-lg-10 page-faq-one">
            <div class="page-faq-left">
                <img src="{{ asset('/fe_assets') }}/img/faq-4.png">
            </div>
            <div class="page-faq-right">
                <h2>Est-ce que le co&ucirc;t de la carte grise est inclus dans le prix du v&eacute;hicule ?</h2>
                <p>Non. La carte grise doit &ecirc;tre pay&eacute;e directement &agrave; votre pr&eacute;fecture. Cependant, nous pouvons nous occuper pour vous des d&eacute;marches via mandat. Ce mandat vous co&ucirc;tera 200 euros + le prix de la carte grise.</p>
            </div>
        </div>
        <div class="col-xs-12 col-lg-offset-1 col-lg-10 page-faq-one">
            <div class="page-faq-left">
                <img src="{{ asset('/fe_assets') }}/img/faq-5.png">
            </div>
            <div class="page-faq-right">
                <h2>Est-ce que mon v&eacute;hicule aura une carte grise sp&eacute;cifique aux voitures de collection ?</h2>
                <p>Oui, pour les v&eacute;hicules de plus de 30 ans, une carte grise sp&eacute;cifique aux voitures de collection sera &eacute;mise.</p>
            </div>
        </div>
        <div class="col-xs-12 col-lg-offset-1 col-lg-10 page-faq-one">
            <div class="page-faq-left">
                <img src="{{ asset('/fe_assets') }}/img/faq-6.png">
            </div>
            <div class="page-faq-right">
                <h2>Que dois-je faire pour immatriculer mon v&eacute;hicule ?</h2>
                <p>C'est facile, vous devez envoyer un dossier complet &agrave; la F&eacute;d&eacute;ration Fran&ccedil;aise des V&eacute;hicules d'&Eacute;poque (FFVE) pour obtenir une attestation. Le d&eacute;lai de traitement des demandes d'attestation pour un dossier re&ccedil;u complet est de 4 &agrave; 8 semaines. Si vous le souhaitez, vous pouvez mandater Fast & Retro afin que nous nous occupions de ces d&eacute;marches pour vous.</p>
            </div>
        </div>
        <div class="col-xs-12 col-lg-offset-1 col-lg-10 page-faq-one">
            <div class="page-faq-left">
                <img src="{{ asset('/fe_assets') }}/img/faq-7.png">
            </div>
            <div class="page-faq-right">
                <h2>Combien co&ucirc;te une attestation FFVE ?</h2>
                <p>Une attestation de la F&eacute;d&eacute;ration Fran&ccedil;aise des V&eacute;hicules d'&Eacute;poque (FFVE) co&ucirc;te 50 euros.</p>
            </div>
        </div>
        <div class="col-xs-12 col-lg-offset-1 col-lg-10 page-faq-one">
            <div class="page-faq-left">
                <img src="{{ asset('/fe_assets') }}/img/faq-8.png">
            </div>
            <div class="page-faq-right page-faq-blue">
                <h2>Qu'inclut le prix indiqu&eacute; sur le site pour chaque v&eacute;hicule de collection ?</h2>
                <p>Notre tarif pour les v&eacute;hicules classiques, de collection ou muscle cars inclut :<br>
                    -La TVA fran&ccedil;aise &agrave; 5,5%<br>
                    -La tva am&eacute;ricaine (diff&eacute;rente en fonction des &eacute;tats am&eacute;ricains)<br>
                    -L'assurance du v&eacute;hicule<br>
                    -L'enl&egrave;vement et transport du v&eacute;hicule jusqu'au port aux &Eacute;tats Unis<br>
                    -La location du conteneur pour le transport maritime<br>
                    -Le d&eacute;potage<br>
                <span>Les seuls frais suppl&eacute;mentaires seront le co&ucirc;t de votre carte grise et l'attestation FFVE pour les v&eacute;hicules de plus de 30 ans.</span></p>
            </div>
        </div>


        <div class="col-xs-12 col-lg-offset-1 col-lg-10">
            <div class="page-footer-car-child">
                <img src="{{ asset('/fe_assets') }}/img/page-footer-logo.png" class="page-footer-car-first">
                <img src="{{ asset('/fe_assets') }}/img/page-faq-footer-car.png" class="page-footer-car-second">
            </div>
        </div>
    </div>
</div>

<div class="container blankspace">
    <p>&nbsp;</p>
</div>

@endsection