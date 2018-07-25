@extends('layouts.front')
@section('content')
    <div class="pk-rank" ng-app="wcapp" ng-controller="mainCtrl">
        <h5>
            <img src="img/today_guess.png" alt=""/>
            <img src="img/click.gif" alt="" class="jingcaigif"/>
            <i ng-click="showRule()" style="font-size:16px;width:24%;height:20%">游戏规则</i>
        </h5>
        <ul>
            @foreach($today_games as $game)
                <li class="germany">
                    <h6>
                        <span>{{ $game->team_count }}人 &nbsp;&nbsp;&nbsp;&nbsp; {{ substr($game->game_time,5,11) }} &nbsp;&nbsp;&nbsp;&nbsp; {{ $game->opponent_count }}人</span>
                    </h6>
                    <h4>
                        <img src="{{ $game->team_url }}" alt="" class="argentina" ng-click="openBetForm({ game_id: {{$game->game_id}},result: 1,code: '{{ $code }}',tip: '确认选择 {{ $game->team_name }} 胜 {{ $game->opponent_team }} 吗?' })"/>
                        <span class="argentina {{ isset($game->bet_result) && $game->bet_result == 1 ? 'highlight' : '' }}" ng-click="openBetForm({ game_id: {{$game->game_id}},result: 1,code: '{{ $code }}',tip: '确认选择 {{ $game->team_name }} 胜 {{ $game->opponent_team }} 吗?' })">{{ $game->team_name }}</span>
                        <i class="{{ isset($game->bet_result) && $game->bet_result == 0 ? 'highlight' : '' }}" ng-click="openBetForm({ game_id: {{$game->game_id}},result: 0,code: '{{ $code }}',tip: '确认选择 {{ $game->team_name }} 打平 {{ $game->opponent_team }} 吗?' })">VS</i>
                        <span class="germany {{ isset($game->bet_result) && $game->bet_result == -1 ? 'highlight' : '' }}" ng-click="openBetForm({ game_id: {{$game->game_id}},result: -1,code: '{{ $code }}',tip: '确认选择 {{ $game->opponent_team }} 胜 {{ $game->team_name }} 吗?' })">{{ $game->opponent_team }}</span>
                        <img src="{{ $game->opponent_url }}" alt="" class="germany" ng-click="openBetForm({ game_id: {{$game->game_id}},result: -1,code: '{{ $code }}',tip: '确认选择 {{ $game->opponent_team }} 胜 {{ $game->team_name }} 吗?' })"/>
                    </h4>
                    <p>
                        <span class="argentina"><i
                                    ng-click="openBetForm({ game_id: {{$game->game_id}},result: 1,code: '{{ $code }}',tip: '确认选择 {{ $game->team_name }} 胜 {{ $game->opponent_team }} 吗?' })">胜</i></span>
                        <b><i ng-click="openBetForm({ game_id: {{$game->game_id}},result: 0,code: '{{ $code }}',tip: '确认选择 {{ $game->team_name }} 打平 {{ $game->opponent_team }} 吗?' })">平</i></b>
                        <span ng-click="openBetForm({ game_id: {{$game->game_id}},result: -1,code: '{{ $code }}',tip: '确认选择 {{ $game->opponent_team }} 胜 {{ $game->team_name }} 吗?' })"
                              class="germany"><i>胜</i></span>
                    </p>
                </li>
            @endforeach
        </ul>
        <h5>
            <img src="img/tit5.png" alt="" class="yst"/>
        </h5>
        <ul>
            @foreach($yesterday_games as $game)
                <li class="germany">
                    <h6>
                        <span>{{ $game->team_score }}:{{ $game->opponent_score }}</span>
                    </h6>
                    <h4 ng-click="jumpToLottery({{ $game->result == $game->bet_result && $game->bet_result !== null && $game->lottery_result == -1 && $game->tomorrow_now == 1 }},'{{ url('/lottery?id='.$game->game_id ) }}')">
                        <img src="{{ $game->team_url }}" alt="" class="argentina"/>
                        <span class="argentina  {{ $game->team_score > $game->opponent_score ? 'highlight' : '' }} ">{{ $game->team_name }}</span>
                        <i>VS</i>
                        <span class="germany {{ $game->team_score < $game->opponent_score ? 'highlight' : '' }} ">{{ $game->opponent_team }}
                            @if ($game->lottery_result > -1)
                                <img src="img/yichoujiang.png" class="germany jingcaishengli" /></span>
                        @elseif($game->result == $game->bet_result && $game->bet_result !== null && $game->lottery_result == -1 && $game->tomorrow_now == 1 )
                            <img src="img/jingcaishengli.gif" class="germany jingcaishengli" /></span>
                        @endif
                        <img src="{{ $game->opponent_url }}" alt="" class="germany"/>
                    </h4>
                </li>
            @endforeach
        </ul>
        <a href="{{ url('/history') }}" class="more">点击查看往期赛事 ...</a>

        <div class="alert" id="win-rule-alert">
            <div class="rules" id="win-rule">
                <div class="rules-inf">
                    <h2>
                        游戏规则
                    </h2>
                    <p>
                        1、扫码开启小花样世界杯激情之旅。<br/>
                        活动期间：<br/>
                        1、在2018年6月14日至7月15日，购买限量小花样世界杯版，扫描活动指定产品封套内的二维码（每个二维码只有一次参与机会），可进入本次活动主页面；参与每日助力竞猜活动，嬴取俄罗斯世界杯豪华之旅！<br/>
                        操作细则：<br/>
                        a
                        根据活动页面的指引，消费者可选择最近几场比赛中自己所支持的世界杯球队的赛况，选择平局或胜利，为你钟爱的球队加油助力（即“竞猜狂欢”环节）。竞猜成功获胜者即可获得抽奖机会一次，奖品名单为：一等奖（1名）：运动摄像机；
                        二等奖（2名：）Adidas世界杯双肩包； 三等奖 （3名）手机单反镜； 幸运奖（25名）：复古游戏机/彩色调酒杯；<br/>
                        b. 每次参与竞猜成功者，累计成功次数，在（即“谁是预言帝”排行榜）游戏排行榜上排名前三的（即“谁是预言帝”排行榜）获奖者，可对应获得以下大奖。【每个奖项，仅限一个获奖者】<br/>第一名：俄罗斯境外豪华游
                        第二名：65寸高清液晶大电视 第三名：小米电动滑板车<br/>
                        中奖结果公布<br/>
                        每日的竞猜中奖者的情况公布，将在次日中午12点之后开放的抽奖通道揭晓。<br/>
                        公布的猜中者具备竞猜获胜资格，可于当日12：00-24：00期间即可参与活动奖品在线抽奖；
                        （每个抽奖机会，对应一次在线抽奖，仅限当日时段抽奖）<br/>
                        关于中奖后的礼品发放：个人信息登记或个人竞猜结果等个人信息，均可于点击个人中心进行查询及登记。<br/>
                        所有礼品兑换期限：截止于2018年7月18日24：00<br/>
                        消费者活动参与声明<br/>
                        消费者本人在参与活动前已完整阅读了本次活动规则，对活动规则已完全理解并同意。
                        本次活动的所有解释权，归本公司所有。
                    </p>
                </div>
                <h6>
                    <a href="#" ng-click="hideRule()">我已了解 点击跳过 >>></a>
                </h6>
            </div>

            <div class="betting">
                <h5><b>@{{ betInfo.tip }}</b></h5>
                <h6>
                    <a class="sub" ng-click="doBet()">确认</a>
                    <a class="retu" ng-click="hideBetForm()">返回</a>
                </h6>
            </div>

            <div class="used" style="height:55%;top:30%">
                <h5><b>@{{ betInfo.tip }}</b></h5>
                <p style="font-size:10px;float:left;margin-left:2%;line-height:23px">竞猜正确者，可于次日12：00-24：00期间参与抽奖</p>
                <img src="{{ asset('img/weixin.png') }}" height="50%" width="70%">
                <span style="font-size:10px;float:left;margin-left:28%">如有疑问，请联系客服</span>
                <h6>
                    <a class="retu" ng-click="hideTipForm()">返回</a>
                </h6>
            </div>

        </div>
    </div>
@endsection

@section('custom-scripts')
    <script src="{{ asset('js/front/main-service-controller.js') }}"></script>
    <script>
        $('.title ul').children().eq(0).addClass('acti');
    </script>
@endsection