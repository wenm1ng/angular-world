<?php

namespace App\Listeners;

use App\Events\TalkEvent;
use App\Repositories\RedisRepository;

class TalkEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    protected $redis;

    public function __construct(RedisRepository $repository)
    {
        $this->redis = $repository;
    }

    /**
     * Handle the event.
     *
     * @param  TalkEvent $event
     * @return void
     */
    public function handle(TalkEvent $event)
    {
        $this->redis->saveToList('worldcup:talks', json_encode($event->talk));
    }
}
