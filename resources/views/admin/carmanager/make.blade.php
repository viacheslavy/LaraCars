@extends('admin._layout.main')

@section('content')

	<div class="right_col" role="main">
        <div class="page-title">
            <div class="title_left">
                <h3>Car Manager</h3>
            </div>
            <div class="">
                <div class="col-xs-12 col-sm-3 form-group pull-left">
                    <div class="input-group">
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target=".price-manager">Price Manager</button>
                    </div>
                </div>
        	</div>
	        <table class="table table-bordered">
			    <thead>
			      <tr>
			        <th>Firstname</th>
			        <th>Lastname</th>
			        <th>Email</th>
			      </tr>
			    </thead>
			    <tbody>
			      <tr>
			        <td>John</td>
			        <td>Doe</td>
			        <td>john@example.com</td>
			      </tr>
			      <tr>
			        <td>Mary</td>
			        <td>Moe</td>
			        <td>mary@example.com</td>
			      </tr>
			      <tr>
			        <td>July</td>
			        <td>Dooley</td>
			        <td>july@example.com</td>
			      </tr>
			    </tbody>
		    </table>
		</div>    
	</div>		                

@endsection