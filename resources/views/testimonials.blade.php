@extends('layouts.app')

@section('slider')
    {{--<div class="container-fluid underheader text-center">--}}
        {{--<div class="container">--}}
            {{--<img src="{{ asset('fe_assets') }}/img/testimonial-bigpic.png" class="img-responsive">--}}
        {{--</div>--}}
    {{--</div>--}}
@endsection

@section('content')

<div class="container-fluid page-head-parent">
    <div class="container">
        <div class="col-xs-12 col-lg-offset-1 col-lg-10 page-head">
            <p>Temoignages - Ecrits</p>
            <hr>
        </div>
    </div>
</div>

<div class="container-fluid page-testimonial">
    <div class="container">
        <div class="col-xs-12 col-lg-offset-1 col-lg-10 testimonial-one-parent">
            <div class="testimonial-one">
                <img class="testimonial-logo" src="{{ asset('/fe_assets') }}/img/testimonial-logo.png">
                <div class="testimonial-one-left">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-1.png">
                </div>
                <div class="testimonial-one-quote">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-quote.png">
                </div>
                <div class="testimonial-one-right">
                    <p>bonjour Fast & Retro.<br>
Merci mille fois, je viens de recevoir ma belle Ford mustang 66 et elle est tout simplement magnifique.Vous avez realise mon reve !!! Il est clair que ma prochaine americaine sera achetee chez vous.<br>
Cordialement<br><br>
                    Dépt : 60
                    </p>
                </div>
                <div class="testimonial-bottom">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-line.png">
                    <p>Michel et Jacqueline.E</p>
                </div>
            </div>
        </div>

        <div class="col-xs-12 sidebar-divider">
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
        </div>

        <div class="col-xs-12 col-lg-offset-1 col-lg-10 testimonial-one-parent">
            <div class="testimonial-one">
                <img class="testimonial-logo" src="{{ asset('/fe_assets') }}/img/testimonial-logo.png">
                <div class="testimonial-one-left">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-1.png">
                </div>
                <div class="testimonial-one-quote">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-quote.png">
                </div>
                <div class="testimonial-one-right">
                    <p>Merci Alex pour votre professionalisme après l'achat de ma camaro chez vous. Merci également pour votre gentillesse et disponibilité.
Je recommande Fast & Retro sans hésitation pour les prix très compétitifs,commande,délai et livraison sans surprise.<br>
Pour ma part je recommanderais votre societe a ma famille et a mes amis
Encore merci pour tou<br>
                    Dépt : 70
                    </p>
                </div>
                <div class="testimonial-bottom">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-line.png">
                    <p>Jean.D</p>
                </div>
            </div>
        </div>
        <div class="col-xs-12 sidebar-divider">
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
        </div>

        <div class="col-xs-12 col-lg-offset-1 col-lg-10 testimonial-one-parent">
            <div class="testimonial-one">
                <img class="testimonial-logo" src="{{ asset('/fe_assets') }}/img/testimonial-logo.png">
                <div class="testimonial-one-left">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-1.png">
                </div>
                <div class="testimonial-one-quote">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-quote.png">
                </div>
                <div class="testimonial-one-right">
                    <p>Achat d'une Corvette le premier septembre, voiutre recu le 23 septembre,nous sommes très satisfaits de la prestation offerte par votre entreprise. Tout y est: explications claires, échanges constructifs, et accueil sympathique!
Nous recommandons vivement , et ne manquerons pas de revenir.<br>
                    Dépt : 27
                    </p>
                </div>
                <div class="testimonial-bottom">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-line.png">
                    <p>Sylvain.B</p>
                </div>
            </div>
        </div>
        <div class="col-xs-12 sidebar-divider">
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
        </div>

        <div class="col-xs-12 col-lg-offset-1 col-lg-10 testimonial-one-parent">
            <div class="testimonial-one">
                <img class="testimonial-logo" src="{{ asset('/fe_assets') }}/img/testimonial-logo.png">
                <div class="testimonial-one-left">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-1.png">
                </div>
                <div class="testimonial-one-quote">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-quote.png">
                </div>
                <div class="testimonial-one-right">
                    <p>Il n'est pas évident de commander une voiture à 10,000 km de son domicile !!!...dès le premier contact téléphonique avec votre equipe, nous avons été rassurés par votre sérieux.
