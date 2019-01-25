@extends('layout')

@section('title', 'Create New Project')

@section('content')
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title"> Create New Project Page </h3>
            <!-- END PAGE TITLE-->
            <!-- BEGIN PAGE BAR -->
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('home')}}">Dashboard</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="{{route('projects.index')}}">List of Projects</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Create New Project Page</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height default dropdown-toggle" data-toggle="dropdown"> Actions
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li>
                                <a href="{{route('projects.index')}}">
                                    <i class="icon-action-undo"></i> Back to Projects</a>
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
                        <i class="fa fa-gears font-red-sunglo"></i>
                        <span class="caption-subject font-red-sunglo bold uppercase">Create new project form</span>
                    </div>
                </div>
                @include('errors')
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    {{Form::open(['route' => 'projects.store', 'id' => 'projects_form', 'files' => true, 'class' => 'horizontal-form'])}}
                    <div class="form-body">
                        <h3 class="form-section">General Project Info</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <input type="text" name="name" id="name" value="{{old('name')}}" maxlength="70" class="form-control" placeholder="Name">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Domain</label>
                                    <input type="text" name="domain" id="domain" value="{{old('domain')}}" maxlength="70" class="form-control" placeholder="Domain">
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Register Page</label>
                                    <input type="text" name="register_page" id="register_page" value="{{old('register_page')}}" maxlength="191" class="form-control" placeholder="Register Page">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Login Page</label>
                                    <input type="text" name="login_page" id="login_page" value="{{old('login_page')}}" maxlength="191" class="form-control" placeholder="Login Page">
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <h3 class="form-section">Profile Settings</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Use Proxy</label>
                                    <div class="checkbox-list">
                                        <input type="checkbox" name="is_use_proxy" @if (old('is_use_proxy')) checked @endif class="make-switch" id="is_use_proxy">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Generate Random Address</label>
                                    <div class="checkbox-list">
                                        <input type="checkbox" name="is_generate_address" @if (old('is_generate_address')) checked @endif class="make-switch" id="is_generate_address">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/row-->
                        <div class="row">
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Separate Username</label>
                                    <div class="checkbox-list">
                                        <input type="checkbox" name="is_same_username" @if (old('is_same_username')) checked @endif class="make-switch" id="is_easy_password">
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Separate Password</label>
                                    <div class="checkbox-list">
                                        <input type="checkbox" name="is_same_password" @if (old('is_same_password')) checked @endif class="make-switch" id="is_easy_password">
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Use Easy Password</label>
                                    <div class="checkbox-list">
                                        <input type="checkbox" name="is_easy_password" @if (old('is_easy_password')) checked @endif class="make-switch" id="is_easy_password">
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Generate Random Phone</label>
                                    <div class="checkbox-list">
                                        <input type="checkbox" name="is_generate_phone" @if (old('is_generate_phone')) checked @endif class="make-switch" id="is_generate_phone">
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Use Email As Username</label>
                                    <div class="checkbox-list">
                                        <input type="checkbox" name="is_use_email_as_username" @if (old('is_use_email_as_username')) checked @endif class="make-switch" id="is_use_email_as_username">
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Use Domain Word As Username</label>
                                    <div class="checkbox-list">
                                        <input type="checkbox" name="is_use_domainword_as_username" @if (old('is_use_domainword_as_username')) checked @endif class="make-switch" id="is_use_domainword_as_username">
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Use Only Main Anchor</label>
                                    <div class="checkbox-list">
                                        <input type="checkbox" name="is_use_main_anchor" @if (old('is_use_main_anchor')) checked @endif class="make-switch" id="is_use_main_anchor">
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Post Date After Registration</label>
                                    <input type="text" name="post_date" id="post_date" value="{{old('post_date')}}" maxlength="2" class="form-control" placeholder="">
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <h3 class="form-section">Post Settings</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Use Post</label>
                                    <div class="checkbox-list">
                                        <input type="checkbox" name="is_use_post" @if (old('is_use_post')) checked @endif class="make-switch" id="is_use_post">
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Use Images In Post</label>
                                    <div class="checkbox-list">
                                        <input type="checkbox" name="is_use_images" @if (old('is_use_images')) checked @endif class="make-switch" id="is_use_images">
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Use Videos In Post</label>
                                    <div class="checkbox-list">
                                        <input type="checkbox" name="is_use_videos" @if (old('is_use_videos')) checked @endif class="make-switch" id="is_use_videos">
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Paragraph Frame</label>
                                    <input type="text" name="paragraph_frame" id="paragraph_frame" value="{{old('paragraph_frame')}}" maxlength="191" class="form-control" placeholder="Paragraph Frame">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Link Frame</label>
                                    <input type="text" name="link_frame" id="link_frame" value="{{old('link_frame')}}" maxlength="191" class="form-control" placeholder="Link Frame">
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Image Frame</label>
                                    <input type="text" name="image_frame" id="image_frame" value="{{old('image_frame')}}" maxlength="191" class="form-control" placeholder="Image Frame">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Video Frame</label>
                                    <input type="text" name="video_frame" id="video_frame" value="{{old('video_frame')}}" maxlength="191" class="form-control" placeholder="Video frame">
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Link Location In Paragraph</label>
                                    <input type="text" name="paragraph_link" id="paragraph_link" value="{{old('paragraph_link')}}" maxlength="1" class="form-control" placeholder="">
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <h3 class="form-section">Associations</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">State Associations</label>
                                    <textarea name="state_associations" id="state_associations" class="form-control" placeholder="State Associations" rows="6">{{old('state_associations')}}</textarea>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <h3 class="form-section">Ubot Files</h3>
                        <div class="row">
                            <div class="col-md-2">
                                <label class="control-label">Register Script</label>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <span class="btn green btn-file">
                                            <span class="fileinput-new"> Select file </span>
                                            <span class="fileinput-exists"> Change </span>
                                            <input type="file" name="login_file"> </span>
                                        <span class="fileinput-filename"> </span> &nbsp;
                                        <a href="javascript:;" class="close fileinput-exists" data-dismiss="fileinput"> </a>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-2">
                                <label class="control-label">Login Script</label>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <span class="btn green btn-file">
                                            <span class="fileinput-new"> Select file </span>
                                            <span class="fileinput-exists"> Change </span>
                                            <input type="file" name="singin_file"> </span>
                                        <span class="fileinput-filename"> </span> &nbsp;
                                        <a href="javascript:;" class="close fileinput-exists" data-dismiss="fileinput"> </a>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-2">
                                <label class="control-label">Posting Script</label>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <span class="btn green btn-file">
                                            <span class="fileinput-new"> Select file </span>
                                            <span class="fileinput-exists"> Change </span>
                                            <input type="file" name="post_file"> </span>
                                        <span class="fileinput-filename"> </span> &nbsp;
                                        <a href="javascript:;" class="close fileinput-exists" data-dismiss="fileinput"> </a>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                    </div>
                    <div class="form-actions left">
                        <a href="{{route('projects.index')}}" class="btn default">Cancel</a>
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