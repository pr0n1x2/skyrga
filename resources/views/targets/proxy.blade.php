@extends('ubot')

@section('title', 'Check Proxy')

@section('content')
    <div class="alert alert-info">
        <strong>Info!</strong> You need '{{$target->project->login_file}}' file.
    </div>
    @if(($target->project->is_use_proxy && $activeProxyID) || !$target->project->is_use_proxy)
    <div class="alert alert-success">
        <strong>Success!</strong> <span class="proxy">Proxy is OK</span>.
    </div>
    @else
    <div class="alert alert-danger">
        <strong>Error!</strong> <span class="proxy">Could not find a working proxy</span>.
    </div>
    @endif
    <form action="" method="post">
        <input type="hidden" name="target_id" value="{{$target->id}}">
        <input type="hidden" name="proxy_id" value="{{$activeProxyID}}">
        <input type="hidden" name="filename" value="{{$target->project->login_file}}">
    </form>
@endsection