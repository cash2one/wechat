<?php
/*
	@author hongxiaoqiang
	@email cool.hxq@gmail.com
	@desc 分组
*/

include "../wechatsdk/wechat.class.php"; 
include "../global_func.php";
include "../global_define.php";

$options = array(
		'token'=>'coolhxq', //填写你设定的key
		'debug'=>true,
		'logcallback'=>'server_logger',
		'appid'=>TEST_APPID,
		'appsecret'=>TEST_APPSECRET
	);
$weObj = new Wechat($options);
$result = $weObj->getGroup();
if ($result)
{
	var_dump($result);
	exit;
}
?>
