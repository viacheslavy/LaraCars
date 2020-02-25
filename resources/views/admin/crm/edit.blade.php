@extends('admin._layout.main')

@section('content')


    <div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>User Profile</h3>
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

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>User Report <small>Activity report</small></h2>

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

                        <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                            <div class="profile_img">
                                <div id="crop-avatar">
                                    <!-- Current avatar -->
                                    <img class="img-responsive avatar-view" src="{{ asset('/admin_assets') }}/images/picture.jpg" alt="Avatar" title="Change the avatar">
                                </div>
                            </div>
                            <h3>{{ $user->name }}</h3>

                            <ul class="list-unstyled user_data">
                                @if($user->city || $user->state || $user->country)
                                <li><i class="fa fa-map-marker user-profile-icon"></i> {{ $user->city }}, {{ $user->state }}, {{ $user->country }}
                                </li>
                                @endif

                                @if($user->occupation)
                                <li>
                                    <i class="fa fa-briefcase user-profile-icon"></i> {{ $user->occupation }}
                                </li>
                                @endif

                                    @if($user->website)
                                <li class="m-top-xs">
                                    <i class="fa fa-external-link user-profile-icon"></i>
                                    <a href="{{ $user->website }}" target="_blank">{{ $user->website }}</a>
                                </li>
                                        @endif
                            </ul>

                            <a href="#tab_content3" data-toggle="tab" id="editProfileID" class="btn btn-success"><i class="fa fa-edit m-right-xs"></i> Edit Profile</a>

                            <a href="#" data-toggle="modal" data-target="#sendEmail" class="btn btn-warning"><i class="fa fa-envelope m-right-xs"></i> Send Email</a>
                            <br />

                            <div id="sendEmail" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Send Email</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('post.send.email') }}" class="form-horizontal form-label-left" novalidate="">
                                                {{ csrf_field() }}

                                                <input type="hidden" value="{{ $user->id }}" name="customer_id">

                                                <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Subject <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="subject" placeholder="Subject" required="required" type="text">
                                                    </div>
                                                </div>

                                                <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Message <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <textarea id="textarea" required="required" name="message" placeholder="Message" class="form-control col-md-7 col-xs-12"></textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-md-6 col-md-offset-3">
                                                        <button id="send" type="submit" class="btn btn-success">Send</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- start skills -->
                            <!-- end of skills -->

                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-12">

                            <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                    {{--<li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Recent Activity</a></li>--}}
                                    {{--<li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Projects Worked on</a></li>--}}
                                    <li role="presentation" class="active">
                                        <a href="#tab_content1" role="tab" id="profile-tab1" data-toggle="tab" aria-expanded="true">Profile</a>
                                    </li>

                                    <li role="presentation">
                                        <a href="#tab_content2" role="tab" id="email-tab2" data-toggle="tab" aria-expanded="true">Emails</a>
                                    </li>
                                </ul>
                                <div id="myTabContent" class="tab-content">


                                    <div role="tabpanel" class="tab-pane active in fade" id="tab_content1" aria-labelledby="profile-tab1">

                                        <div class="x_content">

                                            <form method="POST" action="{{ route('post.edit.user') }}" class="form-horizontal form-label-left" novalidate="">
                                                {{ csrf_field() }}

                                                <input type="hidden" name="customer_id" value="{{ $user->id }}">

                                                <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="both name(s) e.g Jon Doe" value="{{ $user->name }}" required="required" type="text">
                                                    </div>
                                                </div>
                                                <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input type="email" id="email" name="email" required="required" value="{{ $user->email }}" class="form-control col-md-7 col-xs-12">
                                                    </div>
                                                </div>

                                                <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Phone Number <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input type="phone" id="number" name="phone" required="required" data-validate-minmax="10,100" value="{{ $user->phone }}" class="form-control col-md-7 col-xs-12">
                                                    </div>
                                                </div>


                                                <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Country <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" value="{{ $user->country }}" data-validate-words="2" name="country" required="required" type="text">
                                                    </div>
                                                </div>

                                                <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">State <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" value="{{ $user->state }}" data-validate-words="2" name="state" required="required" type="text">
                                                    </div>
                                                </div>

                                                <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">City <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" value="{{ $user->city }}" data-validate-words="2" name="city" required="required" type="text">
                                                    </div>
                                                </div>

                                                <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="website">Website URL <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input type="url" id="website" name="website" required="required" placeholder="http://www.website.com" value="{{ $user->website }}" class="form-control col-md-7 col-xs-12">
                                                    </div>
                                                </div>
                                                <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Occupation <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <input id="occupation" type="text" name="occupation" data-validate-length-range="5,20" value="{{ $user->occupation }}" class="optional form-control col-md-7 col-xs-12">
                                                    </div>
                                                </div>

                                                <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Status <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <select class="form-control" name="status" id="">
                                                            <option value="1" @if($user->status == 1) selected @endif>Basic Contact</option>
                                                            <option value="2" @if($user->status == 2) selected @endif>Contacted</option>
                                                            <option value="3" @if($user->status == 3) selected @endif>Previous Customer</option>
                                                            <option value="4" @if($user->status == 4) selected @endif>Left Message</option>
                                                            <option value="5" @if($user->status == 5) selected @endif>Call Back</option>
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Group
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <select class="form-control" name="group_id" id="">
                                                            <option value="0">Choose group</option>
                                                            @foreach($groups as $group)
                                                                <option @if($user->group_id == $group->id) selected @endif value="{{ $group->id }}">{{ $group->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Notes <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <textarea id="textarea" required="required" name="notes" class="form-control col-md-7 col-xs-12">{{ $user->notes }}</textarea>
                                                    </div>
                                                </div>

                                                <div class="ln_solid"></div>
                                                <div class="form-group">
                                                    <div class="col-md-6 col-md-offset-3">
                                                        <button id="send" type="submit" class="btn btn-success">Save</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>


                                    </div>


                                    <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="email-tab2">

                                        <h1>Emails</h1>

                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>Email</th>
                                                <th>Subject</th>
                                                <th>Message</th>
                                                <th>#</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($emails as $email)
                                                <?php
                                                $customer = \App\Customer::find($email->customer_id);
                                                ?>
                                                <tr>
                                                    <th scope="row">{{ $customer->email }}</th>
                                                    <td>{{ $email->subject }}</td>
                                                    <td>{{ $email->message }}</td>
                                                    <td><a href="{{ route('get.delete.email', $email->id) }}" type="button" class="btn btn-danger btn-xs"><i class="fa fa-trash" aria-hidden="true"></i> Delete </a></td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>

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

@endsection

@section('scripts')


    <script>
        $(document).ready(function() {
            $("#editProfileID").click(function(e) {
                e.preventDefault();

                $($(this).attr('href')).attr('aria-expanded', 'true');

            });
        });
    </script>


@endsection