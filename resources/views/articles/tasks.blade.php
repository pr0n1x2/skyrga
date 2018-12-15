@extends('layout')

@section('title', 'List of Articles')

@section('content')
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title"> List of Articles  </h3>
            <!-- END PAGE TITLE-->
            <!-- BEGIN PAGE BAR -->
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('home')}}">Dashboard</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>List of Articles</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height default dropdown-toggle" data-toggle="dropdown"> Actions
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li>
                                <a href="{{route('articles.create')}}">
                                    <i class="fa fa-file-word-o"></i> Add new Article</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- END PAGE BAR -->
            <!-- END PAGE HEADER-->
            @include('errors')
            @include('success')
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet light bordered">
                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="tasks_table">
                                <thead>
                                <tr>
                                    <th style="width: 7%"> ID </th>
                                    <th style="width: 36%"> Theme </th>
                                    <th style="width: 13%"> Deadline </th>
                                    <th style="width: 11%"> Status </th>
                                    <th style="width: 11%"> Messages </th>
                                    <th style="width: 12%"> Date </th>
                                    <th style="width: 10%"> Action </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($articles as $article)
                                    <tr class="odd gradeX">
                                        <td> {{$article->id}} </td>
                                        <td> {{$article->theme}} </td>
                                        <td> {!!$article->formatDeadline()!!} </td>
                                        <td> {!!$article->getArticleStatus($article->status)!!} </td>
                                        <td>
                                            @if (!$article->admin_new_message)
                                                <span class="label label-default"> No new messages </span>
                                            @else
                                                <span class="label label-danger"> New message </span>
                                            @endif
                                        </td>
                                        <td> {{$article->created_at->format('F d, Y')}} </td>
                                        <td>
                                            <a href="/tasks/view/{{$article->id}}" class="btn btn-outline btn-circle green btn-xs green">
                                                <i class="fa fa-edit"></i> View Article </a>
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