$(function(){
    $('.mysubmit').onkeydown(function(event){
        if(event.keyCode == 13){
            var text = $(this).val();
            var _this = $(this);
            var url = "http://momo.mmrui.cn:8811/?s=index/chart/index";
            var data = {content:text,game_id:1};
            $.post(url,data,function(){
                _this.val('');
            },'json')
        }
    });
});