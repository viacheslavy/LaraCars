@extends('admin._layout.main')

@section('content')

<div class="right_col" role="main">
        <div class="page-title">
            <div class="title_left">
                <h3>Users Manager</h3>
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
                    <a href="{{ route('get.createAdminUser') }}" class="btn btn-primary">Add User</a>
                </div>
            </div>
	        <table class="table table-bordered" id="makeList">
			    <thead>
			      <tr>
			        <th>Name</th>
			        <th>Email</th>
			        <th>Phone</th>
			        <th></th>
			      </tr>
			    </thead>
			    <tbody>
			    @if(!$users->isEmpty())
				    @foreach ($users as $user)
				      <tr>
				        <td>{{ $user->name }}</td>
				        <td>{{ $user->email }}</td>
				        <td>{{ $user->phone }}</td>				 
				        <td><a href="{{ route('get.editUserAdmin', $user->id) }}" type="button" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
	                        <a type="button" onClick="return confirm('Are you sure?')" href="{{ route('get.deleteUserAdmin', $user->id) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash" aria-hidden="true"></i> Delete </a></td>
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
            $('#makeList').DataTable({
                "pageLength": 9,
                "bLengthChange": false,
                "columnDefs": [
                    { "orderable": false, "targets": 0 }
                ]
            });
        });
    </script>

@endsection