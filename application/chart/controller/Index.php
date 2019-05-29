<?php
namespace app\chart\controller;

class Index extends Base{

    public function index(){
        $mobile =  session('mobile');
        $userid =  session('userid');
        $sign =  session('sign')?session('sign'):'这家伙很懒！什么也没留';
        $avatar =  session('avatar');
        $this->assign(get_defined_vars());
        return $this->fetch();
    }

    public function getList(){
        $obj = new \logic\login\UserLogin();
        $user = $obj->info(session('userid'));
        $mine = [
            'username' =>$user['account'],
            'id'       =>$user['userid'],
            'status'  =>$user['userid']==2?'online':'offline',
            'sign'      =>$user['sign']?$user['sign']:'这家伙很懒！什么也没留',
            'avatar' =>$user['avatar'],
        ];

        $friend = [
            [
                'groupname' =>'知名人物',
                'id'    =>0,
                'list'  =>[
                    [
                        'username'=>'贤心',
                        'id'  =>100001,
                        'avatar' =>'http://tva1.sinaimg.cn/crop.0.0.118.118.180/5db11ff4gw1e77d3nqrv8j203b03cweg.jpg',
                        'sign'     =>'这些都是测试数据，实际使用请严格按照该格式返回',
                        'status' =>'online',
                    ],
                    [
                        'username'=>'刘小涛',
                        'id'  =>100001222,
                        'avatar' =>'http://tva4.sinaimg.cn/crop.0.1.1125.1125.180/475bb144jw8f9nwebnuhkj20v90vbwh9.jpg',
                        'sign'     =>'如约而至，不负姊妹欢乐颂',
                    ],
                    [
                        'username'=>'谢小楠',
                        'id'  =>10034001,
                        'avatar' =>'http://tva2.sinaimg.cn/crop.1.0.747.747.180/633f068fjw8f9h040n951j20ku0kr74t.jpg',
                        'sign'     =>'',
                    ],
                    [
                        'username'=>'马小云',
                        'id'  =>168168,
                        'avatar' =>'http://tva1.sinaimg.cn/crop.0.0.180.180.180/7fde8b93jw1e8qgp5bmzyj2050050aa8.jpg',
                        'sign'     =>'夜深人静的时候，想起了她',
                        'status' =>'online',
                    ],
                    [
                        'username'=>'徐小峥',
                        'id'  =>666666,
                        'avatar' =>'http://tva1.sinaimg.cn/crop.0.0.512.512.180/6a4acad5jw8eqi6yaholjj20e80e8t9f.jpg',
                        'sign'     =>'代码在囧途，也要写到底',
                    ],
                ]
            ],
            [
                'groupname' =>'网红声优',
                'id'    =>1,
                'list'  =>[
                    [
                        'username'=>'罗小凤',
                        'id'  =>121286,
                        'avatar' =>'http://tva4.sinaimg.cn/crop.0.0.640.640.180/4a02849cjw8fc8vn18vktj20hs0hs75v.jpg',
                        'sign'     =>'在自己实力不济的时候，不要去相信什么媒体和记者。他们不是善良的人，有时候候他们的采访对当事人而言就是陷阱',
                        'status' =>'online',
                    ],
                    [
                        'username'=>'Z_子晴',
                        'id'  =>108101,
                        'avatar' =>'http://tva1.sinaimg.cn/crop.0.23.1242.1242.180/8693225ajw8fbimjimpjwj20yi0zs77l.jpg',
                        'sign'     =>'微电商达人',
                    ],
                    [
                        'username'=>'大鱼_MsYuyu',
                        'id'  =>12123454,
                        'avatar' =>'http://tva2.sinaimg.cn/crop.0.0.512.512.180/005LMAegjw8f2bp9qg4mrj30e80e8dg5.jpg',
                        'sign'     =>'我瘋了！這也太準了吧  超級笑點低',
                    ],
                    [
                        'username'=>'醋醋cucu',
                        'id'  =>102101,
                        'avatar' =>'http://tva2.sinaimg.cn/crop.0.0.640.640.180/648fbe5ejw8ethmg0u9egj20hs0ht0tn.jpg',
                        'sign'     =>'',
                    ],
                    [
                        'username'=>'柏雪近在它香',
                        'id'  =>3435343,
                        'avatar' =>'http://tva2.sinaimg.cn/crop.0.8.751.751.180/961a9be5jw8fczq7q98i7j20kv0lcwfn.jpg',
                        'sign'     =>'代码在囧途，也要写到底',
                    ],
                ]
            ],
            [
                'groupname' =>'女神艺人',
                'id'    =>2,
                'list'  =>[
                    [
                        'username'=>'王小贤',
                        'id'  =>76543,
                        'avatar' =>'http://wx2.sinaimg.cn/mw690/5db11ff4gy1flxmew7edlj203d03wt8n.jpg',
                        'sign'     =>'我爱贤心',
                    ],
                    [
                        'username'=>'佟小娅',
                        'id'  =>4803920,
                        'avatar' =>'http://tva3.sinaimg.cn/crop.0.0.750.750.180/5033b6dbjw8etqysyifpkj20ku0kuwfw.jpg',
                        'sign'     =>'我也爱贤心吖吖啊',
                    ]
                ]
            ],
        ];

        $group = [
            ['groupname'=>'前端群','id'=>101,'avatar'=>'http://tva1.sinaimg.cn/crop.0.0.200.200.50/006q8Q6bjw8f20zsdem2mj305k05kdfw.jpg'],
            ['groupname'=>'PHP群','id'=>102,'avatar'=>'http://tva2.sinaimg.cn/crop.0.0.199.199.180/005Zseqhjw1eplix1brxxj305k05kjrf.jpg'],
        ];
        $data = [
            'code'=>0,
            'msg' =>'',
            'data' =>[
                'mine' =>$mine,
                'friend'=>$friend,
                'group' =>$group
            ]
        ];
        echo json_encode($data);
    }

