<?php
namespace App\Repositories;

use Illuminate\Support\Facades\Redis;

class RedisRepositoryImpl implements RedisRepository
{

    function saveToList($key, $data)
    {
        $redis = Redis::connection();
        $redis->lpush($key, $data);
    }

    function del($key)
    {
        $redis = Redis::connection();
        $redis->del($key);
    }

    function getListByPage($key, $page)
    {
        $redis = Redis::connection();

        $talks = [];

        $jsonedTalks = $redis->lrange($key, 0, $page * 15);
        foreach ($jsonedTalks as $t) {
            $talks[] = json_decode($t);
        }
        return $talks;
    }
}

