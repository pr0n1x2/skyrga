@extends('layout')

@section('title', 'Link Analysis')

@section('content')
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Link Analysis </h3>
        <!-- END PAGE TITLE-->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="{{route('home')}}">Dashboard</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <span>Link Analysis</span>
                </li>
            </ul>
            <div class="page-toolbar">
                <div class="btn-group pull-right">
                    <button type="button" class="btn btn-fit-height default dropdown-toggle" data-toggle="dropdown"> Actions
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <li>
                            <a href="#">
                                <i class="icon-bell"></i> Action</a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon-shield"></i> Another action</a>
                        </li>
                        <li class="divider"> </li>
                        <li>
                            <a href="{{route('hrefs.create')}}">
                                <i class="fa fa-upload"></i> Upload New Data</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- END PAGE BAR -->
        <!-- END PAGE HEADER-->
        <div class="row hrefs-row">
            <div class="col-md-6 hrefs-left">
                @php
                    $domain = $href->domain->scheme->name . $href->domain->domain;
                    $googleQuery = urlencode('site:' . $domain . ' ' . $href->site->domain);
                    $google = 'https://www.google.com/search?q=' . $googleQuery;
                    $link = $domain . $href->url;
                @endphp
                <div class="mt-element-ribbon hrefs-ribon bg-grey-steel">
                    <div class="ribbon ribbon-border-hor ribbon-clip href-ribon ribbon-color-danger uppercase">
                        <div class="ribbon-sub ribbon-clip"></div> Donor site
                    </div>
                    <div class="row hrefs-row">
                        <div class="hrefs-data col-md-4">Domain:</div>
                        <div class="hrefs-data col-md-8"><a href="{{$domain}}" target="_blank">{{$domain}}</a></div>
                    </div>
                    <div class="row hrefs-row">
                        <div class="hrefs-data col-md-4">Link:</div>
                        <div class="hrefs-data col-md-8"><a href="{{$link}}" target="_blank">{{$link}}</a></div>
                    </div>
                    <div class="row hrefs-row">
                        <div class="hrefs-data col-md-4">Page Title:</div>
                        <div class="hrefs-data col-md-8">{{$href->page_title}}</div>
                    </div>
                    <div class="row hrefs-row">
                        <div class="hrefs-data col-md-4">Domain Rating:</div>
                        <div class="hrefs-data col-md-8">{{$href->domain->rating}}</div>
                    </div>
                    <div class="row hrefs-row">
                        <div class="hrefs-data col-md-4">External Link Count:</div>
                        <div class="hrefs-data col-md-8">{{$href->external_links_count}}</div>
                    </div>
                    <div class="row hrefs-row">
                        <div class="hrefs-data col-md-4">Search in Google:</div>
                        <div class="hrefs-data col-md-8"><a href="{{$google}}" target="_blank" class="btn btn-xs btn-info"> <i class="fa fa-google"></i> Find Acceptor in Google </a></div>
                    </div>
                </div>
                <div class="mt-element-ribbon hrefs-ribon bg-grey-steel">
                    <div class="ribbon ribbon-border-hor ribbon-clip href-ribon ribbon-color-success uppercase">
                        <div class="ribbon-sub ribbon-clip"></div> Acceptor site
                    </div>
                    <div class="row hrefs-row">
                        <div class="hrefs-data col-md-4">Page:</div>
                        <div class="hrefs-data col-md-8">{{$href->link_url}}</div>
                    </div>
                    <div class="row hrefs-row">
                        <div class="hrefs-data col-md-4">Domain:</div>
                        <div class="hrefs-data col-md-8"><a href="{{$href->site->url}}" target="_blank">{{$href->site->url}}</a></div>
                    </div>
                    <div class="row hrefs-row">
                        <div class="hrefs-data col-md-4">Link Type:</div>
                        <div class="hrefs-data col-md-8">{{$href->type->name}}</div>
                    </div>
                    <div class="row hrefs-row">
                        <div class="hrefs-data col-md-4">Keyword:</div>
                        <div class="hrefs-data col-md-8"><a href="javascript:;" class="btn btn-xs yellow"> <i class="fa fa-copy"></i> </a>
                            {{$href->site->domain}}
                        </div>
                    </div>
                    <div class="row hrefs-row">
                        <div class="hrefs-data col-md-4">Anchor:</div>
                        <div class="hrefs-data col-md-8"><a href="javascript:;" class="btn btn-xs yellow"> <i class="fa fa-copy"></i> </a>
                            {{$href->link_anchor}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 hrefs-right">
                <div class="mt-element-ribbon hrefs-ribon bg-grey-steel">
                    <div class="ribbon ribbon-border-hor ribbon-clip href-ribon ribbon-color-info uppercase">
                        <div class="ribbon-sub ribbon-clip"></div> Status
                    </div>
                    {{Form::open(['route' => ['hrefs.index'], 'id' => 'articles_form', 'class' => 'horizontal-form'])}}
                    <div class="row hrefs-row">
                        <div class="hrefs-data radio-success col-md-12">
                            <div class="radio-list">
                                <label class="radio-inline">
                                    <input type="radio" name="optionsRadios" id="optionsRadios25" value="option1" checked> The site was successfully registered and managed to place a link. </label>
                            </div>
                        </div>
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
@endsection
