<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;

class MembersController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('manage-members')->with('users',$users);
    }

}
