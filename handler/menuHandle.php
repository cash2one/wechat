 <?php
/*
	@author hongxiaoqiang
	@email cool.hxq@gmail.com
	@desc 菜单管理：创建，删除，修改，可直接在浏览器中执行该脚本
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
$newmenu =  array(
	'button' => array(
		0 => array(
			'name' => '最新资讯',
			'sub_button' => array(
				0 => array(
					'type' => 'view',
					'name' => '最新公告',
					'url' => 'http://ld.ztgame.com/html/news/2015-04-22/001-1429-00034-696339.shtml',
					),
				1 => array(
					'type' => 'view',
					'name' => '官方网站',
					'url' => 'http://ld.ztgame.com/index.shtml',
					),
				2 => array(
					'type' => 'view',
					'name' => '官方论坛',
					'url' => 'http://tieba.baidu.com/f?kw=%C2%D2%EC%C0%D3%A2%D0%DB',
					),
				3 => array(
					'type' => 'view',
					'name' => '游戏下载',
					'url' => 'http://ld.ztgame.com/html/news/2015-04-22/001-1429-00034-696339.shtml',
					),
				),
			),
		1 => array(
			'name' => '资料攻略',
			'sub_button' => array(
				0 => array(
					'type' => 'view',
					'name' => '游戏介绍',
					'url' => 'http://ld.ztgame.com/game/',
					),
				1 => array(
					'type' => 'view',
					'name' => '英雄介绍',
					'url' => 'http://ld.ztgame.com/game/005-1398-00016-330078.shtml',
					),
				2 => array(
					'type' => 'view',
					'name' => '武器介绍',
					'url' => 'http://ld.ztgame.com/game/002-1398-0000b-329983.shtml',
					),
				3 => array(
					'type' => 'view',
					'name' => '阵容搭配',
					'url' => 'http://ld.ztgame.com/game/000-1398-00013-330045.shtml',
					),
				4 => array(
					'type' => 'view',
					'name' => '攻略汇总',
					'url' => 'http://ld.ztgame.com/game/008-1398-00005-329937.shtml',
					),
				),
			),
		2 => array(
			'name' => '便捷服务',
			'sub_button' => array(
				0 => array(
					'type' => 'view',
					'name' => '联系客服',
					'url' => 'http://www.baidu.com',
					),
				1 => array(
					'type' => 'view',
					'name' => '微博互动',
					'url' => 'http://www.baidu.com',
					),
				2 => array(
					'type' => 'view',
					'name' => '礼包码',
					'url' => 'http://www.baidu.com',
					),
				3 => array(
					'type' => 'view',
					'name' => '常见问题',
					'url' => 'http://www.baidu.com',
					),
				4 => array(
					'type' => 'click',
					'name' => '签到',
					'key' => 'EVENT_KEY_BIND_USER',
					),
				),
			),
		),
	);
//var_dump($newmenu['button'][0]['sub_button'][0]['url']);

//$result = $weObj->deleteMenu();
$result = $weObj->createMenu($newmenu);
//$result = $weObj->getMenu();
if ($result)
{
    server_logger("[menuHandler]," . $result);
    var_dump($result);
}
else
{
    $err = $weObj->errCode .  " - " . $weObj->errMsg;
    server_logger("[menuHandler]," . $err);
    var_dump($err);
}
 ?>