Cette première bonne impression n'a fait que s'étoffer au fil des semaines : aimable, sérieux dans les documents, disponible, avec un parler "vrai", vous n’hesitez pas a vous investir, même financièrement, pour satisfaire votre clientèle.Tout a été traité par téléphone et courrier, au final nous possèdons le vehicule conforme au mandat signé et sommes très satisfaits de votre prestation, merci pour tout !!!...<br>
                    Dépt : 27
                    </p>
                </div>
                <div class="testimonial-bottom">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-line.png">
                    <p>Pierre C, Retraité</p>
                </div>
            </div>
        </div>
        <div class="col-xs-12 sidebar-divider">
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
        </div>

        <div class="col-xs-12 col-lg-offset-1 col-lg-10 testimonial-one-parent">
            <div class="testimonial-one">
                <img class="testimonial-logo" src="{{ asset('/fe_assets') }}/img/testimonial-logo.png">
                <div class="testimonial-one-left">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-1.png">
                </div>
                <div class="testimonial-one-quote">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-quote.png">
                </div>
                <div class="testimonial-one-right">
                    <p>Toujours un accueil très sympathique et très professionnel.
C'est le deuxième véhicule que nous achetons chez vous et nous sommes totalement satisfait prix, délais démarches .... 
Nous vous recommanderons très fortement et sans aucune réserve.
Encore merci a toute l’equipe de Fast & Retro…<br>
                    Dépt : 69
                    </p>
                </div>
                <div class="testimonial-bottom">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-line.png">
                    <p>Arnaud.F</p>
                </div>
            </div>
        </div>
        
        <div class="col-xs-12 sidebar-divider">
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
        </div>

        <div class="col-xs-12 col-lg-offset-1 col-lg-10 testimonial-one-parent">
            <div class="testimonial-one">
                <img class="testimonial-logo" src="{{ asset('/fe_assets') }}/img/testimonial-logo.png">
                <div class="testimonial-one-left">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-1.png">
                </div>
                <div class="testimonial-one-quote">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-quote.png">
                </div>
                <div class="testimonial-one-right">
                    <p>
C' est la premiere fois que j achete un vehicule chez Fast & Retro et je suis pleinement satisfait des prestations de votre societe.
C’est  les yeux fermés que je commanderai un autre vehicule chez vous .Pour nous il ete important que vous vous occupiez des demarches administratives.
Disponible ,prudent sur les informations delivrées quant aux options ou equipement d origine ,Alex est un intercoluteur fiable et surtout tres professionnel . Je sais a qui m adresser pour la prochaine!<br>
                    Dépt : 02
                    </p>
                </div>
                <div class="testimonial-bottom">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-line.png">
                    <p>Didier.L</p>
                </div>
            </div>
        </div>
        
        <div class="col-xs-12 sidebar-divider">
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
        </div>

        <div class="col-xs-12 col-lg-offset-1 col-lg-10 testimonial-one-parent">
            <div class="testimonial-one">
                <img class="testimonial-logo" src="{{ asset('/fe_assets') }}/img/testimonial-logo.png">
                <div class="testimonial-one-left">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-1.png">
                </div>
                <div class="testimonial-one-quote">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-quote.png">
                </div>
                <div class="testimonial-one-right">
                    <p>Par ce témoignage, je tiens à recommander Fast & Retro et surtout Alex.
