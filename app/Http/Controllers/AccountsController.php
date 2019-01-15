<?php

namespace App\Http\Controllers;

use App\Account;
use Illuminate\Http\Request;

class AccountsController extends Controller
{
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
