<!DOCTYPE html>
<html>
	<head>
		<script src="{{ asset('admin_assets/vendors/jquery/dist/jquery.min.js') }}"></script>
	</head>
	<body>
		<script type="text/javascript">
			$(document).ready(function(){
				@foreach($carInsertedIds as $key => $carInsertedId)
					window.open("{{url('cpanel/cars/edit/')}}" + "/{{$carInsertedId}}");
				@endforeach
				<?php Session::flash('message', 'Les voitures ont été ajoutées !'); ?>
				// window.location.href = "{!! $backUrl !!}";
				// document.location.href = "{!! $backUrl !!}";
				location.assign("{{url('/cpanel')}}");
			});
		</script>
	</body>
</html>