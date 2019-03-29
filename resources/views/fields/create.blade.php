@extends('layout')

@section('title', 'Create New Fields')

@section('content')
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title"> Create New Fields Page </h3>
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
                        <a href="{{route('projects.edit', $project->id)}}">Project For {{$project->domain->domain}}</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Create New Fields Page</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height default dropdown-toggle" data-toggle="dropdown"> Actions
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li>
                                <a href="{{route('projects.edit', $project->id)}}">
                                    <i class="icon-action-undo"></i> Back to project for {{$project->domain->domain}}</a>
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
                        <i class="fa fa-briefcase font-red-sunglo"></i>
                        <span class="caption-subject font-red-sunglo bold uppercase">Create new fields form</span>
                    </div>
                </div>
                @include('errors')
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    {{Form::open(['route' => 'fields.store', 'id' => 'create_fields_form', 'class' => 'horizontal-form'])}}
                    <div class="form-body">
                        <h3 class="form-section">Fields Info</h3>
                        @for($i = 1; $i <= 10; $i++)
                            @if(!in_array($i, $fields))
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Name</label>
                                            <div><span class="form-control-static"> <strong>Field {{$i}}</strong> </span></div>
                                        </div>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label class="control-label">Type</label>
                                            {{Form::select('type[' . $i . ']', ['varchar' => 'VarChar', 'text' => 'Text'], old('type'), ['placeholder' => 'Pick a Field Type', 'class' => 'form-control'])}}
                                        </div>
                                    </div>
                                    <!--/span-->
                                </div>
                                <!--/row-->
                            @endif
                        @endfor
                    </div>
                    <div class="form-actions left">
                        <input type="hidden" name="project_id" value="{{$project->id}}">
                        <a href="{{route('projects.edit', $project->id)}}" class="btn default">Cancel</a>
                        <button type="submit" class="btn blue">
                            <i class="fa fa-check"></i> Create</button>
                    </div>
                {{Form::close()}}
                <!-- END FORM-->
                </div>
            </div>
        </div>
        <!-- END CONTENT BODY -->
    </div>
@endsection