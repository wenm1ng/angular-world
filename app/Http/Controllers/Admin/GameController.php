<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Lottery;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GameController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->get('current_page');
        //$list = Game::get();
        return response()->json(Game::orderBy('game_time' , 'asc')->orderBy('id','desc')->paginate(15, ['*'], 'page', $page));
    }

    public function saveGame(Request $request)
    {
        if ($request->get('id') > 0) {
            $game = Game::find($request->get('id'));
        } else {
            $game = new Game();
        }

        $game->fill($request->all());

        if (isset($game->team_score) && isset($game->opponent_score)) {
            if($game->team_score > $game->opponent_score){
                $game->result = 1;
            }else if($game->team_score == $game->opponent_score){
                $game->result = 0;
            }else{
                $game->result = -1;
            }
        }
        $game->save();

        return responseSuccessJson($game);
    }

    public function deleteGame(Request $request)
    {
        $game = Game::find($request->get('id'));
        $game->delete();

        return responseSuccessJson($game);
    }

    public function listTeams()
    {
        return response()->json(Team::get());
    }

    public function saveTeam(Request $request)
    {
        if ($request->get('id') > 0) {
            $team = Team::find($request->get('id'));
        } else {
            $team = new Team();
        }

        $team->fill($request->all());

        $relativeUrl = $this->saveFile($request, 'flag_url');
        if (!empty($relativeUrl)) {
            $team->flag_url = $relativeUrl;
        }

        $team->save();

        return responseSuccessJson(Team::get());
    }

    public function deleteTeam(Request $request)
    {
        $team = Team::find($request->get('id'));
        $team->delete();

        return responseSuccessJson(Team::get());
    }

    public function guesses(Request $request)
    {
        return DB::select('CALL QUERY_GAME_GUESSES(' . $request->input('game') . ','. $request->input('team') .')');
    }

    public function deleteLottery(Request $request)
    {
        $lottery = Lottery::find($request->input('id'));
        $lottery->delete();

        return responseSuccessJson($lottery);
    }

    public function saveLottery(Request $request)
    {
        $lottery = new Lottery();
        $lottery->fill($request->all());
        $lottery->save();

        return responseSuccessJson($lottery);
    }
}
