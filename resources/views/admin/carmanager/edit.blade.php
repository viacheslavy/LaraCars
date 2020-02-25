@extends('admin._layout.main')

@section('content')
    <link rel="stylesheet" href="{{ asset('cropper/css/cropper.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.fileupload.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <style type="text/css">
        .load-modal{
            display:    none;
            position:   fixed;
            z-index:    1000;
            top:        0;
            left:       0;
            height:     100%;
            width:      100%;
            background: rgba( 255, 255, 255, .8 ) url('{{asset('/images/loader.gif')}}') 50% 50%  no-repeat;
        }
        body.loading{overflow: hidden;}
        body.loading .load-modal{display: block;}
        textarea#number{font-size: 16px;}
    </style>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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
    <!-- page content -->
    <div class="right_col" role="main">

        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <?php
                    $title = str_replace("Details about", "", $car->title);
                    if(strpos($car->title, 'Details about') !== false) {
                        $title = substr($title, 5);
                    }
                    ?>
                    <h3>{{ $title }}</h3>
                </div>

                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>{{ $title }}</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Settings 1</a>
                                        </li>
                                        <li><a href="#">Settings 2</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">


                            @if(Session::has('message2'))
                                <div class="alert alert-success">
                                    {{ Session::get('message2') }}
                                </div>
                            @endif

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="product-image">
                                    <a href="#" data-toggle="modal" data-target="#imageCropModal">
                                        <?php $isfeatured = false; ?>
                                        @foreach($car->images as $image)
                                            @if($image->featured == 1)
                                                <?php $isfeatured = true; ?>
                                                <img id="mainSlideImage" src="{{ $image->big }}" alt="..." />
                                                <?php break; ?>
                                            @endif    
                                        @endforeach                                        
                                        <?php if($isfeatured == false): ?>
                                            @foreach($car->images as $image)
                                                <img id="mainSlideImage" src="{{ $image->big }}" alt="..." />
                                                <?php break; ?>
                                            @endforeach
                                        <?php endif; ?>
                                    </a>
                                </div>
                                <form action="{{ route('post.apply.featured.image') }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="product_gallery">
                                        @foreach($car->images as $image)
                                            <div  style="position:relative;">
                                                <a href="{{ $image->big }}" class="imageSwitch" data-imageIDgive="{{ $image->id }}">
                                                    <img src="{{ $image->big }}" alt="..." />
                                                </a>
                                                <!-- <a href="#" class="deleteImageClass" data-deleteImageId="{{ $image->id }}">
                                                    <i class="fa fa-times timesIconClass" aria-hidden="true"></i>
                                                </a> -->
                                                <span style="border: 3px solid #337ab7; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%; padding: 3px; float:right;margin-left:5px;">
                                                    <input type="radio" name="featured_image" @if($image->featured == 1) checked @endif value="{{ $image->id }}">
                                                </span>
                                                <input type="hidden" name="carImage_id" value="{{ $car->id }}">
                                                <input type="checkbox" class="deleteChecked" name="deleteCheckedImage[]" value="{{ $image->id }}">
                                            </div>
                                        @endforeach
                                    </div>
                                    <br><br>
                                    <button class="btn btn-success" type="submit">Change Featured Image</button>
                                </form>

                                <button class="btn btn-danger" type="button" id="RemoveSelectImages">Remove Selected Images</button>
                                <!-- @if($car->images->count() > 0)
                                    <a type="button" href="{{ route('get.deleteImages', $car->id) }}" class="btn btn-danger" onClick="return confirm('Are you sure?')">Remove all images</a>
                                @endif -->

                                <input type="hidden" id="deleteImageUrl" value="{{ route('post.delete.image') }}">
                                <input type="hidden" id="deleteCheckedImageUrl" value="{{ route('post.deleteCheckedImage') }}">

                                <br><br>

                                <span class="btn btn-success fileinput-button">
                                    <i class="glyphicon glyphicon-plus"></i>
                                    <span>Select files...</span>
                                    <!-- The file input field used as target for the file upload widget -->
                                    <input id="fileupload" type="file" name="files[]" multiple>
                                    <!-- <input type="hidden" name="car_id" value="{{ $car->id }}"> -->
                                </span>
                                <br>
                                <br>
                                <!-- The global progress bar -->
                                <div id="progress" class="progress">
                                    <div class="progress-bar progress-bar-success"></div>
                                </div>
                                <!-- The container for the uploaded files -->
                                <div id="files" class="files"></div>
                                <br>

                                <div class="dropzoneWrapper">

                                    <!-- <div id="actions" class="row">

                                        <div class="col-lg-12">

                                        <span class="btn btn-success fileinput-button dz-clickable">
                                            <i class="glyphicon glyphicon-plus"></i>
                                            <span>Add files...</span>
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

                                    <div class="table table-striped" class="files" id="previews">

                                        <div id="template" class="file-row">
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

                                    </div> -->

                                    <input type="hidden" value="{{ route('post.upload.images') }}" id="uploadImagesID">
                                    <input type="hidden" value="{{ $car->id }}" name="car_id">

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


                                            @foreach($car->images as $image)
                                                <img id="image" src="{{ $image->big }}" data-imageid="{{ $image->id }}" alt="Picture">
                                                <?php break; ?>
                                            @endforeach


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
                                                    <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getCroppedCanvas&quot;)">
                                                      Get Cropped Canvas
                                                    </span>
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
                            <?php $desc = unserialize($car->specification); $titleVal = ''; $brand = ''; $model = ''; $year = ''; $mileage = ''; $price = ''; $trans=''; $eng="";?>
                            @if (!empty($desc))
                                @foreach($desc as $key => $value)
                                    <?php if($key == 'Mileage') $mileage = $value; if($key == 'Vehicle Title') $titleVal = $value; 
                                        if($key == 'Make') $brand = $value; if($key == 'Model') $model = $value;
                                        if($key == 'Year') $year = $value; if($key == 'Price') $price = $value;
                                        if($key == 'Transmission' && ($value == 'Auto' || $value == 'Automatic')) $trans = 'auto';
                                    ?>
                                @endforeach
                            @endif

                            <div class="col-md-6 col-sm-6 col-xs-12" style="border:0px solid #e5e5e5;">

                                <h3 class="prod_title">&euro; <span id="topPriceTitle"><!-- {{ number_format($finalPrice, 2, ',', '') }} --> {{ number_format($car->price, 2, ',', '') }}</span></h3>
                                @if($car->seller) 
                                    <p>Seller: 
                                        <strong>{{ $car->seller }}</strong>
                                        <a type="button" onClick="return confirm('Are you sure?')" href="{{route('get.changeEditCar', array($car->id, 'seller'))}}">
                                            <!-- <img src="{{ asset('admin_assets/images/spec_delete.png') }}" style="width:4%; height:4%"> --> 
                                            <i class="fa fa-trash fa-1x iconColor"></i>
                                        </a>
                                    </p> 
                                @endif
                                <p>ID Reference: <strong>{{ $car->referenceID }}</strong></p>
                                <p>Modèle : <strong>{{ empty($car->model) ? $model : $car->model }}</strong></p>
                                <!-- <p>Motorization : <strong>{{ $car->engine }}</strong></p>
                                <p>Tranmission : <strong>{{ $car->transmission }}</strong></p> -->
                                <p>Marque: <strong>{{ empty($car->brand) ? $brand : $car->brand }}</strong></p>
                                <p>Année: <strong>{{ empty($car->year) ? $yearVal : $car->year }}</strong></p>
                                <!-- <p>Killometrage: <strong>{{ $car->mileage }} km</strong></p> -->
                                <p>Killometrage: <strong>{{ number_format((float) filter_var( $car->mileage, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION ) * 1.6) }}{{-- number_format(intval(intval(str_replace(',', "", $car->mileage)) * 1.6)) --}} km</strong></p>
                                <p>
                                    Tranmission : 
                                    <strong>@if($car->transmission === 'automatic') Automatique @elseif($car->transmission === 'manual') Manuelle @else Automatique @endif</strong>
                                </p>
                                <?php
                                    $engineVal = ""; $yearVal = "";
                                    if($car->specification != ' ' && !empty($car->specification && $car->specification != 's:0:"";')):
                                        $data = @unserialize($car->specification);
                                        if($car->specification != 's:0:"";'){
                                            if($data){
                                                $desc = unserialize($car->specification);
                                                    foreach ($desc as $key => $value):
                                    ?>
                                                    @if($key == 'Interior Color' || $key == 'Exterior Color' || $key == 'Engine' || $key == 'Transmission' || $key == 'Year' || $key == 'Make' || $key == 'Model' || $key == 'Moteur')
                                                        @if($key == 'Engine')
                                                            <?php $engineVal = $value; ?>
                                                            <p>Moteur: <strong>{{ empty($car->engine) ? $engineVal : $car->engine }}</strong>
                                                                <a type="button" onClick="return confirm('Are you sure?')" href="{{route('get.changeEditCar', array($car->id, $key))}}">
                                                                    <i class="fa fa-trash fa-1x" style="color: red;"></i>
                                                                </a>
                                                            </p>
                                                        @endif
                                                        @if($key == 'Interior Color')
                                                            @if($value && $value != '')
                                                                @foreach($translate as $key1 => $value1)
                                                                    <?php if(strtolower($value) == strtolower($key1)): ?>
                                                                        <p>Couleur intérieure: 
                                                                            <strong>{{ $value1 }}</strong>
                                                                            <a type="button" onClick="return confirm('Are you sure?')" href="{{route('get.changeEditCar', array($car->id, $key))}}">
                                                                                <!-- <img src="{{ asset('admin_assets/images/spec_delete.png') }}" style="width:4%; height:4%"> --> 
                                                                                <i class="fa fa-trash fa-1x" style="color: red;"></i>
                                                                            </a>
                                                                        </p>
                                                                    <?php endif; ?>
                                                                @endforeach
                                                            @else <p>Couleur intérieure: <strong>Nous contacter</strong></p> @endif
                                                        @endif
                                                        @if($key == 'Exterior Color')
                                                            @if($value && $value != '')
                                                                @foreach($translate as $key2 => $value2)
                                                                    <?php if(strtolower($value) == strtolower($key2)): ?>
                                                                        <p>Couleur extérieure: 
                                                                            <strong>{{ $value2 }}</strong> 
                                                                            <a type="button" onClick="return confirm('Are you sure?')" href="{{route('get.changeEditCar', array($car->id, $key))}}">
                                                                                <!-- <img src="{{ asset('admin_assets/images/spec_delete.png') }}" style="width:4%; height:4%"> --> 
                                                                                <i class="fa fa-trash fa-1x" style="color: red;"></i>
                                                                            </a>
                                                                        </p>
                                                                    <?php endif; ?>
                                                                @endforeach
                                                            @else <p>Couleur extérieure: <strong>Nous contacter</strong></p> @endif
                                                        @endif
                                                        @if($key == 'Transmission')
                                                            <p>{{$key}}: @if($car->transmission =='automatic') Automatique @elseif($car->transmission =='manual') Manuelle @else {{$value}} @endif 
                                                                <a type="button" onClick="return confirm('Are you sure?')" href="{{route('get.changeEditCar', array($car->id, $key))}}">
                                                                    <!-- <img src="{{ asset('admin_assets/images/spec_delete.png') }}" style="width:4%; height:4%"> --> 
                                                                    <i class="fa fa-trash fa-1x" style="color: red;"></i>
                                                                </a>
                                                            </p>
                                                        @endif    
                                                    @else
                                                        @if($key == 'Mileage') <p>{{$key}}: <strong>{{$car->mileage}}</strong></p>
                                                        @else
                                                            <p>{{$key}}:
                                                                <strong>{{$value}}</strong>
                                                                <a type="button" onClick="return confirm('Are you sure?')" href="{{route('get.changeEditCar', array($car->id, $key))}}">
                                                                    <!-- <img src="{{ asset('admin_assets/images/spec_delete.png') }}" style="width:4%; height:4%"> -->
                                                                    <i class="fa fa-trash fa-1x" style="color: red;"></i>
                                                                </a>
                                                            </p>
                                                        @endif
                                                    @endif
                                    <?php           endforeach;
                                            }
                                        }
                                    ?>
                                <?php endif; ?>

                                <div class="x_panel">

                                    <div class="x_content">


                                        @if(Session::has('message'))

                                            <div class="alert alert-success">
                                                {{ Session::get('message') }}
                                            </div>

                                        @endif

                                        <form class="form-horizontal form-label-left" action="{{ route('post.edit.car') }}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" value="{{ $car->id }}" name="car_id">

                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Titre <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input id="occupation" type="text" name="title" data-validate-length-range="5,20" value="{{ empty($car->title) ? $titleVal : $car->title }}" class="optional form-control col-md-7 col-xs-12">
                                                </div>
                                            </div>

                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Marque <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select class="form-control col-md- col-xs-12" name="brand" >
                                                        <option value="{{ empty($car->brand) ? $brand : $car->brand }}" selected>{{ $car->brand }}</option>
                                                        @if ( !empty($makedetails) )
                                                            @foreach($makedetails as $make)
                                                                <option value="{{ $make->name }}" data-modelcode="{{ $make->id }}">{{$make->name}}</option>
                                                            @endforeach
                                                        @endif
                                                        </select>
                                                    <!-- <input id="occupation" type="text" name="brand" data-validate-length-range="5,20" value="{{ $car->brand }}" class="optional form-control col-md-7 col-xs-12"> -->
                                                </div>
                                            </div>

                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Modèle <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input id="occupation" type="text" name="model" data-validate-length-range="5,20" value="{{ empty($car->model) ? $model : $car->model }}" class="optional form-control col-md-7 col-xs-12">
                                                </div>
                                            </div>

                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Année <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select class="form-control col-md- col-xs-12" name="year" >
                                                        <option value="{{ empty($car->year) ? $year : $car->year}}" selected>{{$car->year}}</option>
                                                        {{ $start = date("Y") }}
                                                        {{$end = date("Y") - 150 }}
                                                        @while ($start > $end)
                                                            <option value="{{ $start }}">{{ $start }}</option>
                                                            {{$start--}}
                                                        @endwhile
                                                    </select>
                                                    <!-- <input type="number" id="number" name="year" required="required" data-validate-minmax="10,100" value="{{ $car->year }}" class="form-control col-md-7 col-xs-12"> -->
                                                </div>
                                            </div>

                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Mileage <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id="number" name="mileage" data-validate-minmax="10,100" value="{{ empty($car->mileage) ? $mileage : $car->mileage }}" class="form-control col-md-7 col-xs-12">
                                                </div>
                                            </div>

                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Transmission</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select class="form-control col-md- col-xs-12" name="transmission" >
                                                        <option value=""></option>
                                                        @if($car->transmission === 'automatic' || $trans == 'auto')
                                                            <option value="automatic" selected>Automatique</option>
                                                            <option value="manual">Manuelle</option>
                                                        @elseif($car->transmission === 'manual')
                                                            <option value="manual" selected>Manuelle</option>
                                                            <option value="automatic">Automatique</option>
                                                        @else
                                                            <option value="automatic">Automatique</option>
                                                            <option value="manual">Manuelle</option>
                                                        @endif
                                                    </select>
                                                    <!-- <input type="text" id="number" name="transmission" required="required" data-validate-minmax="10,100" value="{{ $car->transmission }}" class="form-control col-md-7 col-xs-12"> -->
                                                </div>
                                            </div>

                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Engine</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id="number" name="engine" data-validate-minmax="10,100" value="{{ empty($car->engine) ? $engineVal : $car->engine }}" class="form-control col-md-7 col-xs-12">
                                                </div>
                                            </div>

                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Prix </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="number" id="number" name="price" data-validate-minmax="10,100" value="{{ $car->price }}" class="form-control col-md-7 col-xs-12">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">Statut <span class="required"></span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select id="proizvodjacSearch" class="form-control col-md- col-xs-12" name="status" >
                                                        <option value=""></option>
                                                        @if($car->status === 'sold')
                                                            <option value="sold" selected>vendue</option>
                                                            <option value="booked">réservé</option>
                                                        @elseif($car->status === 'booked')
                                                            <option value="booked" selected>réservé</option>
                                                            <option value="sold">vendue</option>
                                                        @else
                                                            <option value="booked">réservé</option>
                                                            <option value="sold">vendue</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>

                                            
                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="version">Version</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id="version" name="version" value="{{$car->version}}" class="form-control col-md-7 col-xs-12">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cylinders">Nombre cylindre</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="number" id="cylinders" name="cylinders" data-validate-minmax="10,100" value="{{$car->cylinders}}" class="form-control col-md-7 col-xs-12">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bodytype">Carrosserie</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id="bodytype" name="bodytype" value="{{$car->bodytype}}" class="form-control col-md-7 col-xs-12">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exterior_color">Couleur extérieure</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id="exterior_color" name="exterior_color" value="{{$car->exterior_color}}" class="form-control col-md-7 col-xs-12">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="interior_color">Couleur intérieure</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id="interior_color" name="interior_color" value="{{$car->interior_color}}" class="form-control col-md-7 col-xs-12">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="option">Option</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id="option" name="option" value="{{$car->option}}" class="form-control col-md-7 col-xs-12">
                                                </div>
                                            </div>


                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Description</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <textarea type="number" id="number" placeholder="Description" name="description" rows="15" data-validate-minmax="10,100" value="" class="form-control col-md-7 col-xs-12">{{ $car->description }}</textarea>
                                                </div>
                                            </div>

                                            <div class="ln_solid"></div>
                                            <div class="form-group">
                                                <div class="col-md-6 col-md-offset-3">
                                                    <button id="send" type="submit" class="btn btn-success">Save</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>


                                <br />

                                <br />

                                <a href="{{ $car->original_url }}" target="_blank" class="btn btn-warning btn-lg">Listing original</a>
                                <a href="{{ route('get.product', $car->id) }}" target="_blank" class="btn btn-info btn-lg">View Car on Site</a>



                                <?php
                                if(\App\Car::where('referenceID', $car->referenceID)->count()) {
                                    $listed = "listé";
                                    $listedInt = 1;
                                } else {
                                    $listed = "Non listé";
                                    $listedInt = 0;
                                }
                                ?>

                                <div class="col-xs-12 product_price">
                                    <div class="">
                                        <div class="col-xs-12 col-sm-6" style="border-right: 1px solid #E0E0E0;">
                                            <a href="#" data-toggle="modal" data-target=".pricemarkup">
                                                <h1 class="price">
                                                    <span>&euro;</span>
                                                    <span id="oldPriceMarkup">
                                                    <!-- {{ number_format($finalPrice) }} -->
                                                    {{ number_format($car->price) }}
                                                    </span>
                                                </h1>
                                            </a>
                                            <span class="price-tax">Prix Original: {{ '$' . number_format($car->original_price) }}</span>
                                            <br>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 text-center">
                                            <h2>Statut: <span style="color: #26B99A">{{ $listed }}</span></h2>
                                            <br>
                                        </div>
                                    </div>
                                </div>

                                <form action="{{ route('post.delete.listing') }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="carId" value="{{$car->id}}">
                                    <input type="hidden" name="listed" value="1">
                                    <input type="hidden" name="backToView" value="1">
                                    <button type="submit" class="btn btn-warning">Remove Listing</button>
                                </form>



                                <div class="modal fade bs-example-modal-lg pricemarkup" id="modal1" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" id="closeModal1ID"><span aria-hidden="true">X</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="x_panel">
                                                    <div class="x_title">
                                                        <h2><i class="fa fa-align-right" aria-hidden="true"></i> Price Markup <small>Either change price globally or locally</small></h2>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <div class="x_content">

                                                        <form class="form-horizontal form-label-left">

                                                            <div class="form-group well">
                                                                <div class="col-xs-12">
                                                                    <h2 style="display: inline-block; text-align: left">Fixed Rate Price Markup</h2>
                                                                    <div class="checkbox pull-right">
                                                                        <label>
                                                                            <input type="checkbox" class="flat" checked="checked"> Enabled
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="col-xs-12 col-sm-3 control-label">Price Markup</label>

                                                                <div class="col-xs-12 col-sm-9">
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control" id="priceMarkupID">
                                                                    <span class="input-group-btn">
                                                                        <button type="button" id="savePriceMarkupID" class="btn btn-success">Save</button>
                                                                    </span>
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



                                <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">X</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="x_panel">
                                                    <div class="x_title">
                                                        <h2><i class="fa fa-align-right" aria-hidden="true"></i> Price Markup <small>Either change price globally or locally</small></h2>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <div class="x_content">

                                                        <form class="form-horizontal form-label-left">

                                                            <div class="form-group well">
                                                                <div class="col-xs-12">
                                                                    <h2 style="display: inline-block; text-align: left">Fixed Rate Price Markup</h2>
                                                                    <div class="checkbox pull-right">
                                                                        <label>
                                                                            <input type="checkbox" class="flat" checked="checked"> Enabled
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="col-xs-12 col-sm-3 control-label">Price Markup</label>

                                                                <div class="col-xs-12 col-sm-9">
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control">
                                                                    <span class="input-group-btn">
                                                                        <button type="button" class="btn btn-success">Save</button>
                                                                    </span>
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

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->
@endsection

