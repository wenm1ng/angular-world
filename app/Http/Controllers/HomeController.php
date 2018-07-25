<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    public function code()
    {
        for ($i = 0; $i < 1000; $i++) {
            info('http://worldcup.flower-wine.com?c=' . Uuid::uuid1()->getHex());
        }
    }

    public function guess(Request $request)
    {
        // $code = $request->input('c');

        // if (getLoginUserId() == 0) {
        //     session(['target_url' => '?c=' . $code]);
        //     return $this->redirectToAuth();
        // } else {
        //     $user = User::find($this->getLoginUserId());
        //     if (null == $user) {
        //         return $this->redirectToAuth();
        //     }
        // }

        // if (!empty($code)) {
        //     session(['user:' . $this->getLoginUserId() . ':code' => $code]);
        // }
        // print_r(DB::select(sprintf("CALL QUERY_YESTERDAY_GAMES(%d)", 23)));
        return view('main')->with(
            [
                'today_games' => DB::select(sprintf("CALL QUERY_TODAY_GAMES(%d)", 23)),
                'yesterday_games' => DB::select(sprintf("CALL QUERY_YESTERDAY_GAMES(%d)", 23)),
                'code' => ''
            ]
        );
    }

    public function test(){
        Cookie::queue('wenming','sdfsdfhsdjghksgskdg',10);

        // print_r(Cookie::get('wenming'));
        session_start();
        print_r(session_id());
    }

    public function center()
    {
        return view('center')->with([
            'guesses' => DB::select(sprintf("CALL USER_GUESSES(%d)", 23)),
            'lotteries' => DB::select(sprintf("CALL USER_LOTTERIES(%d)", 23))
        ]);
    }

    public function loadAddress()
    {
        return User::find($this->getLoginUserId());
    }

    public function saveAddress(Request $request)
    {
        $user = User::find($this->getLoginUserId());

        $user->real_name = $request->input('real_name');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');

        $user->save();

        return responseSuccessJson();
    }
}
