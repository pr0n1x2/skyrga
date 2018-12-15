@extends('layout')

@section('title', 'List of Projects')

@section('content')
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title"> List of Projects </h3>
            <!-- END PAGE TITLE-->
            <!-- BEGIN PAGE BAR -->
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('home')}}">Dashboard</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>List of Projects</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height default dropdown-toggle" data-toggle="dropdown"> Actions
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li>
                                <a href="{{route('projects.create')}}">
                                    <i class="fa fa-gears"></i> Add new Project</a>
                            </li>
                            <li>
                                <a data-toggle="modal" href="#archive">
                                    <i class="fa fa-trash-o"></i> Move All to Archive </a>
                            </li>
                            <li>
                                <a href="/projects/zip">
                                    <i class="fa fa-download"></i> Download All Active Files </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- END PAGE BAR -->
            <!-- END PAGE HEADER-->
            @include('success')
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet light bordered">
                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="projects_table">
                                <thead>
                                <tr>
                                    <th style="width: 10%"> ID </th>
                                    <th style="width: 55%"> Name </th>
                                    <th style="width: 15%"> Status </th>
                                    <th style="width: 20%"> Actions </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($projects as $project)
                                    <tr class="odd gradeX">
                                        <td> {{$project->id}} </td>
                                        <td> {{$project->name}} </td>
                                        <td>
                                            @if (!$project->is_archive)
                                                <span class="label label-sm label-success"> Active </span>
                                            @else
                                                <span class="label label-sm label-danger"> Archived </span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                    <i class="fa fa-angle-down"></i>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li>
                                                        <a href="{{route('projects.edit', $project->id)}}">
                                                            <i class="fa fa-edit"></i> Edit </a>
                                                    </li>
                                                    <li>
                                                        <a data-toggle="modal" href="#delete" data-item="{{$project->id}}">
                                                            <i class="fa fa-trash-o"></i> Move to Archive </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
            </div>
            <div class="modal fade" id="delete" tabindex="-1" role="delete" aria-hidden="true">
                <div class="modal-dialog">
                    {{Form::open(['route' => ['projects.destroy', null], 'method' => 'delete', 'id' => 'projects_delete_form'])}}
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Move to Archive</h4>
                        </div>
                        <div class="modal-body"> Are you sure you want to archive the project? </div>
                        <div class="modal-footer">
                            <button type="button" class="btn dark btn-outline" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn green">Yes</button>
                        </div>
                    </div>
                {{Form::close()}}
                <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            <div class="modal fade" id="archive" tabindex="-1" role="archive" aria-hidden="true">
                <div class="modal-dialog">
                    {{Form::open(['route' => 'projects.archive', 'id' => 'projects_archive_form'])}}
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Move to Archive</h4>
                        </div>
                        <div class="modal-body"> Are you sure you want to send all projects to the archive? </div>
                        <div class="modal-footer">
                            <button type="button" class="btn dark btn-outline" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn green">Yes</button>
                        </div>
                    </div>
                {{Form::close()}}
                <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
        </div>
        <!-- END CONTENT BODY -->
    </div>
@endsection