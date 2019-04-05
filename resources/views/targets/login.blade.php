@php
    $singinRequired = true;
    $runUbot = true;
    $ubotError = 0;

    if (!$target->is_register) {
        $runUbot = false;
        $ubotError = 4;
    }

    if ($target->project->is_sing_in_by_himself) {
        $runUbot = false;
        $ubotError = 5;
    }

    if ($target->project->is_no_need_sing_in) {
        $singinRequired = false;
        $runUbot = false;
        $ubotError = 6;
    }

    if ($target->is_login) {
        $ubotError = 7;
    }
@endphp
@extends('layout')

@section('title', 'Authorization')

@section('content')
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title"> Authorization </h3>
            <!-- END PAGE TITLE-->
            <!-- BEGIN PAGE BAR -->
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('home')}}">Dashboard</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="/targets/{{$date}}">List of Targets</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span> Authorization </span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height default dropdown-toggle" data-toggle="dropdown"> Actions
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li>
                                <a href="/targets/{{$date}}">
                                    <i class="icon-action-undo"></i> Back to Targets</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- END PAGE BAR -->
            @if(!$target->is_register)
                <div class="alert alert-danger">
                    <strong>Attention!</strong> You must first create an account and register.
                </div>
            @elseif($target->is_login)
                <div class="alert alert-success">
                    Authorization already completed.
                </div>
            @elseif(!$target->is_login && !$singinRequired)
                <div class="alert alert-info">
                    <strong>Information!</strong> For this domain authorization is not required.
                </div>
            @elseif(!$target->is_login && $singinRequired && !$runUbot)
                <div class="alert alert-danger">
                    <strong>Attention!</strong> You must authorize yourself without using a script.
                </div>
            @endif
            <!-- END PAGE HEADER-->
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet-body">
                        <div class="portlet light bg-inverse">
                            <div class="portlet-body form">
                                @if($target->is_register)
                                <!-- BEGIN FORM-->
                                {{Form::open(['route' => ['targets.update', $target->id], 'method' => 'put', 'id' => 'targets_register_form', 'class' => 'horizontal-form'])}}
                                <div class="form-body">
                                    @php
                                        $isEditable = false;
                                    @endphp
                                    <h3 class="form-section">Profile Info</h3>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label"><strong>Name:</strong></label>
                                                {{$target->profile->name}}
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Domain:</label>
                                                <a href="{{$target->profile->domain}}" class="editable-field" target="_blank"><i class="fa fa-external-link"></i> {{$target->profile->domain}}</a>
                                                <a href="javascript:;" class="btn btn-xs default copy-data copy-attr" data-field="profile-domain">
                                                    <i class="fa fa-clipboard"></i> copy
                                                </a>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label"><strong>E-mail:</strong></label>
                                                @if($isEditable)
                                                    <a href="javascript:;" class="editable-field" id="email" data-type="select" data-pk="{{$account->id}}" data-value="{{$target->getEmailID()}}" data-url="/accounts/email" data-source="/mail-accounts/get-reserve-emails">{{$target->getEmail()}}</a>
                                                @else
                                                    <span class="not_editable">{{$target->getEmail()}}</span>
                                                @endif
                                                <a href="javascript:;" class="btn btn-xs default copy-data" data-field="email">
                                                    <i class="fa fa-clipboard"></i> copy
                                                </a>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">E-mail Login Page:</label>
                                                <a href="{{$account->email->login_page}}" class="editable-field" target="_blank"><i class="fa fa-external-link"></i> Open login page</a>
                                                <a href="javascript:;" class="btn btn-xs default copy-data copy-attr" data-field="emaillogpage">
                                                    <i class="fa fa-clipboard"></i> copy
                                                </a>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">E-mail Login:</label>
                                                <span class="not_editable">{{$account->email->account_name}}</span>
                                                <a href="javascript:;" class="btn btn-xs default copy-data copy-attr" data-field="emaillogin">
                                                    <i class="fa fa-clipboard"></i> copy
                                                </a>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">E-mail Password:</label>
                                                <span class="not_editable">{{$account->email->password}}</span>
                                                <a href="javascript:;" class="btn btn-xs default copy-data copy-attr" data-field="emailpass">
                                                    <i class="fa fa-clipboard"></i> copy
                                                </a>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                    @if (!empty($target->project->login_instructions))
                                        <h3 class="form-section">Special Instructions</h3>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="note note-danger">
                                                    <p>{!!nl2br($target->project->login_instructions)!!}</p>
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                    @endif
                                    @if (!empty($target->project->login_youtube))
                                        <h3 class="form-section">YouTube Video</h3>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <a href="https://www.youtube.com/watch?v={{$target->project->login_youtube}}" class="editable-field" target="_blank">
                                                        <i class="fa fa-youtube-play font-red-thunderbird"></i> Watch Video On YouTube
                                                    </a>
                                                    <a href="javascript:;" class="btn btn-xs default copy-data copy-attr" data-field="youtube">
                                                        <i class="fa fa-clipboard"></i> copy
                                                    </a>
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                    @endif
                                    <h3 class="form-section">Donor Info</h3>
                                    <div class="row">
                                        @if (!empty($target->project->login_page))
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label"><strong>Login page:</strong></label>
                                                    <a href="{{$target->project->login_page}}" class="editable-field" target="_blank"><i class="fa fa-external-link"></i> Open login page</a>
                                                    <a href="javascript:;" class="btn btn-xs default copy-data copy-attr" data-field="logpage">
                                                        <i class="fa fa-clipboard"></i> copy
                                                    </a>
                                                </div>
                                            </div>
                                            <!--/span-->
                                        @endif
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                @php
                                                    $domain = $target->project->domain->scheme->name . $target->project->domain->domain;
                                                @endphp
                                                <label class="control-label">Domain:</label>
                                                <a href="{{$domain}}" class="editable-field" target="_blank"><i class="fa fa-external-link"></i> {{$domain}}</a>
                                                <a href="javascript:;" class="btn btn-xs default copy-data copy-attr" data-field="domain">
                                                    <i class="fa fa-clipboard"></i> copy
                                                </a>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        @if (!empty($target->project->materials))
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Materials:</label>
                                                    <a href="{{route('projects.download', $target->project_id)}}"><i class="fa fa-download"></i> Download materials</a>
                                                </div>
                                            </div>
                                            <!--/span-->
                                        @endif
                                    </div>
                                    <!--/row-->
                                    <h3 class="form-section">Account Info</h3>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label label-bold">Authorization Data</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Username:</label>
                                                @if($isEditable)
                                                    <a href="#" class="editable-field" id="username" data-type="text" data-pk="{{$account->id}}" data-url="/accounts/username" data-title="Enter username">{{$account->username}}</a>
                                                @else
                                                    <span class="not_editable">{{$account->username}}</span>
                                                @endif
                                                <a href="javascript:;" class="btn btn-xs default copy-data" data-field="username">
                                                    <i class="fa fa-clipboard"></i> copy
                                                </a>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Password:</label>
                                                @if($isEditable)
                                                    <a href="#" class="editable-field" id="password" data-type="text" data-pk="{{$account->id}}" data-url="/accounts/password" data-title="Enter password">{{$account->password}}</a>
                                                @else
                                                    <span class="not_editable">{{$account->password}}</span>
                                                @endif
                                                <a href="javascript:;" class="btn btn-xs default copy-data" data-field="password">
                                                    <i class="fa fa-clipboard"></i> copy
                                                </a>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label label-bold">Person Data</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Prefix:</label>
                                                @if($isEditable)
                                                    <a href="javascript:;" class="editable-field" id="prefix" data-type="select" data-pk="{{$account->id}}" data-url="/accounts/prefix" data-value="{{$account->prefix}}">{{$account->prefix}}</a>
                                                @else
                                                    <span class="not_editable">{{$account->prefix}}</span>
                                                @endif
                                                <a href="javascript:;" class="btn btn-xs default copy-data" data-field="prefix">
                                                    <i class="fa fa-clipboard"></i> copy
                                                </a>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Gender:</label>
                                                @if($isEditable)
                                                    <a href="javascript:;" class="editable-field" id="gender" data-type="select" data-pk="{{$account->id}}" data-url="/accounts/gender" data-value="{{$account->gender}}">{{$account->gender}}</a>
                                                @else
                                                    <span class="not_editable">{{$account->gender}}</span>
                                                @endif
                                                <a href="javascript:;" class="btn btn-xs default copy-data" data-field="gender">
                                                    <i class="fa fa-clipboard"></i> copy
                                                </a>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Birthday:</label>
                                                <span>{{(\Carbon\Carbon::createFromFormat('Y-m-d', $account->birthday))->format('d F Y')}}</span>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">First Name:</label>
                                                @if($isEditable)
                                                    <a href="#" class="editable-field" id="firstname" data-type="text" data-pk="{{$account->id}}" data-url="/accounts/firstname" data-title="Enter firstname">{{$account->firstname}}</a>
                                                @else
                                                    <span class="not_editable">{{$account->firstname}}</span>
                                                @endif
                                                <a href="javascript:;" class="btn btn-xs default copy-data" data-field="firstname">
                                                    <i class="fa fa-clipboard"></i> copy
                                                </a>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Last Name:</label>
                                                @if($isEditable)
                                                    <a href="#" class="editable-field" id="lastname" data-type="text" data-pk="{{$account->id}}" data-url="/accounts/lastname" data-title="Enter lastname">{{$account->lastname}}</a>
                                                @else
                                                    <span class="not_editable">{{$account->lastname}}</span>
                                                @endif
                                                <a href="javascript:;" class="btn btn-xs default copy-data" data-field="lastname">
                                                    <i class="fa fa-clipboard"></i> copy
                                                </a>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Middle Name:</label>
                                                @if($isEditable)
                                                    <a href="#" class="editable-field" id="middlename" data-type="text" data-pk="{{$account->id}}" data-url="/accounts/middlename" data-title="Enter middlename">{{$account->middlename}}</a>
                                                @else
                                                    <span class="not_editable">{{$account->middlename}}</span>
                                                @endif
                                                <a href="javascript:;" class="btn btn-xs default copy-data" data-field="middlename">
                                                    <i class="fa fa-clipboard"></i> copy
                                                </a>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Position:</label>
                                                <span class="not_editable">{{$target->profile->position}}</span>
                                                <a href="javascript:;" class="btn btn-xs default copy-data copy-attr" data-field="position">
                                                    <i class="fa fa-clipboard"></i> copy
                                                </a>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label label-bold">Address</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">City:</label>
                                                @if($isEditable)
                                                    <a href="#" class="editable-field" id="city" data-type="text" data-pk="{{$account->id}}" data-url="/accounts/city" data-title="Enter city">{{$account->city}}</a>
                                                @else
                                                    <span class="not_editable">{{$account->city}}</span>
                                                @endif
                                                <a href="javascript:;" class="btn btn-xs default copy-data" data-field="city">
                                                    <i class="fa fa-clipboard"></i> copy
                                                </a>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Address 1:</label>
                                                @if($isEditable)
                                                    <a href="#" class="editable-field" id="address1" data-type="text" data-pk="{{$account->id}}" data-url="/accounts/address1" data-title="Enter address1">{{$account->address1}}</a>
                                                @else
                                                    <span class="not_editable">{{$account->address1}}</span>
                                                @endif
                                                <a href="javascript:;" class="btn btn-xs default copy-data" data-field="address1">
                                                    <i class="fa fa-clipboard"></i> copy
                                                </a>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Address 2:</label>
                                                @if($isEditable)
                                                    <a href="#" class="editable-field" id="address2" data-type="text" data-pk="{{$account->id}}" data-url="/accounts/address2" data-title="Enter address2">{{$account->address2}}</a>
                                                @else
                                                    <span class="not_editable">{{$account->address2}}</span>
                                                @endif
                                                <a href="javascript:;" class="btn btn-xs default copy-data" data-field="address2">
                                                    <i class="fa fa-clipboard"></i> copy
                                                </a>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">State:</label>
                                                @if($isEditable)
                                                    <a href="javascript:;" class="editable-field" id="state" data-type="select" data-pk="{{$account->id}}" data-url="/accounts/state" data-value="{{$account->state_shortcode}}">{{$account->state}}</a>
                                                @else
                                                    <span class="not_editable">{{$account->state}}</span>
                                                @endif
                                                <a href="javascript:;" class="btn btn-xs default copy-data" data-field="state">
                                                    <i class="fa fa-clipboard"></i> copy
                                                </a>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Zip code:</label>
                                                @if($isEditable)
                                                    <a href="#" class="editable-field" id="zip" data-type="text" data-pk="{{$account->id}}" data-url="/accounts/zip" data-title="Enter zip">{{$account->zip}}</a>
                                                @else
                                                    <span class="not_editable">{{$account->zip}}</span>
                                                @endif
                                                <a href="javascript:;" class="btn btn-xs default copy-data" data-field="zip">
                                                    <i class="fa fa-clipboard"></i> copy
                                                </a>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Phone:</label>
                                                @if($isEditable)
                                                    <a href="#" class="editable-field" id="phone" data-type="text" data-pk="{{$account->id}}" data-url="/accounts/phone" data-title="Enter phone">{{$account->phone}}</a>
                                                @else
                                                    <span class="not_editable">{{$account->phone}}</span>
                                                @endif
                                                <a href="javascript:;" class="btn btn-xs default copy-data" data-field="phone">
                                                    <i class="fa fa-clipboard"></i> copy
                                                </a>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label label-bold">Company</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Name:</label>
                                                <span class="not_editable">{{$target->profile->business_name}}</span>
                                                <a href="javascript:;" class="btn btn-xs default copy-data copy-attr" data-field="company">
                                                    <i class="fa fa-clipboard"></i> copy
                                                </a>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label label-bold">Subdomain</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Domain word:</label>
                                                @if($isEditable)
                                                    <a href="#" class="editable-field" id="domain_word" data-type="text" data-pk="{{$account->id}}" data-url="/accounts/domainword" data-title="Enter domain word">{{$account->domain_word}}</a>
                                                @else
                                                    <span class="not_editable">{{$account->domain_word}}</span>
                                                @endif
                                                <a href="javascript:;" class="btn btn-xs default copy-data" data-field="domain_word">
                                                    <i class="fa fa-clipboard"></i> copy
                                                </a>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label label-bold">Google Account Data</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Login:</label>
                                                <span class="not_editable">{{$target->profile->gmail}}</span>
                                                <a href="javascript:;" class="btn btn-xs default copy-data copy-attr" data-field="google-login">
                                                    <i class="fa fa-clipboard"></i> copy
                                                </a>
                                            </div>
                                        </div>
                                        <!--/span-->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Password:</label>
                                                <span class="not_editable">{{$target->profile->gmail_password}}</span>
                                                <a href="javascript:;" class="btn btn-xs default copy-data copy-attr" data-field="google-pass">
                                                    <i class="fa fa-clipboard"></i> copy
                                                </a>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                    <h3 class="form-section">Authorization Status</h3>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Authorization Is Completed</label>
                                                <div class="checkbox-list">
                                                    <input type="checkbox" name="is_login" @if ($target->is_login)) checked @endif class="make-switch" id="is_login">
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                    </div>
                                    <!--/row-->
                                </div>
                                <div class="form-actions left">
                                    <input type="hidden" name="target-action" value="login">
                                    <input type="hidden" name="date" value="{{$date}}">
                                    <a href="/targets/{{$date}}" class="btn default">Cancel</a>
                                    <button type="submit" class="btn blue">
                                        <i class="fa fa-check"></i> Save</button>
                                </div>
                                {{Form::close()}}
                                <!-- END FORM-->
                                @endif
                                {{Form::open(['route' => 'targets.generate', 'id' => 'ubot_action_form', 'class' => 'horizontal-form'])}}
                                <input type="hidden" name="allow_ubot" value="1" />
                                <input type="hidden" name="error_ubot" value="{{$ubotError}}" />
                                <input type="hidden" name="target_id" value="{{$target->id}}" />
                                <input type="hidden" name="action" value="login" />
                                <input type="hidden" name="profile_path" value="{{$target->getProfileUbotPath()}}" />
                            <!--<input type="hidden" name="domain" value="{{$target->getDomainForUbot()}}" />-->
                                <input type="hidden" name="domain" value="own-free-website-com" />
                                {{Form::close()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END CONTENT BODY -->
    </div>
@endsection