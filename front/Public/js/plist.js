/**
 * Created by Dean on 2017/8/17.
 */
$(function () {
    $(".pro-del").click(function () {
        var id = $(this).data('id');
        $('#modifytoast').html('删除将会删除所有关联数据，不可恢复.请谨慎操作');
        $("#modal_sure").show();
        $('#myModal').modal('show');
    });
});