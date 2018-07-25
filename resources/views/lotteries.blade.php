@extends('layouts.front')
@section('content')
    <div class="list">
        <h5>
            <img src="img/ic21.png" alt=""/>
        </h5>
        @foreach($lotteries as $lottery)
            <div class="list-col">
                <h6>
        				<span>
        					{{ $lottery[0]->d }}
        				</span>
                </h6>
                <ul>
                    @foreach($lottery as $item)
                        <li><img src="{{ $item->avatar }}"></li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
@endsection