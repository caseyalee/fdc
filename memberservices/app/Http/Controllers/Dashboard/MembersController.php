<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class MembersController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('manage-members')->with('users',$users);
    }

    public function hubSpotSync()
    {
        \App\Jobs\SyncHubSpotJob::dispatchSync();
        return redirect()->route('admin-members')->with('status', 'HubSpot Sync Complete');
    }

    public function profileUpdate(Request $request)
    {
        $user = User::findOrFail($request->user);
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->address1 = $request->get('address1');
        $user->address2 = $request->get('address2');
        $user->city = $request->get('city');
        $user->state = $request->get('state');
        $user->zip = $request->get('zip');
        $user->pref_marketing_emails = ($request->get('pref_marketing_emails') == 'on') ? 'true' : 'false';
        $user->pref_newsletter_emails = ($request->get('pref_newsletter_emails') == 'on') ? 'true' : 'false';
        $user->pref_sms = ($request->get('pref_sms') == 'on') ? 'true' : 'false';
        $user->save();
        return redirect()->route('dashboard')->with('status', 'Profile Updated!');
    }

}
