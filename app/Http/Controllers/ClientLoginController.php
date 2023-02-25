<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Client;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientLoginController extends Controller
{
    

    public function login(Request $req)
    {
        if ($req->session()->has('client_id')) {
            return redirect('/accounts/current-vehicles');
        }        
        return back();
    }


    public function logout_client()
    {
        session()->flush();
        return redirect('/');
    }

    public function profile()
    {
        $sold = Car::where('u_id',session()->get('client_id'))
        ->where('status','sold')->count();
        $purchased = Car::where('p_id',session()->get('client_id'))
        ->count();
        $current = Car::where('u_id',session()->get('client_id'))
        ->where('status','Not sold')->count();

        //dd($sold->count());

        if (!session()->has('client_id')) {
            return redirect('/');
        }
        $client = User::find(session()->get('client_id'));

        return view('client.profile', [
            'client' => $client,
            'sold' => $sold,
            'purchased'=> $purchased,
            'current'=> $current,
        ]);
    }


    public function password()
    {
        $client = User::find(session()->get('client_id'));

        if (request("new-password") == request("confirm-password") && Hash::check(request("current-password"), $client->password)) {

            $client->update([
                "password" => Hash::make(request("new-password")),
                'isApproved' => false
            ]);
            return redirect('/accounts/profile')->with("msg", "Password updated successfully. You have to wait until admin approves updates");
        } else {
            return redirect('/accounts/profile')->with("err", "Current password is invalid.");
        }
    }
}
