<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GithubAuthController extends Controller
{
    public function __construct()
    {
        $this ->middleware(['guest']);
    }
    public function redirect(){
        return Socialite::driver('github')->redirect();
}
    public function callback(){
        $user = Socialite::driver('github')->user();
        // dd($user->getNickName());
        // dd($user->getEmail());
        $user = User::firstOrCreate(
            ['name'=> $user -> getNickName()],
            ['email'=> $user -> getEmail(),
            'password'=> Hash::make(Str::random(24))],
        );
        Auth::login($user);

        //사용자가 원래 요청한 페이지로 redirection
        return redirect()->intended('/dashboard');
    }
}
