<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/teams', function () {
        return view('admin.team');
    });
    Route::get('/list_index', function () {
        return view('admin.index');
    });
    Route::get('/games', function () {
        return view('admin.index');
    });
    Route::get('/users', function () {
        return view('admin.user');
    });
    Route::get('/talks', function () {
        return view('admin.talk');
    });
    Route::get('/guesses', function (\Illuminate\Http\Request $request) {
        return view('admin.guess')->with(['game_id' => $request->input('game'),'team_id' => $request->input('team')]);
    });

    Route::get('/game/list', 'GameController@index');
    Route::post('/game/save', 'GameController@saveGame');
    Route::post('/game/delete', 'GameController@deleteGame');
    Route::get('/game/guesses', 'GameController@guesses');
    Route::post('/game/delete_lottery', 'GameController@deleteLottery');
    Route::post('/game/save_lottery', 'GameController@saveLottery');

    Route::get('/team/list', 'GameController@listTeams');
    Route::post('/team/save', 'GameController@saveTeam');
    Route::post('/team/delete', 'GameController@deleteTeam');

    Route::get('/user/list', 'UserController@listUsers');

    Route::get('/talk/list', 'UserController@listTalks');
    Route::post('/talk/delete', 'UserController@deleteTalk');
});

Route::get('/', 'HomeController@guess');
Route::get('/test', 'HomeController@test');
Route::get('/talk', function () {
    return view('talk');
});
Route::get('/talk/list', 'TalkController@talks');
Route::post('/talk/talk', 'TalkController@talk');

Route::get('/rules', function () {
    return view('rules');
});
Route::get('/center', 'HomeController@center');
Route::get('/rank', 'GameController@rank');
Route::get('/address', function () {
    return view('address');
});
Route::get('/address/load', 'HomeController@loadAddress');
Route::post('/address/save', 'HomeController@saveAddress');

Route::get('/lotteries', 'GameController@lotteries');
Route::get('/lottery', function (\Illuminate\Http\Request $request) {
    return view('lottery')->with([
        'game_id' => $request->get('id')
    ]);
});
Route::get('/lottery/draw', 'GameController@drawLottery');

Route::post('/game/bet', 'GameController@bet');
Route::get('/history', 'GameController@history');

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/wx/oauth_callback', 'WechatController@wxOAuthCallback');
Route::get('/wx/serve', 'WechatController@serve');
Route::get('/check_token', 'WechatController@checkToken');

Route::get('/code', 'HomeController@code');