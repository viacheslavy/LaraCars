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
                    <h2 style="float: none;">Customers</h2>
                      <hr>
                      <p>Choose from the list of customers bellow</p>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    @if(Session::has('message'))

                      <div class="alert alert-success">
                        {{ Session::get('message') }}
                      </div>

                    @endif

                    <div class="row">
                      <form action="{{ route('get.filter.customers.group') }}" method="GET">
                        <div class="col-md-12">
                          <div class="item form-group">
                            <div class="col-md-2 col-sm-2 col-xs-12">
                              Filter customers by group:
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                              <select class="form-control" name="group_id" id="">
                                @foreach($groups as $group)
                                  <option @if(\Request::get('group_id')) @if(\Request::get('group_id') == $group->id) selected @endif @endif value="{{ $group->id }}">{{ $group->name }}</option>
                                @endforeach
                              </select>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                              <button class="btn btn-success">Filter</button>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>

                    <br>

                    <form action="{{ route('post.bulk.group.users') }}" method="POST">

                        <select class="form-control" style="width: 200px; display: inline" name="group_id" id="bulkSelectDrop">
                          <option value="">Groups...</option>
                          @foreach($groups as $group)
                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                          @endforeach
                        </select>
                        <button type="submit" id="" class="btn btn-success">Add users to group</button>
                        {{ csrf_field() }}

                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>Bulk</th>
                              <th>Name</th>
                              <th>Phone Number</th>
                              <th>Emails</th>
                              <th>Status</th>
                              <th>Notes</th>
                              <th>Notes Updated</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>

                            @foreach($users as $user)

                              <tr>
                                <th><input type="checkbox" name="customer_id[]" value="{{ $user->id }}"></th>
                                <th scope="row">{{ $user->name }}</th>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->email }}</td>
                                @if($user->status == 1 || $user->status == 0)
                                  <td class="label label-info">Basic Contact</td>
                                @endif

                                @if($user->status == 2)
                                  <td class="label label-success">Contacted</td>
                                @endif

                                @if($user->status == 3)
                                  <td class="label label-warning">Previous Customer</td>
                                @endif

                                @if($user->status == 4)
                                  <td class="label label-default">Left Message</td>
                                @endif

                                @if($user->status == 5)
                                  <td class="label label-danger">Call Back</td>
                                @endif
                                <td>{{ $user->notes }}</td>
                                <td>{{ $user->notes_updated }}</td>
                                <td><a href="{{ route('get.edit.user', $user->id) }}" type="button" class="btn btn-info btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                                  <a href="{{ route('get.delete.user', $user->id) }}" type="button" class="btn btn-danger btn-xs"><i class="fa fa-trash" aria-hidden="true"></i> Delete </a></td>
                              </tr>
                            @endforeach

                          </tbody>
                        </table>
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

@endsection