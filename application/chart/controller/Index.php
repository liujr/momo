<?php
namespace app\chart\controller;

class Index extends Base{

    public function index(){
        //聊天用户
        $userInfo = [
            'id' => 1,
            'username' => 'admin',
            'avatar' => 'admin',
            'sign' => 'admin'
        ];

        $this->assign([
            'uinfo' => $userInfo
        ]);
        return $this->fetch();
    }

    //获取列表
    public function getList()
    {
        //查询自己的信息
        $mine = [
            'id' =>1,
            'user_name' =>'admin',
            'pwd' =>'iweruiwuesdncjsh3243245jsdncjsnic',
            'sign'  =>'qwert',
            'avatar'  =>'sdadsdsds',
            'sex'  =>1,
            'age'  =>12,
            'pid'  =>110000,
            'cid'  =>110000,
            'aid'  =>110101,
            'area'  =>'北京-北京市-东城区',
            'status'  =>1,

        ];

        //查询当前用户的所处的群组
        $groupArr = [
            ['user_id' => 1,'user_name'=>'群组1','user_avatar'=>'群组11','user_sign'=>'群组111','group_id'=>1],
            ['user_id' => 1,'user_name'=>'群组2','user_avatar'=>'群组22','user_sign'=>'群组222','group_id'=>2],
            ['user_id' => 1,'user_name'=>'群组3','user_avatar'=>'群组33','user_sign'=>'群组333','group_id'=>3],
        ];

        $online = 0;
        $group = [];  //记录分组信息
        $userGroup = config('user_group');
        $list = [];  //群组成员信息
        $i = 0;
        $j = 0;
        //查询该用户的好友
        $friends = db('friends')->alias('f')->field('c.user_name,c.id,c.avatar,c.sign,c.status,f.group_id')
            ->join('v3_chatuser c', 'c.id = f.friend_id')
            ->where('f.user_id', $uid)->select();

        foreach( $userGroup as $key=>$vo ){
            $group[$i] = [
                'groupname' => $vo,
                'id' => $key,
                'online' => 0,
                'list' => []
            ];
            $i++;
        }
        unset( $userGroup );

        foreach( $group as $key=>$vo ){

            foreach( $friends as $k=>$v ) {

                if ($vo['id'] == $v['group_id']) {

                    $list[$j]['username'] = $v['user_name'];
                    $list[$j]['id'] = $v['id'];
                    $list[$j]['avatar'] = $v['avatar'];
                    $list[$j]['sign'] = $v['sign'];
                    $list[$j]['status'] = empty($v['status']) ? 'offline' : 'online';

                    if (1 == $v['status']) {
                        $online++;
                    }

                    $group[$key]['online'] = $online;
                    $group[$key]['list'] = $list;

                    $j++;
                }
            }
            $j = 0;
            $online = 0;
            unset($list);
        }
        //print_r($group);die;
        unset( $friends );

        $return = [
            'code' => 0,
            'msg'=> '',
            'data' => [
                'mine' => [
                    'username' => $mine['user_name'],
                    'id' => $mine['id'],
                    'status' => 'online',
                    'sign' => $mine['sign'],
                    'avatar' => $mine['avatar']
                ],
                'friend' => $group,
                'group' => $groupArr
            ],
        ];

        echo json_encode( $return );

    }

}