Les points forts : gentillesse, disponibilité et réactivité.
Alex nous à accompagné de la commande à l'immatriculation finale de la voiture.
Aucun couac du début à la fin, la voiture est même arrivée plus tôt que prévue.
Et au final une voiture magnifique!! Encore merci a toute l’equipe…<br>
                    Dépt : 75
                    </p>
                </div>
                <div class="testimonial-bottom">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-line.png">
                    <p>Benjamin.P</p>
                </div>
            </div>
        </div>
        
        <div class="col-xs-12 sidebar-divider">
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
        </div>

        <div class="col-xs-12 col-lg-offset-1 col-lg-10 testimonial-one-parent">
            <div class="testimonial-one">
                <img class="testimonial-logo" src="{{ asset('/fe_assets') }}/img/testimonial-logo.png">
                <div class="testimonial-one-left">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-1.png">
                </div>
                <div class="testimonial-one-quote">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-quote.png">
                </div>
                <div class="testimonial-one-right">
                    <p>Juste impeccable avec Fast & Retro !!! comme beaucoup de monde j'ai eu du mal à me lancer sur un achat a distance mais je ne regrette pas du tout. En effet, tout c'est très bien passé, professionnalisme, respect des délais et livraison du véhicule conforme à ma commande. quelle gentillesse, disponibilité de toute l’equipe et qui s’occupe de tout les papiers, en un mot PARFAIT. Je  rachèterais certainement mon prochain véhicule chez vous. Merci<br>
                    Dépt : 62
                    </p>
                </div>
                <div class="testimonial-bottom">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-line.png">
                    <p>Loïc.A</p>
                </div>
            </div>
        </div>
        
        <div class="col-xs-12 sidebar-divider">
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
        </div>

        <div class="col-xs-12 col-lg-offset-1 col-lg-10 testimonial-one-parent">
            <div class="testimonial-one">
                <img class="testimonial-logo" src="{{ asset('/fe_assets') }}/img/testimonial-logo.png">
                <div class="testimonial-one-left">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-1.png">
                </div>
                <div class="testimonial-one-quote">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-quote.png">
                </div>
                <div class="testimonial-one-right">
                    <p>c'est la 3eme voiture que nous achetons chez vous, comme d'abitude, tout c'est passé sans probléme,réactivité,disponibilité vous etes des vrais professionels, je vous recommande vivement avec la gentillesse en plus.<br>
                    Dépt : 50
                    </p>
                </div>
                <div class="testimonial-bottom">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-line.png">
                    <p>Maurice.B</p>
                </div>
            </div>
        </div>
        
        <div class="col-xs-12 sidebar-divider">
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
        </div>

        <div class="col-xs-12 col-lg-offset-1 col-lg-10 testimonial-one-parent">
            <div class="testimonial-one">
                <img class="testimonial-logo" src="{{ asset('/fe_assets') }}/img/testimonial-logo.png">
                <div class="testimonial-one-left">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-1.png">
                </div>
                <div class="testimonial-one-quote">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-quote.png">
                </div>
                <div class="testimonial-one-right">
                    <p>Voiture livré sans aucun problème du début de la transaction jusque la fin.sérieux ,efficace et toujours a notre disposition pour le suivi et toutes les questions que l'on peu se poser .je recommande vivement.<br>
                    Dépt : 04
                    </p>
                </div>
                <div class="testimonial-bottom">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-line.png">
                    <p>Thierry. M</p>
                </div>
            </div>
        </div>
        
        <div class="col-xs-12 sidebar-divider">
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
        </div>

        <div class="col-xs-12 col-lg-offset-1 col-lg-10 testimonial-one-parent">
            <div class="testimonial-one">
                <img class="testimonial-logo" src="{{ asset('/fe_assets') }}/img/testimonial-logo.png">
                <div class="testimonial-one-left">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-1.png">
                </div>
                <div class="testimonial-one-quote">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-quote.png">
                </div>
                <div class="testimonial-one-right">
                    <p>Nous avons trouvé Fast & Retro par hasard sur internet. Toute l’equipe à vraiment été à l'écoute et disponible lors de la commande de notre véhicule. Voiture reçue dans les délais et conforme à la commande, prix défiant toute concurrence. Ravi de notre acquisition.et merci pour le professionnalisme de cette jeune equipe...<br>
                    Dépt : 92
                    </p>
                </div>
                <div class="testimonial-bottom">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-line.png">
                    <p>Michel.A</p>
                </div>
            </div>
        </div>
        
        <div class="col-xs-12 sidebar-divider">
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
        </div>

        <div class="col-xs-12 col-lg-offset-1 col-lg-10 testimonial-one-parent">
            <div class="testimonial-one">
                <img class="testimonial-logo" src="{{ asset('/fe_assets') }}/img/testimonial-logo.png">
                <div class="testimonial-one-left">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-1.png">
                </div>
                <div class="testimonial-one-quote">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-quote.png">
                </div>
                <div class="testimonial-one-right">
                    <p>Sans connaissance particuliere nous avons choisi Fast & Retro au hasard,pour la recherche de notre véhicule et aujourd'hui je peux dire que nous avons fait le bon choix sérieux, avenant, tres professionnel, a l'ecoute et je dirai meme avec une pointe d'amitié.
