@extends('admin._layout.main')

@section('content')
	<div class="right_col" role="main">
		<div class="page-title">
			<div class="title_left">
				<h3>Contacts</h3>
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
			<div class="col-xs-12 col-sm-3  pull-left">
				<div>
					<a href="{{ route('get.contact_export') }}" class="btn btn-primary">Export</a>
				</div>
			</div>
			<table class="table table-bordered" id="contactsList">
				<thead>
					<tr>
						<th>Email</th>
						<th>Ip</th>
						<th>Location</th>
						<th>DateTime</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@if(!$contacts->isEmpty())
						@foreach ($contacts as $contact)
							<tr>
								<td>{{ $contact->email }}</td>
								<td>{{ $contact->ip }}</td>
								<td>{{ $contact->address }}</td>
								<td>{{ date('Y-m-d H:i:s', strtotime($contact->created_at)) }}</td>
								<td>
									<a type="button" onClick="return confirm('Are you sure?')" href="{{ route('get.delete_contact', $contact->id) }}" class="btn btn-danger btn-xs">
										<i class="fa fa-trash" aria-hidden="true"></i> Supprimer
									</a>
								</td>
							</tr>
						@endforeach
					@endif
				</tbody>
			</table>
		</div>
	</div>
@endsection

@section('scripts')
	<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<script>
		$(document).ready(function(){
			$('#contactsList').DataTable({
				pageLength: 100,
				bLengthChange: false,
				order: [[ 3, "desc" ]],
				columnDefs: [{
					orderable: false,
					targets: 4,
				}],
				oLanguage: {
					"oPaginate": {
						sPrevious: "Précédent",
						sNext: "Suivant",
					},
					sInfo: "Montrant _START_ sur les _TOTAL_ enregistrements",
				}
			});
		});
	</script>
@endsection