    public function memberListUrl(){
        $list = [
            [
                'username'=>'贤心',
                'id'  =>100001,
                'avatar' =>'http://tva1.sinaimg.cn/crop.0.0.118.118.180/5db11ff4gw1e77d3nqrv8j203b03cweg.jpg',
                'sign'     =>'这些都是测试数据，实际使用请严格按照该格式返回',
            ],
            [
                'username'=>'Z_子晴',
                'id'  =>108101,
                'avatar' =>'http://tva1.sinaimg.cn/crop.0.23.1242.1242.180/8693225ajw8fbimjimpjwj20yi0zs77l.jpg',
                'sign'     =>'微电商达人',
            ],
            [
                'username'=>'Lemon_CC',
                'id'  =>102101,
                'avatar' =>'http://tva4.sinaimg.cn/crop.0.0.180.180.180/6d424ea5jw1e8qgp5bmzyj2050050aa8.jpg',
                'sign'     =>'',
            ],
            [
                'username'=>'马小云',
                'id'  =>168168,
                'avatar' =>'http://tva1.sinaimg.cn/crop.0.0.180.180.180/7fde8b93jw1e8qgp5bmzyj2050050aa8.jpg',
                'sign'     =>'夜深人静的时候，想起了她',
            ],
            [
                'username'=>'徐小峥',
                'id'  =>666666,
                'avatar' =>'http://tva1.sinaimg.cn/crop.0.0.512.512.180/6a4acad5jw8eqi6yaholjj20e80e8t9f.jpg',
                'sign'     =>'代码在囧途，也要写到底',
            ],
            [
                'username'=>'罗小凤',
                'id'  =>121286,
                'avatar' =>'http://tva4.sinaimg.cn/crop.0.0.640.640.180/4a02849cjw8fc8vn18vktj20hs0hs75v.jpg',
                'sign'     =>'在自己实力不济的时候，不要去相信什么媒体和记者。他们不是善良的人，有时候候他们的采访对当事人而言就是陷阱',
            ],
            [
                'username'=>'刘小涛',
                'id'  =>100001222,
                'avatar' =>'http://tva4.sinaimg.cn/crop.0.1.1125.1125.180/475bb144jw8f9nwebnuhkj20v90vbwh9.jpg',
                'sign'     =>'如约而至，不负姊妹欢乐颂',
            ],
            [
                'username'=>'大鱼_MsYuyu',
                'id'  =>12123454,
                'avatar' =>'http://tva2.sinaimg.cn/crop.0.0.512.512.180/005LMAegjw8f2bp9qg4mrj30e80e8dg5.jpg',
                'sign'     =>'我瘋了！這也太準了吧  超級笑點低',
            ],
            [
                'username'=>'谢小楠',
                'id'  =>10034001,
                'avatar' =>'http://tva2.sinaimg.cn/crop.1.0.747.747.180/633f068fjw8f9h040n951j20ku0kr74t.jpg',
                'sign'     =>'',
            ],
            [
                'username'=>'柏雪近在它香',
                'id'  =>3435343,
                'avatar' =>'http://tva2.sinaimg.cn/crop.0.8.751.751.180/961a9be5jw8fczq7q98i7j20kv0lcwfn.jpg',
                'sign'     =>'',
            ],
            [
                'username'=>'王小贤',
                'id'  =>76543,
                'avatar' =>'http://wx2.sinaimg.cn/mw690/5db11ff4gy1flxmew7edlj203d03wt8n.jpg',
                'sign'     =>'我爱贤心',
            ],
            [
                'username'=>'佟小娅',
                'id'  =>4803920,
                'avatar' =>'http://tva3.sinaimg.cn/crop.0.0.750.750.180/5033b6dbjw8etqysyifpkj20ku0kuwfw.jpg',
                'sign'     =>'我也爱贤心吖吖啊',
            ],
        ];

        $data =[
            'code'=>0,
            'msg' =>'',
            'data'=>[
                'list' => $list
            ]
        ];

        echo json_encode($data);
    }

    public function uploadImgUrl(){
        $data = [
            'code'=>0,
            'msg'  =>'',
            'data'=>[
                'src'=>'http://momo.mmrui.cn/static/common/layui/images/face/0.gif'
            ],
        ];
        echo json_encode($data);

    }

    public function uploadFileUrl(){
        $data = [
            'code'=>0,
            'msg'  =>'',
            'data'=>[
                'src'=>'http://momo.mmrui.cn/static/common/layui/images/face/0.gif'
            ],
        ];
        echo json_encode($data);

    }


    public function  msgBoxUrl(){

    }
    public function  findUrl(){

    }
    public function  chatlogUrl(){

    }



}