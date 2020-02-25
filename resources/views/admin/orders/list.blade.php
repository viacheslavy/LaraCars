@extends('admin._layout.main')

@section('content')
	<div class="right_col" role="main">
	    <div class="page-title">
	        <div class="title_left">
	            <h3>Commandes</h3>
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
	        <table class="table table-bordered" id="ordersList">
			    <thead>
			      <tr>
			        <th>Nom</th>
			        <th>Email</th>
			        <th>Adresse</th>
			        <th>Type</th>
			        <th></th>
			      </tr>
			    </thead>
			    <tbody>
			    @if(!$orders->isEmpty())
				    @foreach ($orders as $order)
				      <tr>
				        <td>{{ $order->name }}</td>
				        <td>{{ $order->email }}</td>
				        <td>{{ $order->address }}</td>
				        <td>{{ $order->type }}</td>				 
				        <td><a href="{{ url('/cpanel/orders/view', ['id' => $order->id]) }}" type="button" class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> VOIR</a>
	                        <a type="button" onClick="return confirm('Are you sure?')" href="{{ url('/cpanel/orders/delete', ['id' => $order->id]) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash" aria-hidden="true"></i> Supprimer </a></td>
				      </tr>
				    @endforeach
			    @else
			    	<tr>
			    		<td colspan="5" class="text-center">No data!!</td>
		    		</tr>
				@endif     
			    </tbody>
		    </table>
		    {{ $orders->render() }}
		</div>    
	</div>
@endsection