<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use EasyWeChat\Foundation\Application;
use App\User;

class WechatController extends Controller
{
    public function wxOAuthCallback()
    {
        $conf = wxConfig();
        $app = new Application($conf);
        $oauth = $app->oauth;
        $returnedUser = $oauth->user();

        $userInDB = User::where('open_id', $returnedUser->id)->first();
        if ($userInDB == null) {
            $userInDB = new User();
        }

        $userInDB->name = $returnedUser->getName();
        $userInDB->open_id = $returnedUser->id;
        $userInDB->nickname = $returnedUser->nickname;
        $userInDB->sex = $returnedUser->getOriginal()['sex'];
        $userInDB->avatar = $returnedUser->avatar;
        $userInDB->city = $returnedUser->getOriginal()['city'];
        $userInDB->province = $returnedUser->getOriginal()['province'];
        $userInDB->country = $returnedUser->getOriginal()['country'];

        $userInDB->save();

        session(['wechat_user' => $userInDB->id]);
        return redirect(session('target_url'));
    }

    public function serve(Request $request)
    {
        $conf = wxConfig();
        $app = new Application($conf);
        $oauth = $app->oauth;
        /*
        if (empty(session('wechat_user'))) {
            return $oauth->redirect();
        }
        */
        return $oauth->redirect();
    }

    public function checkToken(Request $request)
    {
        echo $request->get('echostr');
    }
}
