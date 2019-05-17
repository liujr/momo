<?php
namespace app\index\controller;
use think\Exception;
use app\common\Common;
use app\common\Redis;
class Push
{
    /**
     * 推送数据
     */
    public function index(){
        try{
            if(empty($_GET))Common::E('请填入数据');
            $teams = [
                1=>['name'=>'马刺','logo'=>'/live/imgs/team1.png'],
                4=>['name'=>'火箭','logo'=>'/live/imgs/team2.png'],
            ];
            $data = [
                    'type' =>intval($_GET['type']),
                    'title'  =>!empty($teams[$_GET['team_id']]['name']) ? $teams[$_GET['team_id']]['name']:'直播员',
                     'logo'  =>!empty($teams[$_GET['team_id']]['logo']) ? $teams[$_GET['team_id']]['logo']:'',
                     'content'  =>!empty($_GET['content']) ? $_GET['content']:'',
                    'image'  =>!empty($_GET['image']) ? $_GET['image']:'',
            ];

            $senddata = array(
                'controller' =>'PushTask',
                'method'     =>'push',
                'data'          =>$data
            );
            $_POST['http']->task($senddata);

            return Common::show(config('code.success'),'保存成功');
        }catch (\Exception $e){
            return Common::show(config('code.error'),$e->getMessage());
        }

    }
}
