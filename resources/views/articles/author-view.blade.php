@extends('layout')

@section('title', 'View Article')

@section('content')
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title"> View Article </h3>
            <!-- END PAGE TITLE-->
            <!-- BEGIN PAGE BAR -->
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('home')}}">Dashboard</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="/tasks">List of Articles</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>View Article</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height default dropdown-toggle" data-toggle="dropdown"> Actions
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li>
                                <a href="/tasks">
                                    <i class="icon-action-undo"></i> Back to Articles</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- END PAGE BAR -->
            @include('errors')
            @include('success')
            <!-- END PAGE HEADER-->
            <div class="row">
                <div class="col-md-6">
                    <div class="portlet light portlet-fit bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-info-circle font-green"></i>
                                <span class="caption-subject bold font-green uppercase"> Article Information</span>
                            </div>
                            <div class="actions">
                                @if(!empty($article->file_revision))
                                <a href="/articles/edited/{{$article->id}}" class="btn btn-circle red-sunglo ">
                                    <i class="fa fa-download"></i> Download article </a>
                                @elseif(!empty($article->file_result))
                                <a href="/articles/download/{{$article->id}}" class="btn btn-circle red-sunglo ">
                                    <i class="fa fa-download"></i> Download article </a>
                                @endif
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="row static-info">
                                <div class="col-md-4 name"> Article ID: </div>
                                <div class="col-md-8 value"> {{$article->id}} </div>
                            </div>
                            <div class="row static-info">
                                <div class="col-md-4 name"> Article Theme: </div>
                                <div class="col-md-8 value"> {{$article->theme}} </div>
                            </div>
                            @if(!empty($article->file_attache))
                            <div class="row static-info">
                                <div class="col-md-4 name"> Attached File: </div>
                                <div class="col-md-8 value"> <a href="/articles/attached/{{$article->id}}" class="btn blue btn-xs"><i class="fa fa-download"></i> Download </a> </div>
                            </div>
                            @endif
                            <div class="row static-info">
                                <div class="col-md-4 name"> Creation Date: </div>
                                <div class="col-md-8 value"> {{$article->created_at->format('d F Y \\a\t H:i')}} </div>
                            </div>
                            <div class="row static-info">
                                <div class="col-md-4 name"> Article Cost: </div>
                                <div class="col-md-8 value"> ${{$article->price}} </div>
                            </div>
                            <div class="row static-info">
                                <div class="col-md-4 name"> Deadline: </div>
                                <div class="col-md-8 value"> {!!$article->formatDeadline()!!} </div>
                            </div>
                            <div class="row static-info">
                                <div class="col-md-4 name"> Article Status: </div>
                                <div class="col-md-8 value"> {!!$article->getArticleStatus($article->status)!!} </div>
                            </div>
                            <h3>Description</h3>
                            <p>{!!nl2br($article->message)!!}</p>
                            @if($isSendAvailable)
                            <div class="form-actions right">
                                <a href="javascript:;" class="btn green article-send" data-item="{{$article->id}}">
                                    <i class="fa fa-send"></i> Send article </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    {{Form::open(['route' => 'articles.message', 'id' => 'messages_form', 'class' => 'form-horizontal'])}}
                    <!-- TASK HEAD -->
                    <div class="form">
                        <div class="form-group">
                            <div class="col-md-8 col-sm-8">
                                <div class="todo-taskbody-user">
                                    <img class="todo-userpic pull-left" src="{{Auth::user()->getUserPhotoPath()}}" width="50px" height="50px">
                                    <span class="todo-username pull-left">{{Auth::user()->fullname}}</span>
                                </div>
                            </div>
                        </div>
                        <!-- END TASK HEAD -->
                        <div class="form-group">
                            <div class="col-md-12">
                                <textarea name="message" id="message" maxlength="5000" class="form-control todo-taskbody-taskdesc" rows="8" placeholder="Message..."></textarea>
                            </div>
                        </div>
                        <div class="form-actions right">
                            <input type="hidden" name="article_id" value="{{$article->id}}">
                            <button type="submit" class="btn btn-circle btn-sm green">Send Message</button>
                        </div>
                    </div>
                    {{Form::close()}}
                    <div class="tabbable-line">
                        <!-- TASK COMMENTS -->
                        <div class="form-group">
                            <div class="col-md-12">
                                <ul class="media-list">
                                    @foreach($messages as $message)
                                    <li class="media">
                                        <span class="pull-left">
                                            <img class="todo-userpic" src="{{$message->user->getUserPhotoPath()}}" width="27px" height="27px"> </span>
                                        <div class="media-body todo-comment">
                                            <p class="todo-comment-head">
                                                <span class="todo-comment-username">{{$message->user->fullname}}</span> &nbsp;
                                                <span class="todo-comment-date">{{$message->date}}</span>
                                            </p>
                                            <p class="todo-text-color">{!!$message->getMessage()!!}</p>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!-- END TASK COMMENTS -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <div class="modal fade" id="send" tabindex="-1" role="send" aria-hidden="true">
        <div class="modal-dialog">
            {{Form::open(['route' => $route, 'files' => true, 'id' => 'articles_send_form'])}}
            <input type="hidden" name="article_id" id="article_id" value="">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Submit The Completed Article</h4>
                </div>
                <div class="modal-body">
                    <div class="portlet-body form">
                        <div class="form-body form-padding-0">
                            <div class="row">
                                <div class="form-group">
                                    <label class="control-label">Attach an article file</label>
                                    <div class="checkbox-list">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <span class="btn green btn-file">
                                            <span class="fileinput-new"> Select file </span>
                                            <span class="fileinput-exists"> Change </span>
                                            <input type="file" name="{{$fieldName}}"> </span>
                                            <span class="fileinput-filename"> </span> &nbsp;
                                            <a href="javascript:;" class="close fileinput-exists" data-dismiss="fileinput"> </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn green">Send</button>
                </div>
            </div>
            {{Form::close()}}
        <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection