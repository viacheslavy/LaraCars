@extends('admin._layout.main')

@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Type de paiement</h3>
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
            </div>
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
                        Type de paiement
                    </div>
                    <div class="x_content">
                        {{ Form::model($type, ['class' => 'form-horizontal', 'files' => 'true', ]) }}
                            {{ csrf_field() }}
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type">Type <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {{ Form::select('type', ['payzee' => 'Payzee', 'authorize' => 'Authorize'], null, array('required' => '', 'class' => 'form-control', 'id' => 'type',)) }}
                                    @if ($errors->has('type'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('type') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button id="send" type="submit" class="btn btn-success">Enregistrer</button>
                                    <a href="{{ url('/cpanel') }}" class="btn btn-primary" type="reset">Annuler</a>
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