@extends('layouts.front')
@section('content')
    <style type="text/css">
        .win_coin {
            width: 12%;
            height: 65%;
            color: #fff;
            font-size: .22rem;
            display: inline-block;
            margin: 0 auto;
            background-color: #af161e;
            border-radius: .02rem;
            text-align: center;
            line-height: .30rem;
            font-weight: normal;
        }

        .draw_coin {
            width: 12%;
            height: 65%;
            color: black;
            font-size: .22rem;
            display: inline-block;
            margin: 0 auto;
            background-color: #fff;
            border-radius: .02rem;
            text-align: center;
            line-height: .30rem;
            font-weight: normal;
        }
    </style>
    <div class="record">
        <div class="record-item">
            <h5>
                <img src="img/ic19.png" alt=""/>
            </h5>
            <ul>
                @foreach($lotteries as $g)
                    <li>
                        <span>{{ $g->game_time  }}</span>
                        <b>{{ $g->team_name  }} VS {{ $g->opponent_team  }}</b>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="record-item">
            <h5>
                <img src="img/my_guess.png" alt=""/>
            </h5>
            <ul>
                @foreach($guesses as $g)
                    <li class="{{ $g->bet_result == $g->result ? 'acti' : '' }}">
                        <span style=" @if($g->bet_result == $g->result && $g->status != 0) color:#af161e @endif " >{{ $g->game_time  }}</span>
                        <b>{{ $g->team_name  }} <i
                                    class="win_coin"> {{ $g->bet_result == 1 ? '胜': ($g->bet_result == 0 ? '平' : '负')  }} </i> {{ $g->opponent_team }}
                        </b>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="record-item">
            <h5>
                <img src="img/ic21zhong.png" alt=""/>
            </h5>
            <ul>
                @foreach($lotteries as $g)
                    @if($g->result != '0' )
                        <a href="/address">
                            <li class="acti">
                                <span>{{ $g->game_time  }}</span>
                                <b>{{ $g->result  }}</b>
                            </li>
                        </a>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
@endsection