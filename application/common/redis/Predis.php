<?php

namespace app\common\redis;

use think\Exception;

class Predis
{
    public $redis = '';

    private static $_instance = null;

    private function __construct()
    {
        $this->redis = new \Redis();
        $this->redis->connect('127.0.0.1', 6379);
        $this->redis->auth(6542759);
        if ($this->redis === false) {
            throw new Exception('redis connect failed');
        }
    }

    public static function getInstance()
    {
        if (empty(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }


    public function set($key, $value, $ttl)
    {
        if (!$key) {
            return '';
        }
        if (is_array($value)) {
            $value = json_encode($value);
        }

        if (!$ttl) {
            return $this->redis->set($key, $value);
        }

        return $this->redis->setex($key, $ttl, $value);
    }

    public function get($key)
    {
        if (!$key) {
            return '';
        }
        return $this->redis->get($key);
    }

    public function sMembers($key)
    {
        return $this->redis->sMembers($key);
    }

    public function sRem($key, $fd)
    {
        return $this->redis->sRem($key, $fd);
    }

    public function sAdd($key, $fd)
    {
        return $this->redis->sAdd($key, $fd);
    }
}