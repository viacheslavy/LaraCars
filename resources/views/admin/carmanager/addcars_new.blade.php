@extends('admin._layout.main')

@section('content')
	<style type="text/css">
		.load-modal{display: none;position: fixed;z-index: 1200;top: 0;left: 0;height: 100%;width: 100%;background: rgba( 255, 255, 255, .8 ) url('{{asset('/images/loader.gif')}}') 50% 50% no-repeat;}
		body.loading{overflow: hidden;}
		body.loading .load-modal{display: block;}
		.res-btn{position: absolute;vertical-align: middle;float: right;right: 5%;top: 1.8%;border-radius: 6px;font-size: 18px;line-height: 1.33333;padding: 8px 25px;}
		.chcolor{background-color: #959490; border-color: #959490;}
		.appNom{display: block;}
		.label-color{color:red;}
		.disabled-res{pointer-events: none;cursor: default;}

		#resmyModal.modal{display: none;position: fixed;z-index: 1;left: 0;top: 0;width: 100%;height: 100%;overflow: auto;background-color: rgb(0,0,0);background-color: rgba(0,0,0,0.4);}
		#resmyModal .modal-content{background-color: #fefefe;margin: 15% auto;padding: 20px;border: 1px solid #888;width: 80%;}
		.close{color: #aaa;float: right;font-size: 28px;font-weight: bold;}
		.close:hover, .close:focus{color: black;text-decoration: none;cursor: pointer;}
		.modal-backdrop.in{opacity: 0;}
		.modal-backdrop{z-index: 0;}
	</style>
	<div class="load-modal" id="ajax-loading"></div>
	<div id="resmyModal" class="modal">
		<div class="modal-content">
			<span class="close" data-dismiss="modal">&times;</span>
			<p id="reserrMsg"></p>
		</div>
	</div>

	<div class="right_col" role="main">
		<div class="">
			<div class="page-title">
				<div class="title_left"><h3>Car Manager</h3></div>
				<div class="title_right">
					<div class="col-xs-12 col-sm-3 form-group pull-right">
						<!-- <div class="input-group">
							<button type="button" class="btn btn-warning" data-toggle="modal" data-target=".price-manager">Price Manager</button>
						</div> -->
					</div>
					<div class="modal fade price-manager" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">X</span></button>
								</div>
								<div class="modal-body">
									<div class="x_panel">
										<div class="x_title">
											<h2><i class="fa fa-align-right" aria-hidden="true"></i> Price Markup Manager<small>Either change price globally or locally</small></h2>
											<div class="clearfix"></div>
										</div>
										<div class="x_content">
											<div class="form-horizontal form-label-left">
												<form action="{{ route('post.range.percentage') }}" id="saveRangePIDForm" method="POST">
													{{ csrf_field() }}
													<div class="form-group well">
														<div class="col-xs-12">
															<h2 style="display: inline-block; text-align: left">Percentage by Price Range </h2>
															<div class="checkbox pull-right">
																<label>
																	<?php $somePercentage = \App\Setting::find(1); ?>
																	<input type="checkbox" name="enabled" id="firstPCheckbox" class="flat onlyOneChecked" @if($somePercentage->enabled == 1) checked @endif> Enabled
																</label>
															</div>
														</div>
													</div>
													<table id="percentageRangeTable" class="table table-hover table-bordered">
														<thead>
															<tr>
																<th>#</th>
																<th>Greater Than</th>
																<th>Price Markup</th>
															</tr>
														</thead>
														<tbody>
															<?php $i = 1; ?>
															@foreach($manageprices as $manageprice)
																<tr id="rowNumber{{ $i }}">
																	<th scope="row" data-tableId="{{ $manageprice->id }}">{{ $i }}</th>
																	<td>&euro; <span>{{ $manageprice->price }}</span></td>
																	<td>
																		<div class="pull-left" style="width: 50%">
																			<span>{{ $manageprice->percentage }}</span>%
																		</div>
																		<div class="pull-left" style="width: 50%; text-align: right;">
																			<a href="#" class="btn btn-info btn-xs clickEditPrice" data-id="rowNumber{{ $i }}"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
																			<a href="{{ route('get.delete.price.range', $manageprice->id) }}" class="btn btn-danger btn-xs clickDeletePrice" data-id="rowNumber{{ $i }}"><i class="fa fa-times" aria-hidden="true"></i> Delete</a>
																		</div>
																	</td>
																</tr>
																<?php $i++; ?>
															@endforeach
														</tbody>
													</table>
													<div class="itsaplus-parent">
														<button id="addNewRange" class="btn btn-success itsaplus">&#43;</button>
													</div>
													<br>
													<div class="row">
														<div class="col-md-12">
															<button style="margin-right: auto !important; width: 50%" type="submit" class="btn btn-success center-block" id="saveRangePID">Save</button>
														</div>
													</div>
													<div class="alert alert-success" style="display:none" id="saveRangePIDFormMessage">
														<p>Done!</p>
													</div>
												</form>
												<input type="hidden" id="urlAddPercentage" value="{{ route('post.add.percentage') }}">
												<input type="hidden" id="urlEditPercentage" value="{{ route('post.edit.percentage') }}">
												{{ csrf_field() }}
												<br><br>
												<?php $percentage = \App\Setting::find(2); ?>
												<form action="{{ route('post.global.percentage') }}" method="POST" id="saveGlobalPIDForm">
													{{ csrf_field() }}
													<div class="row">
														<div class="form-group well">
															<div class="col-xs-12">
																<h2 style="display: inline-block; text-align: left">Global Percentage </h2>
																<div class="checkbox pull-right">
																	<label><input type="checkbox" id="secondPCheckbox" name="enabled" class="flat onlyOneChecked" @if($percentage->enabled == 1) checked @endif> Enabled</label>
																</div>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-6 form-group">
															<p><input type="number" name="percentage" class="form-control" style="width: 90% !important;display: inline" placeholder="Price Markup..." value="{{ $percentage->percentage }}"> %</p>
														</div>
														<div class="col-md-6 form-group">
															<input type="submit" class="form-control btn btn-success" id="saveGlobalPID" value="Save">
														</div>
													</div>
													<div class="alert alert-success" style="display:none" id="saveGlobalPIDFormMessage">
														<p>Done!</p>
													</div>
												</form>
												<?php $globalRate = \App\Setting::find(3); ?>
												<form action="{{ route('post.global.rate') }}" method="POST" id="saveGFixedRatePIDForm">
													{{ csrf_field() }}
													<div class="row">
														<div class="form-group well">
															<div class="col-xs-12">
																<h2 style="display: inline-block; text-align: left">Global Fix Rate </h2>
																<div class="checkbox pull-right">
																	<label><input type="checkbox" id="thirdPCheckbox" name="enabled" class="flat onlyOneChecked" @if($globalRate->enabled == 1) checked @endif> Enabled</label>
																</div>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-6 form-group">
															<p><input type="number" name="fixed_rate" class="form-control" style="width: 90% !important;display: inline" placeholder="Price Markup..." value="{{ $globalRate->fixed_rate }}"> &euro;</p>
														</div>
														<div class="col-md-6 form-group">
															<input type="submit" class="form-control btn btn-success" id="saveGFixedRatePID" value="Save">
														</div>
													</div>
													<div class="alert alert-success" style="display:none" id="saveGFixedRatePIDFormMessage">
														<p>Done!</p>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<div id="addNewListingModal" class="modal fade" role="dialog" style="">
				<div class="modal-dialog">
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Ajouter un nouveau listing</h4>
						</div>
						<div class="modal-body">
							<div id="dropZoneWrapper" class="dropzoneWrapper">
								<h4>Upload images for added car</h4>
								<div id="actions" class="row">
									<div class="col-lg-12">
										<!-- The fileinput-button span is used to style the file input field as button -->
										<span class="btn btn-success fileinput-button dz-clickable" id="enable1" disabled = "true">
											<i class="glyphicon glyphicon-plus"></i>
											<span>Add files...</span>
										</span>
										<button type="submit" class="btn btn-primary start" id="enable2" disabled = "true">
											<i class="glyphicon glyphicon-upload"></i>
											<span>Start upload</span>
										</button>
										<button type="reset" class="btn btn-warning cancel" id="enable3" disabled = "true">
											<i class="glyphicon glyphicon-ban-circle"></i>
											<span>Cancel upload</span>
										</button>
									</div>
									<div class="col-lg-5">
										<span class="fileupload-process">
											<div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
												<div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress=""></div>
											</div>
										</span>
									</div>
								</div>
								<!-- HTML heavily inspired by http://blueimp.github.io/jQuery-File-Upload/ -->
								<div class="table table-striped" class="files" id="previews">
									<div id="template" class="file-row">
									<!-- This is used as the file preview template -->
										<div>
											<span class="preview"><img data-dz-thumbnail /></span>
										</div>
										<div>
											<p class="name" data-dz-name></p>
											<strong class="error text-danger" data-dz-errormessage></strong>
										</div>
										<div>
											<p class="size" data-dz-size></p>
											<div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
												<div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
											</div>
										</div>
										<div>
											<button class="btn btn-primary start">
												<i class="glyphicon glyphicon-upload"></i>
												<span>Start</span>
											</button>
											<button data-dz-remove class="btn btn-warning cancel">
												<i class="glyphicon glyphicon-ban-circle"></i>
												<span>Cancel</span>
											</button>
											<button data-dz-remove class="btn btn-danger delete">
												<i class="glyphicon glyphicon-trash"></i>
												<span>Delete</span>
											</button>
										</div>
									</div>
								</div>
								<form id="submitFeaturedImageForm" action="{{ route('post.apply.featured.image') }}" method="POST">
									{{ csrf_field() }}
									<div class="product_gallery"></div>
								</form>
								<input type="hidden" value="{{ route('post.upload.images') }}" id="uploadImagesID">
								<input type="hidden" id="imageCarIdUpload" value="" name="car_id">
							</div>
							<form class="form-horizontal form-label-left" action="{{ route('post.add.new.listing') }}" id="addNewListingForm" method="POST">
								{{ csrf_field() }}
								<div class="item form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Titre</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input id="occupation" type="text" name="title" data-validate-length-range="5,20" value="" class="optional form-control col-md-7 col-xs-12">
									</div>
								</div>
								<div class="item form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">ID Reference</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input id="occupation" type="text" name="referenceID" data-validate-length-range="5,20" value="" class="optional form-control col-md-7 col-xs-12">
									</div>
								</div>
								<div class="item form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Marque</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<!-- <input id="occupation" type="text" name="brand" data-validate-length-range="5,20" value="" class="optional form-control col-md-7 col-xs-12"> -->
										<select id="makeSearch" class="form-control col-md- col-xs-12"  name="brand">
											<option value="" data-modelcode="00"></option>
											@if(!empty($makedetails))
												@foreach($makedetails as $make)
													<option value="{{ $make->name }}" data-modelcode="{{ $make->id }}">{{$make->name}}</option>
												@endforeach
											@endif
										</select>
									</div>
								</div>
								<div class="item form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Modèle</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<!-- <input id="occupation" type="text" name="model" data-validate-length-range="5,20" value="" class="optional form-control col-md-7 col-xs-12"> -->
										<select class="form-control col-md- col-xs-12" name="model" id="modelSearchAdd">
											<option value=""></option>
										</select>
									</div>
								</div>
								<div class="item form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Année</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<!--  <input type="number" id="number" name="year" required="required" data-validate-minmax="10,100" value="" class="form-control col-md-7 col-xs-12"> -->
										<select name="year" class="form-control col-md- col-xs-12">
											<option value=""></option>
											{{ $start = date("Y") }}
											{{ $end = date("Y") - 150 }}
											@while ($start > $end)
												<option value="{{ $start }}">{{ $start }}</option>
												{{$start--}}
											@endwhile
										</select>    
									</div>
								</div>
								<div class="item form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Killometrage</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input type="number" id="number" name="mileage" required="required" data-validate-minmax="10,100" value="" class="form-control col-md-7 col-xs-12">
									</div>
								</div>
								<div class="item form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Transmission    </label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<select class="form-control col-md- col-xs-12" name="transmission" >
											<option value=""></option>
											<option value="automatic">Automatique</option>
											<option value="manual">Manuelle</option>
										</select>
									<!-- <input type="text" id="number" name="transmission" required="required" data-validate-minmax="10,100" value="" class="form-control col-md-7 col-xs-12"> -->
									</div>
								</div>
								<div class="item form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Engine</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input type="text" id="number" name="engine" required="required" data-validate-minmax="10,100" value="" class="form-control col-md-7 col-xs-12">
									</div>
								</div>
								<div class="item form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Price</label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<input type="number" id="number" name="price" required="required" data-validate-minmax="10,100" value="" class="form-control col-md-7 col-xs-12">
									</div>
								</div>
								<div class="item form-group">
									<label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Description </label>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<textarea type="number" id="number" placeholder="Description" name="description" required="required" data-validate-minmax="10,100" value="" class="form-control col-md-7 col-xs-12"></textarea>
									</div>
								</div>
								<div class="ln_solid"></div>
								<div class="form-group">
									<div class="col-md-6 col-md-offset-3">
										<button id="addNewListingButton" type="submit" class="btn btn-success">Save</button>
										<i id="newListingLoader" style="display: none" class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i>
									</div>
								</div>
							</form>
							<div id="dropZoneWrapperSho" class="dropzoneWrappe" style="display: none;">
								<h4>Upload images for added car</h4>
								<div id="actions" class="row">
									<div class="col-lg-12">
										<!-- The fileinput-button span is used to style the file input field as button -->
										<span class="btn btn-success fileinput-button dz-clickable">
											<i class="glyphicon glyphicon-plus"></i><span>Add files...</span>
										</span>
										<button type="submit" class="btn btn-primary start">
											<i class="glyphicon glyphicon-upload"></i>
											<span>Start upload</span>
										</button>
										<button type="reset" class="btn btn-warning cancel">
											<i class="glyphicon glyphicon-ban-circle"></i>
											<span>Cancel upload</span>
										</button>
									</div>
									<div class="col-lg-5">
										<span class="fileupload-process">
											<div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
												<div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress=""></div>
											</div>
										</span>
									</div>
								</div>

								<!-- HTML heavily inspired by http://blueimp.github.io/jQuery-File-Upload/ -->
								<div class="table table-striped" class="files" id="previews">
									<div id="template" class="file-row">
										<!-- This is used as the file preview template -->
										<div>
											<span class="preview"><img data-dz-thumbnail /></span>
										</div>
										<div>
											<p class="name" data-dz-name></p>
											<strong class="error text-danger" data-dz-errormessage></strong>
										</div>
										<div>
											<p class="size" data-dz-size></p>
											<div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
												<div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
											</div>
										</div>
										<div>
											<button class="btn btn-primary start"><i class="glyphicon glyphicon-upload"></i><span>Start</span></button>
											<button data-dz-remove class="btn btn-warning cancel"><i class="glyphicon glyphicon-ban-circle"></i><span>Cancel</span></button>
											<button data-dz-remove class="btn btn-danger delete"><i class="glyphicon glyphicon-trash"></i><span>Delete</span></button>
										</div>
									</div>
								</div>
								<form id="submitFeaturedImageForm" action="{{ route('post.apply.featured.image') }}" method="POST">
									{{ csrf_field() }}
									<div class="product_gallery"></div>
								</form>
								<input type="hidden" value="{{ route('post.upload.images') }}" id="uploadImagesID">
								<input type="hidden" id="imageCarIdUpload" value="" name="car_id">
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>


            <form action="{{ route('post.filter.sites') }}" id="getCarsForm" method="GET">

                {{ csrf_field() }}
                <div class="row">
                    <div class="col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Sites internet <small>Ajouter une voiture à votre site</small></h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <br />
                                <div class="form-horizontal form-label-left">
                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label" style="text-align: left;">Sélectionner des sites
                                            <br>
                                            <small class="text-navy">Récupérer les données depuis ces sites de vente de voitures</small>
                                        </label>

                                        <div class="col-md-9 col-sm-9 col-xs-12">

                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="ebay" name="sites[]" @if(\Request::get('sites')) @if(in_array('ebay', \Request::get('sites'))) checked @endif @endif class="flat"> eBay
                                                </label>
                                            </div>

                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="carsforsale" name="sites[]" @if(\Request::get('sites')) @if(in_array('carsforsale', \Request::get('sites'))) checked @endif @endif class="flat"> Carsforsale
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="autotrader" name="sites[]" @if(\Request::get('sites')) @if(in_array('autotrader', \Request::get('sites'))) checked @endif @endif class="flat"> Autotrader
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="hemmings" name="sites[]" @if(\Request::get('sites')) @if(in_array('hemmings', \Request::get('sites'))) checked @endif @endif class="flat"> Hemmings
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="gatewayclassiccars" name="sites[]" @if(\Request::get('sites')) @if(in_array('gatewayclassiccars', \Request::get('sites'))) checked @endif @endif class="flat"> Gateway ClassicCars
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Filtrer <small>restreignez vos résultats</small></h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <br />
                                <div id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Marque <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select id="proizvodjacSearch" class="form-control col-md- col-xs-12" name="make">
                                                @if(\Request::get('make'))
                                                    <option value="{{ \Request::get('make') }}" selected>{{ \Request::get('make') }}</option>
                                                @endif

                                                        <option value="" data-param="">Any Make</option>
                                                        <option value="AMC" data-kw="AMC" data-lookup="AMC">AMC</option>
                                                        <option value="Acura" data-kw="Acura" data-lookup="Acura">
                                                            Acura
                                                        </option>
                                                        <option value="Alfa Romeo" data-kw="Alfa Romeo"
                                                                data-lookup="Alfa Romeo">Alfa Romeo
                                                        </option>
                                                        <option value="Ariel" data-kw="Ariel" data-lookup="Ariel">
                                                            Ariel
                                                        </option>
                                                        <option value="Aston Martin" data-kw="Aston Martin"
                                                                data-lookup="Aston Martin">Aston Martin
                                                        </option>
                                                        <option value="Audi" data-kw="Audi" data-lookup="Audi">Audi
                                                        </option>
                                                        <option value="Austin" data-kw="Austin" data-lookup="Austin">
                                                            Austin
                                                        </option>
                                                        <option value="Austin Healey" data-kw="Austin Healey"
                                                                data-lookup="Austin Healey">Austin Healey
                                                        </option>
                                                        <option value="BMW" data-kw="BMW" data-lookup="BMW">BMW</option>
                                                        <option value="Bentley" data-kw="Bentley" data-lookup="Bentley">
                                                            Bentley
                                                        </option>
                                                        <option value="Bugatti" data-kw="Bugatti" data-lookup="Bugatti">
                                                            Bugatti
                                                        </option>
                                                        <option value="Buick" data-kw="Buick" data-lookup="Buick">
                                                            Buick
                                                        </option>
                                                        <option value="Cadillac" data-kw="Cadillac"
                                                                data-lookup="Cadillac">Cadillac
                                                        </option>
                                                        <option value="Chevrolet" data-kw="Chevrolet"
                                                                data-lookup="Chevrolet">Chevrolet
                                                        </option>
                                                        <option value="Chrysler" data-kw="Chrysler"
                                                                data-lookup="Chrysler">Chrysler
                                                        </option>
                                                        <option value="Citro&euml;n" data-kw="Citro&euml;n" data-lookup="Citro&euml;n">
                                                            Citro&euml;n
                                                        </option>
                                                        <option value="Cord" data-kw="Cord" data-lookup="Cord">Cord
                                                        </option>
                                                        <option value="Daewoo" data-kw="Daewoo" data-lookup="Daewoo">
                                                            Daewoo
                                                        </option>
                                                        <option value="Daihatsu" data-kw="Daihatsu"
                                                                data-lookup="Daihatsu">Daihatsu
                                                        </option>
                                                        <option value="Datsun" data-kw="Datsun" data-lookup="Datsun">
                                                            Datsun
                                                        </option>
                                                        <option value="De Tomaso" data-kw="De Tomaso"
                                                                data-lookup="De Tomaso">De Tomaso
                                                        </option>
                                                        <option value="DeLorean" data-kw="DeLorean"
                                                                data-lookup="DeLorean">DeLorean
                                                        </option>
                                                        <option value="DeSoto" data-kw="DeSoto" data-lookup="DeSoto">
                                                            DeSoto
                                                        </option>
                                                        <option value="Dodge" data-kw="Dodge" data-lookup="Dodge">
                                                            Dodge
                                                        </option>
                                                        <option value="Eagle" data-kw="Eagle" data-lookup="Eagle">
                                                            Eagle
                                                        </option>
                                                        <option value="Edsel" data-kw="Edsel" data-lookup="Edsel">
                                                            Edsel
                                                        </option>
                                                        <option value="Ferrari" data-kw="Ferrari" data-lookup="Ferrari">
                                                            Ferrari
                                                        </option>
                                                        <option value="Fiat" data-kw="Fiat" data-lookup="Fiat">Fiat
                                                        </option>
                                                        <option value="Fisker" data-kw="Fisker" data-lookup="Fisker">
                                                            Fisker
                                                        </option>
                                                        <option value="Ford" data-kw="Ford" data-lookup="Ford">Ford
                                                        </option>
                                                        <option value="GMC" data-kw="GMC" data-lookup="GMC">GMC</option>
                                                        <option value="Geo" data-kw="Geo" data-lookup="Geo">Geo</option>
                                                        <option value="Honda" data-kw="Honda" data-lookup="Honda">
                                                            Honda
                                                        </option>
                                                        <option value="Hudson" data-kw="Hudson" data-lookup="Hudson">
                                                            Hudson
                                                        </option>
                                                        <option value="Hummer" data-kw="Hummer" data-lookup="Hummer">
                                                            Hummer
                                                        </option>
                                                        <option value="Hyundai" data-kw="Hyundai" data-lookup="Hyundai">
                                                            Hyundai
                                                        </option>
                                                        <option value="Infiniti" data-kw="Infiniti"
                                                                data-lookup="Infiniti">Infiniti
                                                        </option>
                                                        <option value="International Harvester"
                                                                data-kw="International Harvester"
                                                                data-lookup="International Harvester">International
                                                            Harvester
                                                        </option>
                                                        <option value="Isuzu" data-kw="Isuzu" data-lookup="Isuzu">
                                                            Isuzu
                                                        </option>
                                                        <option value="Jaguar" data-kw="Jaguar" data-lookup="Jaguar">
                                                            Jaguar
                                                        </option>
                                                        <option value="Jeep" data-kw="Jeep" data-lookup="Jeep">Jeep
                                                        </option>
                                                        <option value="Kia" data-kw="Kia" data-lookup="Kia">Kia</option>
                                                        <option value="Koenigsegg" data-kw="Koenigsegg"
                                                                data-lookup="Koenigsegg">Koenigsegg
                                                        </option>
                                                        <option value="Lamborghini" data-kw="Lamborghini"
                                                                data-lookup="Lamborghini">Lamborghini
                                                        </option>
                                                        <option value="Lancia" data-kw="Lancia" data-lookup="Lancia">
                                                            Lancia
                                                        </option>
                                                        <option value="Land Rover" data-kw="Land Rover"
                                                                data-lookup="Land Rover">Land Rover
                                                        </option>
                                                        <option value="Lexus" data-kw="Lexus" data-lookup="Lexus">
                                                            Lexus
                                                        </option>
                                                        <option value="Lincoln" data-kw="Lincoln" data-lookup="Lincoln">
                                                            Lincoln
                                                        </option>
                                                        <option value="Lotus" data-kw="Lotus" data-lookup="Lotus">
                                                            Lotus
                                                        </option>
                                                        <option value="MG" data-kw="MG" data-lookup="MG">MG</option>
                                                        <option value="Maserati" data-kw="Maserati"
                                                                data-lookup="Maserati">Maserati
                                                        </option>
                                                        <option value="Maybach" data-kw="Maybach" data-lookup="Maybach">
                                                            Maybach
                                                        </option>
                                                        <option value="Mazda" data-kw="Mazda" data-lookup="Mazda">
                                                            Mazda
                                                        </option>
                                                        <option value="McLaren" data-kw="McLaren" data-lookup="McLaren">
                                                            McLaren
                                                        </option>
                                                        <option value="Mercedes-Benz" data-kw="Mercedes-Benz"
                                                                data-lookup="Mercedes-Benz">Mercedes-Benz
                                                        </option>
                                                        <option value="Mercury" data-kw="Mercury" data-lookup="Mercury">
                                                            Mercury
                                                        </option>
                                                        <option value="Mini" data-kw="Mini" data-lookup="Mini">Mini
                                                        </option>
                                                        <option value="Mitsubishi" data-kw="Mitsubishi"
                                                                data-lookup="Mitsubishi">Mitsubishi
                                                        </option>
                                                        <option value="Morgan" data-kw="Morgan" data-lookup="Morgan">
                                                            Morgan
                                                        </option>
                                                        <option value="Morris" data-kw="Morris" data-lookup="Morris">
                                                            Morris
                                                        </option>
                                                        <option value="Nash" data-kw="Nash" data-lookup="Nash">Nash
                                                        </option>
                                                        <option value="Nissan" data-kw="Nissan" data-lookup="Nissan">
                                                            Nissan
                                                        </option>
                                                        <option value="Oldsmobile" data-kw="Oldsmobile"
                                                                data-lookup="Oldsmobile">Oldsmobile
                                                        </option>
                                                        <option value="Opel" data-kw="Opel" data-lookup="Opel">Opel
                                                        </option>
                                                        <option value="Packard" data-kw="Packard" data-lookup="Packard">
                                                            Packard
                                                        </option>
                                                        <option value="Peugeot" data-kw="Peugeot" data-lookup="Peugeot">
                                                            Peugeot
                                                        </option>
                                                        <option value="Plymouth" data-kw="Plymouth"
                                                                data-lookup="Plymouth">Plymouth
                                                        </option>
                                                        <option value="Pontiac" data-kw="Pontiac" data-lookup="Pontiac">
                                                            Pontiac
                                                        </option>
                                                        <option value="Porsche" data-kw="Porsche" data-lookup="Porsche">
                                                            Porsche
                                                        </option>
                                                        <option value="Ram" data-kw="Ram" data-lookup="Ram">Ram</option>
                                                        <option value="Renault" data-kw="Renault" data-lookup="Renault">
                                                            Renault
                                                        </option>
                                                        <option value="Rolls-Royce" data-kw="Rolls-Royce"
                                                                data-lookup="Rolls-Royce">Rolls-Royce
                                                        </option>
                                                        <option value="Saab" data-kw="Saab" data-lookup="Saab">Saab
                                                        </option>
                                                        <option value="Saturn" data-kw="Saturn" data-lookup="Saturn">
                                                            Saturn
                                                        </option>
                                                        <option value="Scion" data-kw="Scion" data-lookup="Scion">
                                                            Scion
                                                        </option>
                                                        <option value="Shelby" data-kw="Shelby" data-lookup="Shelby">
                                                            Shelby
                                                        </option>
                                                        <option value="Skoda" data-kw="Skoda" data-lookup="Skoda">
                                                            Skoda
                                                        </option>
                                                        <option value="Smart" data-kw="Smart" data-lookup="Smart">
                                                            Smart
                                                        </option>
                                                        <option value="Studebaker" data-kw="Studebaker"
                                                                data-lookup="Studebaker">Studebaker
                                                        </option>
                                                        <option value="Subaru" data-kw="Subaru" data-lookup="Subaru">
                                                            Subaru
                                                        </option>
                                                        <option value="Sunbeam" data-kw="Sunbeam" data-lookup="Sunbeam">
                                                            Sunbeam
                                                        </option>
                                                        <option value="Suzuki" data-kw="Suzuki" data-lookup="Suzuki">
                                                            Suzuki
                                                        </option>
                                                        <option value="Tesla" data-kw="Tesla" data-lookup="Tesla">
                                                            Tesla
                                                        </option>
                                                        <option value="Toyota" data-kw="Toyota" data-lookup="Toyota">
                                                            Toyota
                                                        </option>
                                                        <option value="Triumph" data-kw="Triumph" data-lookup="Triumph">
                                                            Triumph
                                                        </option>
                                                        <option value="Volkswagen" data-kw="Volkswagen"
                                                                data-lookup="Volkswagen">Volkswagen
                                                        </option>
                                                        <option value="Volvo" data-kw="Volvo" data-lookup="Volvo">
                                                            Volvo
                                                        </option>
                                                        <option value="Willys" data-kw="Willys" data-lookup="Willys">
                                                            Willys
                                                        </option>
                                                        <option value="Replica/Kit Makes" data-kw="Replica/Kit Makes"
                                                                data-lookup="Replica/Kit Makes">Replica/Kit Makes
                                                        </option>
                                                        <option value="Other Makes" data-kw="Other Makes"
                                                                data-lookup="Other Makes">Other Makes
                                                        </option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Année <span class="required">*</span>
                                        </label>
                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <select id="" class="form-control col-md- col-xs-12" name="year1">
                                                <option value="" selected="">From</option>
                                                @if(\Request::get('year1'))
                                                    <option value="{{ \Request::get('year1') }}" selected>{{ \Request::get('year1') }}</option>
                                                @endif
                                                <option value="1986">1986</option>
                                                <option value="1985">1985</option>
                                                <option value="1984">1984</option>
                                                <option value="1983">1983</option>
                                                <option value="1982">1982</option>
                                                <option value="1981">1981</option>
                                                <option value="1980">1980</option>
                                                <option value="1979">1979</option>
                                                <option value="1978">1978</option>
                                                <option value="1977">1977</option>
                                                <option value="1976">1976</option>
                                                <option value="1975">1975</option>
                                                <option value="1974">1974</option>
                                                <option value="1973">1973</option>
                                                <option value="1972">1972</option>
                                                <option value="1971">1971</option>
                                                <option value="1970">1970</option>
                                                <option value="1969">1969</option>
                                                <option value="1968">1968</option>
                                                <option value="1967">1967</option>
                                                <option value="1966">1966</option>
                                                <option value="1965">1965</option>
                                                <option value="1964">1964</option>
                                                <option value="1963">1963</option>
                                                <option value="1962">1962</option>
                                                <option value="1961">1961</option>
                                                <option value="1960">1960</option>
                                                <option value="1959">1959</option>
                                                <option value="1958">1958</option>
                                                <option value="1957">1957</option>
                                                <option value="1956">1956</option>
                                                <option value="1955">1955</option>
                                                <option value="1954">1954</option>
                                                <option value="1953">1953</option>
                                                <option value="1952">1952</option>
                                                <option value="1951">1951</option>
                                                <option value="1950">1950</option>
                                                <option value="1949">1949</option>
                                                <option value="1948">1948</option>
                                                <option value="1947">1947</option>
                                                <option value="1946">1946</option>
                                                <option value="1945">1945</option>
                                                <option value="1944">1944</option>
                                                <option value="1943">1943</option>
                                                <option value="1942">1942</option>
                                                <option value="1941">1941</option>
                                                <option value="1940">1940</option>
                                                <option value="1939">1939</option>
                                                <option value="1938">1938</option>
                                                <option value="1937">1937</option>
                                                <option value="1936">1936</option>
                                                <option value="1935">1935</option>
                                                <option value="1934">1934</option>
                                                <option value="1933">1933</option>
                                                <option value="1932">1932</option>
                                                <option value="1931">1931</option>
                                                <option value="1930">1930</option>
                                                <option value="1929">1929</option>
                                                <option value="1928">1928</option>
                                                <option value="1927">1927</option>
                                                <option value="1926">1926</option>
                                                <option value="1925">1925</option>
                                                <option value="1924">1924</option>
                                                <option value="1923">1923</option>
                                                <option value="1922">1922</option>
                                                <option value="1921">1921</option>
                                                <option value="1920">1920</option>
                                                <option value="1919">1919</option>
                                                <option value="1918">1918</option>
                                                <option value="1917">1917</option>
                                                <option value="1916">1916</option>
                                                <option value="1915">1915</option>
                                                <option value="1914">1914</option>
                                                <option value="1913">1913</option>
                                                <option value="1912">1912</option>
                                                <option value="1911">1911</option>
                                                <option value="1910">1910</option>
                                                <option value="1909">1909</option>
                                                <option value="1908">1908</option>
                                                <option value="1907">1907</option>
                                                <option value="1906">1906</option>
                                                <option value="1905">1905</option>
                                                <option value="1904">1904</option>
                                                <option value="1903">1903</option>
                                                <option value="1902">1902</option>
                                                <option value="1901">1901</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <select id="" class="form-control col-md- col-xs-12" name="year2">
                                                <option value="" selected="">To</option>
                                                @if(\Request::get('year2'))
                                                    <option value="{{ \Request::get('year2') }}" selected>{{ \Request::get('year2') }}</option>
                                                @endif
                                                <option value="1986">1986</option>
                                                <option value="1985">1985</option>
                                                <option value="1984">1984</option>
                                                <option value="1983">1983</option>
                                                <option value="1982">1982</option>
                                                <option value="1981">1981</option>
                                                <option value="1980">1980</option>
                                                <option value="1979">1979</option>
                                                <option value="1978">1978</option>
                                                <option value="1977">1977</option>
                                                <option value="1976">1976</option>
                                                <option value="1975">1975</option>
                                                <option value="1974">1974</option>
                                                <option value="1973">1973</option>
                                                <option value="1972">1972</option>
                                                <option value="1971">1971</option>
                                                <option value="1970">1970</option>
                                                <option value="1969">1969</option>
                                                <option value="1968">1968</option>
                                                <option value="1967">1967</option>
                                                <option value="1966">1966</option>
                                                <option value="1965">1965</option>
                                                <option value="1964">1964</option>
                                                <option value="1963">1963</option>
                                                <option value="1962">1962</option>
                                                <option value="1961">1961</option>
                                                <option value="1960">1960</option>
                                                <option value="1959">1959</option>
                                                <option value="1958">1958</option>
                                                <option value="1957">1957</option>
                                                <option value="1956">1956</option>
                                                <option value="1955">1955</option>
                                                <option value="1954">1954</option>
                                                <option value="1953">1953</option>
                                                <option value="1952">1952</option>
                                                <option value="1951">1951</option>
                                                <option value="1950">1950</option>
                                                <option value="1949">1949</option>
                                                <option value="1948">1948</option>
                                                <option value="1947">1947</option>
                                                <option value="1946">1946</option>
                                                <option value="1945">1945</option>
                                                <option value="1944">1944</option>
                                                <option value="1943">1943</option>
                                                <option value="1942">1942</option>
                                                <option value="1941">1941</option>
                                                <option value="1940">1940</option>
                                                <option value="1939">1939</option>
                                                <option value="1938">1938</option>
                                                <option value="1937">1937</option>
                                                <option value="1936">1936</option>
                                                <option value="1935">1935</option>
                                                <option value="1934">1934</option>
                                                <option value="1933">1933</option>
                                                <option value="1932">1932</option>
                                                <option value="1931">1931</option>
                                                <option value="1930">1930</option>
                                                <option value="1929">1929</option>
                                                <option value="1928">1928</option>
                                                <option value="1927">1927</option>
                                                <option value="1926">1926</option>
                                                <option value="1925">1925</option>
                                                <option value="1924">1924</option>
                                                <option value="1923">1923</option>
                                                <option value="1922">1922</option>
                                                <option value="1921">1921</option>
                                                <option value="1920">1920</option>
                                                <option value="1919">1919</option>
                                                <option value="1918">1918</option>
                                                <option value="1917">1917</option>
                                                <option value="1916">1916</option>
                                                <option value="1915">1915</option>
                                                <option value="1914">1914</option>
                                                <option value="1913">1913</option>
                                                <option value="1912">1912</option>
                                                <option value="1911">1911</option>
                                                <option value="1910">1910</option>
                                                <option value="1909">1909</option>
                                                <option value="1908">1908</option>
                                                <option value="1907">1907</option>
                                                <option value="1906">1906</option>
                                                <option value="1905">1905</option>
                                                <option value="1904">1904</option>
                                                <option value="1903">1903</option>
                                                <option value="1902">1902</option>
                                                <option value="1901">1901</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Modèle <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                          {{--   <select name="model" id="modelSearch" class="form-control col-md- col-xs-12" required="">
                                                <option value=" ">Any Model</option>
                                            </select>
                                            <input type="hidden" id="model_jsonSearch" value="{{ url('/') .'/models/' }}"> --}}
                                               <input type="text" id="model" name="model" value="{{ \Request::get('model') }}" class="form-control col-md-7 col-xs-12" placeholder="Modèle">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Couleur
                                        </label>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <select id="" class="form-control col-md- col-xs-12"  name="color">
                                                <option value="">Choose..</option>
                                                <option value="Red" @if(\Request::get('color') == 'Red') selected @endif>Rouge</option>
                                                <option value="Black" @if(\Request::get('color') == 'Black') selected @endif>Noir</option>
                                                <option value="Yellow" @if(\Request::get('color') == 'Yellow') selected @endif>Jaune</option>
                                                <option value="Blue" @if(\Request::get('color') == 'Blue') selected @endif>Bleu</option>
                                                <option value="White" @if(\Request::get('color') == 'White') selected @endif>Blanc</option>
                                                <option value="Pink" @if(\Request::get('color') == 'Pink') selected @endif>Rose</option>
                                                <option value="Brown" @if(\Request::get('color') == 'Brown') selected @endif>Brun</option>
                                                <option value="Purple" @if(\Request::get('color') == 'Purple') selected @endif>Violet</option>
                                            </select>


                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Mot clé
                                        </label>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <input type="text" id="last-name" name="keyword" value="@if(\Request::get('keyword')){{ \Request::get('keyword') }}@else @endif" class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Kilomètre
                                        </label>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <input type="text" id="last-name" name="miles" value="@if(\Request::get('miles')){{ \Request::get('miles') }}@else @endif" class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Prix
                                        </label>
                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <input type="number" id="last-name" placeholder="From" name="price1" value="@if(\Request::get('price1')){{ \Request::get('price1') }}@else @endif" class="form-control col-md-7 col-xs-12">
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <input type="number" id="last-name" placeholder="To" name="price2" value="@if(\Request::get('price2')){{ \Request::get('price2') }}@else @endif" class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>



                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <button type="reset" class="btn btn-primary">Annuler</button>
                                            <button id="findListingAjaxGet" type="submit" class="btn btn-success">Trouver une liste</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>

			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="x_title">
							<h2>Listings <small>Visualisez vos listings ici</small></h2>
							<ul class="nav navbar-right panel_toolbox">
								<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
							</ul>
							<div class="clearfix"></div>
							<div class="col-md-3 col-sm-3 col-xs-12 form-group pull-right top_search" style="margin-top: 30px;"></div>
						</div>
						<div class="x_content">
							@if(Session::has('message')) <div class="alert alert-success"> {{ Session::get('message') }} </div> @endif
							<div class="table-responsive">
								@if(!empty($resultJson))
									<form action="{{ route('post.add.all.cars') }}" method="POST">
										{{ csrf_field() }}
										@foreach($resultJson as $car)
											@if(!in_array(strtolower(trim($car['brand'])), array_map("strtolower", $excludeBrands)))
												<input type="hidden" name="all_car_links[]" value="{{ $car['reference_id'] }}">
											@endif
										@endforeach
										<button type="submit" class="btn btn-info">Ajouter toutes les voitures</button>
									</form>
									<form action="{{ route('post.bulk.add.listings') }}" id="submitForAddListing" method="POST">
										<select class="form-control" style="width: 200px; display: inline" name="" id="bulkSelectDrop">
											<option value="">Bulk action...</option>
											<option value="1">Ajouter des listings</option>
											<option value="">Option2</option>
										</select>
										<button type="submit" id="applyClickBulk" class="btn btn-success">Appliquer</button>
										{{ csrf_field() }}
										<table id="carListings" class="display" cellspacing="0" width="100%">
											<thead>
												<tr>
													<th><p style="width: 50px !important;"> <input type="checkbox" id="checkAllID">Bulk</p></th>
													<th>Image</th>
													<th>ID Reference</th>
													<th>Source Site</th>
													<!-- <th>Nom du vendeur</th> -->
													<th>Titre du listing</th>
													<th>Statut</th>
													<th>Prix Original</th>
													<th>Action</th>
												</tr>
											</thead>
											<tfoot>
												<tr>
													<th>Bulk</th>
													<th>Image</th>
													<th>ID Reference</th>
													<th>Source Site</th>
													<!-- <th>Nom du vendeur</th> -->
													<th>Titre du listing</th>
													<th>Statut</th>
													<th>Prix Original</th>
													<th>Action</th>
												</tr>
											</tfoot>
											<tbody>
												@foreach($resultJson as $car)
													@if(!in_array(strtolower(trim($car['brand'])), array_map("strtolower", $excludeBrands)))
														@if(! ($cars->where("referenceID", $car['reference_id'])->count() > 0))
															<tr id="{{$car['reference_id']}}-tr">
																<th><input type="checkbox" class="checkMeAll" value="{{ $car['reference_id'] }}" name="bulk_links[]"></th>
																<td>
																	@if($car['src'] && count($car['src']) > 0)
																		@foreach($car['src'] as $image)
																			@if($image)
																				<img style="height: 50px; width: 70px" class="lazy" data-original="{{ $image }}">
																				<?php break; ?>
																			@endif
																		@endforeach
																	@endif
																</td>
																<td>{{ $car['reference_id'] }}</td>
																<td>
																	@if($car['href'] && !empty($car['href']))
																		{{(strpos($car['href'], strtolower('hemmings'))) ? 'Hemmings' : ((strpos($car['href'], strtolower('ebay'))) ? 'Ebay' : ((strpos($car['href'], strtolower('carsforsale'))) ? 'Carsforsale' : ((strpos($car['href'], strtolower('autotrader'))) ? 'Autotrader' : (strpos($car['href'], strtolower('gatewayclassiccars'))) ? 'Gateway Classic cars' : '' )))}}
																	@endif
																</td>
																<!-- <td>
																	@if(isset($car['seller_name']) && !empty($car['seller_name'])) {{$car['seller_name']}} @endif
																	@if(isset($car['specs']) && isset($car['specs']['For Sale By']) && !empty($car['specs']['For Sale By'])) {{$car['specs']['For Sale By']}} @endif
																</td> -->
																<td>{{ $car['title'] }}</td>
																<td>{{ ($cars->where("referenceID", $car['reference_id'])->count() > 0) ? 'chargé' : 'Non chargé' }}</td>
																<td>{{ '$' . number_format(intval($car['price'])) }}</td>
																<td>
																	<button onclick="$('#thisIsViewForm-{{$car['reference_id']}}').submit();" class="btn btn-primary btn-xs" type="button">VOIR</button>
																</td>
															</tr>
														@endif
													@endif
												@endforeach
											</tbody>
										</table>
									</form>
									{!! $paginator->appends($search)->render() !!}
									@foreach($resultJson as $car)
										@if(!in_array(strtolower(trim($car['brand'])), array_map("strtolower", $excludeBrands)))
											<form id="thisIsViewForm-{{$car['reference_id']}}" action="{{ route('get.car.detailsPost') }}" method="POST" target="_blank">
												{{ csrf_field() }}
												<input type="hidden" value="{{ $car['href'] }}" name="car_link">
												<input type="hidden" value="{{json_encode($car)}}" name="car_data">
											</form>
										@endif
									@endforeach
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>



        </div>
    </div>

	<!-- Modal -->
	<div id="imageCropModal" class="modal fade" role="dialog">
		<div class="modal-dialog" style="width: 1000px;">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Edit Image</h4>
				</div>
				<div class="modal-body" style="height: 550px; width: 900px;">
					<img id="image" src="" data-imageid="" alt="Picture" style="height: 150px; width: 300px;">                                                                                          
					<div class="col-md-9 docs-buttons">
						<button type="button" class="btn btn-primary" data-method="zoom" data-option="0.1" title="Zoom In">
							<span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;zoom&quot;, 0.1)">
								<span class="fa fa-search-plus"></span>
							</span>
						</button>
						<button type="button" class="btn btn-primary" data-method="zoom" data-option="-0.1" title="Zoom Out">
							<span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;zoom&quot;, -0.1)">
								<span class="fa fa-search-minus"></span>
							</span>
						</button>
						<button id="getCroppedCanvas" type="button" class="btn btn-primary" data-method="getCroppedCanvas">
							<span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getCroppedCanvas&quot;)">Get Cropped Canvas</span>
						</button>
						<!-- Show the cropped image in modal -->
						<div class="modal fade docs-cropped" id="getCroppedCanvasModal" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h4 class="modal-title" id="getCroppedCanvasTitle">Cropped</h4>
									</div>
									<div class="modal-body"></div>
									<div class="modal-footer">
										<i style="display: none;" id="loadingSaveImage" class="fa fa-circle-o-notch fa-spin fa-3x fa-fw margin-bottom"></i>
										<button type="button" class="btn btn-default" id="closeModalsID" data-dismiss="modal">Close</button>
										<a class="btn btn-primary" style="display:none" id="download" href="javascript:void(0);" download="cropped.jpg">Download</a>
										<a href="#" class="btn btn-primary" id="saveCroppedImage">Save</a>
									</div>
								</div>
							</div>
						</div><!-- /.modal -->
					</div><!-- /.docs-buttons -->
				</div>
				<div class="modal-footer">
					<button type="button" id="closeBGModal" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div>
	<!-- /page content -->
	<button style="display: none" id="clickForLoadingModal" type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalLoadingScrapingCars">Loading</button>
	<div class="modal fade bs-example-modal-lg" id="modalLoadingScrapingCars" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" id="closeModal1ID"><span aria-hidden="true">X</span></button>
				</div>
				<div class="modal-body">
					<div class="x_panel">
						<div class="x_title">
							<h2><i class="fa fa-align-right" aria-hidden="true"></i> Loading Car Listings <small>The proccess will take between 10 - 15 min depending how many listings you're retreiving.</small></h2>
							<div class="clearfix"></div>
						</div>
						<div class="x_content">
							<form class="form-horizontal form-label-left">
								<div class="form-group well">
									<div class="col-xs-12">
										<h2 style="display: inline-block; text-align: left"> Car Listing Progress</h2>
									</div>
								</div>
								<div class="form-group">
									<div class="col-xs-12 col-sm-12">
										<br><span style="width: 100%; display:block; margin: 0 auto; text-align:center">Loading...</span><br>
										<div class="progress">
											<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:100%"></div>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
	<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
	<script>
		$(document).ready(function(){
			$("#makeSearch").change(function(){
				var model_json_file = $(this).find(':selected').attr('data-modelcode') + '.json';
				//var url = $("#model_jsonSearch").val() + model_json_file;
				// var url = $("#proizvodjacSearch").val();
				var url = $(this).find(':selected').attr('data-modelcode');
				if($(this).find(':selected').attr('data-modelcode') == "00"){
					var $el = $("#modelSearchAdd");
					$el.empty();
					$el.append($("<option></option>").attr("value", "").text("Tous les modèles"));
					return;
				}
				var $el = $("#modelSearchAdd");
				$el.empty();
				$el.append($("<option></option>").attr("value", "").text("Tous les modèles"));
				$.ajax({
					url: '/getMakes/' + url,
					data: {},
					type: 'GET',
					success: function(response){
						var newOptions = response;
						var $el = $("#modelSearchAdd");
						$.each(newOptions, function(index, value, key){
							$el.append($("<option></option>").attr("value", value.label).text(value.label));
						});
					}
				});
			});
			$("#addNewListingButton").click(function(e){
				e.preventDefault();
				$(this).hide();
				$("#newListingLoader").show();
				$.ajax({
					url: $("#addNewListingForm").attr('action'),
					type: 'POST',
					data: $("#addNewListingForm").serialize(),
					success: function(response){
						//$("#addNewListingForm").hide();
						$("#imageCarIdUpload").val(response);
						//$("#dropZoneWrapperShow").show();
						$("#newListingLoader").hide();
						$("#enable1").attr('disabled', false);
						$("#enable2").attr('disabled', false);
						$("#enable3").attr('disabled', false);
					}
				});
			});
			$(".onlyOneChecked").on('click', function(){
				// in the handler, 'this' refers to the box clicked on
				var $box = $(this);
				if($box.is(":checked")){
					// the name of the box is retrieved using the .attr() method
					// as it is assumed and expected to be immutable
					var group = "input:checkbox[name='" + $box.attr("name") + "']";
					// the checked state of the group/box on the other hand will change
					// and the current value is retrieved using .prop() method
					$(group).prop("checked", false);
					$box.prop("checked", true);
				}else{ $box.prop("checked", false); }
			});
			$("#findListingAjaxGet").click(function(e){
				e.preventDefault();
				$("#clickForLoadingModal").trigger('click');
				$("#getCarsForm").submit();
			});
			$(document).on('click', "#findListingAjaxGet", function(e){
				e.preventDefault();
				$("#clickForLoadingModal").trigger('click');
				$("#getCarsForm").submit();
			});
			$(document).on('click', ".pagination > li > a", function(e){ $("#clickForLoadingModal").trigger('click'); });
			$("#checkAllID").click(function(e){
				myTable.rows().every(function(rowIdx, tableLoop, rowLoop){
					var $tr = this.nodes().to$()
					if($("#checkAllID").is(":checked")){ $tr.find(".checkMeAll").prop('checked', true); }
					else{ $tr.find(".checkMeAll").prop('checked', false); }
				})
				/*if($(this).is(":checked")){ $(".checkMeAll").attr('checked', true); }
				else{ $(".checkMeAll").attr('checked', false); }*/
			});
			$('#applyClickBulk').on('click', function(e){
				e.preventDefault();
				if($("#bulkSelectDrop").val() == "1"){
					// $("#submitForAddListing").submit(); // Old 
					/* New */
					var refIds = $(".checkMeAll:checkbox:checked").map(function(){ return $(this).val(); }).get();
					$.ajax({
						url: "{{ route('post.bulk.add.listings_alias') }}",
						data: { 'bulk_links': refIds, },
						type: 'POST',
						success: function(res){
							$('#reserrMsg').text(res.message);
							$('#resmyModal').modal('show');
							$.each(res.carInsertedIds, function(index, value){
								var timeout = 1000 * ((index + 1) * 7);
								// setTimeout(function(){ window.open("{{url('cpanel/cars/edit/')}}" + "/" + value.id); }, timeout);
								window.open("{{url('cpanel/cars/edit/')}}" + "/" + value.id);
								myTable.row($("tr#" + value.val + "-tr")).remove().draw();
							});
							$body.removeClass("loading");
						},
						error: function(error){
							$('#reserrMsg').text(error.responseJSON.error);
							$('#resmyModal').modal('show');
							$body.removeClass("loading");
						},
					});
				}
			});
			$("#saveGlobalPID").click(function(e){
				e.preventDefault();
				$("#saveGlobalPIDFormMessage").hide();
				$.ajax({
					url: $("#saveGlobalPIDForm").attr('action'),
					type: 'POST',
					data: $("#saveGlobalPIDForm").serialize(),
					success: function(response) {
						$("#saveGlobalPIDFormMessage").show();
						$("#firstPCheckbox").prop('checked', false);
						$("#thirdPCheckbox").prop('checked', false);
					}
				});
			});
			$("#saveRangePID").click(function(e) {
				e.preventDefault();
				$("#saveRangePIDFormMessage").hide();
				$.ajax({
					url: $("#saveRangePIDForm").attr('action'),
					type: 'POST',
					data: $("#saveRangePIDForm").serialize(),
					success: function(response) {
						$("#saveRangePIDFormMessage").show();
						$("#secondPCheckbox").prop('checked', false);
						$("#thirdPCheckbox").prop('checked', false);
					}
				});
			});
			$("#saveGFixedRatePID").click(function(e) {
				e.preventDefault();
				$("#saveGFixedRatePIDFormMessage").hide();
				$.ajax({
					url: $("#saveGFixedRatePIDForm").attr('action'),
					type: 'POST',
					data: $("#saveGFixedRatePIDForm").serialize(),
					success: function(response){
						$("#saveGFixedRatePIDFormMessage").show();
						$("#firstPCheckbox").prop('checked', false);
						$("#secondPCheckbox").prop('checked', false);
					}
				});
			});
			/*$("#submitViewForm").click(function(e){
				e.preventDefault();
				$("#thisIsViewForm").submit();
			});*/
			var myTable = $('#carListings').DataTable({ "pageLength": 100, "columnDefs": [{ "orderable": false, "targets": 0 }], "bPaginate": false, "bInfo" : false, "oLanguage": { "sSearch": "Rechercher", "oPaginate": { "sPrevious": "Précédent", "sNext": "Suivant", }, "sInfo": "Montrant _START_ sur les _TOTAL_ enregistrements", }});
			$(document).on('click', ".clickEditPrice", function(){
				if($("#" + $(this).attr('data-id')).attr('data-attr') == "saveMeBefore"){
					$("#" + $(this).attr('data-id')).attr('data-attr', "");
				}
				editRow("#" + $(this).attr('data-id'));
				$(this).text('Save').css('background-color', 'green').removeClass('clickEditPrice').addClass('clickSavePrice');
			});
			$(document).on('click', ".clickSavePrice", function() {
				saveRow("#" + $(this).attr('data-id'));
				$(this).html('<i class="fa fa-pencil" aria-hidden="true"></i> Edit').css('background-color', '#5bc0de').removeClass('clickSavePrice').addClass('clickEditPrice');
				//$(this).hide();
			});
			$(document).on('click', ".clickDeletePrice", function(e) {
				e.preventDefault();
				$("#" + $(this).attr("data-id")).remove();
				$.ajax({
					url: $(this).attr('href'),
					type: 'GET',
					data: {},
					success: function(response){ console.log(response); }
				});
			});
			$("#addNewRange").click(function(e) {
				e.preventDefault();
				var lastId = $('#percentageRangeTable tbody tr:last-child th:first-child').html();
				var tableId = parseInt($('#percentageRangeTable tbody tr:last-child th:first-child').attr('data-tableId'));
				lastId = parseInt(lastId) + 1;
				tableId = tableId + 1;
				$('#percentageRangeTable > tbody:last-child').append('<tr data-attr="saveMeBefore" id="rowNumber'+ lastId +'"> <th scope="row" data-tableId="' + tableId + '">' + lastId +'</th> <td>&euro; <span><input type="number" value="0"></span></td><td><div class="pull-left" style="width: 50%"> <span><input type="number" value="0"></span>% </div> <div class="pull-left" style="width: 50%; text-align: right;"> <a href="#" class="btn btn-info btn-xs clickSavePrice" data-id="rowNumber'+ lastId +'" style="background-color: green;">Save</a> </div></td> </tr>');
			});
		});
		function editRow(row){
			$('td span',row).each(function(){
				$(this).html('<input type="number" value="' + $(this).html() + '" />');
			});
		}
		function saveRow(row){
			var valuesArray = [];
			$('td span input',row).each(function(index, value){
				valuesArray[index] = $(this).parent().html($(this).val());
			});
			var newPrice = valuesArray[0].html();
			var newPercentage = valuesArray[1].html();
			if($(row).attr('data-attr') == "saveMeBefore"){
				$.ajax({
					url: $("#urlAddPercentage").val(),
					type: 'POST',
					data: {
						_token: $("input[name='_token']").val(),
						price: newPrice,
						percentage: newPercentage
					},
					success: function(response) {
						console.log(response);
					}
				});
			}else{
				var tableId = parseInt($(row + ' th:first-child').attr('data-tableId'));
				$.ajax({
					url: $("#urlEditPercentage").val(),
					type: 'POST',
					data: {
						_token: $("input[name='_token']").val(),
						price: newPrice,
						percentage: newPercentage,
						id: tableId
					},
					success: function(response) {
						console.log(response);
					}
				});
			}
		}
	</script>
	<script src="{{ asset('js/proizvodjacModel.js') }}"></script>
	<script src="{{ asset('js/dropzone.js') }}"></script>
	<link rel="stylesheet" href="{{ asset('css/dropzone.css') }}">
	<script src="{{ asset('cropper/js/cropper.js') }}"></script>
	<script src="{{ asset('js/main.js') }}"></script>
	<script src="{{ asset('js/jquery.lazyload.js') }}" type="text/javascript"></script>
	<script>
		$(document).ready(function(){
			$body = $("body");
			$(document).on({
				ajaxStart: function() { $body.addClass("loading"); },
				ajaxStop: function() { $body.removeClass("loading"); }
			});
			$("img.lazy").lazyload();
			// Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
			var previewNode = document.querySelector("#template");
			previewNode.id = "";
			var previewTemplate = previewNode.parentNode.innerHTML;
			previewNode.parentNode.removeChild(previewNode);
			var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
				url: $("#uploadImagesID").val(), // Set the url
				thumbnailWidth: 80,
				thumbnailHeight: 80,
				parallelUploads: 5,
				maxFiles: 5,
				previewTemplate: previewTemplate,
				autoQueue: false, // Make sure the files aren't queued until manually added
				previewsContainer: "#previews", // Define the container to display the previews
				clickable: ".fileinput-button", // Define the element that should be used as click trigger to select files.
				sending: function(file, xhr, formData){
					formData.append("_token", $("input[name='_token']").val());
					formData.append("car_id", $("input[name='car_id']").val());
				},
			});
			myDropzone.on("addedfile", function(file){
				// Hookup the start button
				file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file); };
			});
			// Update the total progress bar
			myDropzone.on("totaluploadprogress", function(progress){
				document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
			});
			myDropzone.on("sending", function(file) {
				// Show the total progress bar when upload starts
				document.querySelector("#total-progress").style.opacity = "1";
				// And disable the start button
				file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
          			});
			// Hide the total progress bar when nothing's uploading anymore
			/*myDropzone.on("queuecomplete", function(progress, res) {
				console.log(res);
				document.querySelector("#total-progress").style.opacity = "0";
				$(".product_gallery").prepend('<h4>Choose featured image</h4>');
				$("#submitFeaturedImageForm").append('<button class="btn btn-success" type="submit">Save</button>');
			});*/
			myDropzone.on("queuecomplete", function(progress) {
				document.querySelector("#total-progress").style.opacity = "0";
				$(".product_gallery").prepend('<h4>Choose featured image</h4>');
				$("#submitFeaturedImageForm").append('<button class="btn btn-success" type="submit">Save</button>');
			});
			myDropzone.on('success', function(file, response){
				$(".product_gallery").append('<p><img style="width: 100px;" src="'+ response['url'] +'"> <input type="radio" name="featured_image" value="'+ response['id'] +'">&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-primary" type="button" id="newWindow" onclick="openWindow('+ response['id'] +')">Crop</button></p>');
				$(".file-row").hide();
				$("#dropZoneWrapperShow #actions").hide();
				$("#dropZoneWrapperShow h4").hide();
			});
			// Setup the buttons for all transfers
			// The "add files" button doesn't need to be setup because the config
			// `clickable` has already been specified.
			document.querySelector("#actions .start").onclick = function(){
				myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
			};
			document.querySelector("#actions .cancel").onclick = function() {
				myDropzone.removeAllFiles(true);
			};
		});
		function openWindow(id){
			window.open('{{url("/cpanel/cars/image/")}}/' + id, 'Image', "fullscreen=yes,location=no");
		};
	</script>
@endsection