En ce qui me concerne le transport et l’importation tout c’est super bien passe. 
a recommander<br>
merci encore pour tout<br>
                    Dépt : 34
                    </p>
                </div>
                <div class="testimonial-bottom">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-line.png">
                    <p>Stephane et Marie.O</p>
                </div>
            </div>
        </div>
        
        <div class="col-xs-12 sidebar-divider">
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
        </div>

        <div class="col-xs-12 col-lg-offset-1 col-lg-10 testimonial-one-parent">
            <div class="testimonial-one">
                <img class="testimonial-logo" src="{{ asset('/fe_assets') }}/img/testimonial-logo.png">
                <div class="testimonial-one-left">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-1.png">
                </div>
                <div class="testimonial-one-quote">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-quote.png">
                </div>
                <div class="testimonial-one-right">
                    <p>J'ai connu la société Fast & Retro par hasard en consultant des annonces automobiles. Dès le premier contact, Alex m'est apparu très sympathique, sérieux et surtout professionnel. Rien n'était laissé au hasard et le déroulement de la transaction m'a été présenté en toute transparence. 
L'avantage c'est que Alex connaît parfaitement toutes les démarches à effectuer avant et après l'acquisition de l'automobile donc vous n'avez plus qu'à vous laisser guider, ce qui simplifie les démarches administratives.
Au final j'ai bien recu ma cadillad Eldorado ☺ Je suis ravie de cette transaction et je tiens à remercier toute l’equipe. A recommander très fortement et sans aucune réserve <br>
                    Dépt : 91
                    </p>
                </div>
                <div class="testimonial-bottom">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-line.png">
                    <p>Sabrina.F</p>
                </div>
            </div>
        </div>
        
        <div class="col-xs-12 sidebar-divider">
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
        </div>

        <div class="col-xs-12 col-lg-offset-1 col-lg-10 testimonial-one-parent">
            <div class="testimonial-one">
                <img class="testimonial-logo" src="{{ asset('/fe_assets') }}/img/testimonial-logo.png">
                <div class="testimonial-one-left">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-1.png">
                </div>
                <div class="testimonial-one-quote">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-quote.png">
                </div>
                <div class="testimonial-one-right">
                    <p>Très professionnel et sans soucis administratifs
Je vous remercie encore.
<br>
                    Dépt : 67
                    </p>
                </div>
                <div class="testimonial-bottom">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-line.png">
                    <p>Guilain.M</p>
                </div>
            </div>
        </div>
        
        <div class="col-xs-12 sidebar-divider">
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
        </div>

        <div class="col-xs-12 col-lg-offset-1 col-lg-10 testimonial-one-parent">
            <div class="testimonial-one">
                <img class="testimonial-logo" src="{{ asset('/fe_assets') }}/img/testimonial-logo.png">
                <div class="testimonial-one-left">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-1.png">
                </div>
                <div class="testimonial-one-quote">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-quote.png">
                </div>
                <div class="testimonial-one-right">
                    <p>Nous venons de recevoir notre voiture apres quelques annees de recherches et nous tenons à vous féliciter pour votre grande expérience, votre accueil chaleureux, toujours à l'écoute de nos préoccupations et de nos besoins, vous avez rempli complètement votre fonction et bien au-delà de ce que peuvent espérer vos clients. Le service est irréprochable . Nous ne pouvons que recommander vos services. Notre belle Lincoln nous donne entière satisfaction et correspond à notre demande à un prix très avantageux. Le délai de livraison a été respecté ! quel bonheur d'avoir eu affaire à vous d'une si grande qualité ! nous n'hésitons pas une seconde à vous recommander à tous les clients potentiels... et à revenir vous voir dans quelques années... un grand merci !!! <br>
                    Dépt : 80
                    </p>
                </div>
                <div class="testimonial-bottom">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-line.png">
                    <p>Jean-Marie.G</p>
                </div>
            </div>
        </div>
        
        <div class="col-xs-12 sidebar-divider">
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
        </div>

        <div class="col-xs-12 col-lg-offset-1 col-lg-10 testimonial-one-parent">
            <div class="testimonial-one">
                <img class="testimonial-logo" src="{{ asset('/fe_assets') }}/img/testimonial-logo.png">
                <div class="testimonial-one-left">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-1.png">
                </div>
                <div class="testimonial-one-quote">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-quote.png">
                </div>
                <div class="testimonial-one-right">
                    <p>Mon mari et moi étions un peu sceptiques à passer par vous au debut. Vous nous avez mis en confiance et vous nous avez accompagné dans toutes les démarches. Nous vous recommanderons autour de nous et vous souhaitons bonne continuation .Merci mille fois.. <br>
                    Dépt : 80
                    </p>
                </div>
                <div class="testimonial-bottom">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-line.png">
                    <p>Christine et Serge.F</p>
                </div>
            </div>
        </div>
        
        <div class="col-xs-12 sidebar-divider">
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
        </div>

        <div class="col-xs-12 col-lg-offset-1 col-lg-10 testimonial-one-parent">
            <div class="testimonial-one">
                <img class="testimonial-logo" src="{{ asset('/fe_assets') }}/img/testimonial-logo.png">
                <div class="testimonial-one-left">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-1.png">
                </div>
                <div class="testimonial-one-quote">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-quote.png">
                </div>
                <div class="testimonial-one-right">
                    <p>IMPECCABLE.
