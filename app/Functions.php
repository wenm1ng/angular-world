<?php

function wxConfig()
{
    $config = [
        'debug' => true,
        'app_id' => 'wx1cc7fb311d728ec4',         // AppID
        'secret' => 'f7e6a89b4394930675081faeec014fd3',     // AppSecret
        'token' => 'check_token',          // Token
        'aes_key' => 'jTZBaRlZ3pWYAbUJtS35Cr2Fp53fZFhR9FxtuDU1DkI',                    // EncodingAESKey，安全模式下请一定要填写！！！
        'log' => [
            'level' => 'debug',
            'permission' => 0777,
            'file' => '/tmp/easywechat.log',
        ],
        /**
         * OAuth 配置         *
         * scopes：公众平台（snsapi_userinfo / snsapi_base），开放平台：snsapi_login
         * callback：OAuth授权完成后的回调页地址
         */
        'oauth' => [
            'scopes' => ['snsapi_userinfo'],
            'callback' => '/wx/oauth_callback',
        ],
        /**
         * 微信支付
         */
        'payment' => [
            'merchant_id' => 'your-mch-id',
            'key' => 'key-for-signature',
            'cert_path' => '/data/html/shop.flower-wine.com/cert/apiclient_cert.pem', // XXX: 绝对路径！！！！
            'key_path' => '/data/html/shop.flower-wine.com/cert/apiclient_key.pem',      // XXX: 绝对路径！！！！
            // 'device_info'     => '013467007045764',
            // 'sub_app_id'      => '',
            // 'sub_merchant_id' => '',
            // ...
        ],
        /**
         * Guzzle 全局设置
         *
         * 更多请参考： http://docs.guzzlephp.org/en/latest/request-options.html
         */
        'guzzle' => [
            'timeout' => 3.0, // 超时时间（秒）
            //'verify' => false, // 关掉 SSL 认证（强烈不建议！！！）
        ],
    ];
    return $config;
}

function wxPaymentConfig()
{
    $config = [
        'debug' => true,
        'app_id' => 'wx1cc7fb311d728ec4',         // AppID
        'secret' => 'f7e6a89b4394930675081faeec014fd3',     // AppSecret
        'token' => 'check_token',          // Token
        'aes_key' => 'jTZBaRlZ3pWYAbUJtS35Cr2Fp53fZFhR9FxtuDU1DkI',                    // EncodingAESKey，安全模式下请一定要填写！！！
        'log' => [
            'level' => 'debug',
            'permission' => 0777,
            'file' => '/tmp/easywechat.log',
        ],
        /**
         * 微信支付
         */
        'payment' => [
            'merchant_id' => '1491126892',
            'key' => 'flowershop123658996541223sflssss',
            'cert_path' => '/data/html/shop.flower-wine.com/cert/apiclient_cert.pem',
            'key_path' => '/data/html/shop.flower-wine.com/cert/apiclient_key.pem',
            'notify_url' => 'http://shop.flower-wine.com/order/notifyPay'
        ],
        /**
         * Guzzle 全局设置
         *
         * 更多请参考： http://docs.guzzlephp.org/en/latest/request-options.html
         */
        'guzzle' => [
            'timeout' => 3.0, // 超时时间（秒）
            //'verify' => false, // 关掉 SSL 认证（强烈不建议！！！）
        ],
    ];
    return $config;
}

function responseJson($status, $msg = '', $data = '')
{
    /*if (!empty($data)) {
        $data = keyToCamel($data);
    }*/

    /* if (empty($msg)) {
         $msg = errorName($status);
     }*/

    return response()->json(['status' => $status, 'msg' => $msg, 'data' => $data], 200);
}

function errorName($errorCode)
{
    $error = Error::where('key', $errorCode)->first();
    return !empty($error->value) ? $error->value : '';
}

/**
 * 返回成功的数据
 * @param array $data
 */
function responseSuccessJson($data = '')
{
    return responseJson(0, '', $data);
}

/**
 * 返回错误的数据
 * @param array $status
 */
function responseErrorJson($status, $msg = '')
{
    return responseJson($status, $msg);
}

function keyToCamel($data)
{

    if (is_array($data)) {
        foreach ($data as $k => $v) {
            $kk = $k;
            if (strpos($k, '_') !== false) {
                $kk = convertUnderline($k);
                $data[$kk] = $v;
                unset($data[$k]);
            }

            if (is_array($v) || is_object($v)) {
                $data[$kk] = keyToCamel($v);
            }
        }
    } else if (is_object($data)) {
        if ($data instanceof ArrayAccess) {
            $data = keyToCamel($data->toArray());
        } else {
            $data = keyToCamel((array)$data);
        }
    }
    return $data;
}

function convertUnderline($str, $ucfirst = false)
{
    $str = ucwords(str_replace('_', ' ', $str));
    $str = str_replace(' ', '', lcfirst($str));
    return $ucfirst ? ucfirst($str) : $str;
}

function getLoginUserId()
{
    if (!empty(session('wechat_user'))) {
        return intval(session('wechat_user'));
    }
    return 0;
}