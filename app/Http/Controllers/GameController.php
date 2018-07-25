<?php

namespace App\Http\Controllers;

use App\Models\BadCodes;
use App\Models\Game;
use App\Models\Guess;
use App\Models\Lottery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GameController extends Controller
{
    public function bet(Request $request)
    {

        // $code = $request->input('code');
        $code = session('user:' . $this->getLoginUserId() . ':code');
        // $code = '71feaf2f463f711e8a57600fff4c61558';

        $foundCode = DB::table('codes')->where('code', $code)->first();
        if ($foundCode) {

            $foundGuessCount = Guess::where('bet_code', $code)->count();
            if ($foundGuessCount > 0) {
                return responseErrorJson(1, '编码已使用');
            }

            $foundUserGuessCount = Guess::where([
                ['game_id', $request->get('game_id')],
                ['user_id', $this->getLoginUserId()]
            ])->count();

            if ($foundUserGuessCount > 0) {
                return responseErrorJson(1, '您已竞猜本场,请猜其他场次吧');
            }

            $game = Game::find($request->game_id);
            if ($game->game_time < date('Y-m-d H:i:s')) {
                return responseErrorJson(1, '本场竞猜已结束');
            }

            $result_guess = DB::table('guesses')->where('game_user', $request->input('game_id') . '_' . $this->getLoginUserId())->first();

            if (!$result_guess) {
                $guess = new Guess();
                $guess->bet_result = $request->input('result');
                $guess->bet_code = $code;
                $guess->game_id = $request->input('game_id');
                $guess->user_id = $this->getLoginUserId();
                $guess->game_user = $request->input('game_id') . '_' . $this->getLoginUserId();

                $guess->save();
            } else {
                $guess = new Guess();
                $guess->status = 0;
            }

            return responseSuccessJson($guess);
        } else {
            if($code != ''){
                $badCodes = new BadCodes();
                $badCodes->codes = $code;
                $badCodes->status = 0;
                $badCodes->save();
            }
            return responseErrorJson(1, '无效码');
        }
    }

    public function bets()
    {
        return view('bet')->with([
            'bets' => Guess::where('user_id', $this->getLoginUserId())->orderBy('id', 'desc')->get()
        ]);
    }

    private function getName($type)
    {
        switch ($type) {
            case 1:
                $remark = '小米4k运动摄像机';
                break;
            case 2:
                $remark = 'Adidas世界杯双肩包';
                break;
            case 3:
                $remark = '抖音神器-手机单反镜';
                break;
            case 4:
                $remark = '复古游戏机';
                break;
            case 5:
                $remark = '彩色调酒杯';
                break;
            default:
                $remark = '';
                break;
        }
        return $remark;
    }

    public function drawLottery(Request $request)
    {
        $game_id = $request->input('game_id');
        $user_id = $this->getLoginUserId();

        $game = Game::find($game_id);

/*
        if (!((date('d') - date('d' , strtotime($game->game_time)) == 1) && date('H') >= 12)) {
            return responseErrorJson(1, '抽奖还未开始或已结束');
        }
*/
        $guess = Guess::where([
            ['game_id', $game_id],
            ['user_id', $user_id]
        ])->first();

        $lottery = Lottery::where([
            ['game_id', $game_id],
            ['user_id', $user_id]
        ])->first();

        if ($lottery && $lottery->status == 0) {
            $lottery->status = 1;
            $lottery->save();
            $lottery->remark = $this->getName($lottery->result);
            return responseSuccessJson($lottery);
        }

        if ($lottery) {
            return responseErrorJson(1, '不能重复抽奖');
        }

        $goodToDraw = $guess && $game->result == $guess->bet_result;

        if ($goodToDraw) {

            $users = DB::select(sprintf('CALL QUERY_LOTTERY_CANDIDATES(%d)', $game_id));

            $prizes = DB::select(sprintf('CALL QUERY_AVAILABLE_PRIZES(%d)', $game_id));
            $arrPrize = [];
            foreach ($prizes as $prize) {
                for ($i = 0; $i < $prize->left_first; $i++) {
                    $arrPrize[] = 1;
                }
                for ($i = 0; $i < $prize->left_second; $i++) {
                    $arrPrize[] = 2;
                }
                for ($i = 0; $i < $prize->left_third; $i++) {
                    $arrPrize[] = 3;
                }
                for ($i = 0; $i < $prize->left_fourth; $i++) {
                    $arrPrize[] = 4;
                }
                for ($i = 0; $i < $prize->left_five; $i++) {
                    $arrPrize[] = 5;
                }
            }
            if (count($arrPrize) == 0) {
                $prize = [0];
            } else {
                $prize = collect($arrPrize)->random(1);
            }

            $randomUser = collect($users)->random(1);

            $lottery = new Lottery();
            $lottery->game_id = $game_id;
            $lottery->user_id = $user_id;
            $lottery->result = $user_id == $randomUser[0]->user_id ? $prize[0] : 0;
            $lottery->status = 1;

            $lottery->save();

            $lottery->remark = $this->getName($lottery->result);

            return responseSuccessJson($lottery);
        } else {
            return responseErrorJson(1, '未获得抽奖资格');
        }
    }

    public function rank()
    {
        $arr = DB::select('CALL ORDER_WIN_GUESSES()');

        if (!empty($arr)) {
            foreach ($arr as $key => $val) {
                if ($val->id == $this->getLoginUserId()) {
                    $arr[$key]->myself = 1;
                } else {
                    $arr[$key]->myself = 0;
                }
            }
        }

        return view('rank')->with([
            'guesses' => $arr
        ]);
    }

    public function lotteries()
    {
        return view('lotteries')->with([
            'lotteries' => collect(DB::select('CALL QUERY_HISTORY_LOTTERIES()'))->groupBy('d')
        ]);
    }

    public function history()
    {
        return view('history')->with([
            'games' => DB::select('CALL QUERY_HISTORY_GAMES()')
        ]);
    }
}
