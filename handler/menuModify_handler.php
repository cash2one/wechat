<?php
session_start();

require_once "../wechatsdk/wechat.class.php"; 
require_once "../global_func.php";
require_once "../global_define.php";
require_once "../request.php";

$new_notify_url = $_POST['notify_url'];
$menu_data = $_SESSION['menu_data']['menu'];

//var_dump("new_notify_url=" . $new_notify_url);
$menu_data['button'][0]['sub_button'][0]['url'] = $new_notify_url;

$options = array(
    'token'=>'coolhxq', //填写你设定的key
    'debug'=>true,
    'logcallback'=>'server_logger',
    'appid'=>TEST_APPID,
    'appsecret'=>TEST_APPSECRET
);

$weObj = new Wechat($options);
$result = $weObj->deleteMenu();
if ($result)
{
    server_logger("[menumodify_handler], deleteMenu success");
    $ret_create = false;
    for ($i = 0; $i < 20; $i++)
    {
        $ret = $weObj->createMenu($menu_data);
        if ($ret)
        {
            $ret_create = true;
            var_dump('modify success');
            server_logger("[menumodify_handler], createMenu success");
            break;
        }
        else
        {
            var_dump('try ' . $i . ' times failed');
            $err = $weObj->errCode .  " - " . $weObj->errMsg;
            server_logger("[menumodify_handler]," . $err . ' times:' . $i);
            var_dump($err);
        }
    }
    if (!$ret_create)
    {
        var_dump('completed failed, ask for administrator!');
        server_logger("[menumodify_handler], completed failed");
    }
}
else
{
    $err = $weObj->errCode .  " - " . $weObj->errMsg;
    server_logger("[menumodify_handler]," . $err);
    die($err);
}

?>
