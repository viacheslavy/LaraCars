@extends('admin._layout.main')

@section('content')

    <link rel="stylesheet" href="{{ asset('cropper/css/cropper.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

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

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="product-image">
                                <a href="#" data-toggle="modal" data-target="#imageCropModalNOT">

                                  @if ( !empty($car->image) )

                                    <img src="{{ $car->image }}" alt="..." />

                                  @else

                                    <img src="{{ $car->imgUrlsMedium[0] }}" alt="..." />

                                  
                                  @endif   
                                </a>
                            </div>
                            <div class="product_gallery">
                                @if ( !empty($json['src']) )
                                    @foreach($json['src'] as $images)
                                        <a href="#">
                                            <img src="{{ $images }}" alt="..." />
                                        </a>
                                    @endforeach    
                                @endif    
                                {{--<a href="#">--}}
                                    {{--<img src="images/prod-2.jpg" alt="..." />--}}
                                {{--</a>--}}
                                {{--<a>--}}
                                    {{--<img src="images/prod-3.jpg" alt="..." />--}}
                                {{--</a>--}}
                                {{--<a>--}}
                                    {{--<img src="images/prod-4.jpg" alt="..." />--}}
                                {{--</a>--}}
                                {{--<a>--}}
                                    {{--<img src="images/prod-5.jpg" alt="..." />--}}
                                {{--</a>--}}
                            </div>
                        </div>


                        <!-- Modal -->
                        <div id="imageCropModal" class="modal fade" role="dialog">
                            <div class="modal-dialog" style="width: 1000px;">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Modal Header</h4>
                                    </div>
                                    <div class="modal-body" style="height: 550px; width: 900px;">
                                        <img id="image" src="{{ $car->image }}" alt="Picture">

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


                                            <button type="button" class="btn btn-primary" data-method="getCroppedCanvas">
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
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            <a class="btn btn-primary" id="download" href="javascript:void(0);" download="cropped.jpg">Download</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- /.modal -->
                                        </div><!-- /.docs-buttons -->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="col-md-6 col-sm-6 col-xs-12" style="border:0px solid #e5e5e5;">
                            <?php

                            $convertedPrice = 0;
                            if(is_numeric($json['price']))
                                $convertedPrice = $json['price'];

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

                            <h3 class="prod_title">&euro; <span id="topPriceTitle"><!-- {{ number_format(intval($json['price'] + $addOnPrice - $ostatak + 100),2, ',', '') }} -->{{ number_format(intval($pricerule['price'] ),2, ',', '') }}</span></h3>

                            @if(isset($json['seller_name']) && strtolower($json['seller_name']) == 'tradenet')
                                <p>Seller: <strong>{{ $json['seller_name'] }}</strong></p>
                            @endif
                            

                            <p>Source Site: <strong>{{ $car->sourceSite }}</strong></p>

                            <p>ID Reference: <strong>{{ $car->referenceID }}</strong></p>

                            <p>Modèle : <strong>{{ $car->model }}</strong></p>

                            <p>Motorization : <strong>{{ $car->engine }}</strong></p>

                            <p>Tranmission : <strong>{{ $car->transmission }}</strong></p>

                            <p>Année: <strong>{{ $car->year}}</strong></p>

                            <p>Killometrage: <strong>{{ number_format((float) filter_var( $car->mileage, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION ) * 1.6) }}{{-- number_format(intval(intval(str_replace(',', "", $car->mileage)) * 1.6)) --}} km</strong></p>

                     {{--        <p>Motorization: <strong>327 ci</strong></p>

                            <p>Gearbox: <strong>Turbohydramatic 350 Automatic</strong></p> --}}

                   {{--          <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.

                                The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.

                            </p> --}}
                           
