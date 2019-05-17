<?php
namespace app\common;
use think\Config;
use app\common\Common;

/**
* redis
*/
class Redis
{
    public $redis = '';
    /**
     * 定义单例模式的变量
     * @var null
     */
    private  static $_instance = null;

    public static function getInstance(){
        if(empty(self::$_instance)){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    private function __construct(){
        $this->redis = new \Redis();
        $res = $this->redis->connect(config('redis.host'),config('redis.port'));
        if($res === false){
            Common::E('redis 连接失败');
        }
    }

    /**
     * 设置redis字符串
     * @param $key 键
     * @param $value值
     * @param int $time过期时间
     * @return bool|string
     */
    public function set($key,$value,$time = 0){
        if(!$key) Common::E('key不能为空');
        if(!$value) Common::E('value不能为空');
        if(is_array($value)) $value = json_encode($value);
        if(!$time) return $this->redis->set($key,$value);
        return $this->redis->setex($key,$time,$value);
    }

    /**
     * 获取redis值
     * @param $key
     * @return bool|string
     */
    public function get($key){
        if(!$key) Common::E('key不能为空');
        return $this->redis->get($key);
    }

    /**
     * 保存集合
     * @param $key
     * @param $value
     */
    public function sAdd($key,$value){
        if(!$key) Common::E('key不能为空');
        if(!$value) Common::E('value不能为空');
        return $this->redis->sAdd($key);
    }

    /**
     * 删除一个或多个集合
     * @param $key
     * @param $value
     * @return int
     */
    public function sRem($key,$value){
        if(!$key) Common::E('key不能为空');
        if(!$value) Common::E('value不能为空');
        return $this->redis->sRem($key,$value);
    }

    /**
     * 判断集合是否存在该值
     * @param $key
     * @param $value
     * @return bool
     */
    public function sIsmember($key,$value){
        if(!$key) Common::E('key不能为空');
        if(!$value) Common::E('value不能为空');
        return $this->redis->sIsmember($key,$value);
    }

    /**
     * 返回集合所有值
     * @param $key
     * @return array
     */
    public function sMembers($key){
        if(!$key) Common::E('key不能为空');
        return $this->redis->sMembers($key);
    }



}


