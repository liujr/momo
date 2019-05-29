<?php
namespace app\chart\controller;

use app\common\Common;
class Upload{
    /**
     * 文件上传
     */
    public function index(){
        try{
            echo '<pre>';
            $file = request()->file('avatar');
            $info = $file->move('../public/static/upload');
            var_dump($info);die;
            if($info){
                $data = ['img'=>config('url.host').'/upload/'.$info->getSaveName()];
                return Common::show(config('code.success'),'上传成功',$data);
            }else{
                return Common::show(config('code.error'),'上传失败');
            }
        }catch (\Exception $e){
            return Common::show(config('code.error'),$e->getMessage());
        }

    }

}