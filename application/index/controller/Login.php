<?php

namespace app\index\controller;

use app\common\Util;

class Login
{

    public function index()
    {
        $phoneNUm = intval($_GET['phone_num']);
        $code = intval($_GET['code']);

        if (empty($phoneNUm) || empty($code)) {
            return Util::show(config('code.error'), 'phone or code is error');
        }

//        $redisCode = Predis::getInstance()->get(Redis::smsKey($phoneNum));

//        if($redisCode == $code) {
//            // 写入redis
//            $data = [
//                'user' => $phoneNum,
//                'srcKey' => md5(Redis::userkey($phoneNum)),
//                'time' => time(),
//                'isLogin' => true,
//            ];
//            Predis::getInstance()->set(Redis::userkey($phoneNum), $data);
//
//            return \app\common\lib\Util::show(config('code.success'), 'ok', $data);
//        } else {
//            return Util::show(config('code.error'), 'login error');
//        }
    }
}
