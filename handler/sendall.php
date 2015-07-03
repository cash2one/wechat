<?php
/*
	@author hongxiaoqiang
	@email cool.hxq@gmail.com
	@desc 群发
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

//群发文本
/*
$data = array(
	'filter' => array(
		'is_to_all' => true,
		'group_id' => '0',
		),
	'text' => array(
		'content' => 'this is sendall content',
		),
	'msgtype' => 'text',
	);

 */
//群发图文
$data = array(
	'filter' => array(
		'is_to_all' => true,
		//'group_id' => '0',
		),
	'mpnews' => array(
		'media_id' => 'KLGQL8hNqMjoO3uSPWJtIo5Dhq98udLycQ1aZ6G90CM',
		),
	'msgtype' => 'mpnews'
	);

//群发图片
/*
$data = array(
	'filter' => array(
		'is_to_all' => true,
		//'group_id' => '0',
		),
	'image' => array(
		'media_id' => $image_media_id2,
		),
	'msgtype' => 'image'
	);
	*/
$result = $weObj->sendGroupMassMessage($data);
if ($result)
{
    server_logger("[sendall]," . $result);
	var_dump($result);
	exit;
}
else
{
    $err = $weObj->errCode .  " - " . $weObj->errMsg;
    server_logger("[sendall]," . $err);
    var_dump($err);
}
?>
