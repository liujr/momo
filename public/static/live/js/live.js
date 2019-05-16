// 创建一个Socket实例
var socket = new WebSocket('ws://momo.mmrui.cn:8811');

// 打开Socket
socket.onopen = function(event) {
// 发送一个初始化消息
    console.log(event);
    console.log('success')
}

// 监听消息
socket.onmessage = function(event) {
    console.log(event.data)
};

// 监听Socket的关闭
socket.onclose = function(event) {
    console.log('Client notified socket has closed',event);
};