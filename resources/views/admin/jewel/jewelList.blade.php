@extends('admin._layout.main')

@section('content')

	<div class="right_col" role="main">
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
        <div class="page-title">
            <div class="title_left">
                <h3>Gestionnaire de voiture</h3>
			</div>
		</div>
		<div class="page-page">
			@if(!empty($jewel->car))
	            <div class="row">
	                <div class="col-md-12 col-sm-12 col-xs-12">
	                    <div class="x_panel">
	                        <div class="x_content">
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="product-image">
										<a href="#" data-toggle="modal" data-target="#imageCropModal">
											<?php $featuredImage = 0; ?>
											@if(!empty($jewel->car->images))
							                @foreach($jewel->car->images as $image)
							                	@if($image->featured == 1)
							                		<img id="mainSlideImage" src="{{$image->big}}" alt="">
							                		<?php $featuredImage = 1; ?>
								                  	<?php break; ?>
												@endif
							          		@endforeach
							          		@endif
							          		@if($featuredImage == 0)
								            	<img id="mainSlideImage" src="{{ asset('placeholder.jpg') }}" alt="">
											@endif
										</a>
									</div>
	                        	</div>
	                        	<div class="col-md-6 col-sm-6 col-xs-12" style="border:0px solid #e5e5e5;">
	                        		<h3 class="prod_title">{{$jewel->car->title}}</h3>
	                        		<p>Model: <strong>{{ $jewel->car->brand }}</strong></p>
	                        		<p>Price: <strong>{{ $jewel->car->price}}</strong></p>
	                        	</div>
	                        </div>
	                     </div>
	                </div> 
	            </div>
			@endif
        </div>

            <form action="{{ route('post.jewel.cars') }}" method="POST">
            {{ csrf_field() }}
	            <div class="form-group text-center">
	            	<input class="btn btn-success" type="submit" value="Enregistrer">
	            </div>
		        <table id="carListings" class="display table table-striped jambo_table bulk_action" cellspacing="0" width="100%">
	                <thead>
	                    <tr class="headings">
	                        <th class="column-title">Image selectionnée</th>
	                        <th class="column-title">Titre</th>
	                        <th class="column-title">Prix</th>             
	                        <th class="column-title no-link last"><span class="nobr">Action</span></th>
							<th class="bulk-actions" colspan="7">
	                            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
	                        </th>
	                    </tr>
	                </thead>

	                <tbody>

	                    <?php $i = 0; ?>
	                        @foreach($cars as $car)
	                            @if($i % 2 == 0)
	                                <?php $class = "odd"; ?>
	                            @else
	                                <?php $class = "even"; ?>
	                            @endif

	                      	<tr class="{{ $class }} pointer">
	                            <td class=" ">
	                                <?php $featuredImage = 0; ?>
	                                    @if($car->images->count() != 0)
	                                        @foreach($car->images as $image)

	                                            @if($image->featured == 1)
	                                                <img style="height: 50px; width: 70px" src="{{ $image->medium }}">

	                                                    <?php $featuredImage = 1; ?>
	                                                         <?php break; ?>
	                                            @endif

	                                        @endforeach

	                                        @if($featuredImage == 0)
	                                                <img style="height: 50px; width: 70px" src="{{ asset('placeholder.jpg') }}" alt="">
	                                        @endif
	                                        @else
	                                               <img style="height: 50px; width: 70px" src="{{ asset('placeholder.jpg') }}" alt="">
	                                        @endif
	                            </td>
	                            <td class=" ">{{ $car->title }}</td>
	                            <td class=" ">
	                            	<?php

			                            $convertedPrice = 0;
			                            if(is_numeric($car->price))
			                                $convertedPrice = $car->price;

			                            $finalPrice = $convertedPrice;

			                            $setting = \App\Setting::where('enabled', '1');
			                            $addOnPrice = 0;

			                            if($setting->count()) {
			                                $setting = $setting->first();
			                                if($setting->percentage != 0) {
			                                    $addOnPrice = ($finalPrice * $setting->percentage) / 100;
			                                } else if($setting->fixed_rate != 0) {
			                                    $addOnPrice = $setting->fixed_rate;
			                                } else if($setting->id == 1) {
			                                    $percentage = \App\Http\Controllers\GlobalPercentageSettingsController::getRangePercentageSingle($finalPrice);

			                                    $addOnPrice = ($finalPrice * $percentage) / 100;
			                                }
			                            }

			                            $finalPrice += $addOnPrice;
			                            $finalPrice = round($finalPrice);

			                            $ostatak = $finalPrice % 100;

			                            $finalPrice = $finalPrice - $ostatak + 100;

			                            ?>

			                            €{{ number_format($finalPrice, 2, ',', '') }} 
	                            </td>
	                            <td class="a-center ">
	                                <div class="" style="position: relative;"><input type="radio" class="checkMeAll" name="car_id" value="{{ $car->id }}" style="">&nbsp;&nbsp;<a href="{{ route('get.edit.car', $car->id) }}" type="button" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Modifier</a></div>
	                            </td>
	                                                 
	                        </tr>
	                    <?php $i++; ?>
	                        @endforeach

	                </tbody>
	            </table>
	            <br>

                
	        </form>    
		</div>    
	</div>		 
	
@endsection

@section('scripts')
	<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<script>
		$(document).ready(function(){
			$('#carListings').DataTable({
				"pageLength": 10,
				"columnDefs": [{ "orderable": false, "targets": 0 }],
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