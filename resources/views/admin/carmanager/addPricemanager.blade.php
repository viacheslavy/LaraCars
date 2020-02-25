@extends('admin._layout.main')

@section('content')
	<!-- <link href="{{ asset('admin_assets/css/custom.css') }}" rel="stylesheet"> -->
	<style type="text/css">
		.load-modal{display: none;position: fixed;z-index: 1000;top: 0;left: 0;height: 100%;width: 100%;background: rgba( 255, 255, 255, .8 ) url('{{asset('/images/loader.gif')}}') 50% 50%  no-repeat;}
		body.loading{overflow: hidden;}
		body.loading .load-modal{display: block;}
		.errorlabel{ color: red;}
		.successlabel{color: #32CD32;}
		.modal-resize{width: 375px;margin: 100px auto;}
	</style>
	<div class="modal" id="ajax-loading"><!-- jquery loader --></div>
	<div class="right_col" role="main">
		<div class="">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Gestionnaire de prix</h2>
						<ul class="nav navbar-right panel_toolbox"></ul>
						<div class="clearfix"></div>
						@if(count($errors) > 0)
							<div class="alert alert-danger alert-dismissable">
								<button type = "button" class = "close" data-dismiss = "alert" aria-hidden = "true">&times;</button>
								<ul>@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach</ul>
							</div>
						@endif
						@if(Session::has('error'))
							<div class="alert alert-danger alert-dismissible">
								<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button> {{ Session::get('error') }}
							</div>
						@endif
						@if(Session::has('message'))
							<div class="alert alert-success alert-dismissible">
								<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button> {{ Session::get('message') }}
							</div>
						@endif
					</div>
					<div class="x_content">
						{{ Form::open(array('url' => 'cpanel/price/addprice', 'id' => "formvalidate", 'method' => 'post', 'class' => 'form-horizontal form-label-left', )) }}
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Prix plancher <span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									{{Form::number('start_price', null, array( 'class' => 'form-control col-md-7 col-xs-12', "required" => ""))}}
								</div>
							</div>
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Prix plafond <span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									{{Form::number('end_price', null, array( 'class' => 'form-control col-md-7 col-xs-12', "required" => "",))}}
								</div>
							</div>
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Pourcentage<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									{{Form::number('percentage', null, array( 'class' => 'form-control col-md-7 col-xs-12', 'id' => "reqPercent", "required" => "", 'min' => 0, 'max' => 100, 'step' => "0.01", ))}}
								</div>
							</div>
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Prix<span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									{{Form::number('price', 0, array( "required" => "", 'class' => 'form-control col-md-7 col-xs-12', 'id' => "reqPrice", 'min' => 0,))}}
								</div>
							</div>
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">Site <span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									{{Form::select('site', ["all" => "All", "ebay" => "Ebay", "carsforsale" => "Carsforsale", "hemmings" => "Hemmings", "gatewayclassiccar" => "GatewayClassicCars"], null, ["class" => "form-control col-md- col-xs-12", "id" => "site"])}}
								</div>
							</div>
							<div class="item form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">Règle par défaut <span class="required">*</span></label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									{{Form::select('default_rule', ["0" => "Désactivée", "1" => "Activée",], null, ["class" => "form-control col-md- col-xs-12", "id" => "defaultRule"])}}
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-6 col-md-offset-3">
									<button id="send" type="submit" class="btn btn-success">Créer</button>
									<a href="{{ url('cpanel/price/pricemanager') }}" class="btn btn-primary" type="reset">Annuler</a>
								</div>
							</div>
						{{ Form::close() }}
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
		<div class="modal-dialog modal-resize1" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title errorlabel" id="exampleModalLabel"></h5>
				</div>
				<div class="modal-body">
					<h4>Etes-vous sûr de vouloir remettre les règles par défaut ?</h4>
				</div>
				<div class="modal-footer">
					<button type="button" id="closebtn" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
					<button type="button" id="resend" class="btn btn-primary">OK</button>
				</div>
			</div>
		</div>
	</div>
	<div class="load-modal" id="ajax-loading"></div>
@endsection

@section('scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.1/jquery.validate.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.1/additional-methods.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.1/localization/messages_fr.js"></script>
	<script>
		$('#myModal').modal({ show: false, });
		$body = $("body");
		$('#defaultRule').change(function(){
			if($('#defaultRule').val() == 1){
				$body.addClass("loading");
				$.ajax({
					url: "{{url('cpanel/price/defaultrule')}}",
					type: 'GET',
					success: function(res){
						$body.removeClass("loading");
						if(res != 'notexists'){
							$('#myModal').modal({ show: true, backdrop: 'static', keyboard: false, });
						}
					},
					error: function(error){
						$("#defaultRule").val(0);
						$body.removeClass("loading");
						alert("Quelque chose s'est mal passée !");
					},
				});    
			}
		});
		$("#resend").click(function(){ $('#myModal').modal('hide'); });
		$("#closebtn").click(function(){ $("#defaultRule").val(0); });
	</script>
@endsection