@extends('admin._layout.main')

@section('content')

	<div class="right_col" role="main">
        <div class="page-title">
            <div class="title_left">
                <h3>Make Manager</h3>
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
                    <a href="{{ route('get.newmakes.cars') }}" class="btn btn-primary">New Make</a>
                </div>
            </div>
	        <table class="table table-bordered" id="makeList">
			    <thead>
			      <tr>
			        <th>Name</th>
			        <th>Statut</th>
			        <th></th>
			      </tr>
			    </thead>
			    <tbody>
			    @foreach ($makedetails as $make)
			      <tr>
			        <td>{{ $make->name }}</td>
			        <td>{{ $make->status }}</td>
			        <td><a href="{{ route('get.editmakes.cars', $make->id) }}" type="button" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Modifier</a>
                        <a type="button" onClick="return confirm('Are you sure?')" href="{{ route('get.deleteMake.cars', $make->id) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash" aria-hidden="true"></i> Supprimer </a></td>
			      </tr>
			    @endforeach  
			    </tbody>
		    </table>
		</div>    
	</div>		                
              

@endsection

@section('scripts')

<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function(){
            $('#makeList').DataTable({
                "pageLength": 9,
                "bLengthChange": false,
                "columnDefs": [
                    { "orderable": false, "targets": 2 }
                ],
                "oLanguage": {
                "sSearch": "Rechercher",
                "oPaginate": {
                    "sPrevious": "Précédent",
                    "sNext": "Suivant",
                },
                // "sInfo": "Montrant _START_ to _END_ of _TOTAL_ enregistrements",
                "sInfo": "Montrant _START_ sur les _TOTAL_ enregistrements",
            	}
            });
        });
    </script>

@endsection    