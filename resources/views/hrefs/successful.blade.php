@extends('layout')

@section('title', 'Successful domains')

@section('content')
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> List of Successful Domains </h3>
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
                    <span> List of Successful Domains </span>
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
                            <li>
                                <a href="{{route('hrefs.pending')}}">
                                    <i class="fa fa-hand-peace-o"></i> Show Pending Domains</a>
                            </li>
                        @endif
                        <li class="divider"> </li>
                        <li>
                            <a href="{{route('hrefs.index')}}">
                                <i class="icon-action-undo"></i> Back to Hrefs</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- END PAGE BAR -->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-globe font-green"></i>
                            <span class="caption-subject font-green bold uppercase">List of Successful Domains</span>
                        </div>
                        <div class="actions">
                            {{Form::open(['route' => 'hrefs.successful', 'method' => 'get', 'class' => 'horizontal-form'])}}
                            <div class="col-md-4 col-sm-4 field-to-rigth">
                                <input type="text" name="domain" value="{{$domain}}" maxlength="100" class="form-control" placeholder="Domain">
                            </div>
                            <div class="col-md-4 col-sm-4 field-to-rigth">
                                <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd">
                                    <input type="text" name="date" value="{{$date}}" placeholder="Date" class="form-control" readonly>
                                    <span class="input-group-btn">
                                        <button class="btn default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 field-to-rigth button-right">
                                <input type="hidden" name="search" value="1">
                                <button type="submit" class="btn blue">
                                    <i class="fa fa-search"></i> Search</button>
                            </div>
                            {{Form::close()}}
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-scrollable">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th style="width:10%" class="table-td-first"> ID </th>
                                    <th style="width:30%"> Domain </th>
                                    <th style="width:5%"> Domain Rating </th>
                                    <th style="width:15%"> Status </th>
                                    <th style="width:15%"> Date </th>
                                    <th style="width:15%"> User </th>
                                    <th style="width:10%"> Action </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($hrefs as $href)
                                    @php
                                        $domain = $href->domain->scheme->name . $href->domain->domain;
                                        $date = \Carbon\Carbon::createFromFormat('Y-m-d', $href->analized_date)->format('F d, Y');
                                    @endphp
                                    <tr>
                                        <td class="table-td-first"> {{$href->id}} </td>
                                        <td> <a href="{{$domain}}" target="_blank">{{$domain}}</a> </td>
                                        <td> {{$href->domain->rating}} </td>
                                        <td> <span class="label label-success"> Successful </span> </td>
                                        <td> {{$date}} </td>
                                        <td> {{$href->user->fullname}} </td>
                                        <td> <a href="{{route('hrefs.analyze', $href->id)}}" target="_blank" class="btn btn-xs purple"> <i class="fa fa-external-link"></i> Analyze Link </a> </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-5 col-sm-5">
                                <div>
                                    Showing {{$hrefs->firstItem()}} to {{$hrefs->lastItem()}} of {{$hrefs->total()}} domains
                                </div>
                            </div>
                            <div class="col-md-7 col-sm-7">
                                <div class="table-data-scrollable">
                                    {{$hrefs->links()}}
                                </div>
                            </div>
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