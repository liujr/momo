layui.use(['form', 'layer', 'upload'], function () {
    var form = layui.form();
    var layer = layui.layer;
    //修改头像
    layui.upload({
        url: '/chart/upload/index'
        ,title: '修改头像'
        ,ext: 'jpg|png'
        ,success: function(res){
            console.log(res);
            if(100 == res.code){
                $("#LAY_demo_upload").attr('src', res.data.img);
                $("#user_avatar").val(res.data.img);
            }else{
                layer.msg(res.msg, {time:2000});
            }
        }
    });

    //提交修改项
    $("#btn").click(function(){

        layer.ready(function(){

            var mobile = $("#mobile").val();
            if('' == mobile){
                layer.tips('手机号码不能为空', '#mobile');
                return ;
            }

            var myreg=/^[1][3,4,5,7,8][0-9]{9}$/;
            if (!myreg.test(mobile)) {
                layer.tips('请输入正确的手机号', '#mobile');
                return ;
            }

            var user_avatar = $("#user_avatar").val();

            var pwd = $("#pwd").val();
            var repwd = $("#repwd").val();

            if('' == pwd && '' != repwd){
                layer.tips('新密码不能为空', '#pwd');
                return ;
            }

            if('' != pwd && '' == repwd){
                layer.tips('重复密码不能为空', '#repwd');
                return ;
            }


            if('' != pwd && '' != repwd  && pwd != repwd){
                layer.tips('两次密码不一致', '#pwd');
                return ;
            }

            if('' != pwd && '' != repwd  && pwd == repwd){
                if(!/^[\S]{6,12}$/.test(pwd)){
                    layer.tips('密码必须6到12位，且不能出现空格', '#pwd');
                    return ;
                }
                if(!/^[\S]{6,12}$/.test(repwd)){
                    layer.tips('密码必须6到12位，且不能出现空格', '#repwd');
                    return ;
                }
            }

            var sex = $("input[name='sex']:checked").val();
            var age = $("#age").val();

            var pid = $("select[name='province'] option:selected").val();
            var cid = $("select[name='city'] option:selected").val();
            var aid = $("select[name='area'] option:selected").val();

            if('' == pid && '' == cid && '' == aid){
                layer.msg('居住地不能空');
                return ;
            }

            $.post('/chart/User/edit',
                {
                    'mobile' : mobile,
                    'pwd' : pwd,
                    'repwd' : repwd,
                    'avatar' : user_avatar,
                    'sex' : sex,
                    'age' : age,
                    'province' : pid,
                    'city' : cid,
                    'area' : aid
                }, function(res){
                    layer.close(index);
                    if(1 == res.code){
                        layer.msg(res.msg, {time:1500});
                        setTimeout(function(){
                            var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                            parent.layer.close(index); //再执行关闭
                        }, 1500);
                    }else{
                        layer.msg(res.msg, {time:2000});
                    }
                }, 'json');

            var index = layer.load(1, {
                shade: [0.1, '#fff'] //0.1透明度的白色背景
            });

        });
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

        layui.cityselect.Init('user_info', p_code, c_code, a_code);
    });
});
