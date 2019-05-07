<?php
namespace app\common;
/**
* 短信发送（聚合短信）
*/
class Sms
{
	$url = "http://v.juhe.cn/sms/send";
	$key = "fe4eb3c21dc1fdaf5531525464227add";
	$tplidarr = ['1'=>'156531'];
	$tplid = '';
	public function __construct($type){
		if(!$type)  return ['code'=>400,'msg'=>'发送类型不能为空！'];
		if(!in_array($type, $this->tplidarr[$type])) return ['code'=>400,'msg'=>'发送类型不存在！'];
		$this->$tplid = $this->tplidarr[$type];

	}

	/**
	* 发送
	*/
	public function send($param){
		$data = $this->checkdate($param);
		print_r($data);die;
		$paramstring = http_build_query($data);
		$content = post($url, $paramstring);
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
		$randnum = randCode(4,1);
		$data = array(
				'key'   => $this->key, //您申请的APPKEY
			    'mobile'    => $param['mobile'], //接受短信的用户手机号码
			    'tpl_id'    => $this->$tplid, //您申请的短信模板ID，根据实际情况修改
			    'tpl_value' =>'#code#='.$randnum //您设置的模板变量，根据实际情况修改
			);
		return $data;
	}

}


