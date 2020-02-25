@extends('layouts.app')

@section('slider')
    {{--<div class="container-fluid underheader text-center">--}}
        {{--<div class="container">--}}
            {{--<img src="{{ asset('fe_assets') }}/img/etape-bigpic.png" class="img-responsive">--}}
        {{--</div>--}}
    {{--</div>--}}
@endsection

@section('content')

<div class="container-fluid page-head-parent page-presentation-top">
    <div class="container">
        <div class="col-xs-12 col-lg-offset-1 col-lg-10 page-head">
            <p>COMMENT CA MARCHE - Etape par etape</p>
            <hr>
            <h3>Chez Fast &amp; Retro, nous sommes sp&eacute;cialistes en logistique d'importation de v&eacute;hicules de collection en provenance du continent am&eacute;ricain.</h3>
        </div>
    </div>
</div>

<div class="container-fluid page-presentation page-etape">
    <div class="container">
        <div class="col-xs-12 col-lg-offset-1 col-lg-10">
            <div class="col-xs-12 present-one">
                <img src="{{ asset('/fe_assets') }}/img/divider-red-white.png">
                <div class="present-one-text">
                    <p>Chaque jour, nous facilitons de nombreuses acquisitions automobiles, r&eacute;alis&eacute;es outre-atlantique, et veillons &agrave; garantir le parfait d&eacute;roulement de chacune d'entre elles. Depuis des ann&eacute;es, notre activit&eacute; s'est r&eacute;v&eacute;l&eacute;e &eacute;tre une alternative, coh&eacute;rente et toujours plus pl&eacute;biscit&eacute;e, permettant d'acc&eacute;der &agrave; un exceptionnel inventaire en mati&eacute;re de voitures de collection, en se pr&eacute;munissant des moindres risques pouvant r&eacute;sulter d'une acquisition &agrave; distance.</p>
                </div>
            </div>
            <hr>
            <h4>Passionn&eacute;s et agissant pour le compte d'amateurs et collectionneurs, l'&eacute;quipe de Fast &amp; Retro s'implique int&eacute;gralement dans les projets de nos potentiels clients.</h4>
            <div class="col-xs-12 present-one">
                <img src="{{ asset('/fe_assets') }}/img/divider-red-white.png">
                <div class="present-one-text">
                    <p>Nous serions ravis de vous communiquer les t&eacute;moignages de ces derniers, il ne manqueront pas de vous faire part de leur enti&eacute;re satisfaction vis &agrave; vis de notre entreprise.</p>
                </div>
            </div>
            <div class="col-xs-12 sidebar-divider presentation-stars">
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
            </div>
            <div class="col-xs-12 presentation-middle-text etape-red-grey">
                <div class="page-faq-right">
                    <h2>Pour votre information</h2>
                    <p>Veuillez vous r&eacute;f&eacute;rer &agrave; l'image ci-apr&eacute;s pour conna&icirc;tre les diff&eacute;rentes &eacute;tapes li&eacute;es &agrave; l'acquisition de votre v&eacute;hicule.</p>
                </div>
                <img src="{{ asset('/fe_assets') }}/img/etape-erase.png">
            </div>

            <div class="col-xs-12 etape-numbers">
                <img src="{{ asset('/fe_assets') }}/img/etape-car.png" class="etape-car">
                <img src="{{ asset('/fe_assets') }}/img/etape-number-1.png" class="etape-number">
                <div class="etape-numbers-mobile">
                    <img src="{{ asset('/fe_assets') }}/img/etape-numbers-1.png">
                    <img src="{{ asset('/fe_assets') }}/img/etape-numbers-2.png">
                    <img src="{{ asset('/fe_assets') }}/img/etape-numbers-3.png">
                    <img src="{{ asset('/fe_assets') }}/img/etape-numbers-4.png">
                    <img src="{{ asset('/fe_assets') }}/img/etape-numbers-5.png">
                    <img src="{{ asset('/fe_assets') }}/img/etape-numbers-6.png">
                </div>
            </div>

            <div class="col-xs-12 presentation-middle-text etape-red-grey-pic">
                <img src="{{ asset('/fe_assets') }}/img/etape-1.png">
                <div class="page-faq-right">
                    <h2>1 - D&eacute;P&Ocirc;T DE R&eacute;SERVE</h2>
                    <p>Le versement d'un acompte de 2000 euros est n&eacute;cessaire pour initier le processus de r&eacute;servation et d'inspection de votre v&eacute;hicule.</p>
                </div>
            </div>

            <div class="col-xs-12 sidebar-divider presentation-stars">
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
            </div>


            <div class="col-xs-12 etape-red-grey-pic">
                <img src="{{ asset('/fe_assets') }}/img/etape-2.png">
                <div class="page-faq-right">
                    <h2>2 - R&eacute;SERVATION DU V&eacute;HICULE ET INSPECTION</h2>
                    <p>Une fois la r&eacute;servation enregistr&eacute;e, via le versement d'un acompte, un expert automobile agr&eacute;&eacute; par l'&eacute;tat f&eacute;d&eacute;ral am&eacute;ricain se rend sur place entre 5 et 7 jours. Il est d&eacute;p&eacute;ch&eacute; afin de proc&eacute;der aux contr&ocirc;les administratifs et m&eacute;caniques n&eacute;cessaires avec essai routier. Si le v&eacute;hicule correspond &agrave; l'annonce qui en a &eacute;t&eacute; faite et qu'aucun vice cach&eacute; n'est constat&eacute;, et avec votre accord, nous confirmons la vente avec le propri&eacute;taire du v&eacute;hicule.</p>    
                </div>
            </div>

            <div class="col-xs-12 sidebar-divider presentation-stars">
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
            </div>

            <div class="col-xs-12 etape-red-grey-pic">
                <img src="{{ asset('/fe_assets') }}/img/etape-3.png">
                <div class="page-faq-right">
                    <h2>3 - R&eacute;GLEMENT DU VENDEUR ET CONSTITUTION DE VOTRE DOSSIER APR&eacute;S INSPECTION VALIDEE</h2>
                    <p>Un virement international (avec SWIFT et IBAN), diminu&eacute; de l'acompte pr&eacute;c&eacute;demment vers&eacute;, vous sera demand&eacute; et devra &eacute;tre effectu&eacute; sous 72 heures pour profiter du taux de change du moment. D&eacute;s lors notre service logistique constituera le dossier administratif et douanier en votre nom.</p>
                </div>
            </div>

            <div class="col-xs-12 sidebar-divider presentation-stars">
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
            </div>

            <div class="col-xs-12 etape-red-grey-pic">
                <img src="{{ asset('/fe_assets') }}/img/etape-4.png">
                <div class="page-faq-right">
                    <h2>4 - PRISE EN CHARGE DU V&eacute;HICULE AUPR&eacute;S DU VENDEUR</h2>
                    <p>Notre agent transitaire organisera l'enl&eacute;vement de votre v&eacute;hicule et sa livraison au terminal portuaire afin de le charger dans un container de transport s&eacute;curis&eacute;. Au m&eacute;me moment, une assurance maritime tous risques est contract&eacute;e afin de garantir un transport et une livraison sans encombre de votre v&eacute;hicule.</p>
                </div>
            </div>

            <div class="col-xs-12 sidebar-divider presentation-stars">
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
            </div>

            <div class="col-xs-12 etape-red-grey-pic">
                <img src="{{ asset('/fe_assets') }}/img/etape-5.png">
                <div class="page-faq-right">
                    <h2>5 - ARRIV&eacute;E DE VOTRE V&eacute;HICULE , D&eacute;DOUANEMENT ET LIVRAISON</h2>
                    <p>Trois &agrave; cinq semaines apr&eacute;s l'enl&eacute;vement de votre v&eacute;hicule, celui-ci arrivera au port de votre convenance. Il sera d&eacute;douan&eacute; sur place par un commissionnaire en douanes agr&eacute;&eacute;, sous quatre &agrave; cinq jours. Une fois les formalit&eacute;s accomplies, votre automobile sera enlev&eacute;e par transporteur pour &eacute;tre livr&eacute;e sur le lieu de votre choix. ( livraison a domicile en suppl&eacute;ment).</p>    
                </div>
            </div>

            <div class="col-xs-12 sidebar-divider presentation-stars">
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
            </div>

            <div class="col-xs-12 etape-red-grey-pic">
                <img src="{{ asset('/fe_assets') }}/img/etape-6.png">
                <div class="page-faq-right">
                    <h2>6 - IMMATRICULATION</h2>
                    <p>Notre agent transitaire vous d&eacute;livrera les documents administratifs n&eacute;cessaires &egrave; l'immatriculation de votre v&eacute;hicule. Une demande d'attestation d'int&eacute;r&eacute;t historique aupr&eacute;s de la F&eacute;d&eacute;ration Fran&ccedil;aise des v&eacute;hicules d'&eacute;poque (FFVE) sera alors effectu&eacute;e.</p>
                </div>
            </div>



            <div class="col-xs-12 sidebar-divider presentation-stars">
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
                <i class="fa fa-star" aria-hidden="true"></i>
            </div>


        </div>



        <div class="col-xs-12 col-lg-offset-1 col-lg-10">
            <div class="page-etape-footer">
                <img src="{{ asset('/fe_assets') }}/img/etape-logo.png">
                <p>Nous serons heureux de prendre en charge votre projet jusqu'&agrave; son immatriculation et de vous voir r&eacute;aliser votre r&eacute;ve sans encombre.</p>
            </div>
        </div>
    </div>
</div>

<div class="container blankspace">
    <p>&nbsp;</p>
</div>

@endsection