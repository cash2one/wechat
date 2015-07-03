<?php
/*
	@author hongxiaoqiang
	@email cool.hxq@gmail.com
	@desc 上传多媒体：图片，声音，视频 ...
*/
require_once "../wechatsdk/wechat.class.php"; 
require_once "../global_func.php";
require_once "../global_define.php";

$options = array(
		'token'=>'coolhxq', //填写你设定的key
		'debug'=>true,
		'logcallback'=>'server_logger',
		'appid'=>TEST_APPID,
		'appsecret'=>TEST_APPSECRET
	);
$weObj = new Wechat($options);


$forever_news = 'KLGQL8hNqMjoO3uSPWJtIo5Dhq98udLycQ1aZ6G90CM';
$result = $weObj->getForeverList('news', 0, 10);
//$result = $weObj->getForeverCount();
//$result = $weObj->getForeverMedia('xd5TIWiwJsPY4K6uxcTUQOovQNu_UyMDQr0vk-COxNo');
if ($result)
{
    server_logger("[获取素材]," . $result);
	var_dump($result);
	exit;
}
else
{
    $err = $weObj->errCode .  " - " . $weObj->errMsg;

    server_logger("[获取素材]," . $err);
    var_dump($err);
}
?>
