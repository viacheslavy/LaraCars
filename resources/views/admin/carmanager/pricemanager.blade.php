@extends('admin._layout.main')

@section('content')
	<div class="right_col" role="main">
		<div class="">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Gestionnaire de prix</h2>
						<ul class="nav navbar-right panel_toolbox"></ul>
						<div class="clearfix"></div>
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
					<div class="col-xs-12 col-sm-3  pull-left">
						<div>
							<a href="{{ url('cpanel/price/addprice') }}" class="btn btn-primary">Créer une règle de prix</a>
						</div>
					</div>
					@if(!empty($pricerules))          
						<table class="table table-bordered" id="priceList">
							<thead>
								<tr>
									<th>Prix plancher</th>
									<th>Prix plafond</th>
									<th>Prix</th>
									<th>Pourcentage</th>
									<th>Site</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($pricerules as $pricerule)
									<tr>
										<td>{{$pricerule->start_price}}</td>
										<td>{{$pricerule->end_price}}</td>
										<td>{{$pricerule->price}}</td>
										<td>{{$pricerule->percentage}}%</td>
										<td>{{$pricerule->site}}</td>
										<td>
											<a href="{{ url('cpanel/price/editprice', $pricerule->id) }}" type="button" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Modifier</a>
											@if($pricerule->default_rule == 0) <a type="button" onClick="return confirm('Etes-vous sûr ?')" href="{{ url('cpanel/price/deleteprice', $pricerule->id) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash" aria-hidden="true"></i> Supprimer</a> @else Par défaut @endif    
										</td>
									</tr>
								@endforeach  
							</tbody>
						</table>
					@endif    
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<script>
		$(document).ready(function(){
			$('#priceList').DataTable({
				"pageLength": 9,
				"bLengthChange": false,
				"columnDefs": [{ "orderable": false, "targets": 0, }],
				"oLanguage": {
					"sSearch": "Rechercher",
					"oPaginate": { "sPrevious": "Précédent", "sNext": "Suivant", },
					// "sInfo": "Montrant _START_ to _END_ of _TOTAL_ enregistrements",
					"sInfo": "Montrant _START_ sur les _TOTAL_ enregistrements",
				}
			});
		});
	</script>
@endsection