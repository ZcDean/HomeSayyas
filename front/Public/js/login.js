/**
 * Created by Dean on 2017/8/15.
 */
$(function () {

    $("#loginform").submit(function () {
        $.ajax({
            url:module_url+'/Login/login',
            data:{
                uuid:$("#uid").val(),
                pwd:$("#pwd").val()
            }
        }).then(function(data){
            if(data == -1){
                $("#error_msg").show();
            }else {
                location.href = module_url+'/Index/index';
            }
        });
        return false;
    });

});