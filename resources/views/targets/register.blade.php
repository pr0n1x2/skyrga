@extends('ubot')

@section('title', 'Register')

@section('content')
    @foreach($projects as $project)
        <div class="row ubot-row">
            <div class="col-md-12">
                <!-- BEGIN Portlet -->
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption font-blue">
                            <i class="fa fa-globe font-blue"></i>
                            <span class="caption-subject bold uppercase"> {{$project->name}} </span>
                            <span class="caption-helper">project #{{$project->id}}</span>
                        </div>
                        <div class="actions">
                            <a href="{{$project->domain}}" target="_blank" class="btn btn-circle btn-default">
                                <i class="fa fa-globe"></i> Visit website </a>
                            <a href="{{$project->register_page}}" target="_blank" class="btn btn-circle btn-default">
                                <i class="fa fa-plus"></i> Register page </a>
                            <a href="{{$project->login_page}}" target="_blank" class="btn btn-circle btn-default">
                                <i class="fa fa-external-link"></i> Login page </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <ul class="feeds">
                            @foreach($targets[$project->id] as $target)
                            <li>
                                <div class="col1">
                                    <div class="cont">
                                        <div class="cont-col1">
                                            <div class="label label-sm label-default">
                                                <i class="fa fa-check"></i>
                                            </div>
                                        </div>
                                        <div class="cont-col2">
                                            <div class="desc"> {{$target->profile->name}} ({{$target->profile->domain}})

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col2">
                                    <div class="info">
                                        <i class="fa fa-envelope font-yellow-mint"></i> <a href="#" class="email">{{$target->getEmail()}}</a>
                                        <i class="fa fa-user font-yellow-casablanca"></i> {{$target->getEmail()}}
                                        <i class="fa fa-unlock-alt font-yellow-casablanca"></i> URnr4P*6qABb
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!-- END Portlet -->
            </div>
        </div>
    @endforeach
@endsection