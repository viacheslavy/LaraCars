@extends('admin._layout.main')

@section('content')

        <!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Make Manager</h3>
            </div>

            <!-- <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                    </div>
                </div>
            </div> -->
        </div>

        <div class="clearfix"></div>
        <style>
            .label {
                padding: 4px 8px !important;
                display: inline-block;
                margin-top: 5px;
            }

        </style>
        <div class="row">
            <div class="col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <p>New Make</p>
                        <!-- <h2 style="float: none;">New Notification</h2>
                        <hr> -->
                       <!--  <div class="clearfix"></div> -->
                       <!--  <a href="{{ route('get.notifications') }}" class="btn btn-warning">Back</a> -->
                    </div>
                    <div class="x_content">


                        <form method="POST" action="{{ route('post.createmakes.cars') }}" class="form-horizontal form-label-left">
                            {{ csrf_field() }}

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12" data-validate-words="5" name="name" placeholder="Name" required type="text">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">status <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="proizvodjacSearch" class="form-control col-md- col-xs-12" name="status" required="required">
                                	<option value="1">Enable</option>
                                	<option value="0">Disable</option>
                                </select>
                                </div>
                            </div>                       

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button id="send" type="submit" class="btn btn-success">Create</button>
                                    <a href="{{ route('get.make.cars') }}" class="btn btn-primary" type="reset">Cancel</a>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>



            <div class="clearfix"></div>


        </div>
    </div>
</div>
<!-- /page content -->

@endsection




