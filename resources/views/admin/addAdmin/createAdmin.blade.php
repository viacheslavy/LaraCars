@extends('admin._layout.main')

@section('content')

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Admin Manager</h3>
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
                        <p>Create New Admin</p>
                        <!-- <h2 style="float: none;">New Notification</h2>
                        <hr> -->
                       <!--  <div class="clearfix"></div> -->
                       <!--  <a href="{{ route('get.notifications') }}" class="btn btn-warning">Back</a> -->
                    </div>
                    <div class="x_content">

                        <form class="form-horizontal" role="form" method="POST" action="{{ route('post.newAdmin') }}">
                        {{ csrf_field() }}

	                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
	                            <label for="name" class="col-md-4 control-label">Nom</label>
	                            <div class="col-md-6">
	                                <input id="name" type="text" class="form-control" name="name">

	                                @if ($errors->has('name'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('name') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>

	                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
	                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>
	                            <div class="col-md-6">
	                                <input id="email" type="email" class="form-control" name="email">

	                                @if ($errors->has('email'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('email') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>

	                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
	                            <label for="password" class="col-md-4 control-label">Password</label>
	                            <div class="col-md-6">
	                                <input id="password" type="password" class="form-control" name="password">

	                                @if ($errors->has('password'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('password') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>

	                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
	                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
	                            <div class="col-md-6">
	                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

	                                @if ($errors->has('password_confirmation'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>

	                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
	                            <label for="password-confirm" class="col-md-4 control-label">Phone</label>

	                            <div class="col-md-6">
	                                <input id="phone" type="number" class="form-control" name="phone">

	                                @if ($errors->has('phone'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('phone') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>

	                        <div class="form-group">
	                            <div class="col-md-6 col-md-offset-4">
	                                <button type="submit" class="btn btn-primary">
	                                    <i class="fa fa-btn fa-user"></i> Register
	                                </button>
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