<?php

namespace app\admin\controller;

use app\common\Util;

class Image
{
    public function index()
    {
        $file = request()->file('file');
        $info = $file->move('../public/static/upload');
        if ($info) {
            $data = [
                'image' => 'http://www.chimii.cn:9501' . "/upload/" . $info->getSaveName(),
            ];
            return Util::show(200, 'OK', $data);
        } else {
            return Util::show(200, 'error');
        }
    }

}
