<?php

namespace App\Http\Controllers;

use App\Profile;
use App\Project;
use App\Proxy;
use App\Proxy\ProxyChecker;
use App\Target;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TargetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('targets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'date' => 'required|date'
        ]);

        $profiles = Profile::select('id', 'group_id')->whereIsDeleted(0)->orderBy('group_id', 'asc')->get();
        $projects = Project::select('id', 'post_date')->whereIsArchive(0)->orderBy('id', 'asc')->get();

        $beginDate = Carbon::createFromFormat('Y-m-d', $request->get('date'));
        $endDate = Carbon::createFromTimestamp($beginDate->getTimestamp())->addDay($projects->count() - 1);
        $firstDate = Carbon::createFromTimestamp($beginDate->getTimestamp());

        foreach ($projects as $project) {
            $date = Carbon::createFromTimestamp($firstDate->getTimestamp());
            $groupId = $profiles->first()->group_id;

            foreach ($profiles as $profile) {
                if ($groupId != $profile->group_id) {
                    $groupId = $profile->group_id;

                    $date->addDay(1);

                    if ($date->greaterThan($endDate)) {
                        $date = Carbon::createFromTimestamp($beginDate->getTimestamp());
                    }
                }

                $post_date = empty($project->post_date)
                    ? Carbon::createFromTimestamp($date->getTimestamp())->addDay(1)
                    : Carbon::createFromTimestamp($date->getTimestamp())->addDay($project->post_date);

                $target = new Target();
                $target->profile_id = $profile->id;
                $target->project_id = $project->id;
                $target->register_date = $date->format('Y-m-d');
                $target->post_date = $post_date->format('Y-m-d');
                $target->save();
            }

            $firstDate->addDay(1);
        }

        return redirect()->route('projects.index')->with('success', 'New targets has been successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function remove(Request $request)
    {
        $target = Target::find($request->get('id'));
        $result['status'] = false;

        if ($target) {
            $target->account()->delete();

            $profile = Profile::find($target->profile_id);
            $profile->reserve_mail_account_id = null;
            $profile->save();

            $result['id'] = $profile->email->id;
            $result['email'] = $profile->email->email;
            $result['profile_id'] = $profile->id;
            $result['status'] = true;

            $target->account_id = null;
            $target->is_register = 0;
            $target->is_login = 0;
            $target->is_post = 0;
            $target->save();
        }

        return response()->json($result);
    }

    public function register($date = null)
    {
        $date = is_null($date) ? Carbon::now() : Carbon::createFromFormat('Y-m-d', $date);

        $targets = Target::with([
            'profile' => function ($query) {
                $query->select('id', 'name', 'domain', 'mail_account_id', 'reserve_mail_account_id');
            },
            'profile.email' => function ($query) {
                $query->select('id', 'email');
            },
            'profile.reserveEmail' => function ($query) {
                $query->select('id', 'email');
            },
            'account' => function ($query) {
                $query->select('id', 'mail_account_id', 'username', 'password');
            },
            'account.email' => function ($query) {
                $query->select('id', 'email');
            }
        ])->whereRegisterDate($date->format('Y-m-d'))
            ->orderBy('project_id', 'asc')
            ->get()
            ->groupBy('project_id');

        $counts = Target::getTargetsCounts($targets);
        $activeTargetID = Target::getNextTargetID($targets);

        $projects = Project::select('id', 'name', 'domain', 'register_page', 'login_page')
            ->whereIn('id', $targets->keys())
            ->orderBy('id', 'asc')
            ->get();

        return view('targets.register', compact('targets', 'projects', 'counts', 'activeTargetID'));
    }

    public function checkProxy(Request $request)
    {
        // https://free-proxy-list.net/
        $target = Target::find($request->get('target_id'));
        $activeProxyID = 0;

        if ($target->project->is_use_proxy) {
            $proxies = Proxy::all()->diff($target->project->proxies);
            $proxyChecker = new ProxyChecker(Proxy::PING_URL);

            foreach ($proxies as $proxy) {
                $proxyStr = $proxy->generateProxyString();
                $results = collect($proxyChecker->checkProxies([$proxyStr]))->first();

                if (!key_exists('error', $results)) {
                    $allowed = $results['allowed'];

                    if (in_array('get', $allowed)
                        && in_array('post', $allowed)
                        && in_array('cookie', $allowed)
                        && in_array('user_agent', $allowed)) {
                        $activeProxyID = $proxy->id;
                        break;
                    }
                }
            }
        }

        return view('targets.proxy', compact('target', 'activeProxyID'));
    }
}
