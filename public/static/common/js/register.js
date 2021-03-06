layui.use(['form', 'layer'], function () {
    var form = layui.form();
    var layer = layui.layer;
    form.verify({
        phone: [
            /^1\d{10}$/
            ,'请输入正确的手机号'
        ]
        , pass: [
            /^[\S]{6,12}$/
            , '密码必须6到12位，且不能出现空格'
        ]
        ,account:function(value){
            if(value == ''){
                return "账号不能为空";
            }
        }
    });
    //监听提交表单
    form.on('submit(*)', function (data) {
        layer.ready(function () {
            var post_data = data.field;
            if (post_data['pwd'] != post_data['repwd']) {
                layer.tips('两次输入密码不一致', '#pwd');
                return;
            }
            var index = layer.load(1, {
                shade: [0.1, '#fff'] //0.1透明度的白色背景
            });
            $.post('/chart/login/doRegister', post_data, function(res){
                layer.close(index);
                if(100 == res.code){
                    layer.ready(function(){
                        layer.msg(res.msg, {time:2000});
                        setTimeout(function(){
                            window.location.href = '/chart/login/index';
                        },2000);
                    });
                }else{
                    layer.ready(function(){
                        layer.msg(res.msg, {time:2000});
                    });
                }
            }, 'json');
        });
        return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
    });
});


var Nick = {};
//计算字符长度，包括中英文
Nick.GetLength = function (str) {
    var realLength = 0, len = str.length, charCode = -1;
    for (var i = 0; i < len; i++) {
        charCode = str.charCodeAt(i);
        if (charCode > 0 && charCode <= 128) realLength += 1;
        else realLength += 2;
    }
    return realLength;
}


//省市区三级联动
$(function () {

    layui.use(['cityselect'], function () {

        layui.cityselect.Init('register_form', p_code, c_code, a_code);
    });
});
