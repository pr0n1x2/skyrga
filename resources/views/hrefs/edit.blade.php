@extends('layout')

@section('title', 'Edit Pending Domain')

@section('content')
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title"> Edit Pending Domain Page </h3>
            <!-- END PAGE TITLE-->
            <!-- BEGIN PAGE BAR -->
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('home')}}">Dashboard</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="{{route('hrefs.index')}}">Link Analysis</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="{{route('hrefs.pending')}}">List of Pending Domains</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Edit Pending Domain Page</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height default dropdown-toggle" data-toggle="dropdown"> Actions
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li>
                                <a href="{{route('hrefs.successful')}}">
                                    <i class="fa fa-thumbs-o-up"></i> Show Successful Domains</a>
                            </li>
                            <li>
                                <a href="{{route('hrefs.failed')}}">
                                    <i class="fa fa-thumbs-o-down"></i> Show Failed Domains</a>
                            </li>
                            <li class="divider"> </li>
                            <li>
                                <a href="{{route('hrefs.pending')}}">
                                    <i class="icon-action-undo"></i> Back to Pending Domains</a>
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
                        <i class="fa fa-file-video-o font-red-sunglo"></i>
                        <span class="caption-subject font-red-sunglo bold uppercase">Edit pending domain form</span>
                    </div>
                </div>
                @include('errors')
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    {{Form::open(['route' => ['hrefs.update', $href->id], 'method' => 'put', 'id' => 'hrefs_edit_form', 'class' => 'horizontal-form'])}}
                    <div class="form-body">
                        <h3 class="form-section">Domain Info</h3>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <a href="/hrefs/{{$href->id}}" target="_blank" class="btn btn-xs purple"> <i class="fa fa-external-link"></i> Analyze Link </a>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Domain:</label>
                                    @php
                                        $domain = $href->domain->scheme->name . $href->domain->domain;
                                    @endphp
                                    <a href="{{$domain}}" target="_blank">{{$domain}}</a>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-3 button-right">
                                <div class="form-group">
                                    <a href="{{route('projects.create', $href->id)}}" class="btn red">
                                        <i class="fa fa-gears"></i> Create Project
                                    </a>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <h3 class="form-section">Need to prepare</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Requirements</label>
                                    <textarea name="pending_comment" id="pending_comment" class="form-control" placeholder="Requirements" rows="15">{{$href->pending_comment}}</textarea>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                    </div>
                    <div class="form-actions left">
                        <input type="hidden" name="hrefs_status_id" value="{{$href->hrefs_status_id}}">
                        <input type="hidden" name="action" value="edit">
                        <a href="{{route('hrefs.pending')}}" class="btn default">Cancel</a>
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