<form id="subscribeForm" action="{{ route('post.add.customer') }}" class="form-horizontal allForms" method="post" data-parsley-validate="">
    {{ csrf_field() }}
    <fieldset>
        <div class="col-xs-12 col-md-offset-2 col-md-8 contact-c-inputs">
            <div class="form-group">
                <p>1. Entrez votre Email</p>
                <input id="email" name="email" type="text" class="form-control" data-parsley-required-message="E-mail obligatoire" data-parsley-trigger="change focusout" required="" data-parsley-type="email">
            </div>
            <!--
                                                <div class="form-group">
                                                    <p>2. Entrez votre mot de passe</p>
                                                    <input id="lname" name="lname" type="text" class="form-control">
                                                </div>
            -->
            <div class="form-group">
                <p>2. Nom et pr&eacute;nom</p>
                <input id="name" name="name" type="text" class="form-control" data-parsley-required-message="Nom obligatoire" data-parsley-trigger="change focusout" required="">
            </div>
            <!--
                                                <div class="form-group">
                                                    <p>4. Re-entrez votre mot de passe</p>
                                                    <input id="lname" name="lname" type="text" class="form-control">
                                                </div>
            -->

            <div class="form-group btn-wrap">
                <button id="contactSubmit" type="submit" class="btn btncta">Envoyer</button>
            </div>
        </div>
    </fieldset>
</form>

<div id="subscribeModalAlert" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><img src="{{ asset('fe_assets/img/closewindows.png') }}"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-success">
                    <p>Merci de vous etre abonne</p>
                </div>
            </div>
        </div>

    </div>
</div>