Les démarches sont facilitées, claires.Accueil parfait.A conseiller les yeux fermés.
Vraiment satisfaite du service de votre entreprise.
 <br>
                    Dépt : 34
                    </p>
                </div>
                <div class="testimonial-bottom">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-line.png">
                    <p>Sophie et Jerome.Z</p>
                </div>
            </div>
        </div>
        
        <div class="col-xs-12 sidebar-divider">
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
        </div>

        <div class="col-xs-12 col-lg-offset-1 col-lg-10 testimonial-one-parent">
            <div class="testimonial-one">
                <img class="testimonial-logo" src="{{ asset('/fe_assets') }}/img/testimonial-logo.png">
                <div class="testimonial-one-left">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-1.png">
                </div>
                <div class="testimonial-one-quote">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-quote.png">
                </div>
                <div class="testimonial-one-right">
                    <p>Alex un professionnel qui a été à notre écoute et qui a su nous conseiller lors de l'acquisition de notre Pontiac. Il se charge de toutes les formalités administratives. Le véhicule prévu 1ère quinzaine de juin est même arrivé avec un deux semaines d'avance. Tout s'est passé pour le mieux lors de la dernière étape : l'immatriculation avec la FFVE.
A ce jour, les plaques définitives ont même été posées. 
Pour ceux qui gardent en mémoire des mésaventures avec certaines societies ou de mauvais échos, vous pouvez y aller en toute confiance. C'est un ami qui nous a conseillé Fast & Retro et nous en sommes pleinement satisfaits. Nous n'hésiterons pas à y retourner au prochain changement de véhicule et à parler autour de nous. <br>
                    Dépt : 06
                    </p>
                </div>
                <div class="testimonial-bottom">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-line.png">
                    <p>MARC.A</p>
                </div>
            </div>
        </div>
        
        <div class="col-xs-12 sidebar-divider">
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
        </div>

        <div class="col-xs-12 col-lg-offset-1 col-lg-10 testimonial-one-parent">
            <div class="testimonial-one">
                <img class="testimonial-logo" src="{{ asset('/fe_assets') }}/img/testimonial-logo.png">
                <div class="testimonial-one-left">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-1.png">
                </div>
                <div class="testimonial-one-quote">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-quote.png">
                </div>
                <div class="testimonial-one-right">
                    <p>bonjour je viens tout juste de recuperer ma Ford T ! je tenais a vous remercier c'etait la premiere fois que je passais par vous et sincerement dorenavant le jour ou je changerai de voiture j'irai les yeux fermes chez vous ! la voiture est nickel, vos services exceptionnels, vous avez realise mon reve de gosse. Encore merci a toute votre equipe.<br>
                    Dépt : 27
                    </p>
                </div>
                <div class="testimonial-bottom">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-line.png">
                    <p>Gilles.S </p>
                </div>
            </div>
        </div>
        
        <div class="col-xs-12 sidebar-divider">
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
        </div>

        <div class="col-xs-12 col-lg-offset-1 col-lg-10 testimonial-one-parent">
            <div class="testimonial-one">
                <img class="testimonial-logo" src="{{ asset('/fe_assets') }}/img/testimonial-logo.png">
                <div class="testimonial-one-left">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-1.png">
                </div>
                <div class="testimonial-one-quote">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-quote.png">
                </div>
                <div class="testimonial-one-right">
                    <p>Les conditions de vente étaient claires et cohérentes d'un point de vue juridique.
