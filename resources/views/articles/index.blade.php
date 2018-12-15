@extends('layout')

@section('title', 'List of Articles')

@section('content')
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title"> List of Articles </h3>
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
                            <table class="table table-striped table-bordered table-hover table-checkable order-column" id="articles_table">
                                <thead>
                                <tr>
                                    <th style="width: 7%"> ID </th>
                                    <th style="width: 30%"> Theme </th>
                                    <th style="width: 13%"> Author </th>
                                    <th style="width: 11%"> Status </th>
                                    <th style="width: 11%"> Messages </th>
                                    <th style="width: 12%"> Date </th>
                                    <th style="width: 16%"> Actions </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($articles as $article)
                                    <tr class="odd gradeX">
                                        <td> {{$article->id}} </td>
                                        <td> {{$article->theme}} </td>
                                        <td> {{$article->author->fullname}} </td>
                                        <td> {!!$article->getArticleStatus($article->status)!!} </td>
                                        <td>
                                            @if (!$article->author_new_message)
                                                <span class="label label-default"> No new messages </span>
                                            @else
                                                <span class="label label-danger"> New message </span>
                                            @endif
                                        </td>
                                        <td> {{$article->created_at->format('F d, Y')}} </td>
                                        <td>
                                            <div class="btn-group">
                                                <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                    <i class="fa fa-angle-down"></i>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li>
                                                        <a href="{{route('articles.show', $article->id)}}">
                                                            <i class="fa fa-eye"></i> Show article </a>
                                                    </li>
                                                    @if($article->status != \App\Article::ARTICLE_CONFIRMED)
                                                    <li>
                                                        <a href="{{route('articles.edit', $article->id)}}">
                                                            <i class="fa fa-edit"></i> Edit article </a>
                                                    </li>
                                                    <li>
                                                        <a data-toggle="modal" href="#delete" data-item="{{$article->id}}">
                                                            <i class="fa fa-trash-o"></i> Delete article </a>
                                                    </li>
                                                    @endif
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
                    {{Form::open(['route' => ['articles.destroy', null], 'method' => 'delete', 'id' => 'articles_delete_form'])}}
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                            <h4 class="modal-title">Delete Article</h4>
                        </div>
                        <div class="modal-body"> Are you sure you want to delete this article? </div>
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