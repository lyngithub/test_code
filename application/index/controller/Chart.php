<?php

namespace app\index\controller;

use app\common\Util;

class Chart
{
    public function index()
    {
//        header('Access-Control-Allow-Origin: *');
        // 登录
//        if(empty($_POST['game_id'])) {
//            return Util::show(config('code.error'), 'error');
//        }
        if (empty($_POST['content'])) {
            return Util::show(config('code.error'), 'error');
        }

        $data = [
            'user' => "用户" . rand(0, 2000),
            'content' => $_POST['content'],
        ];


        foreach ($_POST['http_server']->connections as $fd) {

            // 升级swoole4之后 需要这样加上判断处理， @20191106
            if ($_POST['http_server']->isEstablished($fd)) {
                $_POST['http_server']->push($fd, json_encode($data));
            }
        }

        return Util::show(config('code.success'), 'ok', $data);
    }


}