Après avoir essayé plusieurs véhicules en concession en France, j'ai fait mon choix. J'ai demandé à Fast & Retro de rechercher le modèle que je souhaitais en stock car j'avais un besoin rapide de véhicule.
Ce dernier m'a proposé rapidement plusieurs véhicules au début du mois de mars.
Il m'a assuré que la livraison pourrait se faire sous 15 jours trois semaines.
En effet, la livraison s'est très bien passée en Belgique sous quinzaine.
J'ai procédé aux formalités en France sans aucun soucis en suivant les prescriptions de Sandra.
Encore merci.<br>
                    Dépt : 01
                    </p>
                </div>
                <div class="testimonial-bottom">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-line.png">
                    <p>Aude et Charles.L</p>
                </div>
            </div>
        </div>
        
        <div class="col-xs-12 sidebar-divider">
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
        </div>

        <div class="col-xs-12 col-lg-offset-1 col-lg-10 testimonial-one-parent">
            <div class="testimonial-one">
                <img class="testimonial-logo" src="{{ asset('/fe_assets') }}/img/testimonial-logo.png">
                <div class="testimonial-one-left">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-1.png">
                </div>
                <div class="testimonial-one-quote">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-quote.png">
                </div>
                <div class="testimonial-one-right">
                    <p>2 ème achat en 3 ans .Réussite totale !
une fois de plus . Tarifs imbattables et engagement professionnel et personnel total , de la commande à la livraison . 
Je tenais a vous remercier du fond du coeur, c’est dur de trouver une societe comme la votre de nos jours. J’ai recu ma corvette rouge et elle est magnifique. Elle est encore plus belle en vrai que sur les photos. Inspection nickel de la voiture, vraiemnt rien a dire. Pour les prochaines j’achete chez vous! Merci a toute l’equipe qui a fait son travail a la perfection..Serge<br>
                    Dépt : 75
                    </p>
                </div>
                <div class="testimonial-bottom">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-line.png">
                    <p>Serge.V</p>
                </div>
            </div>
        </div>
        
        <div class="col-xs-12 sidebar-divider">
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
            <i class="fa fa-star" aria-hidden="true"></i>
        </div>

        <div class="col-xs-12 col-lg-offset-1 col-lg-10 testimonial-one-parent">
            <div class="testimonial-one">
                <img class="testimonial-logo" src="{{ asset('/fe_assets') }}/img/testimonial-logo.png">
                <div class="testimonial-one-left">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-1.png">
                </div>
                <div class="testimonial-one-quote">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-quote.png">
                </div>
                <div class="testimonial-one-right">
                    <p>C'est la première fois que j'achète un véhicule americain. A l'origine je voulais une neuve et je me suis rendu compte que sur les americaines j’allais gagner de l’argent a la revente.
Franchement je ne sais pas quoi dire, on vient de recevoir notre voiture et elle est tout simplement magnifique.Tout c’est tres bien passe , et elle roule ☺
Je penserai à vous pour ma prochaine commande.Merci a tous…<br>
                    Dépt : 95
                    </p>
                </div>
                <div class="testimonial-bottom">
                    <img src="{{ asset('/fe_assets') }}/img/testimonial-line.png">
                    <p>Francois.P</p>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-lg-offset-1 col-lg-10 pagenumber">
            <div class="pagenumber-child">
                <a href="#" class="pagenumber-active">1</a>
                <a href="#">2</a>
                <a href="#">3</a>
                <a href="#">4</a>
                <a href="#">5</a>
                <a href="#">6</a>
                <a href="#">7</a>
                <a href="#">8</a>
                <a href="#" class="pagenumber-right"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
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