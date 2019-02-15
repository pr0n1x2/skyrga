@extends('layout')

@section('title', 'Edit Project')

@section('content')
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title"> Edit Project Page </h3>
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
                        <span>Edit Project Page</span>
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
                        <span class="caption-subject font-red-sunglo bold uppercase">Edit project form</span>
                    </div>
                </div>
                @include('errors')
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    {{Form::open(['route' => ['projects.update', $project->id], 'method' => 'put', 'id' => 'projects_form', 'files' => true, 'class' => 'horizontal-form'])}}
                    <div class="form-body">
                        <h3 class="form-section">General Project Info</h3>
                        <div class="row">
                            <div class="col-md-6">
                                @php
                                    $domain = $project->domain->scheme->name . $project->domain->domain;
                                @endphp
                                <div class="alert alert-info">
                                    <strong>Domain: </strong> <a href="{{$domain}}" target="_blank">{{$domain}}</a>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="alert alert-info">
                                    <a href="/hrefs/{{$project->href_id}}" target="_blank" class="btn btn-xs purple"> <i class="fa fa-external-link"></i> Analyze Link </a>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Register Page</label>
                                    <input type="text" name="register_page" id="register_page" value="{{$project->register_page}}" maxlength="191" class="form-control" placeholder="Register Page">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Login Page</label>
                                    <input type="text" name="login_page" id="login_page" value="{{$project->login_page}}" maxlength="191" class="form-control" placeholder="Login Page">
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <h3 class="form-section">Registration Settings</h3>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">No registration required</label>
                                    <div class="checkbox-list">
                                        <input type="checkbox" name="is_no_need_login" @if ($project->is_no_need_login) checked @endif class="make-switch" id="is_no_need_login">
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Need to register without the use of Ubot</label>
                                    <div class="checkbox-list">
                                        <input type="checkbox" name="is_login_by_himself" @if ($project->is_login_by_himself) checked @endif class="make-switch" id="is_login_by_himself">
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Use Proxy</label>
                                    <div class="checkbox-list">
                                        <input type="checkbox" name="is_use_proxy" @if ($project->is_use_proxy) checked @endif class="make-switch" id="is_use_proxy">
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Special Instructions</label>
                                    <textarea name="login_instructions" id="login_instructions" class="form-control" placeholder="Special Instructions" rows="8">{{$project->login_instructions}}</textarea>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Youtube Link</label>
                                    <input type="text" name="login_youtube" id="login_youtube" value="{{$project->login_youtube}}" maxlength="15" class="form-control" placeholder="Youtube Link">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Use Single Account</label>
                                    <div class="checkbox-list">
                                        <input type="checkbox" name="is_use_single_account" @if ($project->is_use_single_account) checked @endif class="make-switch" id="is_use_single_account">
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Public Account</label>
                                    {{Form::select('account_id', $accounts, $project->account_id, ['placeholder' => 'Pick a Public Account', 'class' => 'form-control', 'tabindex' => 1])}}
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Generate Random Address</label>
                                    <div class="checkbox-list">
                                        <input type="checkbox" name="is_generate_address" @if ($project->is_generate_address) checked @endif class="make-switch" id="is_generate_address">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Generate Random Phone</label>
                                    <div class="checkbox-list">
                                        <input type="checkbox" name="is_generate_phone" @if ($project->is_generate_phone) checked @endif class="make-switch" id="is_generate_phone">
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Use Email As Username</label>
                                    <div class="checkbox-list">
                                        <input type="checkbox" name="is_use_email_as_username" @if ($project->is_use_email_as_username) checked @endif class="make-switch" id="is_use_email_as_username">
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Use Domain Word As Username</label>
                                    <div class="checkbox-list">
                                        <input type="checkbox" name="is_use_domainword_as_username" @if ($project->is_use_domainword_as_username) checked @endif class="make-switch" id="is_use_domainword_as_username">
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Separate Password</label>
                                    <div class="checkbox-list">
                                        <input type="checkbox" name="is_same_password" @if ($project->is_same_password) checked @endif class="make-switch" id="is_easy_password">
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Separate Username</label>
                                    <div class="checkbox-list">
                                        <input type="checkbox" name="is_same_username" @if ($project->is_same_username) checked @endif class="make-switch" id="is_easy_password">
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Use Easy Password</label>
                                    <div class="checkbox-list">
                                        <input type="checkbox" name="is_easy_password" @if ($project->is_easy_password) checked @endif class="make-switch" id="is_easy_password">
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Use Only Main Anchor</label>
                                    <div class="checkbox-list">
                                        <input type="checkbox" name="is_use_main_anchor" @if ($project->is_use_main_anchor) checked @endif class="make-switch" id="is_use_main_anchor">
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Post Date After Registration</label>
                                    <input type="text" name="post_date" id="post_date" value="{{$project->post_date}}" maxlength="2" class="form-control" placeholder="">
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <h3 class="form-section">Login Settings</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Special Instructions</label>
                                    <textarea name="sing_in_instructions" id="sing_in_instructions" class="form-control" placeholder="Special Instructions" rows="8">{{$project->sing_in_instructions}}</textarea>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Youtube Link</label>
                                    <input type="text" name="sing_in_youtube" id="sing_in_youtube" value="{{$project->sing_in_youtube}}" maxlength="15" class="form-control" placeholder="Youtube Link">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">No login required</label>
                                    <div class="checkbox-list">
                                        <input type="checkbox" name="is_no_need_sing_in" @if ($project->is_no_need_sing_in) checked @endif class="make-switch" id="is_no_need_sing_in">
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Need to login without the use of Ubot</label>
                                    <div class="checkbox-list">
                                        <input type="checkbox" name="is_sing_in_by_himself" @if ($project->is_sing_in_by_himself) checked @endif class="make-switch" id="is_sing_in_by_himself">
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <h3 class="form-section">Post Settings</h3>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">No post required</label>
                                    <div class="checkbox-list">
                                        <input type="checkbox" name="is_no_need_post" @if ($project->is_no_need_post) checked @endif class="make-switch" id="is_no_need_post">
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Need to post without the use of Ubot</label>
                                    <div class="checkbox-list">
                                        <input type="checkbox" name="is_post_by_himself" @if ($project->is_post_by_himself) checked @endif class="make-switch" id="is_post_by_himself">
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Special Instructions</label>
                                    <textarea name="post_instructions" id="post_instructions" class="form-control" placeholder="Special Instructions" rows="8">{{$project->post_instructions}}</textarea>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Youtube Link</label>
                                    <input type="text" name="post_youtube" id="post_youtube" value="{{$project->post_youtube}}" maxlength="15" class="form-control" placeholder="Youtube Link">
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Use Post</label>
                                    <div class="checkbox-list">
                                        <input type="checkbox" name="is_use_post" @if ($project->is_use_post) checked @endif class="make-switch" id="is_use_post">
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Use Images In Post</label>
                                    <div class="checkbox-list">
                                        <input type="checkbox" name="is_use_images" @if ($project->is_use_images) checked @endif class="make-switch" id="is_use_images">
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Use Videos In Post</label>
                                    <div class="checkbox-list">
                                        <input type="checkbox" name="is_use_videos" @if ($project->is_use_videos) checked @endif class="make-switch" id="is_use_videos">
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
                                    <input type="text" name="paragraph_frame" id="paragraph_frame" value="{{$project->paragraph_frame}}" maxlength="191" class="form-control" placeholder="Paragraph Frame">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Link Frame</label>
                                    <input type="text" name="link_frame" id="link_frame" value="{{$project->link_frame}}" maxlength="191" class="form-control" placeholder="Link Frame">
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Image Frame</label>
                                    <input type="text" name="image_frame" id="image_frame" value="{{$project->image_frame}}" maxlength="191" class="form-control" placeholder="Image Frame">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Video Frame</label>
                                    <input type="text" name="video_frame" id="video_frame" value="{{$project->video_frame}}" maxlength="191" class="form-control" placeholder="Video frame">
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Heading Frame</label>
                                    <input type="text" name="heading_frame" id="heading_frame" value="{{$project->heading_frame}}" maxlength="191" class="form-control" placeholder="Heading frame">
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Link Location In Paragraph</label>
                                    <input type="text" name="paragraph_link" id="paragraph_link" value="{{$project->paragraph_link}}" maxlength="1" class="form-control" placeholder="">
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
                                    <textarea name="state_associations" id="state_associations" class="form-control" placeholder="State Associations" rows="6">{{$project->state_associations}}</textarea>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <h3 class="form-section">Materials</h3>
                        <div class="row">
                            <div class="col-md-2">
                                <label class="control-label">Attach a file
                                    <br />
                                    @if ($project->materials)
                                        <a href="/projects/download/{{$project->id}}">download</a>
                                    @else
                                        <em>not uploaded</em>
                                    @endif
                                </label>
                            </div>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <span class="btn green btn-file">
                                            <span class="fileinput-new"> Select file </span>
                                            <span class="fileinput-exists"> Change </span>
                                            <input type="file" name="materials"> </span>
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
                        <input type="hidden" name="domain_id" value="{{$project->domain_id}}">
                        <input type="hidden" name="href_id" value="{{$project->href_id}}">
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