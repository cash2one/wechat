<?php
/*
	@author hongxiaoqiang
	@email cool.hxq@gmail.com
	@desc 向指定玩家发送一封邮件
*/
require_once "global_func.php";
require_once "global_define.php";
require_once "request.php";

function send_mail($userid)
{
    global $MSG_TYPE_SEND_MAIL;
    $msgtype = $MSG_TYPE_SEND_MAIL;
    $data = "这是从微信发来的一封邮件，u get it!";
    $result = request($msgtype, 0, 0, $data);
    server_logger("result:" . $result);
    return $result;
}
?>
