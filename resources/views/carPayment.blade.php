@extends('layouts.app')
	
@section('content')
	<div class="container-fluid page-head-parent">
		<div class="container">
			<div class="col-xs-12 col-lg-offset-1 col-lg-10 page-head text-center">
				<h1>Réserver votre voiture</h1>
				<hr>
			</div>
		</div>
	</div>
	<div class="container-fluid page-contact">
		<div class="container">
			<div class="col-xs-2 col-sm-2 col-md-2"></div>
			<div class="col-xs-8 col-sm-8 col-md-8">
				<div class="sidebar-divider">
					<i class="fa fa-star" aria-hidden="true"></i>
					<i class="fa fa-star" aria-hidden="true"></i>
					<i class="fa fa-star" aria-hidden="true"></i>
					<i class="fa fa-star" aria-hidden="true"></i>
					<i class="fa fa-star" aria-hidden="true"></i>
				</div>
				<div class="contact-form">
					@if(Session::has('message'))
						<div class="alert alert-success">
							{{ Session::get('message') }}
						</div>
					@endif
					<form action="{{ route('get.car.reserve', $car->id) }}" class="form-horizontal allForms" method="post" data-parsley-validate novalidate>
						{{ csrf_field() }}
						<fieldset>
							<div class="col-xs-12 contact-c-inputs">
								<div class="form-group">
									<input id="name" name="firstname" type="text" class="form-control" placeholder="Nom *" data-parsley-required-message="Nom obligatoire" data-parsley-trigger="change focusout" required="" value="{{old('firstname')}}">
								</div>
								<div class="form-group">
									<input id="lname" name="lastname" type="text" class="form-control" placeholder="Pr&eacute;nom*" data-parsley-required-message="Prenom obligatoire" data-parsley-trigger="change focusout" required="" value="{{old('lastname')}}">
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-success">Réserver</button>
									<a class="btn btn-default" href="{{url('/product/' . $id)}}">Annuler</a>
								</div>
							</div>
						</fieldset>
					</form>
				</div>
			</div>
			<div class="col-xs-2 col-sm-2 col-md-2"></div>
		</div>
	</div>
	<div class="container-fluid contact-ftr"></div>
@endsection