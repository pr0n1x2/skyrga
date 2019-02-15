<?php

namespace App\Http\Controllers;

use App\Account;
use App\MailAccount;
use Illuminate\Http\Request;

class AccountsController extends Controller
{
    private $rules = [
        'mail_account_id' => 'required',
        'gender' => 'required',
        'username' => 'required|min:5|max:40',
        'password' => 'required|min:8|max:25',
        'firstname' => 'required|min:3|max:25',
        'lastname' => 'required|min:3|max:25',
        'prefix' => 'required|min:2|max:10',
        'middlename' => 'required|min:2|max:25',
        'birthday' => 'required|date',
        'address1' => 'required|min:3|max:60',
        'address2' => 'nullable|min:3|max:60',
        'state' => 'required|min:3|max:60',
        'state_shortcode' => 'required|min:2|max:2',
        'city' => 'required|min:2|max:40',
        'zip' => 'required|min:5|max:10',
        'phone' => 'required|min:16|max:20',
        'domain_word' => 'required|min:8|max:40'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = Account::with('email')->whereIsPublic(1)->orderBy('id', 'desc')->get();

        return view('accounts.index', compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $emails = MailAccount::whereIsDeleted(0)->get();
        $profileEmails = MailAccount::whereHas('profile')->get();
        $reserveEmails = $emails->diff($profileEmails)->pluck('email', 'id');

        return view('accounts.create', compact('reserveEmails'));
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

        $account = new Account();
        $account->fill($request->all());
        $account->is_public = 1;
        $account->save();

        return redirect()->route('accounts.index')->with('success', 'New account has been successfully added.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $account = Account::find($id);

        $emails = MailAccount::whereIsDeleted(0)->get();
        $profileEmails = MailAccount::whereHas('profile')->get();
        $reserveEmails = $emails->diff($profileEmails)->pluck('email', 'id');

        return view('accounts.edit', compact('account', 'reserveEmails'));
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

        $account = Account::find($id);
        $account->fill($request->all());
        $account->save();

        return redirect()->route('accounts.index')->with('success', 'Account has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $account = Account::find($id);
        $account->is_public = 0;
        $account->save();

        return redirect()->route('accounts.index')->with('success', 'Account has been deleted.');
    }

    public function setPassword(Request $request)
    {
        $account = Account::find($request->get('id'));
        $result['status'] = false;

        if ($account) {
            $account->password = $request->get('password');
            $account->save();

            $result['status'] = true;
        }

        return response()->json($result);
    }
}
