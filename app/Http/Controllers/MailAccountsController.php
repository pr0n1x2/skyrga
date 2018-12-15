<?php

namespace App\Http\Controllers;

use App\MailAccount;
use Illuminate\Http\Request;

class MailAccountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = MailAccount::all();

        return view('mail-accounts.index', compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mail-accounts.create');
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
            'email' => 'required|email|max:191',
            'account_name'  => 'required|max:40',
            'password'  => 'required|max:25',
            'domain'  => 'required|url|max:70',
            'login_page'  => 'required|url|max:191'
        ]);

        $account = new MailAccount();
        $account->fill($request->all());
        $account->save();

        return redirect()->route('mail-accounts.index')
            ->with('success', 'New mail account has been successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $account = MailAccount::find($id);

        return response()->json([
            'email'  => $account->email,
            'login'   => $account->account_name,
            'password'   => $account->password,
            'domain'   => $account->domain,
            'page'   => $account->login_page
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $account = MailAccount::find($id);

        return view('mail-accounts.edit', compact('account'));
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
        $this->validate($request, [
            'email' => 'required|email|max:191',
            'account_name'  => 'required|max:40',
            'password'  => 'required|max:25',
            'domain'  => 'required|url|max:70',
            'login_page'  => 'required|url|max:191'
        ]);

        $account = MailAccount::find($id);
        $account->fill($request->all());
        $account->is_deleted = $request->is_deleted ? 0 : 1;
        $account->save();

        return redirect()->route('mail-accounts.index')
            ->with('success', 'Mail account has been updated successfully.');
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
}
