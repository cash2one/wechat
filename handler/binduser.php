<?php

session_start();

/**
 * 微信oAuth认证示例
 */
require_once "../wechatsdk/wechat.class.php";
require_once "../global_func.php";
require_once "../global_define.php";
require_once "../auth.php";

$options = array(
		'token'=>'coolhxq', //填写你设定的key
		'debug'=>true,
		'logcallback'=>'server_logger',
		'appid'=>TEST_APPID,
		'appsecret'=>TEST_APPSECRET
	);
$auth = new wxauth($options);
server_logger("[网页授权]:" . $auth->wxuser["open_id"] . " " . $auth->wxuser["nickname"] . " " . $auth->wxuser["sex"]);

?>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
<body>
    <form action="binduser_handler.php" method="post" target="bind_iframe">
        zone :
        <select name="zone">
            <option value="1">zone1</option>
            <option value="2">zone2</option>
            <option value="3">zone3</option>
        </select><br><br>
        role: <input type="text" name="role" value="50001"><br><br>
    <input type = "submit" onclick="alert('一个微信账号只能绑定一个角色，确定绑定吗');">
    </form>
    <iframe id="bind_iframe" name="bind_iframe" stype=""></iframe>
</body>
</html>
