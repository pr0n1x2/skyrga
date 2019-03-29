@php
    if ($isToday) {
        $title = 'List of Today\'s Targets';
        $dateForLink = null;
    } else {
        $dateTitle = \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format('d F Y');
        $title = 'List of Targets for ' . $dateTitle;
        $dateForLink = $date;
    }
@endphp
@extends('layout')

@section('title', $title)

@section('content')
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title"> {{$title}} </h3>
            <!-- END PAGE TITLE-->
            <!-- BEGIN PAGE BAR -->
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('home')}}">Dashboard</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span> List of Targets </span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height default dropdown-toggle" data-toggle="dropdown"> Actions
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li>
                                <a href="{{route('hrefs.failed')}}">
                                    <i class="fa fa-thumbs-o-down"></i> Show Failed Domains</a>
                            </li>
                            @if(\Illuminate\Support\Facades\Auth::user()->role == \App\User::ADMIN_ROLE)
                                <li class="divider"> </li>
                                <li>
                                    <a href="{{route('targets.upload')}}">
                                        <i class="fa fa-upload"></i> Upload New Ubot Archive</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <!-- END PAGE BAR -->
            @if($user->is_new_ubot_archive)
                <div class="alert alert-block alert-danger fade in">
                    <button type="button" class="close" data-dismiss="alert"></button>
                    <h4 class="alert-heading">Attention!</h4>
                    <p> A new archive has been posted. Download it before you start working. </p>
                    <p>
                        <a class="btn blue" href="{{route('targets.ubot')}}"> <i class="fa fa-download"></i> Download </a>
                    </p>
                </div>
            @endif
            @include('success')
            <!-- END PAGE HEADER-->
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet-body">
                            <div class="table-scrollable">
                                <table class="table table-bordered table-hover table-baseline">
                                    <thead>
                                    <tr>
                                        <th style="width:5%" class="table-td-first"> # </th>
                                        <th style="width:25%"> Profile </th>
                                        <th style="width:25%"> Domain </th>
                                        <th style="width:15%" class="table-td-first"> Register </th>
                                        <th style="width:15%" class="table-td-first"> Login </th>
                                        <th style="width:15%" class="table-td-first"> Post </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $counter = 0;
                                    @endphp
                                    @foreach($targets as $target)
                                        @php
                                            $counter++;
                                            $domain = $target->project->domain->scheme->name . $target->project->domain->domain;
                                        @endphp
                                        <tr>
                                            <td class="table-td-first"> {{$counter}} </td>
                                            <td> {{$target->profile->name}} </td>
                                            <td> <a href="{{$domain}}" target="_blank">{{$domain}}</a> </td>
                                            <td class="table-td-first">
                                                <a href="{{route('targets.register', [$target->id, $dateForLink])}}" class="btn btn-sm @if(!$target->is_register) default @else btn-success @endif">
                                                    <i class="fa fa-external-link"></i> Register
                                                </a>
                                            </td>
                                            <td class="table-td-first">
                                                <a href="javascript:;" class="btn btn-sm default">
                                                    <i class="fa fa-external-link"></i> Login
                                                </a>
                                            </td>
                                            <td class="table-td-first">
                                                <a href="javascript:;" class="btn btn-sm default">
                                                    <i class="fa fa-external-link"></i> Post Link
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
            </div>
        </div>
        <!-- END CONTENT BODY -->
    </div>
@endsection