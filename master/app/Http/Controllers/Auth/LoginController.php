<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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
    // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return string
     */
    protected function authenticated($request, $user)
    {
        if ($user->usertype == 'super_admin' ) {
            return redirect('/dashboard');
        }elseif( $user->usertype == 'owner'){
            return redirect('/subsalons');
        }
        elseif( $user->usertype == 'employee'){
            return redirect('/bookings');

        }
         else {
            return redirect('/home');
        }
    }
}
