<?php
namespace app\index\controller;
use think\Exception;
use app\common\Common;
class Image
{
    /**
     * 发送短信
     */
    public function index(){
        try{
            print_r($_FILES);
           /*$file = request()->file('file');
            $info = $file->move('../public/static/upload');
            if($info){
                $data = ['img'=>config('url.host').'/upload/'.$info->getSaveName()];
                return Common::show(config('code.success'),'上传成功',$data);
            }else{
                return Common::show(config('code.error'),'上传失败');
            }*/
        }catch (\Exception $e){
            return Common::show(config('code.error'),$e->getMessage());
        }

    }
}
