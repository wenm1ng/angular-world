@extends('layouts.front')
@section('content')
    <div class="pk-rank">
        <h5>
            <img src="img/ic23.png" alt=""/>
        </h5>
        <ul>
            @foreach($games as $game)
                <li class="germany">
                    <h6>
                        <span>{{ $game->team_score }}:{{ $game->opponent_score }}</span>
                    </h6>
                    <h4>
                        <img src="{{ $game->team_url }}" alt="" class="argentina"/>
                        <span class="argentina">{{ $game->team_name }}</span>
                        <i>VS</i>
                        <span class="germany">{{ $game->opponent_team }}</span>
                        <img src="{{ $game->opponent_url }}" alt="" class="germany"/>
                    </h4>
                    <h2>
                        {{ $game->game_time }}
                    </h2>
                </li>
            @endforeach
        </ul>
    </div>
@endsection