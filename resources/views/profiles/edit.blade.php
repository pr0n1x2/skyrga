@extends('layout')

@section('title', 'Edit Profile')

@section('content')
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title"> Edit Profile Page </h3>
            <!-- END PAGE TITLE-->
            <!-- BEGIN PAGE BAR -->
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('home')}}">Dashboard</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="{{route('profiles.index')}}">List of Profiles</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Edit Profile Page</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height default dropdown-toggle" data-toggle="dropdown"> Actions
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li>
                                <a href="{{route('profiles.index')}}">
                                    <i class="icon-action-undo"></i> Back to Profiles</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- END PAGE BAR -->
            <!-- END PAGE HEADER-->
            <div class="portlet light bg-inverse">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-sitemap font-red-sunglo"></i>
                        <span class="caption-subject font-red-sunglo bold uppercase">Edit profile form</span>
                    </div>
                </div>
                @include('errors')
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    {{Form::open(['route' => ['profiles.update', $profile->id], 'method' => 'put', 'id' => 'profiles_form', 'class' => 'horizontal-form'])}}
                    <div class="form-body">
                        <h3 class="form-section">General Profile Info</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <input type="text" name="name" id="name" value="{{$profile->name}}" maxlength="70" class="form-control" placeholder="Name">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Domain</label>
                                    <input type="text" name="domain" id="domain" value="{{$profile->domain}}" maxlength="70" class="form-control" placeholder="Domain">
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">E-mail Account</label>
                                    {{Form::select('mail_account_id', $accounts, $profile->mail_account_id, ['placeholder' => 'Pick a E-mail Account', 'class' => 'form-control', 'tabindex' => 1])}}
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Reserve E-mail Account (optional)</label>
                                    {{Form::select('reserve_mail_account_id', $accounts, $profile->reserve_mail_account_id, ['placeholder' => 'Pick a E-mail Account', 'class' => 'form-control', 'tabindex' => 1])}}
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Group</label>
                                    {{Form::select('group_id', $groups, $profile->group_id, ['placeholder' => 'Pick a Group', 'class' => 'form-control', 'tabindex' => 1])}}
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <h3 class="form-section">Gmail Info</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Gmail</label>
                                    <input type="text" name="gmail" id="gmail" value="{{$profile->gmail}}" maxlength="191" class="form-control" placeholder="Gmail">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Gmail Password</label>
                                    <input type="text" name="gmail_password" id="gmail_password" value="{{$profile->gmail_password}}" maxlength="40" class="form-control" placeholder="Gmail Password">
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <h3 class="form-section">Profile Address Info</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Business Name</label>
                                    <input type="text" name="business_name" id="business_name" value="{{$profile->business_name}}" maxlength="140" class="form-control" placeholder="Business Name">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Business Phone</label>
                                    <input type="text" name="phone" id="phone" value="{{$profile->phone}}" maxlength="20" class="form-control" placeholder="+1(123)-123-45-6789">
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Address</label>
                                    <input type="text" name="address1" id="address1" value="{{$profile->address1}}" maxlength="60" class="form-control" placeholder="Address">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Address 2 (optional)</label>
                                    <input type="text" name="address2" id="address2" value="{{$profile->address2}}" maxlength="60" class="form-control" placeholder="Address">
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">State</label>
                                    <input type="text" name="state" id="state" value="{{$profile->state}}" maxlength="30" class="form-control" placeholder="State">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">State Shortcode</label>
                                    <input type="text" name="state_shortcode" id="state_shortcode" value="{{$profile->state_shortcode}}" maxlength="2" class="form-control" placeholder="">
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">City</label>
                                    <input type="text" name="city" id="city" value="{{$profile->city}}" maxlength="40" class="form-control" placeholder="City">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Zip</label>
                                    <input type="text" name="zip" id="zip" value="{{$profile->zip}}" maxlength="10" class="form-control" placeholder="Zip">
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <h3 class="form-section">Security Answers</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Mother's Maiden Name</label>
                                    <input type="text" name="security_answer_mother" id="security_answer_mother" value="{{$profile->security_answer_mother}}" maxlength="30" class="form-control" placeholder="Answer">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Pet's Name</label>
                                    <input type="text" name="security_answer_pet" id="security_answer_pet" value="{{$profile->security_answer_pet}}" maxlength="30" class="form-control" placeholder="Answer">
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <h3 class="form-section">Blog Info</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Blog Name</label>
                                    <textarea name="blog_name" id="blog_name" class="form-control" placeholder="Spin Blog Name" rows="5">{{$profile->blog_name}}</textarea>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">About</label>
                                    <textarea name="about" id="about" class="form-control" placeholder="Spin About" rows="5">{{$profile->about}}</textarea>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Anchor</label>
                                    <textarea name="anchor" id="anchor" class="form-control" placeholder="Spin Anchor" rows="5">{{$profile->anchor}}</textarea>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Main Anchor</label>
                                    <textarea name="main_anchor" id="main_anchor" class="form-control" placeholder="Spin Main Anchor" rows="5">{{$profile->main_anchor}}</textarea>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <h3 class="form-section">Proxy Info</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Proxy</label>
                                    <input type="text" name="proxy" id="proxy" value="{{$profile->proxy}}" maxlength="80" class="form-control" placeholder="Proxy">
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <h3 class="form-section">Custom Fields</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Field 1 (optional)</label>
                                    <input type="text" name="field1" id="field1" value="{{$profile->field1}}" maxlength="191" class="form-control" placeholder="Value">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Field 2 (optional)</label>
                                    <input type="text" name="field2" id="field2" value="{{$profile->field2}}" maxlength="191" class="form-control" placeholder="Value">
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Field 3 (optional)</label>
                                    <input type="text" name="field3" id="field3" value="{{$profile->field3}}" maxlength="191" class="form-control" placeholder="Value">
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <h3 class="form-section">Profile Status</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Active</label>
                                    <div class="checkbox-list">
                                        <input type="checkbox" name="is_deleted" @if (!$profile->is_deleted) checked @endif class="make-switch" id="is_deleted">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <div class="form-actions left">
                        <a href="{{route('profiles.index')}}" class="btn default">Cancel</a>
                        <button type="submit" class="btn blue">
                            <i class="fa fa-check"></i> Save</button>
                    </div>
                    {{Form::close()}}
                <!-- END FORM-->
                </div>
            </div>
        </div>
        <!-- END CONTENT BODY -->
    </div>
@endsection