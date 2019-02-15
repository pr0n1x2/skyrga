@extends('layout')

@section('title', 'List of Public Accounts')

@section('content')
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title"> List of Public Accounts </h3>
            <!-- END PAGE TITLE-->
            <!-- BEGIN PAGE BAR -->
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('home')}}">Dashboard</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>List of Public Accounts</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height default dropdown-toggle" data-toggle="dropdown"> Actions
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li>
                                <a href="{{route('accounts.create')}}">
                                    <i class="fa fa-user-plus"></i> Add new Public Accounts</a>
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
                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="accounts_table">
                                <thead>
                                <tr>
                                    <th style="width: 10%"> ID </th>
                                    <th style="width: 25%"> E-mail </th>
                                    <th style="width: 15%"> Username </th>
                                    <th style="width: 15%"> Password </th>
                                    <th style="width: 10%"> Firstname </th>
                                    <th style="width: 10%"> Lastname </th>
                                    <th style="width: 15%"> Actions </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($accounts as $account)
                                    <tr class="odd gradeX">
                                        <td> {{$account->id}} </td>
                                        <td> {{$account->email->email}} </td>
                                        <td> {{$account->username}} </td>
                                        <td> {{$account->password}} </td>
                                        <td> {{$account->firstname}} </td>
                                        <td> {{$account->lastname}} </td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                    <i class="fa fa-angle-down"></i>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li>
                                                        <a href="{{route('accounts.edit', $account->id)}}">
                                                            <i class="fa fa-edit"></i> Edit </a>
                                                    </li>
                                                    <li>
                                                        <a data-toggle="modal" href="#delete" data-item="{{$account->id}}">
                                                            <i class="fa fa-remove"></i> Delete </a>
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
                    {{Form::open(['route' => ['accounts.destroy', null], 'method' => 'delete', 'id' => 'accounts_delete_form'])}}
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Delete Public Account</h4>
                        </div>
                        <div class="modal-body"> Are you sure you want to delete this account? </div>
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