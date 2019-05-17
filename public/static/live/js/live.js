// 创建一个Socket实例
var socket = new WebSocket('ws://momo.mmrui.cn:8811');

// 打开Socket
socket.onopen = function(event) {
// 发送一个初始化消息
    console.log('success')
}

// 监听消息
socket.onmessage = function(event) {

    mypush(JSON.parse(event.data));
    console.log(event.data)
};

// 监听Socket的关闭
socket.onclose = function(event) {
    console.log('Client notified socket has closed',event);
};

function mypush(data){
        var html = '<div class="frame">';
                html  += '<h3 class="frame-header">';
                html  += '<i class="icon iconfont icon-shijian"></i>第'+data.type+'节';
                html +=data.time;
                html  += '</h3>';
                html  += '<div class="frame-item">';
                html  += '<span class="frame-dot"></span>';
                html  += '<div class="frame-item-author">';
                if(data.logo){
                    html  += '<img src="'+data.logo+'" width="20px" height="20px" />';
                }
                html +=data.title;
                html  += '</div>';
                html  += '<p>'+data.content+'</p>';
                html  += '</div>';
                html  += '</div>';
                $('#match-result').prepend(html);
}