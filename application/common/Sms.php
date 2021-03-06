<?php
namespace app\common;
use app\common\Common;
use think\Exception;
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
		if(!$type)  Common::E('发送类型不能为空！');
		if(!array_key_exists ($type,$this->tplidarr)) Common::E('发送类型不存在！');
		$this->tplid = $this->tplidarr[$type];

	}

	/**
	* 发送
	*/
	public function send($param){
		$data = $this->checkdate($param);
		$senddata = array(
		    'controller' =>'SmsTask',
            'method'     =>'sendSms',
            'data'          =>$data
        );
        $_POST['http']->task($senddata);
	}

	/**
	* 验证数据和组装数据
	*/
	private function checkdate($param){
		if(!$param['mobile'])  Common::E('手机号码不能为空！');
		$randnum = Common::randnum(4,1);//随机获取4位数
		$data = array(
                'key'   => $this->key, //您申请的APPKEY
                'url'     =>$this->url,
                'mobile'    => $param['mobile'], //接受短信的用户手机号码
                'tpl_id'    => $this->tplid, //您申请的短信模板ID，根据实际情况修改
                'tpl_value' =>'#code#='.$randnum, //您设置的模板变量，根据实际情况修改
                'randnum' =>$randnum
			);
		return $data;
	}
}


