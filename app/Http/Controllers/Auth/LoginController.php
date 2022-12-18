<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\Order_item;
use App\Models\Comment;

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

     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function createlogin()
    {
        return view('auth/login');
    }
    
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            

            if (Auth::user()->permission == 0 || Auth::user()->permission == 1) {
                return redirect()->route('homeAdmin');
            } else {
                return redirect()->route('home');
            }

        } else {
            session()->flash('messageLoginError', 'User account or password incorrect');
            return redirect()->route('login');
        }
    }

}
