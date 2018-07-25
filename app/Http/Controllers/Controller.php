<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function saveFile(Request $request, $name)
    {
        $relativePath = '';
        if ($request->hasFile($name) && $request->file($name)->isValid()) {
            $path = public_path() . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR;
            $extension = $request->file($name)->guessExtension();
            if ($extension == 'jpeg') {
                $extension = 'jpg';
            }

            $fileName = date('ymdhis') . str_random(4) . '.' . $extension;
            $request->file($name)->move($path, $fileName);

            $relativePath = str_replace(public_path(), '', $path) . $fileName;
        }

        return $relativePath;
    }

    public function getLoginUserId()
    {
        if (!empty(session('wechat_user'))) {
            return intval(session('wechat_user'));
        }
        return 7;
        //return 4; //TODO::CHANGE THIS PLEASE
    }

    public function redirectToAuth()
    {
        return redirect('/wx/serve');
    }
}
