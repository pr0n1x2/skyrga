@extends('ubot')

@section('title', 'Registration is complete')

@section('content')
<div class="page-container">
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content ubot-full-width">
            <!-- BEGIN PAGE HEADER-->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title"> Registration is complete </h3>
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <div class="note note-success">
                <p> Congratulations, profile &quot;{{$target->profile->name }} ({{($target->profile->domain)}})&quot; was successfully registered.</p>
            </div>
            <div class="col-md-6">
                <!-- BEGIN Portlet PORTLET-->
                <div class="portlet">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-info"></i>Account Info </div>
                    </div>
                    <div class="portlet-body">
                        @php
                            $domain = $target->project->domain->scheme->name . $target->project->domain->domain;
                        @endphp
                        <div class="row">
                            <div class="fa-item col-md-4">Target:</div>
                            <div class="fa-item col-md-8">{{$domain}}</div>
                        </div>
                        <div class="row">
                            <div class="fa-item col-md-4"><strong>E-mail:</strong></div>
                            <div class="fa-item col-md-8"><strong>{{$target->account->email->email}}</strong></div>
                        </div>
                        <div class="row">
                            <div class="fa-item col-md-4">Username:</div>
                            <div class="fa-item col-md-8">{{$target->account->username}}</div>
                        </div>
                        <div class="row">
                            <div class="fa-item col-md-4">Password:</div>
                            <div class="fa-item col-md-8">@if(!empty($target->account->password)) {{$target->account->password}} @else password not set @endif</div>
                        </div>
                        <div class="row">
                            <div class="fa-item col-md-4">Gender:</div>
                            <div class="fa-item col-md-8">{{ucfirst($target->account->gender)}}</div>
                        </div>
                        <div class="row">
                            <div class="fa-item col-md-4">Firstname:</div>
                            <div class="fa-item col-md-8">{{$target->account->firstname}}</div>
                        </div>
                        <div class="row">
                            <div class="fa-item col-md-4">Lastname:</div>
                            <div class="fa-item col-md-8">{{$target->account->lastname}}</div>
                        </div>
                        <div class="row">
                            <div class="fa-item col-md-4">Registration date:</div>
                            <div class="fa-item col-md-8">{{$target->account->created_at->format('d F Y \a\t H:i')}}</div>
                        </div>
                    </div>
                </div>
                <!-- END Portlet PORTLET-->
            </div>
            <div class="col-md-6">
                <!-- BEGIN Portlet PORTLET-->
                <div class="portlet">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-arrow-circle-o-right"></i>Continue Registration </div>
                    </div>
                    <div class="portlet-body">
                        <a href="/targets/{{$date}}" class="btn btn-lg blue">
                            <i class="fa fa-forward"></i> Go To Next Step
                        </a>
                    </div>
                </div>
                <!-- END Portlet PORTLET-->
            </div>
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
</div>
@endsection