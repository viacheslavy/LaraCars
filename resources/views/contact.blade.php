@extends('layouts.app')

@section('slider')
    {{--<div class="container-fluid underheader text-center">--}}
        {{--<div class="container">--}}
            {{--<img src="{{ asset('fe_assets') }}/img/page-contact-bigpic.png" class="img-responsive">--}}
        {{--</div>--}}
    {{--</div>--}}
@endsection

@section('content')

<div class="container-fluid page-head-parent">
    <div class="container">
        <div class="col-xs-12 col-lg-offset-1 col-lg-10 page-head">
            <p>CONTACTEZ NOUS</p>
            <hr>
        </div>
    </div>
</div>

<div class="container-fluid page-contact">
    <div class="container">
        <div class="col-xs-12 col-lg-offset-1 col-lg-10">
            <div class="col-xs-12 page-contact-head">
                <h2>Contactez nous par mail en remplissant ce formulaire, ou par t&eacute;l&eacute;phone au <span>+33 1 80 89 45 45</span></h2>
            </div>
            <div class="col-xs-12 col-sm-7 col-md-8 contact-content">
                <div class="sidebar-divider">
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                </div>
                <p>Vous avez besoin d'un conseil, d'une estimation, d'informations complémentaires sur un véhicule ou vous êtes à la recherche d’un modèle bien précis ? En tant que passionnés de véhicules de collection et de voitures américaines, nous serons heureux de traiter votre demande dans les meilleurs délais.</p>

                <div class="contact-form">

                    @if(Session::has('message'))
                        <div class="alert alert-success">
                            {{ Session::get('message') }}
                        </div>
                    @endif

                    <form action="{{ route('post.send.mail') }}" class="form-horizontal allForms" onsubmit="checkCaptcha()" id="checkCaptcha" method="post" data-parsley-validate novalidate>
                        {{ csrf_field() }}
                        <fieldset>
                            <div class="col-xs-12 contact-c-inputs">
                                <div class="form-group">
                                    <input type="hidden" name="isAdd" value="false">
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
                                    <input type="hidden" name="captcha" id="recaptcha" value="">
                                    <div class="g-recaptcha" data-sitekey="6LexhBQUAAAAAAlcYzCUWn9bivnPg8rCvgd8RD-m" data-callback="correctCaptcha"></div>
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
            <!-- <div class="col-xs-12 col-sm-5 col-md-4 contact-sidebar">
                <a href="#">showrooms</a>
                <img src="{{ asset('/fe_assets') }}/img/contact-car.png">
                <p><strong>Etats Unis</strong> <br>9903 Santa Monica Blvd
                    <br>Beverly Hills , CA, 90212<br><span>310-400-2073</span>
                </p>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3305.151696198424!2d-118.41407008478463!3d34.06562538060226!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2bbf5fbf841d9%3A0x74272aeed8dcec60!2s9903+Santa+Monica+Blvd%2C+Beverly+Hills%2C+CA+90212!5e0!3m2!1sen!2s!4v1477749571255" width="100%" height="130" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div> -->
        </div>
    </div>
</div>

<div class="container-fluid contact-ftr"></div>
@endsection
@section('fotterjs')
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script>
        var correctCaptcha = function(res){
            document.getElementById("recaptcha").value = res;
        }
        function checkCaptcha(){
            var val = document.getElementById("recaptcha").value;
            if(val && val != undefined){
                return true;
            }else{
                alert('Veuillez sélectionner captcha');
                event.preventDefault();
            } 
        }
    </script>
@endsection