@extends('layout')

@section('title', 'Edit Account')

@section('content')
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title"> Edit Account Page </h3>
            <!-- END PAGE TITLE-->
            <!-- BEGIN PAGE BAR -->
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('home')}}">Dashboard</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="{{route('accounts.index')}}">List of Public Accounts</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Edit Account Page</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height default dropdown-toggle" data-toggle="dropdown"> Actions
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li>
                                <a href="{{route('accounts.index')}}">
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
                        <i class="fa fa-user-plus font-red-sunglo"></i>
                        <span class="caption-subject font-red-sunglo bold uppercase">Edit account form</span>
                    </div>
                </div>
                @include('errors')
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    {{Form::open(['route' => ['accounts.update', $account->id], 'method' => 'put', 'id' => 'accounts_form', 'class' => 'horizontal-form'])}}
                    <div class="form-body">
                        <h3 class="form-section">General Account Info</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">E-mail Account</label>
                                    {{Form::select('mail_account_id', $reserveEmails, $account->mail_account_id, ['placeholder' => 'Pick a E-mail Account', 'class' => 'form-control', 'tabindex' => 1])}}
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Gender</label>
                                    {{Form::select('gender', ['male' => 'Male', 'female' => 'Female'], $account->gender, ['placeholder' => 'Pick a Gender', 'class' => 'form-control', 'tabindex' => 2])}}
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Username</label>
                                    <input type="text" name="username" id="username" value="{{$account->username}}" maxlength="40" class="form-control" placeholder="Username">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Password</label>
                                    <input type="text" name="password" id="password" value="{{$account->password}}" maxlength="25" class="form-control" placeholder="Password">
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Firstname</label>
                                    <input type="text" name="firstname" id="firstname" value="{{$account->firstname}}" maxlength="25" class="form-control" placeholder="Firstname">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Lastname</label>
                                    <input type="text" name="lastname" id="lastname" value="{{$account->lastname}}" maxlength="25" class="form-control" placeholder="Lastname">
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Prefix</label>
                                    <input type="text" name="prefix" id="prefix" value="{{$account->prefix}}" maxlength="10" class="form-control" placeholder="Ms. or Mr.">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Middlename</label>
                                    <input type="text" name="middlename" id="middlename" value="{{$account->middlename}}" maxlength="25" class="form-control" placeholder="Middlename">
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Birthday</label>
                                    <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd">
                                        <input type="text" name="birthday" id="birthday" value="{{$account->birthday}}" class="form-control" readonly>
                                        <span class="input-group-btn">
                                        <button class="btn default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <h3 class="form-section">Account Address Info</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Address</label>
                                    <input type="text" name="address1" id="address1" value="{{$account->address1}}" maxlength="60" class="form-control" placeholder="Address">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Address 2 (optional)</label>
                                    <input type="text" name="address2" id="address2" value="{{$account->address2}}" maxlength="60" class="form-control" placeholder="Address">
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">State</label>
                                    <input type="text" name="state" id="state" value="{{$account->state}}" maxlength="30" class="form-control" placeholder="State">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">State Shortcode</label>
                                    <input type="text" name="state_shortcode" id="state_shortcode" value="{{$account->state_shortcode}}" maxlength="2" class="form-control" placeholder="">
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">City</label>
                                    <input type="text" name="city" id="city" value="{{$account->city}}" maxlength="40" class="form-control" placeholder="City">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Zip</label>
                                    <input type="text" name="zip" id="zip" value="{{$account->zip}}" maxlength="10" class="form-control" placeholder="Zip">
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Phone</label>
                                    <input type="text" name="phone" id="phone" value="{{$account->phone}}" maxlength="20" class="form-control" placeholder="+1(123)-123-6789">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Domain Word</label>
                                    <input type="text" name="domain_word" id="domain_word" value="{{$account->domain_word}}" maxlength="40" class="form-control" placeholder="Domain word">
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                    </div>
                    <div class="form-actions left">
                        <a href="{{route('accounts.index')}}" class="btn default">Cancel</a>
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