<?php

namespace app\admin\controller;

use app\common\Util;
use app\common\redis\Predis;

class Live
{

    public function push()
    {
        if (empty($_GET)) {
            return Util::show(config('code.error'), 'error');
        }  // admin
        // token    md5(content)
        // => mysql
        $teams = [
            1 => [
                'name' => '马刺',
                'logo' => '/live/imgs/team1.png',
            ],
            4 => [
                'name' => '火箭',
                'logo' => '/live/imgs/team2.png',
            ],
        ];

        $data = [
            'type' => intval($_GET['type']),
            'title' => !empty($teams[$_GET['team_id']]['name']) ? $teams[$_GET['team_id']]['name'] : '直播员',
            'logo' => !empty($teams[$_GET['team_id']]['logo']) ? $teams[$_GET['team_id']]['logo'] : '',
            'content' => !empty($_GET['content']) ? $_GET['content'] : '',
            'image' => !empty($_GET['image']) ? $_GET['image'] : '',
        ];

        // 获取连接的用户
        // 赛况的基本信息入库   2、数据组织好 push到直播页面
        $taskData = [
            'method' => 'pushLive',
            'data' => $data
        ];

//        $clients = Predis::getInstance()->sMembers("live_game_key");
//        foreach ($clients as $fd) {
//            $_POST['http_server']->push($fd, json_encode($data));
//        }
        $_POST['http_server']->task($taskData);
        return Util::show(200, 'ok');
    }
}
