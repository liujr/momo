<?php
namespace app\common;
/**
* 短信发送（聚合短信）
*/
class Sms
{
	private $url = "http://v.juhe.cn/sms/send";
	private $key = "fe4eb3c21dc1fdaf5531525464227add";
	private $tplidarr = ['1'=>'156531'];
	private $tplid = '';
	public function __construct($type){
		print_r(12312);
		if(!$type)  return ['code'=>400,'msg'=>'发送类型不能为空！'];
		print_r($this->tplidarr);
		print_r($this->tplidarr);
		print_r(in_array($type, $this->tplidarr[$type]));
		if(!in_array($type,$this->tplidarr[$type])) return ['code'=>400,'msg'=>'发送类型不存在！'];
		$this->$tplid = $this->tplidarr[$type];

	}

	/**
	* 发送
	*/
	public function send($param){
		$data = $this->checkdate($param);
		print_r($data);
		$paramstring = http_build_query($data);
		$content = $this->post($this->url, $paramstring);
		$result = json_decode($content, true);
		if ($result) {
		    var_dump($result);
		} else {
		    //请求异常
		}
	}

	/**
	* 验证数据
	*/
	private function checkdate($param){
		if(!$param['mobile'])  return ['code'=>400,'msg'=>'手机号码不能为空！'];
		$randnum = $this->randnum(4,1);
		$data = array(
				'key'   => $this->key, //您申请的APPKEY
			    'mobile'    => $param['mobile'], //接受短信的用户手机号码
			    'tpl_id'    => $this->$tplid, //您申请的短信模板ID，根据实际情况修改
			    'tpl_value' =>'#code#='.$randnum //您设置的模板变量，根据实际情况修改
			);
		return $data;
	}

	/**
	* 生成随机字符串
	* @param int       $length  要生成的随机字符串长度
	* @param string    $type    随机码类型：0，数字+大小写字母；
	* 1，数字；2，小写字母；3，大写字母；4，特殊字符；
	* -1，数字+大小写字母+特殊字符
	* @return string
	*/
	private function randnum($length = 4, $type = 0) {
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
	private function post($url, $params = false, $ispost = 0)
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

}


