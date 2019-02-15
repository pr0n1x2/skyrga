<?php

namespace App\Http\Controllers;

use App\Group;
use App\MailAccount;
use App\Profile;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    private $rules = [
        'name'                      => 'required|min:2|max:70',
        'domain'                    => 'required|url|max:70',
        'mail_account_id'           => 'required',
        'group_id'                  => 'required',
        'gmail'                     => 'required|max:191',
        'gmail_password'            => 'required|max:40',
        'business_name'             => 'required|min:10|max:140',
        'phone'                     => 'required|min:10|max:20',
        'address1'                  => 'required|min:3|max:60',
        'state'                     => 'required|min:3|max:30',
        'state_shortcode'           => 'required|min:2|max:2',
        'city'                      => 'required|min:3|max:40',
        'zip'                       => 'required|min:5|max:10',
        'security_answer_mother'    => 'required|min:3|max:30',
        'security_answer_pet'       => 'required|min:3|max:30',
        'blog_name'                 => 'required',
        'about'                     => 'required',
        'anchor'                    => 'required',
        'main_anchor'               => 'required',
        'proxy'                     => 'required|max:80'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profiles = Profile::select('id', 'name', 'domain', 'is_deleted')->get();

        return view('profiles.index', compact('profiles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profiles.create', [
            'accounts' => MailAccount::pluck('email', 'id')->all(),
            'groups' => Group::pluck('name', 'id')->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules);

        $profile = new Profile();
        $profile->fill($request->all());
        $profile->save();

        return redirect()->route('profiles.index')->with('success', 'New profile has been successfully added.');
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
        $profile = Profile::find($id);

        return view('profiles.edit', [
            'profile' => $profile,
            'accounts' => MailAccount::pluck('email', 'id')->all(),
            'groups' => Group::pluck('name', 'id')->all()
        ]);
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
        $this->validate($request, $this->rules);

        $profile = Profile::find($id);
        $profile->fill($request->all());
        $profile->is_deleted = $request->is_deleted;
        $profile->save();

        return redirect()->route('profiles.index')->with('success', 'Profile has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profile = Profile::find($id);
        $profile->is_deleted = false;
        $profile->save();

        return redirect()->route('profiles.index')->with('success', 'Profile has been deleted.');
    }

    public function setReserveEmail(Request $request)
    {
        $profile = Profile::find($request->get('profile_id'));
        $result['status'] = false;

        if ($profile) {
            $profile->reserve_mail_account_id = $request->get('id');
            $profile->save();

            $result['status'] = true;
        }

        return response()->json($result);
    }
}
