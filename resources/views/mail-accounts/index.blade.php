@extends('layout')

@section('title', 'List of Mail Accounts')

@section('content')
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title"> List of Mail Accounts </h3>
            <!-- END PAGE TITLE-->
            <!-- BEGIN PAGE BAR -->
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('home')}}">Dashboard</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>List of Mail Accounts</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height default dropdown-toggle" data-toggle="dropdown"> Actions
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li>
                                <a href="{{route('mail-accounts.create')}}">
                                    <i class="fa fa-envelope-o"></i> Add new Mail Account</a>
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
                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="mail_accounts_table">
                                <thead>
                                <tr>
                                    <th style="width: 10%"> ID </th>
                                    <th style="width: 25%"> E-mail </th>
                                    <th style="width: 20%"> Login </th>
                                    <th style="width: 15%"> Pasword </th>
                                    <th style="width: 10%"> Status </th>
                                    <th style="width: 20%"> Actions </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($accounts as $account)
                                    <tr class="odd gradeX">
                                        <td> {{$account->id}} </td>
                                        <td> <a href="javascript:;" class="account-show" data-item="{{$account->id}}">{{$account->email}}</a> </td>
                                        <td> {{$account->account_name}} </td>
                                        <td> {{$account->password}} </td>
                                        <td>
                                            @if (!$account->is_deleted)
                                                <span class="label label-sm label-success"> Active </span>
                                            @else
                                                <span class="label label-sm label-danger"> Deleted </span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                    <i class="fa fa-angle-down"></i>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li>
                                                        <a href="{{route('mail-accounts.edit', $account->id)}}">
                                                            <i class="fa fa-edit"></i> Edit </a>
                                                    </li>
                                                    <li>
                                                        <a class="account-show" href="javascript:;" data-item="{{$account->id}}">
                                                            <i class="fa fa-eye"></i> Show </a>
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
            <div class="modal fade" id="show" tabindex="-1" role="Show" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Mail Account Info</h4>
                        </div>
                        <div class="modal-body">
                            <p><strong>Domain:</strong> <a href="" target="_blank" id="show_domain"></a></p>
                            <p><strong>E-mail:</strong> <span id="show_email"></span></p>
                            <p><strong>Login:</strong> <span id="show_login"></span></p>
                            <p><strong>Password:</strong> <span id="show_password"></span></p>
                            <p><strong>Login page:</strong> <a href="" target="_blank" id="show_page">Go To Login Page</a></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
        </div>
        <!-- END CONTENT BODY -->
    </div>
@endsection