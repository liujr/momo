<?php 

class Ws{

    const HOST = '0.0.0.0';
    const PORT = 8811;
    public $ws = null;
    public function __construct(){
        $this->ws = new \swoole_websocket_server(self::HOST,self::PORT);

        $this->ws->set(
            [
                'enable_static_handler'  =>true,
                'document_root' =>"/data/wwwroot/momo/public/static",
                'worker_num' => 5,
                'task_worker_num' =>4,
            ]
        );
        $this->ws->on('open',[$this,'onopen']);
        $this->ws->on('message',[$this,'onMessage']);
        $this->ws->on('workerstart',[$this,'onWorkerStart']);
        $this->ws->on('request',[$this,'onRequest']);
        $this->ws->on('task',[$this,'onTask']);
        $this->ws->on('finish',[$this,'onFinish']);
        $this->ws->on('close',[$this,'onClose']);
        $this->ws->start();
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
        //将swoole请get信息转换为php的get
        $_FILES = [];
        if(isset($request->files)){
            foreach($request->files as $k=>$v){
                $_GET[$k] = $v;
            }
        }

        //将swoole请post信息转换为php的post
        $_POST = [];
        $_POST['http'] = $this->ws;
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
            $class = "\\task\\".$data['controller'];
            if(!class_exists($class))   app\common\Common::E($data['controller'].'类不存在');
            if(!$data['method'])  app\common\Common::E('方法名不能为空');
            $obj =  new $class();
            $method = $data['method'];
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
     * onOpen回调
     * @param $server
     * @param $worker_id
     */
    public function onOpen($ws, $request){

    }
    /**
     * onMessage回调
     * @param $server
     * @param $worker_id
     */
    public function onMessage($ws, $frame){
        
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
new ws();
 ?>