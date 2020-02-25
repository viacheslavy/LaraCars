@extends('admin._layout.main')

@section('content')

    <div class="right_col" role="main">
        <div class="">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>View Cars</h2>
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

                            <!-- <button class="btn btn-info" data-toggle="modal" data-target="#addNewListingModal">Add New Listing</button> -->
                            <a href="{{ route('get.newcar.cars') }}" class="btn btn-info">Ajouter un nouveau listing</a>

                            <div id="addNewListingModal" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Add New Listing</h4>
                                        </div>
                                        <div class="modal-body">

                                            <form class="form-horizontal form-label-left" action="{{ route('post.add.new.listing') }}" id="addNewListingForm" method="POST">
                                                {{ csrf_field() }}

                                                <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Title
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input id="occupation" type="text" name="title" data-validate-length-range="5,20" value="" class="optional form-control col-md-7 col-xs-12">
                                                    </div>
                                                </div>

                                                <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">ID Reference
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input id="occupation" type="text" name="referenceID" data-validate-length-range="5,20" value="" class="optional form-control col-md-7 col-xs-12">
                                                    </div>
                                                </div>

                                                <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Marque
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input id="occupation" type="text" name="brand" data-validate-length-range="5,20" value="" class="optional form-control col-md-7 col-xs-12">
                                                    </div>
                                                </div>

                                                <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Modèle
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input id="occupation" type="text" name="model" data-validate-length-range="5,20" value="" class="optional form-control col-md-7 col-xs-12">
                                                    </div>
                                                </div>

                                                <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Année
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input type="number" id="number" name="year" required="required" data-validate-minmax="10,100" value="" class="form-control col-md-7 col-xs-12">
                                                    </div>
                                                </div>

                                                <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Killometrage
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input type="number" id="number" name="mileage" required="required" data-validate-minmax="10,100" value="" class="form-control col-md-7 col-xs-12">
                                                    </div>
                                                </div>

                                                <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Transmission
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input type="text" id="number" name="transmission" required="required" data-validate-minmax="10,100" value="" class="form-control col-md-7 col-xs-12">
                                                    </div>
                                                </div>

                                                <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Engine
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input type="text" id="number" name="engine" required="required" data-validate-minmax="10,100" value="" class="form-control col-md-7 col-xs-12">
                                                    </div>
                                                </div>

                                                <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Price
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input type="number" id="number" name="price" required="required" data-validate-minmax="10,100" value="" class="form-control col-md-7 col-xs-12">
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


                                            <div id="dropZoneWrapperShow" class="dropzoneWrapper" style="display: none;">

                                                <h4>Upload images for added car</h4>

                                                <div id="actions" class="row">

                                                    <div class="col-lg-12">
                                                        <!-- The fileinput-button span is used to style the file input field as button -->
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
                                                    <div class="product_gallery">

                                                    </div>
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






                            <form style="display: inline;" action="{{ route('post.delete.all.cars') }}" method="POST">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger">Supprimer toutes les voitures</button>
                            </form>

                            <br>
                            <br>


                            <div class="row">
                                <div class="col-md-6">
                                    <form method="GET" action="{{ route('get.back.search') }}" class="form-horizontal">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <select id="" name="brand" class="form-control">
                                                        <option value="" data-modelcode="00">Make</option>
                                                        @if(\Request::get('brand'))
                                                            <option value="{{ \Request::get('brand') }}" selected>{{ \Request::get('brand') }}</option>
                                                        @endif

                                                        <option value="AMC" data-modelcode="2152">A M C</option>
                                                        <option value="Aixam" data-modelcode="2152">Aixam</option>
                                                        <option value="Alfa Romeo" data-modelcode="92">Alfa Romeo</option>
                                                        <option value="Aston Martin" data-modelcode="2153">Aston Martin</option>
                                                        <option value="Audi" data-modelcode="93">Audi</option>
                                                        <option value="Bentley" data-modelcode="2148">Bentley</option>
                                                        <option value="Austin" data-modelcode="2154">Austin</option>
                                                        <option value="Bestelauto's" data-modelcode="95">Bestelauto's</option>
                                                        <option value="BMW" data-modelcode="96">BMW</option>
                                                        <option value="Buick" data-modelcode="97">Buick</option>
                                                        <option value="Cadillac" data-modelcode="98">Cadillac</option>
                                                        <option value="Chevrolet" data-modelcode="99">Chevrolet</option>
                                                        <option value="Chrysler" data-modelcode="100">Chrysler</option>
                                                        <option value="Citro&euml;n" data-modelcode="101">Citroen</option>
                                                        <option value="Dacia" data-modelcode="2660">Dacia</option>
                                                        <option value="Daewoo" data-modelcode="103">Daewoo</option>
                                                        <option value="Daihatsu" data-modelcode="105">Daihatsu</option>
                                                        <option value="Dodge" data-modelcode="108">Dodge</option>
                                                        <option value="Ferrari" data-modelcode="110">Ferrari</option>
                                                        <option value="Fiat" data-modelcode="111">Fiat</option>
                                                        <option value="Fisker" data-modelcode="2829">Fisker</option>
                                                        <option value="Ford" data-modelcode="113">Ford Usa</option>
                                                        <option value="Honda" data-modelcode="114">Honda</option>
                                                        <option value="Hummer" data-modelcode="2149">Hummer</option>
                                                        <option value="Hyundai" data-modelcode="115">Hyundai</option>
                                                        <option value="Infiniti" data-modelcode="2659">Infiniti</option>
                                                        <option value="Jaguar" data-modelcode="117">Jaguar</option>
                                                        <option value="Jeep" data-modelcode="118">Jeep</option>
                                                        <option value="Kia" data-modelcode="119">Kia</option>
                                                        <option value="Lada" data-modelcode="2155">Lada</option>
                                                        <option value="Lamborghini" data-modelcode="122">Lamborghini</option>
                                                        <option value="Lancia" data-modelcode="123">Lancia</option>
                                                        <option value="Land Rover" data-modelcode="124">Land Rover</option>
                                                        <option value="Landwind" data-modelcode="2831">Landwind</option>
                                                        <option value="Lexus" data-modelcode="125">Lexus</option>
                                                        <option value="Lincoln" data-modelcode="2150">Lincoln</option>
                                                        <option value="Lotus" data-modelcode="127">Lotus</option>
                                                        <option value="Maserati" data-modelcode="128">Maserati</option>
                                                        <option value="Mazda" data-modelcode="129">Mazda</option>
                                                        <option value="Mercedes-Benz" data-modelcode="130">Mercedes-Benz</option>
                                                        <option value="Mercury" data-modelcode="131">Mercury</option>
                                                        <option value="MG" data-modelcode="132">MG</option>
                                                        <option value="Mini" data-modelcode="133">Mini</option>
                                                        <option value="Mitsubishi" data-modelcode="134">Mitsubishi</option>
                                                        <option value="Nissan" data-modelcode="135">Nissan</option>
                                                        <option value="Oldsmobile" data-modelcode="136">Oldsmobile</option>
                                                        <option value="Oldtimers" data-modelcode="137">Oldtimers</option>
                                                        <option value="Opel" data-modelcode="138">Opel</option>
                                                        <option value="Peugeot" data-modelcode="140">Peugeot</option>
                                                        <option value="Pontiac" data-modelcode="143">Pontiac</option>
                                                        <option value="Porsche" data-modelcode="144">Porsche</option>
                                                        <option value="Renault" data-modelcode="146">Renault</option>
                                                        <option value="Rolls-Royce" data-modelcode="2156">Rolls-Royce</option>
                                                        <option value="Rover" data-modelcode="147">Rover</option>
                                                        <option value="Saab" data-modelcode="148">Saab</option>
                                                        <option value="Seat" data-modelcode="150">Seat</option>
                                                        <option value="Skoda" data-modelcode="151">Skoda</option>
                                                        <option value="Smart" data-modelcode="152">Smart</option>
                                                        <option value="Ssangyong" data-modelcode="2151">Ssangyong</option>
                                                        <option value="Subaru" data-modelcode="153">Subaru</option>
                                                        <option value="Suzuki" data-modelcode="154">Suzuki</option>
                                                        <option value="Tesla" data-modelcode="2830">Tesla</option>
                                                        <option value="Toyota" data-modelcode="155">Toyota</option>
                                                        <option value="Triumph" data-modelcode="156">Triumph</option>
                                                        <option value="Volkswagen" data-modelcode="157">Volkswagen</option>
                                                        <option value="Volvo" data-modelcode="158">Volvo</option>
                                                        <option value="Vrachtwagens" data-modelcode="159">Vrachtwagens</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="Modèle" value="@if(\Request::get('model')){{ \Request::get('model') }}@endif" name="model" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <select name="source_site" class="form-control">
                                                        <option value="">Source site</option>

                                                        @if(\Request::get('source_site'))
                                                            <option value="{{ \Request::get('source_site') }}" selected>{{ \Request::get('source_site') }}</option>
                                                        @endif

                                                        <option value="ebay">Ebay</option>
                                                        <option value="carsforsale">Carsforsale</option>
                                                        <option value="hemmings">Hemmings</option>
                                                        <option value="autotrader">Autotrader</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <select name="export_site" class="form-control">
                                                        <option value="">Export site</option>
                                                        @if(\Request::get('export_site'))
                                                            <option value="{{ \Request::get('export_site') }}" selected>{{ \Request::get('export_site') }}</option>
                                                        @endif
                                                        <option value="UBIFLOW">UBIFLOW</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        {{--<div class="form-group">--}}
                                            {{--<div class="row">--}}
                                                {{--<div class="col-md-12">--}}
                                                    {{--<input type="text" placeholder="Status" name="status" class="form-control">--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="number" placeholder="Kilomètre" value="@if(\Request::get('mileage')){{ \Request::get('mileage') }}@endif" name="mileage" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="number" placeholder="Price from" value="@if(\Request::get('price1')){{ \Request::get('price1') }}@endif" name="price1" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="number" placeholder="Price to" value="@if(\Request::get('price2')){{ \Request::get('price2') }}@endif" name="price2" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <select id="" class="form-control" name="year1">
                                                        <option value="" selected="">Year from</option>
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
                                                <div class="col-md-6">
                                                    <select id="" class="form-control" name="year2">
                                                        <option value="" selected="">Year to</option>
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
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <button class="btn btn-success">Filtrer</button>
                                                    <a href="{{ route('get.view.cars') }}" class="btn btn-warning">Réinitialiser le filtre</a>
                                                </div>
                                            </div>
                                        </div>

                                    </form>

                                </div>
                            </div>

                            <br>
                            <br>

                            <form action="{{ route('post.bulk.action') }}" id="submitForAddListing" method="POST">
                                <select class="form-control" style="width: 200px; display: inline" name="type" id="bulkSelectDrop">
                                    <option value="">Bulk action...</option>
                                    <option value="delete">Delete selected</option>
                                    <option value="assign">Assign to UBIFLOW</option>
                                    <option value="deassign">Deassign UBIFLOW</option>
                                </select>

                                <button id="applyClickBulk" class="btn btn-success">Appliquer</button>
                                {{ csrf_field() }}
                            </form>

                            

                        <form action="{{ route('post.export.xml') }}" method="POST">
                            {{ csrf_field() }}
                            

                            <div class="table-responsive">

                                    <table id="carListings" class="display table table-striped jambo_table bulk_action" cellspacing="0" width="100%">
                                        <thead>
                                            <tr class="headings">
                                                <th>
                                                    <div class="" style="position: relative;"><input type="checkbox" id="checkAllID" class="" style=""></div>
                                                </th>
                                                <th class="column-title">Image selectionnée</th>
                                                <th class="column-title">Reference ID</th>
                                                <th class="column-title">Titre</th>
                                                <th class="column-title">Marque</th>
                                                <th class="column-title">Modèle</th>
                                                <th class="column-title">Année</th>
                                                <th class="column-title">Prix Original</th>
                                                <th class="column-title">Prix de vente</th>
                                                <th class="column-title no-link last"><span class="nobr">Action</span>
                                                </th>
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
                                                    <td class="a-center ">
                                                        <div class="" style="position: relative;"><input type="checkbox" class="checkMeAll" name="car_id[]" value="{{ $car->id }}" style=""></div>
                                                    </td>
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
                                                    <td class=" ">{{ $car->referenceID }}</td>
                                                    <td class=" ">{{ $car->title }}</td>
                                                    <td class=" ">{{ $car->brand }}</td>
                                                    <td class=" ">{{ $car->model }}</td>
                                                    <td class=" ">{{ $car->year }}</td>
                                                    <!-- <td class="a-right a-right ">@if(is_numeric($car->price)){{ '&euro;' . number_format($car->price) }} @endif</td> -->
                                                    <td class="a-right a-right ">{{ '&euro;' .number_format($car->original_price ,2, ',', '') }}</td>
                                                    <td>

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
                                                        <!-- {{ '&euro;' .number_format($finalPrice) }} -->
                                                        {{ '&euro;' .number_format($car->price ,2, ',', '') }}
                                                    </td>
                                                    <td class="last">
                                                        <a href="{{ route('get.edit.car', $car->id) }}" type="button" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Modifier</a>
                                                        <a href="{{ route('get.delete.car', $car->id) }}" type="button" class="btn btn-danger btn-xs"><i class="fa fa-trash" aria-hidden="true"></i> Supprimer</a>
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                            @endforeach

                                        </tbody>
                                    </table>

                                <div class="form-group">
                                    <div class="col-md-3">
                                        <select name="generate_export" id="" class="form-control">
                                            <option value="">Choisir de quel site exporter</option>
                                            <option value="UBIFLOW">UBIFLOW</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="clearfix"></div>

                                <br>

                                <div class="form-group">
                                    <input class="btn btn-success" type="submit" value="Export XML">
                                </div>

                            </div>
                        </form>


                    </div>
                </div>
            </div>

        </div>
    </div>


@endsection

@section('scripts')

    <script>
        $(document).ready(function() {

            $("#addNewListingButton").click(function(e) {
                e.preventDefault();

                $(this).hide();
                $("#newListingLoader").show();

                $.ajax({
                    url: $("#addNewListingForm").attr('action'),
                    type: 'POST',
                    data: $("#addNewListingForm").serialize(),
                    success: function(response) {
                        $("#addNewListingForm").hide();
                        $("#imageCarIdUpload").val(response);
                        $("#dropZoneWrapperShow").show();
                        $("#newListingLoader").hide();
                    }
                });
            });

            $('#applyClickBulk').on('click', function(e) {
                e.preventDefault();

                if($("#bulkSelectDrop").val() != "") {
                    $("#submitForAddListing").submit();
                }
            });

            $("#submitForAddListing").submit(function(eventObj) {
                $(".checkMeAll:checked").each(function() {
                    $('<input />').attr('type', 'hidden')
                            .attr('name', "car_id[]")
                            .attr('value', $(this).val())
                            .appendTo('#submitForAddListing');
                });

                return true;
            });

            $("#checkAllID").click(function() {
                if($(this).is(":checked")) {
                    $(".checkMeAll").attr('checked', true);
                } else {
                    $(".checkMeAll").attr('checked', false);
                }
            });
        });
    </script>

    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function(){
            $('#carListings').DataTable({
                "pageLength": 100,
                "columnDefs": [
                    { "orderable": false, "targets": 0 }
                ],
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