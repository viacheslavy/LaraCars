@extends('admin._layout.main')

@section('content')


    <link rel="stylesheet" href="{{ asset('cropper/css/cropper.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.fileupload.css') }}">
        <div class="load-modal" id="ajax-loading"></div>
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
                    
                </div>

                <div class="title_right">

                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="input-group">
                            
                    
                        </div>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Add Cars</h2>
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


                            @if(Session::has('message'))
                                <div class="alert alert-success">
                                    {{ Session::get('message') }}
                                </div>
                            @endif

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="product-image">
                                    
                                </div>
                                <form id="setFeaturedImage" action="{{ route('post.apply.featured.image') }}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="product_gallery">
                                        <input type="hidden" id="deleteCheckedImageUrl" value="{{ route('post.deleteCheckedImage') }}">
                                    </div>
                                    <br><br>
                                    <!-- <button class="btn btn-success" type="submit">Change Featured Image</button> -->
                                </form>
                                <button class="btn btn-danger" type="button" id="RemoveSelectImages">Remove Selected Images</button>


                                <input type="hidden" id="deleteImageUrl" value="{{ route('post.delete.image') }}">

                                <br><br>

                                <div class="dropzoneWrapper">

                                    <span class="btn btn-success fileinput-button">
                                        <i class="glyphicon glyphicon-plus"></i>
                                        <span>Select files...</span>
                                    <!-- The file input field used as target for the file upload widget -->
                                        <input id="fileupload" type="file" name="files[]" multiple>
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

                                    </div>
 -->
                                    <input type="hidden" value="{{ route('post.uploadNewCar.images') }}" id="uploadImagesID">

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


                                           


                                            <div class="col-md-9 docs-buttons" style="margin-top: 10px;">

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


                            <div class="col-md-6 col-sm-6 col-xs-12" style="border:0px solid #e5e5e5;">
                                

                                <div class="x_panel">

                                    <div class="x_content">

                                        <form class="form-horizontal form-label-left" action="{{ route('post.add.new.listing') }}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" id="image_id" name="image_id" value="">
                                            <input type="hidden" id="featuredImageId" name="featuredData" value="">
                                            

                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Titre <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input id="occupation" type="text" name="title" data-validate-length-range="5,20" class="optional form-control col-md-7 col-xs-12">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">ID Reference <span class="required"></span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" name="referenceID" class="optional form-control col-md-7 col-xs-12">
                                                </div>
                                            </div>

                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Marque <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select class="form-control col-md- col-xs-12" name="brand" >
                                                        @if(!empty($makedetails) )
                                                            @foreach($makedetails as $make)
                                                                <option value="{{ $make->name }}" data-modelcode="{{ $make->id }}">{{$make->name}}</option>
                                                            @endforeach
                                                        @endif
                                                        </select>
                                                </div>
                                            </div>

                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Modèle <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input id="occupation" type="text" name="model" data-validate-length-range="5,20" class="optional form-control col-md-7 col-xs-12">
                                                </div>
                                            </div>

                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Année <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select class="form-control col-md- col-xs-12" name="year" >
                                                        {{ $start = date("Y") }}
                                                        {{$end = date("Y") - 150 }}
                                                        @while ($start > $end)
                                                            <option value="{{ $start }}">{{ $start }}</option>
                                                            {{$start--}}
                                                        @endwhile
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Mileage <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id="number" name="mileage" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
                                                </div>
                                            </div>

                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Transmission <span class="required"></span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select class="form-control col-md- col-xs-12" name="transmission" >
                                                        <option value=""></option>
                                                        <option value="automatic">Automatique</option>
                                                        <option value="manual">Manuelle</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Engine <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id="number" name="engine" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
                                                </div>
                                            </div>

                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Price <span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="number" id="number" name="price" required="required" data-validate-minmax="10,100" value="" class="form-control col-md-7 col-xs-12">
                                                </div>
                                            </div>

                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">Statut <span class="required"></span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select id="proizvodjacSearch" class="form-control col-md- col-xs-12" name="status" >
                                                        <option value=""></option>
                                                        <option value="booked">réservé</option>
                                                        <option value="sold">vendue</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="version">Version</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id="version" name="version" class="form-control col-md-7 col-xs-12">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cylinders">Nombre cylindre</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="number" id="cylinders" name="cylinders" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bodytype">Carrosserie</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id="bodytype" name="bodytype" class="form-control col-md-7 col-xs-12">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exterior_color">Couleur extérieure</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id="exterior_color" name="exterior_color" class="form-control col-md-7 col-xs-12">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="interior_color">Couleur intérieure</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id="interior_color" name="interior_color" class="form-control col-md-7 col-xs-12">
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="option">Option</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id="option" name="option" class="form-control col-md-7 col-xs-12">
                                                </div>
                                            </div>

                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="original_url">URL
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input id="original_url" type="text" name="original_url" class="optional form-control col-md-7 col-xs-12">
                                                </div>
                                            </div>

                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Description
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <textarea type="number" id="number" placeholder="Description" name="description" data-validate-minmax="10,100" value="" class="form-control col-md-7 col-xs-12"></textarea>
                                                </div>
                                            </div>

                                            <div class="ln_solid"></div>
                                            <div class="form-group">
                                                <div class="col-md-6 col-md-offset-3">
                                                    <button id="send" type="submit" class="btn btn-success">Créer</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>


                                <br />

                                <br />



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

                $(document).on('click', "#mainSlideImage", function() {
                    $("#image").attr('src', $(this).attr('src'));

                    var blobURL = $(this).attr('src');



                    $("#image").one('built.cropper', function () {}).cropper('reset', true).cropper('clear').cropper('replace', blobURL);
                });

                $(document).on('click', ".imageSwitch", function(e) {
                    e.preventDefault();

                    $("#image").attr('data-imageid', $(this).attr('data-imageIDgive'));

                    $("#mainSlideImage").attr('src', $(this).attr('href'));

                    return false;
                });
            </script>

            <script src="{{ asset('js/dropzone.js') }}"></script>
            <link rel="stylesheet" href="{{ asset('css/dropzone.css') }}">
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

                    // // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
                    // var previewNode = document.querySelector("#template");
                    // previewNode.id = "";
                    // var previewTemplate = previewNode.parentNode.innerHTML;
                    // previewNode.parentNode.removeChild(previewNode);

                    // var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
                    //     url: $("#uploadImagesID").val(), // Set the url
                    //     thumbnailWidth: 80,
                    //     thumbnailHeight: 80,
                    //     parallelUploads: 20,
                    //     previewTemplate: previewTemplate,
                    //     autoQueue: false, // Make sure the files aren't queued until manually added
                    //     previewsContainer: "#previews", // Define the container to display the previews
                    //     clickable: ".fileinput-button", // Define the element that should be used as click trigger to select files.
                    //     sending: function(file, xhr, formData) {
                    //         //formData.append("_token", $("input[name='_token']").val());
                    //         //formData.append("car_id", $("input[name='car_id']").val());
                    //     },
                    // });

                    // myDropzone.on("addedfile", function(file) {
                    //     // Hookup the start button
                    //     file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file); };
                    // });

                    // // Update the total progress bar
                    // myDropzone.on("totaluploadprogress", function(progress) {
                    //     document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
                    // });

                    // myDropzone.on("sending", function(file) {
                    //     // Show the total progress bar when upload starts
                    //     document.querySelector("#total-progress").style.opacity = "1";
                    //     // And disable the start button
                    //     file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
                    // });

                    // // Hide the total progress bar when nothing's uploading anymore
                    // myDropzone.on("queuecomplete", function(progress) {
                    //     document.querySelector("#total-progress").style.opacity = "0";
                    // });
                    // var valueIds = [];
                    // myDropzone.on('success', function(file, response){
                    //     $(".product_gallery").append('<div><a href="'+ response['url'] +'" class="imageSwitch" data-imageIDgive="'+ response['id'] +'"> <img src="'+ response['url'] +'" alt="..."> </a><a href="#" class="deleteImageClass" data-deleteImageId="'+ response['id'] +'"><i class="fa fa-times timesIconClass" aria-hidden="true"></i></a></div>');
                    //     $(".file-row").fadeOut();
                    //     valueIds.push(response['id']);
                    //     $("#image_id").val(JSON.stringify(valueIds));
                    // });
                    // // Setup the buttons for all transfers
                    // // The "add files" button doesn't need to be setup because the config
                    // // `clickable` has already been specified.
                    // document.querySelector("#actions .start").onclick = function() {
                    //     myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
                    // };
                    // document.querySelector("#actions .cancel").onclick = function() {
                    //     myDropzone.removeAllFiles(true);
                    // };
                    var valueIds = [];
                    $('#fileupload').fileupload({
                        url: $("#uploadImagesID").val(), // Set the url
                        dataType: 'json',
                        done: function(e, data){
                            if(data && data.result){
                                var html = '<div style="position:relative;"><a href="' + data.result.url + '" class="imageSwitch" data-imageidgive="' + data.result.id + '"><img src="' + data.result.url + '" alt="..."></a>';
                                //html += '<a href="#" class="deleteImageClass" data-deleteimageid="' + data.result.id + '"><i class="fa fa-times timesIconClass" aria-hidden="true"></i></a><span style="border: 3px solid #337ab7  ; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%; padding: 3px; float:right;margin-left:5px;"><input class="checkedRadio" name="featured_image" value="' + data.result.id + '" type="radio"></span><input name="carImage_id" value="" type="hidden"><input class="deleteChecked" name="deleteCheckedImage[]" value="' + data.result.id + '" type="checkbox"></div>';
                                html += '<span style="border: 3px solid #337ab7  ; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%; padding: 3px; float:right;margin-left:5px;"><input class="checkedRadio" name="featured_image" value="' + data.result.id + '" type="radio"></span><input name="carImage_id" value="" type="hidden"><input class="deleteChecked" name="deleteCheckedImage[]" value="' + data.result.id + '" type="checkbox"></div>';
                                $(".product_gallery").append(html);
                                $('#progress .progress-bar').css('width', '0%');
                                valueIds.push(data.result.id);
                                $("#image_id").val(JSON.stringify(valueIds));
                            }
                        },
                        progressall: function (e, data) {
                            var progress = parseInt(data.loaded / data.total * 100, 10);
                            $('#progress .progress-bar').css('width', progress + '%');
                        }
                    }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');

                    $(document).on('click', '.deleteImageClass', function(e){
                        e.preventDefault();
                        var imageId = $(this).attr('data-deleteImageId');
                        var imageToRemove = $(this);
                        if(confirm('Are you sure you want to delete this image?')){
                            var arrayVal = JSON.parse($("#image_id").val());
                            $.each(arrayVal, function(index, value){
                                if(value == parseInt(imageId)){ arrayVal.splice(index, 1); }
                            });
                            $.each(valueIds, function(index, value){
                                if(value == parseInt(imageId)){ valueIds.splice(index, 1); }
                            });
                            $("#image_id").val(JSON.stringify(arrayVal));
                            imageToRemove.parent().remove();
                        }
                    });

                    $(document).on('click', '#RemoveSelectImages', function(e) {
                        e.preventDefault();
                        var values = $(".deleteChecked:checked").map(function(){ return $(this).val(); }).get();
                        if(values.length > 0){
                            var arrayVal = JSON.parse($("#image_id").val());
                            $.each(values, function(index, value){
                                $.each(arrayVal, function(index, val){
                                    if(val == parseInt(value)){ arrayVal.splice(index, 1); }
                                });
                                $.each(valueIds, function(index, val){
                                    if(val == parseInt(value)){ valueIds.splice(index, 1); }
                                });
                                $("a[data-imageidgive='" + value + "']").parent().remove();
                            });
                            $("#image_id").val(JSON.stringify(arrayVal));
                        };
                    });
                    $(document).on('change', "input[type=radio][name=featured_image]", function(e){
                        var radioValue = $("input[name='featured_image']:checked").val();
                        $("#featuredImageId").val(radioValue);
                    });  

                    $(document).on('click', "#savePriceMarkupID", function(e) {
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
                            success: function(response) {

                            }
                        });
                    });
                });
            </script>

            <script>


                $(document).ready(function(){
                   // $('#carListings').DataTable();
                });

                $(document).on('click', "#saveCroppedImage", function() {

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
                        success: function(response) {
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
