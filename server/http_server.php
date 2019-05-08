<?php 

$http = new \swoole_http_server("0.0.0.0",8811);

$http->set(
	[
		'enable_static_handler'  =>true,
		'document_root' =>"/data/wwwroot/momo/public/static",
        'worker_num' => 5,
	]
);
$http->on('WorkerStart',function(swoole_server $server,$worker_id){
    
    // 定义应用目录
    define('APP_PATH', __DIR__ . '/../application/');
    //定义public目录
    define('PUBLIC_PATH', __DIR__ . '/../public/');
    // 1. 加载基础文件
    require __DIR__ . '/../thinkphp/base.php';
});
$http->on('request',function($request,$response){
        //将swoole请求头信息转换为php的请求头
        $_SERVER = [];
        if(isset($request->server)){
            foreach($request->server as $k=>$v){
                $_SERVER[strtoupper($k)] = $v;
            }
        }

        //将swoole请求头信息转换为php的请求头
        if(isset($request->header)){
            foreach($request->header as $k=>$v){
                $_SERVER[strtoupper($k)] = $v;
            }
        }
        //将swoole请get信息转换为php的get
        $_GET = [];
        if(isset($request->get)){
            foreach($request->get as $k=>$v){
                $_GET[$k] = $v;
            }
        }
        
        //将swoole请post信息转换为php的post
        $_POST = [];
        if(isset($request->post)){
            foreach($request->post as $k=>$v){
                $_POST[$k] = $v;
            }
        }
        ob_start(); //打开缓冲区

        // 2. 执行应用
        try{
            // 执行应用并响应
        think\Container::get('app', [APP_PATH])
            ->run()
            ->send();
        }catch (\Exception $e){
            $response->end($e->getMessage());
        };
        
        $res = ob_get_contents();//获取当前缓冲区内容
        ob_end_clean();// 清空（擦除）缓冲区并关闭输出缓冲
		$response->end($res);
        //$http->close();
});

$http->start();


 ?>