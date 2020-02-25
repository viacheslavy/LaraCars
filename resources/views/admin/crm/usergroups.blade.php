@extends('admin._layout.main')

@section('content')

        <!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>CRM <small>Cultivate and grow your customer base</small></h3>
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
                        <h2 style="float: none;">Groups</h2>
                        <hr>
                        <div class="clearfix"></div>
                        <a href="{{ route('get.create.group') }}" class="btn btn-info">Create group</a>
                    </div>
                    <div class="x_content">

                        @if(Session::has('message'))

                            <div class="alert alert-success">
                                {{ Session::get('message') }}
                            </div>

                        @endif


                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($groups as $group)

                                <tr>
                                    <th scope="row">{{ $group->name }}</th>
                                    <td>{{ $group->description }}</td>
                                    <td><a href="{{ route('get.delete.group', $group->id) }}" type="button" class="btn btn-danger btn-xs"><i class="fa fa-trash" aria-hidden="true"></i> Delete </a></td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>

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

@endsection