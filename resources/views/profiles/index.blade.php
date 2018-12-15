@extends('layout')

@section('title', 'List of Profiles')

@section('content')
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title"> List of Profiles </h3>
            <!-- END PAGE TITLE-->
            <!-- BEGIN PAGE BAR -->
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('home')}}">Dashboard</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>List of Profiles</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height default dropdown-toggle" data-toggle="dropdown"> Actions
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li>
                                <a href="{{route('profiles.create')}}">
                                    <i class="fa fa-sitemap"></i> Add new Profile</a>
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
                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="profiles_table">
                                <thead>
                                <tr>
                                    <th style="width: 10%"> ID </th>
                                    <th style="width: 30%"> Name </th>
                                    <th style="width: 25%"> Domain </th>
                                    <th style="width: 15%"> Status </th>
                                    <th style="width: 20%"> Actions </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($profiles as $profile)
                                    <tr class="odd gradeX">
                                        <td> {{$profile->id}} </td>
                                        <td> {{$profile->name}} </td>
                                        <td> <a href="{{$profile->domain}}" target="_blank">{{$profile->domain}}</a> </td>
                                        <td>
                                            @if (!$profile->is_deleted)
                                                <span class="label label-sm label-success"> Active </span>
                                            @else
                                                <span class="label label-sm label-danger"> Inactive </span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                    <i class="fa fa-angle-down"></i>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li>
                                                        <a href="{{route('profiles.edit', $profile->id)}}">
                                                            <i class="fa fa-edit"></i> Edit </a>
                                                    </li>
                                                    <li>
                                                        <a data-toggle="modal" href="#delete" data-item="{{$profile->id}}">
                                                            <i class="fa fa-trash-o"></i> Delete </a>
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
                    {{Form::open(['route' => ['profiles.destroy', null], 'method' => 'delete', 'id' => 'profiles_delete_form'])}}
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Delete Profile</h4>
                        </div>
                        <div class="modal-body"> Are you sure you want to delete this profile? </div>
                        <div class="modal-footer">
                            <button type="button" class="btn dark btn-outline" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn green">Delete</button>
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