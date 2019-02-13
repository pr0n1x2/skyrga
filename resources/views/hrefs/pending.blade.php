@extends('layout')

@section('title', 'Pending domains')

@section('content')
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title"> List of Pending Domains </h3>
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
                        <span> List of Pending Domains </span>
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
                                <a href="{{route('hrefs.index')}}">
                                    <i class="icon-action-undo"></i> Back to Hrefs</a>
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
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-globe font-green"></i>
                                <span class="caption-subject font-green bold uppercase">List of Pending Domains</span>
                            </div>
                            <div class="actions">
                                {{Form::open(['route' => 'hrefs.pending', 'method' => 'get', 'class' => 'horizontal-form'])}}
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
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th sryle="width:10%" class="table-td-first"> ID </th>
                                    <th sryle="width:40%"> Domain </th>
                                    <th sryle="width:10%"> Domain Rating </th>
                                    <th sryle="width:15%"> Status </th>
                                    <th sryle="width:15%"> Date </th>
                                    <th sryle="width:10%"> Action </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($hrefs as $href)
                                    @php
                                        $domain = $href->domain->scheme->name . $href->domain->domain;
                                        $date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $href->pending_date)->format('F d, Y \a\t H:i');
                                    @endphp
                                    <tr>
                                        <td class="table-td-first"> {{$href->id}} </td>
                                        <td> <a href="{{$domain}}" target="_blank">{{$domain}}</a> </td>
                                        <td> {{$href->domain->rating}} </td>
                                        <td> <span class="label label-warning"> Pending </span> </td>
                                        <td> {{$date}} </td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                    <i class="fa fa-angle-down"></i>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li>
                                                        <a href="{{route('hrefs.edit', $href->id)}}">
                                                            <i class="fa fa-edit"></i> Edit </a>
                                                    </li>
                                                    <li>
                                                        <a data-toggle="modal" href="#delete" data-item="{{$href->id}}">
                                                            <i class="fa fa-trash-o"></i> Remove </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
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
        <div class="modal fade" id="delete" tabindex="-1" role="delete" aria-hidden="true">
            <div class="modal-dialog">
                {{Form::open(['route' => ['profiles.destroy', null], 'method' => 'delete', 'id' => 'hrefs_delete_form'])}}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Remove Domain</h4>
                    </div>
                    <div class="modal-body"> Are you sure you want to remove this profile? </div>
                    <div class="modal-footer">
                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn green">Remove</button>
                    </div>
                </div>
            {{Form::close()}}
            <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <!-- END CONTENT BODY -->
    </div>
@endsection