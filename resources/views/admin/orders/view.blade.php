@extends('admin._layout.main')

@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Aperçu de la commande</h3>
                @if ($errors->any())
                    <ul class="alert alert-danger">
                         @foreach($errors->all() as $error)
                            <li style="list-style:none;">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        Détail de la commande
                    </div>
                    <div class="x_content">
    	    			<form class="form-horizontal">
                            @if($order->occupation_type)
                                <div class="form-group">
                                    <label class="col-md-2">Type d'occupation</label>
                                    <div class="col-md-6">
                                        @if($order->occupation_type == 'particular') Particulier
                                        @else Professionnel    
                                        @endif
                                    </div>
                                </div>
                            @endif
                            <div class="form-group">
                                <label class="col-md-2">Prénom</label>
                                <div class="col-md-6">{{ $order->name }}</div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2">Nom de famille</label>
                                <div class="col-md-6">{{ $order->family_name }}</div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2">Email</label>
                                <div class="col-md-6">{{ $order->email }}</div>
                            </div>
                            @if($order->address)
                                <div class="form-group">
                                    <label class="col-md-2">Adresse</label>
                                    <div class="col-md-6">{{ $order->address }}</div>
                                </div>
                            @endif
                            @if($order->amount)
                                <div class="form-group">
                                    <label class="col-md-2">Accompte</label>
                                    <div class="col-md-6">{{ $order->amount }} $</div>
                                </div>
                            @endif
                            @if($order->civility)
                                <div class="form-group">
                                    <label class="col-md-2">Civilité</label>
                                    <div class="col-md-6">{{ $order->civility }}</div>
                                </div>
                            @endif
                            @if($order->additional_address)
                                <div class="form-group">
                                    <label class="col-md-2">Complément d’adresse</label>
                                    <div class="col-md-6">{{ $order->additional_address }}</div>
                                </div>
                            @endif
                            @if($order->city)
                                <div class="form-group">
                                    <label class="col-md-2">Ville</label>
                                    <div class="col-md-6">{{ $order->city }}</div>
                                </div>
                            @endif
                            <!-- @if($order->card_user)
                                <div class="form-group">
                                    <label class="col-md-2">Card user</label>
                                    <div class="col-md-6">{{ $order->card_user }}</div>
                                </div>
                            @endif -->
                            <div class="form-group">
                                <label class="col-md-2">Code postal</label>
                                <div class="col-md-6">{{ $order->zip_code }}</div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2">Numéro de téléphone</label>
                                <div class="col-md-6">{{ $order->phone }}</div>
                            </div>
                            @if($order->phone_fixed)
                                <div class="form-group">
                                    <label class="col-md-2">Téléphone fixe</label>
                                    <div class="col-md-6">{{ $order->phone_fixed }}</div>
                                </div>
                            @endif
                            @if($order->building)
                                <div class="form-group">
                                    <label class="col-md-2">Bâtiment</label>
                                    <div class="col-md-6">{{ $order->building }}</div>
                                </div>
                            @endif
                            @if($order->staircase)
                                <div class="form-group">
                                    <label class="col-md-2">Escalier</label>
                                    <div class="col-md-6">{{ $order->staircase }}</div>
                                </div>
                            @endif
                            @if($order->floor)
                                <div class="form-group">
                                    <label class="col-md-2">&Egrave;tage</label>
                                    <div class="col-md-6">{{ $order->floor }}</div>
                                </div>
                            @endif
                            @if($order->door)
                                <div class="form-group">
                                    <label class="col-md-2">Porte</label>
                                    <div class="col-md-6">{{ $order->door }}</div>
                                </div>
                            @endif
                            @if($order->car_id)
                                <div class="form-group">
                                    <label class="col-md-2">Titre</label>
                                    <div class="col-md-6"> @if($order->car) {{ $order->car->title }} @endif</div>
                                </div>
                            @endif
                            <div class="form-group">
                                <label class="col-md-2">Type de carte</label>
                                <div class="col-md-6">{{ $order->card_name }}</div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2">Numero de carte</label>
                                <div class="col-md-6">**********{{ $order->card }}</div>
                            </div>
                            @if($order->type)
                                <div class="form-group">
                                    <label class="col-md-2">Type de paiement</label>
                                    <div class="col-md-6">{{ $order->type }}</div>
                                </div>
                            @endif
                            <!-- <div class="form-group">
                                <label class="col-md-3">Mois / Année</label>
                                <div class="col-md-6">{{ $order->month_year }}</div>
                            </div> -->
                            <div class="form-group">
                                <div class="col-md-3">
                                    <a href="{{ url('/cpanel/orders') }}" class="btn btn-primary" type="reset">Revenir</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- /page content -->
@endsection