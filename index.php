<?php
require_once "wechatsdk/wechat.class.php";
require_once "global_func.php";
require_once "global_define.php";


$options = array(
		'token'=>'coolhxq', //填写你设定的key
		'debug'=>true,
		'logcallback'=>'server_logger',
		'appid'=>TEST_APPID,
		'appsecret'=>TEST_APPSECRET
	);
server_logger("GET参数为：\n".var_export($_GET,true));
$weObj = new Wechat($options);
$ret = $weObj->valid();//明文或兼容模式可以在接口验证通过后注释此句，但加密模式一定不能注释，否则会验证失败
if (!$ret) {
	server_logger("验证失败！");
	var_dump($ret);
	exit;
}

$type = $weObj->getRev()->getRevType();
switch($type) {
	case Wechat::MSGTYPE_TEXT:
			require_once "./handler/textHandle.php";
			deal($weObj);
			exit;
			break;
	case Wechat::MSGTYPE_EVENT:
			require_once "./handler/eventHandle.php";
			deal($weObj);
			exit;
			break;
	case Wechat::MSGTYPE_IMAGE:
			require_once "./handler/imageHandle.php";
			deal($weObj);
			exit;
			break;
	default:
			$weObj->text("help info")->reply();
}
?>
