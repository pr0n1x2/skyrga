<?php

namespace App\Http\Controllers;

use App\Account;
use App\Post;
use App\Profile;
use App\Project;
use App\Proxy;
use App\Proxy\ProxyChecker;
use App\Randomizer\ArticleBuilder;
use App\Randomizer\Randomizer;
use App\Target;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TargetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function index()
    {
        $target = Target::find(1);
//        $post = $target->profile->getNextPost();
//
//        $articleBuilder = new ArticleBuilder($post, $target->profile->city, $target);
//        $article = $articleBuilder->getArticle();
//        $title = $articleBuilder->getTitle();
//        $paragraph = $articleBuilder->getFirstParagraph();

        $post = new Post();
        $post->text = $target->profile->about;

        $articleBuilder = new ArticleBuilder($post, $target->profile->city);
        $article = $articleBuilder->getArticle();
        $title = $articleBuilder->getTitle();
        $paragraph = $articleBuilder->getFirstParagraph();

        dd($paragraph);
        echo $paragraph;
        exit;
    }*/

    public function index($date = null)
    {
        $isToday = false;

        if (!$date) {
            $date = Carbon::now()->format('Y-m-d');
            $isToday = true;
        }

        $targets = Target::with(['project.domain.scheme', 'profile:id,name'])
            ->whereRegisterDate($date)
            ->orderBy('project_id', 'asc')
            ->get();

        $user = User::find(Auth::user()->id);

        return view('targets.index', compact('targets', 'user', 'date', 'isToday'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $profiles = Profile::whereIsDeleted(0)->get()->pluck('name', 'id');

        return view('targets.create', compact('id', 'profiles'));
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
            'periodicity' => 'required',
            'date' => 'required|date',
            'profiles' => 'required',
            'project_id' => 'required'
        ]);

        $periodicity = $request->get('periodicity');
        $project_id = $request->get('project_id');
        $profilesFromForm = $request->get('profiles');
        $publicationCount = 0;

        $project = Project::find($project_id);

        $profiles = Profile::select('id')
            ->orderBy('id')
            ->get()
            ->map(function ($item) use (&$profilesFromForm, &$publicationCount) {
                if (!in_array($item->id, $profilesFromForm)) {
                    return false;
                } else {
                    $publicationCount++;
                    return $item;
                }
            });

        $profilesCount = $profiles->count();

        $targets = [];
        $matrix = Target::getMatrix($request->get('date'));
        $step = 0;

        foreach ($matrix as $date => $values) {
            if (!$step) {
                for ($i = 0; $i < $profilesCount; $i++) {
                    if ($profiles[$i] !== false && $values[$i] == 0 && !in_array($profiles[$i]->id, $targets)) {
                        $targets[$date] = $profiles[$i]->id;
                        $step = $periodicity - 1;
                        break;
                    }
                }
            } else {
                $step--;
            }

            if (count($targets) == $publicationCount) {
                break;
            }
        }

        foreach ($targets as $date => $profile_id) {
            if ($project->post_date) {
                $postDate = Carbon::createFromFormat('Y-m-d', $date)->addDay($project->post_date);
                $postDate = $postDate->format('Y-m-d');
            } else {
                $postDate = $date;
            }

            $target = new Target();
            $target->profile_id = $profile_id;
            $target->project_id = $project->id;
            $target->register_date = $date;
            $target->post_date = $postDate;
            $target->save();
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

    public function register($id, $date = null)
    {
        $target = Target::find($id);
        $account = $target->getAccount();

        $target->getDomainForUbot();

        return view('targets.register', compact('target', 'account'));
    }

    /*public function register($date = null)
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
        $nextTarget = Target::getNextTarget($targets);

        if ($nextTarget) {
            $activeTargetID = $nextTarget->id;
            $activeTargetStr = $nextTarget->profile->name . ' (' . $nextTarget->profile->domain . ')';
        } else {
            $activeTargetID = 0;
        }

        $projects = Project::select('id', 'name', 'domain', 'register_page', 'login_page')
            ->whereIn('id', $targets->keys())
            ->orderBy('id', 'asc')
            ->get();

        return view('targets.register', compact(
            'targets',
            'projects',
            'counts',
            'activeTargetID',
            'activeTargetStr'
        ));
    }*/

    public function registerComplete($id, $date = null)
    {
        $target = Target::find($id);

//        if ($request->has('username')) {
//            $target->account->username = $request->get('username');
//            $target->account->save();
//        }

        return view('targets.regcomplete', compact('target', 'request', 'date'));
    }

    /*public function checkProxy(Request $request)
    {
        // https://free-proxy-list.net/
        // https://www.blackhatprotools.info/showthread.php?2-How-To-Become-VIP-Member-amp-Why
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
    }*/

    public function generate(Request $request)
    {
        $target = Target::find($request->get('target_id'));
        $account = $target->account;
        $randomizer = new Randomizer($target, $account);

        return view('targets.generate', compact('target', 'randomizer'));
    }

    public function upload()
    {
        return view('targets.upload');
    }

    public function storeUbot(Request $request)
    {
        $this->validate($request, [
            'ubot' => 'required|file'
        ]);

        $request->ubot->storeAs(Target::PATH_TO_UBOT_ARCHIVE, Target::UBOT_ARCHIVE_FILENAME);

        DB::table('users')
            ->where('id', '<>', Auth::user()->id)
            ->whereIn('role', [User::ADMIN_ROLE, User::USER_ROLE])
            ->update(['is_new_ubot_archive' => true]);

        return redirect()->route('targets.index')->with('success', 'New archive was successfully uploaded.');
    }

    public function downloadUbot()
    {
        $user = User::find(Auth::user()->id);
        $user->is_new_ubot_archive = false;
        $user->save();

        $file = public_path() . Target::PATH_TO_UBOT_ARCHIVE . Target::UBOT_ARCHIVE_FILENAME;
        $filename = 'UbotArchive' . Carbon::now()->format('Y-m-d') . '.rar';

        return response()->download($file, $filename);
    }

    public function martix()
    {
        $startDate = '2019-02-20';

        $date = Carbon::createFromFormat('Y-m-d', $startDate);
        $profiles = Profile::select('id')->orderBy('id')->get();
        $profilesCount = $profiles->count();

        $tagrets = Target::select('register_date', 'profile_id', 'project_id')
            ->where('register_date', '>=', $startDate)
            ->orderBy('register_date', 'asc')
            ->orderBy('profile_id')
            ->get()
            ->groupBy('register_date')
            ->toArray();

        $in_array = function ($profile_id, $date) use (&$tagrets) {
            for ($i = 0; $i < count($tagrets[$date]); $i++) {
                if ($tagrets[$date][$i]['profile_id'] == $profile_id) {
                    return $tagrets[$date][$i]['project_id'];
                }
            }

            return 0;
        };

        $matrix = [];

        for ($i = 0; $i < 730; $i++) {
            $dateStr = $date->format('Y-m-d');
            $profs = [];

            for ($j = 0; $j < $profilesCount; $j++) {
                if (isset($tagrets[$dateStr])) {
                    $profs[] = $in_array($profiles[$j]->id, $dateStr);
                } else {
                    $profs[] = 0;
                }
            }

            $matrix[$dateStr] = $profs;
            $date->addDay(1);
        }

        echo '<table border="1" width="100%">';

        foreach ($matrix as $date => $values) {
            echo '<tr><td><strong>' . $date . '</strong></td>';

            for ($i = 0; $i < count($values); $i++) {
                if ($values[$i] == 0) {
                    echo '<td style="color:red">' . $values[$i] . '</td>';
                } else {
                    echo '<td>' . $values[$i] . '</td>';
                }

            }

            echo '</tr>';
        }

        echo '</table>';

        exit;
    }
}
