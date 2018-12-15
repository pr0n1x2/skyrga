@extends('layout')

@section('title', 'List of Users')

@section('content')
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> List of Users </h3>
        <!-- END PAGE TITLE-->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="{{route('home')}}">Dashboard</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <span>List of Users</span>
                </li>
            </ul>
            <div class="page-toolbar">
                <div class="btn-group pull-right">
                    <button type="button" class="btn btn-fit-height default dropdown-toggle" data-toggle="dropdown"> Actions
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <li>
                            <a href="{{route('users.create')}}">
                                <i class="icon-user"></i> Add new User</a>
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
                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="users_table">
                            <thead>
                                <tr>
                                    <th style="width: 7%"> ID </th>
                                    <th style="width: 15%"> First Name </th>
                                    <th style="width: 15%"> Last Name </th>
                                    <th style="width: 25%"> E-mail </th>
                                    <th style="width: 12%"> Role </th>
                                    <th style="width: 10%"> Status </th>
                                    <th style="width: 16%"> Actions </th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                            <tr class="odd gradeX">
                                <td> {{$user->id}} </td>
                                <td> {{$user->firstname}} </td>
                                <td> {{$user->lastname}} </td>
                                <td>
                                    <a href="mailto:{{$user->email}}"> {{$user->email}} </a>
                                </td>
                                <td> {{$user::roles($user->role)}} </td>
                                <td>
                                    @if ($user->is_active)
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
                                                <a href="{{route('users.edit', $user->id)}}">
                                                    <i class="fa fa-edit"></i> Edit </a>
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
    </div>
    <!-- END CONTENT BODY -->
</div>
@endsection