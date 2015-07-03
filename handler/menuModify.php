<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
<body>
<?php
session_start();

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
$result = $weObj->getMenu();
if ($result)
{
    server_logger("[menumodify], getMenu success: " . $result);
    $_SESSION['menu_data'] = $result;
}
else
{
    unset($_SESSION['menu_data']);
    $err = $weObj->errCode .  " - " . $weObj->errMsg;
    server_logger("[menumodify]," . $err);
    die($err);
}
$url = $result['menu']['button'][0]['sub_button'][0]['url'];
echo '
    <form action="menuModify_handler.php" method="post" target="menu_iframe">
        notify: <input type="text" name="notify_url" size="40" value="'.$url.'"/>
        <br/><br/>
        <input type="submit"/>
    </form>
    <iframe id="menu_iframe" name="menu_iframe" stype="" width="50%"></iframe>
    ';
?>

<!--iframe id="ifmodifymenu" src="showmenu.php" width="725" height="840" name="ifmodifymenu"></iframe-->

</body>
</html>
