<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller {
    protected function redirectTo(){
        if(Auth::user()->isAdmin){
            return route('profile');
        }
        else {
            //User::logout();
            return route('profile');
        }
    }

}