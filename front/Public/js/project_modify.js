/**
 * Created by Dean on 2017/8/17.
 */
$(function () {

    $(document).on("click",".schedule-plus",function () {
        var div = $("<div></div>");
        var input_date = $('<input type="date" name="schedule_date">');
        var input_text = $('<input type="text" name="schedule_content" style="margin-left: 5px;" placeholder="业务明细">');
        var i_plus = $('<i class="icon-plus schedule-plus" title="添加明细" style="margin:0 8px;"></i>');
        var i_del = $('<i class="icon-remove schedule-delete" title="删除"></i>');
        div.append(input_date,input_text,i_plus,i_del);
        $("#schedules").append(div);
        div.addClass("controls schedules");
    });

    $(document).on('click','.schedule-delete', function () {
        $(this).parent().remove();
    });
    
    
    $("#add_form").submit(function () {
        var data = [];
        var scedule_date = $("input[name='schedule_date']");
        $("input[name='schedule_content']").each(function (j,item) {
            var time = scedule_date[j].value;
            data.push({create_time:time,content:item.value});
        });
        $.ajax({
            url:module_url+'/Project/modifyPro',
            data:{
                report_time:$("#report_time").val(),
                contact:$("#contact").val(),
                contact_tel:$("#contact_tel").val(),
                address:$("#address").val(),
                schedule:data
            }
        }).then(function(data){
            if(data == 1){
                $('#modifytoast').html('本次操作成功!');
                $('#myModal').modal('show');
                $('#myModal').on('hide.bs.modal', function () {
                    location.href = module_url+"/Project/plist";
                })
            }else {
                $('#modifytoast').html('操作失败!');
                $('#myModal').modal('show');
                $("#add_form")[0].reset();
            }
        });
        return false;
    });
});