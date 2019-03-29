@extends('layout')

@section('title', 'Edit Fields')

@section('content')
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title"> Edit Fields Page </h3>
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
                        <span>Edit Fields Page</span>
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
                        <span class="caption-subject font-red-sunglo bold uppercase">Edit fields form for {{$project->domain->domain}}</span>
                    </div>
                </div>
                @include('errors')
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    {{Form::open(['route' => ['fields.update', $project->id], 'method' => 'put', 'id' => 'edit_fields_form', 'class' => 'horizontal-form'])}}
                    <div class="form-body">
                        @foreach($form as $profile_id => $fields)
                        <h3 class="form-section">Fields for {{$profiles[$profile_id]}}</h3>
                            @foreach($fields as $field)
                                <div class="row">
                                    @if($field['type'] == 'varchar')
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">{{ucfirst($field['name'])}}</label>
                                                <input type="text" name="field[{{$field['id']}}]" value="{{$field['value']}}" class="form-control" placeholder="{{$field['name']}}">
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">{{ucfirst($field['name'])}}</label>
                                                <textarea name="field[{{$field['id']}}]" class="form-control" placeholder="{{$field['name']}}" rows="5">{{$field['value']}}</textarea>
                                            </div>
                                        </div>
                                    @endif
                                    <!--/span-->
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                    <div class="form-actions left">
                        <a href="{{route('projects.edit', $project->id)}}" class="btn default">Cancel</a>
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