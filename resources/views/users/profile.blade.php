@extends('layout')

@section('title', 'My Profile')

@section('content')
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title"> My Profile </h3>
            <!-- END PAGE TITLE-->
            <!-- BEGIN PAGE BAR -->
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('home')}}">Dashboard</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>My Profile</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height default dropdown-toggle" data-toggle="dropdown"> Actions
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li>
                                <a href="{{route('home')}}">
                                    <i class="icon-action-undo"></i> Back to Dashboard</a>
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
                        <i class="icon-equalizer font-red-sunglo"></i>
                        <span class="caption-subject font-red-sunglo bold uppercase">Edit profile form</span>
                    </div>
                </div>
                @include('success')
                @include('errors')
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    {{Form::open(['route' => 'profile.update', 'id' => 'profile_form', 'files' => true, 'class' => 'horizontal-form'])}}
                    <div class="form-body">
                        <h3 class="form-section">Person Info</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">First Name</label>
                                    <input type="text" name="firstname" id="firstname" value="{{$user->firstname}}" maxlength="40" class="form-control" placeholder="First Name">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Last Name</label>
                                    <input type="text" name="lastname" id="lastname" value="{{$user->lastname}}" maxlength="40" class="form-control" placeholder="Last Name">
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">E-mail</label>
                                    <input type="text" name="email" id="email" value="{{$user->email}}" maxlength="191" class="form-control" placeholder="E-mail">
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <h3 class="form-section">Person Photo</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <span class="btn green btn-file">
                                        <span class="fileinput-new"> Select file </span>
                                        <span class="fileinput-exists"> Change </span>
                                        <input type="file" name="photo"> </span>
                                    <span class="fileinput-filename"> </span> &nbsp;
                                    <a href="javascript:;" class="close fileinput-exists" data-dismiss="fileinput"> </a>
                                </div>
                            </div>
                            @isset ($user->photo)
                                <div class="col-md-6">
                                    <div class="thumbnail">
                                        <img src="{{$user->getUserPhotoPath()}}" alt="{{$user->firstname . ' ' . $user->lastname}}" border="0">
                                    </div>
                                </div>
                            @endisset
                        </div>
                    </div>
                    <div class="form-actions left">
                        <a href="{{route('home')}}" class="btn default">Cancel</a>
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