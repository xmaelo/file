<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        if (!auth()->check()) {
            return redirect('/admin/accounts/login');
        }

        $user = User::find(auth()->user()->id);
        return view('admin.profile.index', ['user' => $user]);
    }

    public function store()
    {
        if (!auth()->check()) {
            return redirect('/admin/accounts/login');
        }

        $user = User::find(auth()->user()->id);
        if (request("pw") == request("cpw") && Hash::check(request("current"), $user->password)) {
            $user->update([
                "password" => Hash::make(request("pw"))
            ]);

            return redirect("/admin/accounts/profile")->with("msg", "Password updated successfully.");
        } else {
            return redirect("/admin/accounts/profile")->with("err", "Current password is invalid.");
        }
    }
}
