<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use App\Models\Talk;

class TalkEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $talk;

    public function __construct(Talk $talk)
    {
        $this->talk = $talk;
    }
}
