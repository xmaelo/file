<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    public function index()
    {
        if (!auth()->check() && auth()->user()->user_type !== 'admin') {
            return redirect('/admin/accounts/login');
        }

        $memberships= Membership::all();
        return view('admin.membership.index',[
          'memberships'=>$memberships  
        ]);
    }
    public function create(Request $req)
    {
        if (!auth()->check() && auth()->user()->user_type !== 'admin') {
            return redirect('/admin/accounts/login');
        }
        request()->validate([
            'title' => 'required',            
            'description' => 'required',
        ]);        

        Membership::create([
            'title' => request('title'),            
            'description' => request('description'),
        ]);
        return back();
    }

    public function edit(Membership $membership){
        if (!auth()->check() && auth()->user()->user_type !== 'admin') {
            return redirect('/admin/accounts/login');
        }
        return view('admin.membership.edit',[
            'membership' => $membership
        ]);
    }
    public function update(Membership $membership, Request $req){
        if (!auth()->check() && auth()->user()->user_type !== 'admin') {
            return redirect('/admin/accounts/login');
        }

        request()->validate([
            'title' => 'required',         
            'description' => 'required',
        ]);       

        $membership->update([
            'title' => request('title'),           
            'description' => request('description'),
        ]);
        return redirect('/admin/memberships');
    }

    public function destroy(Membership $membership){
        if(!auth()->check() && auth()->user()->user_type !== 'admin'){
            return redirect('/admin/accounts/login');
        }
        $membership->delete();
        return back(); 
    }


}
