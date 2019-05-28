<?php

return[

    'host'=>'127.0.0.1',//成功返回
    'port'  =>6379,//失败返回
    'smskey' =>'sms_', //短信key前缀
    'sms_out_time'  => 60, //短信过期时间
    'online_key' =>'online_fd',//redis 集合 在线键
    'userid_association_fd' =>'useridAssociationFd_',//用户id关联fd
];
