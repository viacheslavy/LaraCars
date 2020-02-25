@extends('admin._layout.main')

@section('content')

        <!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>New Notification</h3>
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
                        <h2 style="float: none;">New Notification</h2>
                        <hr>
                        <div class="clearfix"></div>
                        <a href="{{ route('get.notifications') }}" class="btn btn-warning">Back</a>
                    </div>
                    <div class="x_content">

                        @if(Session::has('message'))

                            <div class="alert alert-success">
                                {{ Session::get('message') }}
                            </div>

                        @endif


                        <form method="POST" action="{{ route('post.edit.notification') }}" class="form-horizontal form-label-left" novalidate="">
                            {{ csrf_field() }}

                            <input type="hidden" value="{{ $notification->id }}" name="id">

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Title <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" value="{{ $notification->title }}" name="title" placeholder="Title" required="required" type="text">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Notification <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea id="textarea" required="required" name="notification" placeholder="Notification" class="form-control col-md-7 col-xs-12">{{ $notification->notification }}</textarea>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Date <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="input-group date" data-provide="datepicker">
                                        <?php
                                        $date = strtotime($notification->date);
                                        $newformat = date('m/d/Y', $date);
                                        ?>
                                        <input type="text" name="date" class="form-control" value="{{ $newformat }}">
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button id="send" type="submit" class="btn btn-success">Create</button>
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


@section('scripts')
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.datepicker').datepicker();
        });
    </script>

@endsection