{{-- 
                            {{$car->attributes}} --}}

            <?php
                $specification = $json['specs'];
                $power = '';
                                          $opt = '';
                if($specification):
                    foreach ($specification as $key => $value):
            ?>
                        @if($key == 'Interior Color' || $key == 'Exterior Color' || $key == 'Engine' || $key == 'Transmission' || $key == 'Power Options' || $key == 'Options' || $key == 'Year' || $key =='Model')
                            @if($key == 'Engine' && $value)
                                <p>Moteur: <strong>{{ $value }}</strong></p>
                            @endif
                            @if($key == 'Power Options' && $value)
                                <?php $power = $value; ?>
                            @endif
                            @if($key == 'Options' && $value)
                                <?php $opt = $value; ?>
                            @endif
                            @if($key == 'Interior Color')
                                @if($value && $value != '')
                                    @foreach($translate as $key1 => $value1)
                                        <?php if(strtolower($value) == strtolower($key1)): ?>
                                                <p>Couleur intérieure: <strong>{{ $value1 }}</strong></p>
                                        <?php endif; ?>
                                    @endforeach
                                @else <!-- <p>Couleur intérieure: <strong>Nous contacter</strong></p> --> @endif
                            @endif
                            @if($key == 'Exterior Color')
                                @if($value && $value != '')
                                    @foreach($translate as $key2 => $value2)
                                        <?php if(strtolower($value) == strtolower($key2)): ?>
                                            <p>Couleur extérieure: <strong>{{ $value2 }}</strong></p>
                                        <?php endif; ?>
                                    @endforeach
                                @else <!-- <p>Couleur extérieure: <strong>Nous contacter</strong></p>  -->@endif
                            @endif
                        @else
                            @if(!empty($value))
                                <p>{{$key}}: <strong>{{$value}}</strong></p>
                            @endif
                        @endif
                    <?php
                    endforeach;
                endif; ?>
                @if($power != '')
                    <p>Options: <strong>{{$power}} @if($opt != '') {{$opt}} @endif</strong></p>
                @endif
                            <br />

                            <div class="">
                                <a href="{{ $car->fullUrl }}" target="_blank" class="btn btn-warning btn-lg">Listing original</a>
                            </div>
                            <br />

                            <?php
                            if(\App\Car::where('referenceID', $car->referenceID)->count()) {
                                $listed = "listé";
                                $color = "rgba(38,185,154,0.88)";
                                $listedInt = 1;
                            } else {
                                $listed = "Non listé";
                                $listedInt = 0;
                                $color = "#d9534f";
                            }
                            ?>

                            <div class="col-xs-12 product_price">
                                <div class="">
                                    <div class="col-xs-12 col-sm-6" style="border-right: 1px solid #E0E0E0;">
                                        <a href="#" data-toggle="modal" data-target=".pricemarkup">
                                            <h1 class="price">
                                                <span>&euro;</span>
                                                <span id="oldPriceMarkup">


                                                    <?php

                                                    if($listedInt == 1)
                                                        echo number_format(intval($pricerule['price'] ),2, ',', ''); 
                                                        //echo number_format(str_replace(",", "", \App\Car::where('referenceID', $car->referenceID)->first()->price) + $addOnPrice - $ostatak + 1000);
                                                    else
                                                        echo number_format(intval($pricerule['price'] ),2, ',', '');
                                                        //echo number_format($finalPrice);
                                                    ?>
                                                </span> <i class="fa fa-pencil" aria-hidden="true" style="color: #73879C;font-size: 20px; vertical-align: middle;"></i>
                                            </h1>
                                        </a>
                                        <span class="price-tax">Prix Original: {{ '$' . number_format(intval($json['price'])) }}</span>
                                        <br>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 text-center">
                                        <h2>Statut: <span style="color: {{ $color }}">{{ $listed }}</span></h2>
                                        <br>
                                    </div>
                                </div>
                            </div>
                <form action="{{ route('post.add.listingalias') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="engine" value="{{ $car->engine }}">
                    <input type="hidden" name="transmission" value="{{ $car->transmission }}">
                    <input type="hidden" name="file" value="{{$file}}">
                    <div class="">
                        @if($listedInt == 0)
                            <button type="submit" class="btn btn-success">Ajouter des listings</button>
                        @else
                            <input type="hidden" name="listed" value="1">
                            <input type="hidden" name="car_id" value="{{ \App\Car::where('referenceID', $car->referenceID)->first()->id }}">
                            <button type="submit" class="btn btn-warning">Remove Listing</button>
                        @endif
                        <a href="{{ Session::get('backUrl') ? Session::get('backUrl') : url('cpanel') }}" class="btn btn-info">Revenir à la recherche</a>
                    </div>
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


        <script>
            jQuery(document).ready(function($){
                $('#carListings').DataTable({"oLanguage": { "sSearch": "Rechercher", "oPaginate": { "sPrevious": "Précédent", "sNext": "Suivant", }, "sInfo": "Montrant _START_ sur les _TOTAL_ enregistrements", }});

                $("#savePriceMarkupID").click(function(e) {
                    e.preventDefault();

                    $("#oldPriceMarkup").text($("#priceMarkupID").val().replace(/[^\w\s]/gi, ''));

                    $("#closeModal1ID").trigger('click');

                    $("#newPriceID").val($("#priceMarkupID").val().replace(/[^\w\s]/gi, ''));
                    $("#topPriceTitle").text($("#priceMarkupID").val().replace(/[^\w\s]/gi, ''));

                    $("#priceMarkupID").val("");

                });
            });
        </script>

    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script> 
    <script src="{{ asset('cropper/js/cropper.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/proizvodjacModel.js') }}"></script>
@endsection