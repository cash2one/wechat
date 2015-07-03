<?php
/*
	@author hongxiaoqiang
	@email cool.hxq@gmail.com
	@desc 事件处理，关注，取消关注等
*/
include "../wechatsdk/wechat.class.php"; 

function deal($weObj)
{
	$eventtype = $weObj->getRev()->getRevEvent();
	switch ($eventtype['event']) {
		case Wechat::EVENT_SUBSCRIBE:
            $weObj->text("欢迎你进入一个new world！<br>" . helpinfo())->reply();
            break;
        case Wechat::EVENT_MENU_CLICK:
            if ($eventtype['key'] == 'EVENT_KEY_BIND_USER')
            {
                $str = "乱炖英雄 <a href=\"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx6bd4eaf6e9b5d02e&redirect_uri=http://222.73.243.6/handler/binduser.php&response_type=code&scope=snsapi_base&state=1#wechat_redirect\">【绑定角色】</a>";
                $weObj->text($str)->reply();
            }
            break;
		default:
            $weObj->text("这里是默认事件处理")->reply();
            break;
	}
}

function helpinfo()
{
	$str = "1. 输入‘文’或者‘文章’会推送一篇文章<br>";
	$str = $str . "2. 发送图片会有提示";
	return $str;
}

?>
