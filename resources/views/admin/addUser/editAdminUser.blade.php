@extends('admin._layout.main')

@section('content')

        <!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>User Manager</h3>
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
                        Edit User
                    </div>
                    <div class="x_content">
                        {{ Form::model($user, ['class' => 'form-horizontal', 'files' => 'true', ]) }}
                            {{ csrf_field() }}
                            <div class="item form-group">
                                 {!! Form::hidden('id', null) !!}
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {{ Form::text('name', null, array('required' => '', 'class' => 'form-control', 'id' => 'name', 'placeholder' => "")) }}

                                    @if ($errors->has('name'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('name') }}</strong>
	                                    </span>
	                                @endif
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {{ Form::text('email', null, array('required' => '', 'class' => 'form-control', 'id' => 'email', 'placeholder' => "")) }}

                                    @if ($errors->has('email'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('email') }}</strong>
	                                    </span>
	                                @endif
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Password <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {{ Form::password('password', array('class' => 'form-control', 'id' => 'password', 'placeholder' => "")) }}

                                    @if ($errors->has('password'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('password') }}</strong>
	                                    </span>
	                                @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password_confirmation">Confirm Password <span class="required">*</span>
                                </label>
                                <div class="col-md-6">
                                    {{ Form::password('password_confirmation', array('required' => '', 'class' => 'form-control', 'id' => 'password_confirmation', 'placeholder' => "")) }}

                                    @if ($errors->has('password_confirmation'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
	                                    </span>
	                                @endif
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Phone <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {{ Form::text('phone', null, array('required' => '', 'class' => 'form-control', 'id' => 'phone', 'placeholder' => "")) }}

                                    @if ($errors->has('phone'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('phone') }}</strong>
	                                    </span>
	                                @endif
                                </div>
                            </div>

                            <!-- <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">status <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {{ Form::select('status', ['1'=>'enable', '0'=> 'disable'], null, ['required' => '', 'class' => 'form-control', 'id' => 'status']) }}
                                </div>
                            </div> -->                       

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button id="send" type="submit" class="btn btn-success">Update</button>
                                    <a href="{{ route('get.users') }}" class="btn btn-primary" type="reset">Cancel</a>
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