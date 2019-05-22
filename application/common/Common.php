<?php
namespace app\common;
/**
* 短信发送（聚合短信）
*/
class Common
{

	/**
	* 生成随机字符串
	* @param int       $length  要生成的随机字符串长度
	* @param string    $type    随机码类型：0，数字+大小写字母；
	* 1，数字；2，小写字母；3，大写字母；4，特殊字符；
	* -1，数字+大小写字母+特殊字符
	* @return string
	*/
	static public function randnum($length = 4, $type = 0) {
	    $arr = array(1 => "0123456789", 2 => "abcdefghijklmnopqrstuvwxyz", 3 => "ABCDEFGHIJKLMNOPQRSTUVWXYZ", 4 => "~@#$%^&*(){}[]|");
	    if ($type == 0) {
	        array_pop($arr);
	        $string = implode("", $arr);
	    } elseif ($type == "-1") {
	        $string = implode("", $arr);
	    } else {
	        $string = $arr[$type];
	    }
	    $count = strlen($string) - 1;
	    $code = '';
	    for ($i = 0; $i < $length; $i++) {
	        $code .= $string[rand(0, $count)];
	    }
	    return $code;
	}

	/**
	 * 请求接口返回内容
	 * @param  string $url [请求的URL地址]
	 * @param  string $params [请求的参数]
	 * @param  int $ipost [是否采用POST形式]
	 * @return  string
	 */
	static public function post($url, $params = false, $ispost = 0)
	{
	    $httpInfo = array();
	    $ch = curl_init();

	    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
	    curl_setopt($ch, CURLOPT_USERAGENT, 'JuheData');
	    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
	    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	    if ($ispost) {
	        curl_setopt($ch, CURLOPT_POST, true);
	        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
	        curl_setopt($ch, CURLOPT_URL, $url);
	    } else {
	        if ($params) {
	            curl_setopt($ch, CURLOPT_URL, $url.'?'.$params);
	        } else {
	            curl_setopt($ch, CURLOPT_URL, $url);
	        }
	    }
	    $response = curl_exec($ch);
	    if ($response === FALSE) {
	        return false;
	    }
	    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	    $httpInfo = array_merge($httpInfo, curl_getinfo($ch));
	    curl_close($ch);
	    return $response;
	}
	/**
	 * $code  状态码
     * $msg   描述
     * $data  返回的数据
     */
	static public function show($code,$msg,$data=[]){
	    $data = [
	        'code' => $code,
            'msg'  => $msg,
            'data' =>$data,
        ];
	    echo json_encode($data);
    }
    //抛出异常
	static public function E($tag='',$code=0){
	    throw new \think\Exception($tag,$code);
	}

    /**
     * 调用数据层模型
     * @param $dir 模块
     * @param $name 方法
     */
    static public function D($dir,$name,$model='data'){
        if(!$dir) self::E('请指定访问的模块');
        if(!$name) self::E('请指定访问的方法');
        $class = '\\'.$model.'\\'.$dir.'\\'.$name;
        return new $class;
    }

    /**
     *	递归重组节点信息为多维数组
     *	@param [type] $node [要处理的节点数组]
     *	@param integer $pid [父级id]
     *  @param integer $pidname [父级id的字段名称]
     *	@param integer $access [权限数组]
     *	@param integer $nid [指定节点的与权限对应的字段]
     *	@return [type]  [description]
     */

static public function nodeMerge($node,$pidname='pid',$pid=0,$access=null,$nid='id',$childrenName='children'){
        $arr=array();
        foreach($node as $v){
            if($v[$pidname]==$pid){
                if(is_array($access)){
                    $v['isIn']=in_array($v[$nid],$access) ? 'checked':'';
                }
                $value['id'] =$v['id'];
                $value['title'] =$v['menuname'];
                $value['href'] =$v['menuurl']?$v['menuurl']:'';
                $value['icon'] =$v['icon'];
                $value['remark'] =$v['remark'];
                $value['spread'] =false;
                $value[$childrenName] = self::nodeMerge($node,$pidname,$v[$nid],$access,$nid);
                $arr[]=$value;
            }
        }
        return $arr;
    }

    /*获取真实IP
**********************************/
    static public function getIp(){
        $realip = '';
        $unknown = 'unknown';
        if (isset($_SERVER)){
            if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR']) && strcasecmp($_SERVER['HTTP_X_FORWARDED_FOR'], $unknown)){
                $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                foreach($arr as $ip){
                    $ip = trim($ip);
                    if ($ip != 'unknown'){
                        $realip = $ip;
                        break;
                    }
                }
            }else if(isset($_SERVER['HTTP_CLIENT_IP']) && !empty($_SERVER['HTTP_CLIENT_IP']) && strcasecmp($_SERVER['HTTP_CLIENT_IP'], $unknown)){
                $realip = $_SERVER['HTTP_CLIENT_IP'];
            }else if(isset($_SERVER['REMOTE_ADDR']) && !empty($_SERVER['REMOTE_ADDR']) && strcasecmp($_SERVER['REMOTE_ADDR'], $unknown)){
                $realip = $_SERVER['REMOTE_ADDR'];
            }else{
                $realip = $unknown;
            }
        }else{
            if(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), $unknown)){
                $realip = getenv("HTTP_X_FORWARDED_FOR");
            }else if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), $unknown)){
                $realip = getenv("HTTP_CLIENT_IP");
            }else if(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), $unknown)){
                $realip = getenv("REMOTE_ADDR");
            }else{
                $realip = $unknown;
            }
        }
        $realip = preg_match("/[\d\.]{7,15}/", $realip, $matches) ? $matches[0] : $unknown;
        return $realip;
    }

    /**是否为手机号码
    @param $mobile 手机号码
    @return boolean
     ***************************************************/
    static public function is_mobile($mobile) {
        if(preg_match("/^1[3-9][0-9]{9}$/", trim($mobile)))  return true;
        return false;

    }
    /**判断是否是字母和数字或字母数字的组合
    @param $mobile 手机号码
    @return boolean
     ***************************************************/
    static public function is_menber_english($str) {
        if(!ctype_alnum($str)) return false;
       return true;
    }

}