@section('scripts')
    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).on('click', "#mainSlideImage", function(){
            $("#image").attr('src', $(this).attr('src'));
            var blobURL = $(this).attr('src');
            $("#image").one('built.cropper', function(){}).cropper('reset', true).cropper('clear').cropper('replace', blobURL);
        });
        $(document).on('click', ".imageSwitch", function(e){
            e.preventDefault();
            $("#image").attr('data-imageid', $(this).attr('data-imageIDgive'));
            $("#mainSlideImage").attr('src', $(this).attr('href'));
            return false;
        });
    </script>
    <script src="{{ asset('js/dropzone.js') }}"></script>
    <div class="load-modal" id="ajax-loading"></div>
    <script>
        $(document).ready(function(){
            // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
            var previewNode = document.querySelector("#template");
            previewNode.id = "";
            var previewTemplate = previewNode.parentNode.innerHTML;
            previewNode.parentNode.removeChild(previewNode);
            var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
                url: $("#uploadImagesID").val(), // Set the url
                thumbnailWidth: 80,
                thumbnailHeight: 80,
                parallelUploads: 20,
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
            myDropzone.on("sending", function(file){
                // Show the total progress bar when upload starts
                document.querySelector("#total-progress").style.opacity = "1";
                // And disable the start button
                file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
            });
            // Hide the total progress bar when nothing's uploading anymore
            myDropzone.on("queuecomplete", function(progress){
                document.querySelector("#total-progress").style.opacity = "0";
            });
            myDropzone.on('success', function(file, response){
                $(".product_gallery").append('<div><a href="'+ response['url'] +'" class="imageSwitch" data-imageIDgive="'+ response['id'] +'"> <img src="'+ response['url'] +'" alt="..."> </a><a href="#" class="deleteImageClass" data-deleteImageId="'+ response['id'] +'"><i class="fa fa-times timesIconClass" aria-hidden="true"></i></a></div>');
                $(".file-row").fadeOut();
                location.reload();
            });
            // Setup the buttons for all transfers
            // The "add files" button doesn't need to be setup because the config
            // `clickable` has already been specified.
            document.querySelector("#actions .start").onclick = function(){
                myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
            };
            document.querySelector("#actions .cancel").onclick = function(){
                myDropzone.removeAllFiles(true);
            };
        });
    </script>
    <script src="{{ asset('cropper/js/jquery.min.js') }}"></script>
    <script src="{{ asset('cropper/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/dropzone.js') }}"></script>
    <div class="load-modal" id="ajax-loading"></div>
    <script src="{{ asset('js/jquery.ui.widget.js') }}"></script>
    <script src="{{ asset('js/jquery.iframe-transport.js') }}"></script>
    <script src="{{ asset('js/jquery.fileupload.js') }}"></script>
    <script src="{{ asset('cropper/js/cropper.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <input type="hidden" id="saveCroppedImageUrl" value="{{ route('post.save.cropped.image') }}">
    <input id="postSavePriceMarkup" type="hidden" value="{{ route('post.save.price.markup') }}">
    <input type="hidden" id="newPriceID">
    <script>
        jQuery(document).ready(function($){
            $('#fileupload').fileupload({
                url: $("#uploadImagesID").val(), // Set the url
                dataType: 'json',
                formData: { car_id: "{{$car->id}}", },
                done: function(e, data){
                    if(data && data.result){
                        var html = '<div style="position:relative;"><a href="' + data.result.url + '" class="imageSwitch" data-imageidgive="' + data.result.id + '"><img src="' + data.result.url + '" alt="..."></a>';
                        // html += '<a href="#" class="deleteImageClass" data-deleteimageid="' + data.result.id + '"><i class="fa fa-times timesIconClass" aria-hidden="true"></i></a><span style="border: 3px solid #337ab7  ; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%; padding: 3px; float:right;margin-left:5px;"><input name="featured_image" value="' + data.result.id + '" type="radio"></span><input name="carImage_id" value="{{$car->id}}" type="hidden"><input class="deleteChecked" name="deleteCheckedImage[]" value="' + data.result.id + '" type="checkbox"></div>';
                        html += '<span style="border: 3px solid #337ab7  ; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%; padding: 3px; float:right;margin-left:5px;"><input name="featured_image" value="' + data.result.id + '" type="radio"></span><input name="carImage_id" value="{{$car->id}}" type="hidden"><input class="deleteChecked" name="deleteCheckedImage[]" value="' + data.result.id + '" type="checkbox"></div>';
                        $(".product_gallery").append(html);
                        $('#progress .progress-bar').css('width', '0%');
                    }
                },
                progressall: function(e, data){
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $('#progress .progress-bar').css('width', progress + '%');
                }
            }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');
            $(document).on('click', '.deleteImageClass', function(e){
                e.preventDefault();
                var imageId = $(this).attr('data-deleteImageId');
                var imageToRemove = $(this);
                if(confirm('Are you sure you want to delete this image?')){
                    $.ajax({
                        url: $("#deleteImageUrl").val(),
                        type: 'POST',
                        data: {
                            imageId: imageId,
                            carId: "{{$car->id}}",
                            _token: $("input[name='_token']").val()
                        },
                        success: function(response){ imageToRemove.parent().remove(); },
                    });
                }else{
                    // Do nothing!
                }
            });
            $(document).on('click', '#RemoveSelectImages', function(e){
                e.preventDefault();
                var values = $(".deleteChecked:checked").map(function(){ return $(this).val(); }).get();
                //var imageToRemove = $(this);
                if(values.length > 0){
                    $.ajax({
                        url: $("#deleteCheckedImageUrl").val(),
                        type: 'POST',
                        data: {
                            imageId: values,
                            _token: $("input[name='_token']").val()
                        },
                        beforeSend: function(){ $("body").addClass("loading"); },
                        success: function(response){ location.reload(); },
                        error: function(err){ $("body").removeClass("loading"); },
                    });
                }
            });
            $(document).on('click', "#savePriceMarkupID", function(e){
                e.preventDefault();
                $("#oldPriceMarkup").text($("#priceMarkupID").val().replace(/[^\w\s]/gi, ''));
                $("#closeModal1ID").trigger('click');
                $("#newPriceID").val($("#priceMarkupID").val().replace(/[^\w\s]/gi, ''));
                $("#topPriceTitle").text($("#priceMarkupID").val().replace(/[^\w\s]/gi, ''));
                $("#priceMarkupID").val("");
                $(".modal-backdrop.in").hide();
                $.ajax({
                    url: $("#postSavePriceMarkup").val(),
                    type: 'POST',
                    data: {
                        car_id: $("input[name='car_id']").val(),
                        price: $("#newPriceID").val(),
                        _token: $("input[name='_token']").val()
                    },
                    success: function(response){},
                });
            });
        });
        $(document).ready(function(){
            // $('#carListings').DataTable();
        });
        $(document).on('click', "#saveCroppedImage", function(){
            $("#loadingSaveImage").show();
            $("#saveCroppedImage").hide();
            $.ajax({
                url: $("#saveCroppedImageUrl").val(),
                type: "POST",
                data: {
                    imageData: $("#download").attr('href'),
                    _token: $('input[name="_token"]').val(),
                    imageID: $("#image").attr('data-imageid')
                },
                success: function(response){
                    console.log(response); // Odje ucitati URL i zamjeniti u slideru
                    $("#mainSlideImage").attr('src', response);
                    $("#loadingSaveImage").hide();
                    $("#closeModalsID").trigger('click');
                    $("#closeBGModal").trigger('click');
                    $('#imageCropModal').modal('hide');
                    $('#getCroppedCanvasModal').modal('hide');
                    $("#saveCroppedImage").show();
                }
            });
        });
    </script>
    <script src="{{ asset('js/proizvodjacModel.js') }}"></script>
@endsection