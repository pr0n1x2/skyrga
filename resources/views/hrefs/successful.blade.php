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
                    <span>Successful Domains</span>
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
                        @if(false)
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
                        @endif
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th> ID </th>
                                <th> Domain </th>
                                <th> Status </th>
                                <th> Date </th>
                                <th> User </th>
                                <th> Action </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($hrefs as $href)
                                @php
                                    $domain = $href->domain->scheme->name . $href->domain->domain;
                                    $date = \Carbon\Carbon::createFromFormat('Y-m-d', $href->analized_date)->format('F d, Y');
                                @endphp
                                <tr>
                                    <td> {{$href->id}} </td>
                                    <td> <a href="{{$domain}}" target="_blank">{{$domain}}</a> </td>
                                    <td>  </td>
                                    <td> {{$date}} </td>
                                    <td> {{$href->user->fullname}} </td>
                                    <td> Action </td>
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




@if(false)
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
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
                    <span>Successful Domains</span>
                </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Список заяв </h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
    @include('success')
    @include('errors')
    <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <a href="{{route('affairs.create')}}" class="btn green testmodal"> <i class="fa fa-plus"></i>
                        Створити заяву
                    </a>
                </div>
                <div class="actions">
                    <a class="btn btn-circle btn-icon-only btn-default" id="template-search-toggle">
                        <i class="fa fa-search"></i>
                    </a>
                </div>
            </div>
            @include('search', ['route' => 'affairs', 'formData' => $formData])
            <div class="portlet-body">
                <div class="table-scrollable">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th> ID </th>
                            <th> Тип шаблону </th>
                            <th> Назва шаблону </th>
                            <th> Активна </th>
                            <th> Категорія заяви </th>
                            <th> Тип документа </th>
                            <th> Дії </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($templates as $template)
                            <tr>
                                <td> {{$template->iddoctemplate}} </td>
                                <td> {{$template->type->name}} </td>
                                @if (!isset($formData['name']))
                                    <td> {{$template->namedoctemplate}} </td>
                                @else
                                    <td> {!!$template->getHighlightedName($formData['name'])!!} </td>
                                @endif
                                <td> <input type="checkbox" {{$template->getHtmlIsChecked()}} class="make-switch temp-switcher" data-item="{{$template->iddoctemplate}}" data-size="mini"> </td>
                                <td> {{$template->getCategoryName()}} </td>
                                <td> {{$template->type->category->name}} </td>
                                <td>
                                    <a href="{{route('affairs.edit', $template->iddoctemplate)}}" target="_blank" class="btn btn-outline btn-circle btn-sm purple">
                                        <i class="fa fa-edit"></i> Редагувати </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{$templates->links()}}
            </div>
        </div>
        <!-- END SAMPLE TABLE PORTLET-->
    </div>
    <!-- END CONTENT BODY -->
</div>
@endif

@endsection