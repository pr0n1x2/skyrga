@extends('layout')

@section('title', 'Create New Targets')

@section('content')
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title"> Create New Targets Page </h3>
            <!-- END PAGE TITLE-->
            <!-- BEGIN PAGE BAR -->
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{route('home')}}">Dashboard</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="{{route('projects.index')}}">List of Projects</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span>Create New Targets Page</span>
                    </li>
                </ul>
                <div class="page-toolbar">
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-fit-height default dropdown-toggle" data-toggle="dropdown"> Actions
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li>
                                <a href="{{route('projects.index')}}">
                                    <i class="icon-action-undo"></i> Back to Projects</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- END PAGE BAR -->
            <!-- END PAGE HEADER-->
            <div class="portlet light bg-inverse">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-anchor font-red-sunglo"></i>
                        <span class="caption-subject font-red-sunglo bold uppercase">Create new targets form</span>
                    </div>
                </div>
                @include('errors')
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    {{Form::open(['route' => 'targets.store', 'id' => 'targets_form', 'class' => 'horizontal-form'])}}
                    <div class="form-body">
                        <h3 class="form-section">Targets Info</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php
                                        $periodicity = [
                                            1 => 'Everyday',
                                            2 => 'Every two days',
                                            3 => 'Every three days',
                                            4 => 'Every four days',
                                            5 => 'Every five days',
                                            6 => 'Every six days',
                                            7 => 'Every seven days',
                                            8 => 'Every eight days',
                                            9 => 'Every nine days',
                                            10 => 'Every ten days'
                                        ];
                                    ?>
                                    <label class="control-label">Periodicity</label>
                                    {{Form::select('periodicity', $periodicity, old('periodicity'), ['placeholder' => 'Pick a Periodicity', 'id' => 'periodicity', 'class' => 'form-control'])}}
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Start date</label>
                                    <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" data-date-start-date="+0d">
                                        <input type="text" name="date" id="date" value="{{old('date')}}" class="form-control" readonly>
                                        <span class="input-group-btn">
                                            <button class="btn default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Profiles</label>
                                    {{Form::select('profiles[]', $profiles, old('profiles'), ['multiple' => 'multiple', 'class' => 'form-control'])}}
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                    </div>
                    <div class="form-actions left">
                        <input type="hidden" name="project_id" value="{{$id}}">
                        <a href="{{route('projects.index')}}" class="btn default">Cancel</a>
                        <button type="submit" class="btn blue">
                            <i class="fa fa-check"></i> Create</button>
                    </div>
                    {{Form::close()}}
                <!-- END FORM-->
                </div>
            </div>
        </div>
        <!-- END CONTENT BODY -->
    </div>
@endsection