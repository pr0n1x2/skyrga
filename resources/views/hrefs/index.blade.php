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
                            <a href="{{route('hrefs.successful')}}">
                                <i class="fa fa-thumbs-o-up"></i> Show Successful Domains</a>
                        </li>
                        <li>
                            <a href="{{route('hrefs.failed')}}">
                                <i class="fa fa-thumbs-o-down"></i> Show Failed Domains</a>
                        </li>
                        @if(\Illuminate\Support\Facades\Auth::user()->role == \App\User::ADMIN_ROLE)
                        <li>
                            <a href="{{route('hrefs.pending')}}">
                                <i class="fa fa-hand-peace-o"></i> Show Pending Domains</a>
                        </li>
                        <li class="divider"> </li>
                        <li>
                            <a href="{{route('hrefs.create')}}">
                                <i class="fa fa-upload"></i> Upload New Data</a>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <!-- END PAGE BAR -->
        <!-- END PAGE HEADER-->
        @include('errors')
        @include('success')
        @if(!$href->is_analized)
            <div class="alert alert-warning">
                <strong>Warning!</strong> This link does not need analysis! You can view the information, but cannot change the link status.
            </div>
        @endif
        @if($href->is_analized && $href->hrefs_status_id != 1)
            <div class="alert alert-info alert-dismissable">
                @php
                    $date = $href->updated_at->format('F d, Y');
                @endphp
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <strong>Info!</strong> The status of this link was last changed on {{$date}} by user {{$href->user->fullname}}.
            </div>
        @endif
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
                    @if($href->domain->root_domain_id)
                        @php
                            $rootDomain = $href->domain->rootDomain->scheme->name . $href->domain->rootDomain->domain;
                        @endphp
                        <div class="row hrefs-row">
                            <div class="hrefs-data col-md-4">Root Domain:</div>
                            <div class="hrefs-data col-md-8"><a href="{{$rootDomain}}" target="_blank">{{$rootDomain}}</a></div>
                        </div>
                    @endif
                    <div class="row hrefs-row">
                        <div class="hrefs-data col-md-4"><strong>Link:</strong></div>
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
                        <div class="hrefs-data col-md-8"><a href="{{$google}}" target="_blank" class="btn btn-xs blue-hoki"> <i class="fa fa-google"></i> Find Acceptor in Google </a></div>
                    </div>
                    <div class="row hrefs-row">
                        <div class="hrefs-data col-md-4">Link Url:</div>
                        <div class="hrefs-data col-md-8"><a href="javascript:;" class="btn btn-xs yellow copy-data copy-url"> <i class="fa fa-copy"></i></a> <span>{{$href->id}}</span></div>
                    </div>
                </div>
                <div class="mt-element-ribbon hrefs-ribon bg-grey-steel">
                    <div class="ribbon ribbon-border-hor ribbon-clip href-ribon ribbon-color-info uppercase">
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
                        <div class="hrefs-data col-md-4"><strong>Keyword:</strong></div>
                        <div class="hrefs-data col-md-8"><a href="javascript:;" class="btn btn-xs yellow copy-data copy-keyword"> <i class="fa fa-copy"></i> </a>
                            <span>{{$href->site->domain}}</span>
                        </div>
                    </div>
                    <div class="row hrefs-row">
                        <div class="hrefs-data col-md-4">Anchor:</div>
                        <div class="hrefs-data col-md-8"><a href="javascript:;" class="btn btn-xs yellow copy-data copy-anchor"> <i class="fa fa-copy"></i> </a>
                            <span>{{$href->link_anchor}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 hrefs-right">
                <div class="mt-element-ribbon hrefs-ribon bg-grey-steel">
                    <div class="ribbon ribbon-border-hor ribbon-clip href-ribon ribbon-color-success uppercase">
                        <div class="ribbon-sub ribbon-clip"></div> Status
                    </div>
                    {{Form::open(['route' => ['hrefs.update', $href->id], 'method' => 'put', 'id' => 'edit_hrefs_form', 'class' => 'horizontal-form'])}}
                    <div class="row hrefs-row">
                        <div class="hrefs-status col-md-12">
                            <div class="radio-list">
                                <label class="radio-inline font-green-jungle">
                                    <input type="radio" name="hrefs_status_id" value="2" @if($href->hrefs_status_id == 2) checked @endif> <strong>The site was successfully registered and the link has been posted</strong> </label>
                            </div>
                        </div>
                        @if(\Illuminate\Support\Facades\Auth::user()->role == \App\User::ADMIN_ROLE)
                            <div class="hrefs-status col-md-12">
                                <div class="radio-list">
                                    <label class="radio-inline font-yellow">
                                        <input type="radio" name="hrefs_status_id" value="3" @if($href->hrefs_status_id == 3) checked @endif> <strong>Donor allows to post a link. Send to prepare</strong> </label>
                                </div>
                            </div>
                        @endif
                        @foreach($statuses as $status)
                            <div class="hrefs-status col-md-12">
                                <div class="radio-list">
                                    <label class="radio-inline radio-error @if($href->hrefs_status_id == $status->id) font-red-thunderbird @endif">
                                        <input type="radio" name="hrefs_status_id" value="{{$status->id}}" @if($href->hrefs_status_id == $status->id) checked @endif> {{$status->name}} </label>
                                </div>
                            </div>
                        @endforeach
                        <div class="hrefs-status col-md-12">
                            <div class="radio-list">
                                <label class="radio-inline radio-error">
                                    <input type="radio" name="hrefs_status_id" value="5" @if($href->hrefs_status_id == 5) checked @endif> Other reason </label>
                            </div>
                        </div>
                        <div class="hrefs-status col-md-12">
                            <div class="form-group">
                                <textarea name="comment" class="form-control" rows="3" placeholder="The reason (optional)">{{$href->comment}}</textarea>
                            </div>
                        </div>
                        <div class="form-actions">
                            @if($href->is_analized)
                                <button type="submit" class="btn green"><i class="fa fa-check"></i> Submit</button>
                            @else
                                <button type="button" class="btn default"><i class="fa fa-check"></i> Submit</button>
                            @endif
                        </div>
                    </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
        @if($pagesFromDomain)
            <div class="row hrefs-row">
                <div class="col-md-12 hrefs-center">
                    <div class="mt-element-ribbon hrefs-ribon bg-grey-steel">
                        <div class="ribbon ribbon-border-hor ribbon-clip href-ribon ribbon-color-warning uppercase">
                            <div class="ribbon-sub ribbon-clip"></div> Links to other acceptors
                        </div>
                        <div class="table-scrollable">
                            <table class="table hrefs-table hrefs-table-hover">
                                <thead>
                                <tr>
                                    <th style="width:5%"> # </th>
                                    <th style="width:25%"> Acceptor </th>
                                    <th style="width:20%"> Keyword </th>
                                    <th style="width:40%"> Link </th>
                                    <th style="width:10%"> Link Analysis </th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $pagesCounter = 0
                                @endphp
                                @foreach($pagesFromDomain as $link)
                                    @php
                                        $site = $link->site->url;
                                        $url = $link->domain->scheme->name  . $link->domain->domain . $link->url;
                                    @endphp
                                    <tr>
                                        <td> {{++$pagesCounter}} </td>
                                        <td> <a href="{{$site}}" target="_blank">{{$site}}</a> </td>
                                        <td> {{$link->site->domain}} </td>
                                        <td> <a href="{{$url}}" target="_blank">{{$url}}</a> </td>
                                        <td> <a href="{{route('hrefs.analyze', $link->id)}}" target="_blank" class="btn btn-xs purple"> <i class="fa fa-external-link"></i> Analyze Link </a> </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if($subDomains)
            <div class="row hrefs-row">
                <div class="col-md-12 hrefs-center">
                    <div class="mt-element-ribbon hrefs-ribon bg-grey-steel">
                        <div class="ribbon ribbon-border-hor ribbon-clip href-ribon ribbon-color-primary uppercase">
                            <div class="ribbon-sub ribbon-clip"></div> Root domain subdomains
                        </div>
                        <div class="table-scrollable">
                            <table class="table hrefs-table hrefs-table-hover">
                                <thead>
                                    <tr>
                                        <th style="width:5%"> # </th>
                                        <th style="width:20%"> Sub Domain </th>
                                        <th style="width:20%"> Acceptor </th>
                                        <th style="width:10%"> Is Analyzed </th>
                                        <th style="width:35%"> Link </th>
                                        <th style="width:10%"> Link Analysis </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $subCounter = 0
                                    @endphp
                                    @foreach($subDomains as $subDomain)
                                    @php
                                        $domain = $subDomain->domain->scheme->name  . $subDomain->domain->domain;
                                        $link = $subDomain->domain->scheme->name  . $subDomain->domain->domain . $subDomain->url;

                                        if ($subDomain->site->domain == $href->site->domain) {
                                            $acceptor = '<span class="label label-info"> ' . $subDomain->site->domain . ' </span>';
                                        } else {
                                            $acceptor = $subDomain->site->domain;
                                        }

                                        if ($subDomain->is_analized == 1 && $subDomain->hrefs_status_id != 1) {
                                            $verified = '<span class="label label-success"> Analyzed </span>';
                                        } else {
                                            $verified = '<span class="label label-default"> Not analyzed </span>';
                                        }
                                    @endphp
                                    <tr>
                                        <td> {{++$subCounter}} </td>
                                        <td> <a href="{{$domain}}" target="_blank">{{$domain}}</a> </td>
                                        <td> {!!$acceptor!!} </td>
                                        <td> {!!$verified!!} </td>
                                        <td> <a href="{{$link}}" target="_blank">{{$link}}</a> </td>
                                        <td> <a href="{{route('hrefs.analyze', $subDomain->id)}}" target="_blank" class="btn btn-xs purple"> <i class="fa fa-external-link"></i> Analyze Link </a> </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <!-- END CONTENT BODY -->
</div>
@endsection
