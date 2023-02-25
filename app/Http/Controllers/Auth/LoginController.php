<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Session\SessionBagProxy;

class LoginController extends Controller
{
  /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

  use AuthenticatesUsers;

  /**
   * Where to redirect users after login.
   *
   * @var string
   */

  protected $redirectTo = RouteServiceProvider::HOME;

  public function username()
  {
    return 'username';
  }

  protected function redirectTo()
  {
    if (Auth::user()->user_type == 'admin') {
      return '/admin';
    }
    if (Auth::user()->user_type == 'user') {

      if (!Auth::user()->isApproved) {
        session()->flush();
        redirect()->route('home')->with('not_apporved', 'Your account is not approved.');
      } elseif (!Auth::user()->isEmailVerified) {
        session()->flush();
        redirect()->route('home')->with('not_apporved', 'Your email is not verified.');
      } else {
        Log::info('else auth');
        session()->put('client_id', auth()->user()->id);
        return  '/accounts/current-vehicles';
      }
    }
  }

  public function __construct()
  {
    $this->middleware('guest')->except('logout');
  }
}
