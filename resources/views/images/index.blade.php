@extends('layout')

@section('title', 'List of Images')

@section('content')
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title"> List of Images </h3>
            <!-- END PAGE TITLE-->
            <!-- BEGIN PAGE BAR -->
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('home')}}">Dashboard</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>List of Images</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height default dropdown-toggle" data-toggle="dropdown"> Actions
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li>
                                <a href="{{route('images.create')}}">
                                    <i class="fa fa-file-image-o"></i> Add new Image</a>
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
                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="images_table">
                                <thead>
                                <tr>
                                    <th style="width: 10%"> ID </th>
                                    <th style="width: 45%"> Name </th>
                                    <th style="width: 25%"> Image </th>
                                    <th style="width: 20%"> Actions </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($images as $image)
                                    <tr class="odd gradeX">
                                        <td> {{$image->id}} </td>
                                        <td> {{$image->name}} </td>
                                        <td> <a href="javascript:;" class="image-show" data-item="{{$image->id}}">
                                                <img src="{{$image->url}}" alt="{{$image->name}}" border="0" style="width: 200px"></a>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                    <i class="fa fa-angle-down"></i>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li>
                                                        <a href="{{route('images.edit', $image->id)}}">
                                                            <i class="fa fa-edit"></i> Edit </a>
                                                    </li>
                                                    <li>
                                                        <a class="image-show" href="javascript:;" data-item="{{$image->id}}">
                                                            <i class="fa fa-picture-o"></i> Show </a>
                                                    </li>
                                                    <li>
                                                        <a data-toggle="modal" href="#delete" data-item="{{$image->id}}">
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
                    {{Form::open(['route' => ['images.destroy', null], 'method' => 'delete', 'id' => 'images_delete_form'])}}
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Delete Image</h4>
                        </div>
                        <div class="modal-body"> Are you sure you want to delete this image? </div>
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
            <div class="modal fade" id="show" tabindex="-1" role="Show" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Delete Image</h4>
                        </div>
                        <div class="modal-body">
                            <p><img src="" alt="" border="0" style="width: 568px"></p>
                            <div class="note note-info">
                                <h4 class="block">Alternative Text</h4>
                                <p></p>
                            </div>
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