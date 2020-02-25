<html>
	<head></head>
	<body>
		<p style="margin-left: 30px;">Bonjour,</p>
		<p style="margin-left: 50px;">Voici la liste des voitures qui ont été supprimées</p>
		<p style="margin-left: 30px;">
			@foreach($carsDetails as $car)
				{{$car->referenceID}}<br>
				{{$car->original_url}}<br><br>
			@endforeach
		</p>	
	<body>
</html>