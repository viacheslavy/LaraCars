@extends('admin._layout.main')

@section('content')

        <!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Model Manager</h3>
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
                        <p>New Model</p>
                    </div>
                    <div class="x_content">
                        {{ Form::open(array('url' => array('/cpanel/cars/createModel'), 'class' => 'form-horizontal', 'id' => 'usermodel', 'files' => 'true', )) }}
                            {{ csrf_field() }}
                          
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {{ Form::text('name', null, array('required' => '', 'class' => 'form-control', 'id' => 'name', 'placeholder' => trans('Name'))) }}
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="value">Value <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {{ Form::text('value', null, array('required' => '', 'class' => 'form-control', 'id' => 'name', 'placeholder' => trans('value'))) }}
                                </div>
                            </div>                       
							<div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="make_id">Make<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {{ Form::select('make_id', $makes, null, ['required' => '', 'class' => 'form-control', 'id' => 'makes_id']) }}
                                </div>
                            </div> 
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">status <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {{ Form::select('status', ['1'=>'enable', '0'=> 'disable'], null, ['required' => '', 'class' => 'form-control', 'id' => 'status']) }}
                                </div>
                            </div>                       

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button id="send" type="submit" class="btn btn-success">Create</button>
                                    <a href="{{ route('get.make.cars') }}" class="btn btn-primary" type="reset">Cancel</a>
                                </div>
                            </div>
                        {{ Form::close() }}

                    </div>
                </div>
            </div>



            <div class="clearfix"></div>


        </div>
    </div>
</div>
<!-- /page content -->

@endsection




