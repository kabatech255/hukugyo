<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Socialite;
use App\User;

class AuthController extends Controller
{
    public function redirectToProvider($provider)
    {
      return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true); //Authにソーシャル情報を預けてログイン
        return redirect('/mypage');   //認証後に表示したいページを指定
    }

    public function findOrCreateUser($user, $provider)
    {
      $authUser = User::where('provider_id', $user->id)->first();
      if( $authUser ){
        return $authUser;
      }

      return User::create([
        'name' => $user->name,
        'email' => $user->email,
        'provider' => $provider,
        'provider_id' => $user->id,
      ]);

    }
}
