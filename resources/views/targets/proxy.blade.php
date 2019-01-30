@extends('ubot')

@section('title', 'Proxy check')

@section('content')
<div class="page-container">
    <!-- BEGIN CONTENT -->
    {{Form::open(['route' => 'targets.generate'])}}
    <input type="hidden" name="target_id" value="{{$target->id}}">
    <input type="hidden" name="proxy_id" value="{{$activeProxyID}}">
    <input type="hidden" name="filename" value="{{$target->project->login_file}}">
    <input type="hidden" name="action" value="register">
    {{Form::close()}}
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content ubot-full-width">
            <!-- BEGIN PAGE HEADER-->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title"> Proxy check </h3>
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <div class="note note-info">
                <p> <strong>Info!</strong> You need &quot;{{$target->project->login_file}}&quot; file. </p>
            </div>
            @if(($target->project->is_use_proxy && $activeProxyID) || !$target->project->is_use_proxy)
                <div class="note note-success">
                    <strong>Success!</strong> <span class="proxy">Proxy is OK</span>.
                </div>
            @else
                <div class="note note-danger">
                    <strong>Error!</strong> <span class="proxy">Could not find a working proxy.</span>.
                </div>
            @endif
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
</div>
@endsection