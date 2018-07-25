@extends('layouts.front')
@section('content')
    <div class="rank-list">
        <div class="rank-tag">
            <ul>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
        <div class="rank-list-col">
            <h5>
                <img src="img/ic17.png" alt=""/>
                <i>预测精准次数排行榜</i>
            </h5>
            <div class="rank-roll" style="overflow-y: scroll;overflow-x: hidden;">
                <ul>
                    @for ($i = 0; $i < count($guesses); $i+=2)
                        <li>
                            <p>
                                <span @if( $guesses[$i]->myself == 1 )style="color:#ffe400"@endif>{{ $i+1 }}.{{ $guesses[$i]->nickname }}</span>
                                <b><i>{{ $guesses[$i]->total }}</i>次</b>
                            </p>
                            @if (!empty($guesses[$i+1]))
                                <p>
                                <span @if( $guesses[$i+1]->myself == 1 )style="color:#ffe400"@endif>{{ $i+2 }} .{{ $guesses[$i+1]->nickname }}</span>
                                <b><i>{{ $guesses[$i+1]->total }}</i>次</b>
                                </p>
                            @endif
                        </li>
                    @endfor
                </ul>
            </div>
        </div>
    </div>
@endsection
@section('custom-scripts')
    <script>
        $('.title ul').children().eq(1).addClass('acti');
    </script>
@endsection