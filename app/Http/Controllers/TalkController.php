<?php

namespace App\Http\Controllers;

use App\Events\TalkEvent;
use App\Models\Talk;
use App\Repositories\RedisRepository;
use Illuminate\Http\Request;

class TalkController extends Controller
{
    protected $redis;

    public function __construct(RedisRepository $repo)
    {
        $this->redis = $repo;
    }

    public function talk(Request $request)
    {
        $talk = new Talk();
        $this->validate($request, [
         'content' => 'required|max:400',
       ]);

        $talk->fill($request->all());

        $userId = $this->getLoginUserId();
        $talk->user_id = $userId;
        $talk->save();

        event(new TalkEvent($talk));
        return responseSuccessJson($talk);
    }

    public function talks(Request $request)
    {
        $page = $request->get('current_page');
        return $this->redis->getListByPage('worldcup:talks', $page);
    }
}
