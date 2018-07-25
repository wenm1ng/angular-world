<?php

namespace App\Repositories;

interface RedisRepository
{
    function saveToList($key, $data);

    function del($key);

    function getListByPage($key,$page);
}


