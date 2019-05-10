<?php 

class Http{

    const HOST = '0.0.0.0';
    const PORT = 8811;
    public $http = null;
    public function __construct(){
        $this->http = new \swoole_http_server(self::HOST,self::PORT);

        $this->http->set(
            [
                'enable_static_handler'  =>true,
                'document_root' =>"/data/wwwroot/momo/public/static",
                'worker_num' => 5,
                'task_worker_num' =>4,
            ]
        );

        $this->http->on('workerstart',[$this,'onWorkerStart']);
        $this->http->on('request',[$this,'onRequest']);
        $this->http->on('task',[$this,'onTask']);
        $this->http->on('finish',[$this,'onFinish']);
        $this->http->on('close',[$this,'onClose']);
        $this->http->start();
    }

    /**
     * WorkerStart回调
     * @param $server
     * @param $worker_id
     */
    public function onWorkerStart($server,$worker_id){
        // 定义应用目录
        define('APP_PATH', __DIR__ . '/../application/');
        // 1. 加载基础文件
        require __DIR__ . '/../thinkphp/start.php';
    }
    /**
     * Request回调
     * @param $server
     * @param $worker_id
     */
    public function onRequest($request,$response){
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
        $_POST['http'] = $this->http;
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
    }

    /**
     * onTask回调
     * @param $server
     * @param $worker_id
     */
    public function onTask($server,$taskid,$workerid,$data){
        try{
            print_r($data['controller']);
            $obj  = new app\core\task. '\\'.$data['controller'];
            $method = $data['method'];
            if(!$obj)  app\common\Common::E('不存在该类');
            if(!$method)  app\common\Common::E('方法名不能为空');
            $obj->$method($data['data']);
        }catch (\Exception $e){
          echo $e->getMessage();
        };

    }
    /**
     * onFinish回调
     * @param $server
     * @param $worker_id
     */
    public function onFinish($server,$taskid,$data){
       echo "taskId:{$taskid}\n";
        echo "finish-data-success:{$data}\n";
    }
    /**
     * onClose回调
     * @param $server
     * @param $worker_id
     */
    public function onClose($ws,$fd){
       echo "clientid:{$fd}\n";
    }


}
new Http();
 ?>