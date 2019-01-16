@extends('ubot')

@section('title', 'Register')

@section('content')
    <div id="target"></div>
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
                            <span class="btn btn-circle @if($targets[$project->id]->count() != $counts[$project->id]) red-sunglo @else green @endif">
                                <i class="fa fa-bar-chart"></i> {{$targets[$project->id]->count()}} / {{$counts[$project->id]}} </span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <ul class="feeds targets">
                            @foreach($targets[$project->id] as $target)
                                @if($target->is_register)
                                <li>
                                    <div class="col1">
                                        <div class="cont target-radio">
                                            <div class="cont-col1">
                                                <div class="label label-sm label-default label-success" data-item="{{$target->id}}">
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
                                            <i class="fa fa-envelope font-yellow-casablanca"></i>
                                            <a href="javascript:;" class="email account-show" data-item="{{$target->getEmailID()}}">{{$target->getEmail()}}</a>
                                        </div>
                                    </div>
                                    <div class="col3">
                                        <div class="info">
                                            <i class="fa fa-user font-yellow-casablanca"></i> {{$target->account->username}}
                                        </div>
                                    </div>
                                    <div class="col4">
                                        <div class="info">
                                            <i class="fa fa-unlock-alt font-yellow-casablanca"></i>
                                            @if(!empty($target->account->password))
                                                {{$target->account->password}}
                                            @else
                                                <a href="javascript:;" class="password-not-set font-red" data-item="{{$target->account->id}}">password not set</a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col5">
                                        <div class="info">
                                            <a href="javascript:;" class="target-remove btn btn-xs red" data-item="{{$target->id}}"><i class="fa fa-trash-o"></i></a>
                                        </div>
                                    </div>
                                </li>
                                @else
                                    <li>
                                        <div class="col1">
                                            <div class="cont target-radio">
                                                <div class="cont-col1">
                                                    <div class="label label-sm label-default target-clickable @if($target->id == $activeTargetID) label-primary @endif" data-item="{{$target->id}}">
                                                        <i class="fa fa-check"></i>
                                                    </div>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc"> {{$target->profile->name}} ({{$target->profile->domain}})

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col6">
                                            <div class="info">
                                                <i class="fa fa-envelope font-yellow-mint"></i>
                                                <a href="javascript:;" class="email reserve_email_change" data-profile="{{$target->profile->id}}">{{$target->getEmail()}}</a>
                                                <a href="javascript:;" class="account-show" data-item="{{$target->getEmailID()}}"><i class="fa fa-info-circle"></i></a>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!-- END Portlet -->
            </div>
        </div>
    @endforeach
    {{Form::open(['route' => 'targets.proxy'])}}
        <input type="hidden" name="target_id" id="target_id" value="{{$activeTargetID}}">
    {{Form::close()}}
    <div class="modal fade" id="show" tabindex="-1" role="Show" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Mail Account Info</h4>
                </div>
                <div class="modal-body">
                    <p><strong>Domain:</strong> <a href="" target="_blank" id="show_domain"></a></p>
                    <p><strong>E-mail:</strong> <span id="show_email"></span></p>
                    <p><strong>Login:</strong> <span id="show_login"></span></p>
                    <p><strong>Password:</strong> <span id="show_password"></span></p>
                    <p><strong>Login page:</strong> <a href="" target="_blank" id="show_page">Go To Login Page</a></p>
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
    <div class="modal fade" id="reserve_email" tabindex="-1" role="reserve_email" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Change Mail Account</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Available Emails</label>
                        <div class="col-md-9">
                            <select class="form-control"></select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn green">Change E-mail</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <div class="modal fade" id="set_password" tabindex="-1" role="set_password" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Set Password</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label">New Password</label>
                        <div class="col-md-9">
                            <input type="text" name="password" maxlength="25" class="form-control"></input>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn green">Save</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <div class="modal fade" id="remove_target" tabindex="-1" role="remove_target" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Delete Account</h4>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this account?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn red">Delete</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection