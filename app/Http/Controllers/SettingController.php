<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $autoBid = User::find(auth()->user()->id)['auto_bid'];
        return view('settings', compact('autoBid'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function save(Request $request): RedirectResponse
    {
        $autoBid = $request->input('auto_bid');

        $user = User::find(auth()->user()->id);
        $user->auto_bid = $autoBid;
        $user->save();

        return redirect()->back()->with('success', 'Settings Updated');

    }
}
