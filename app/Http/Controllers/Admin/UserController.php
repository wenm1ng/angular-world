<?php

namespace App\Http\Controllers\Admin;

use App\Models\Talk;
use App\Repositories\RedisRepository;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    protected $redis;

    public function __construct(RedisRepository $repo)
    {
        $this->redis = $repo;
    }

    public function listUsers(Request $request)
    {
        $page = $request->get('current_page');
        //$list = Game::get();
        return User::orderBy('id', 'desc')->get();
    }

    public function listTalks(Request $request)
    {
        $page = $request->get('current_page');
        return Talk::orderBy('id', 'desc')->paginate(15, ['*'], 'page', $page);
    }

    public function deleteTalk(Request $request)
    {
        $talk = Talk::find($request->get('id'));
        $talk->delete();

        $talks = Talk::orderBy('id')->get();
        $this->redis->del('worldcup:talks');
        foreach ($talks as $t) {
            $this->redis->saveToList('worldcup:talks', json_encode($t));
        }

        return responseSuccessJson($talk);
    }
}
