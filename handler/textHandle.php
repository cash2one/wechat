<?php
/*
	@author hongxiaoqiang
	@email cool.hxq@gmail.com
	@desc 文本处理，自动回复
*/
require_once "wechatsdk/wechat.class.php"; 
require_once "global_func.php";
require_once "sendmail.php";
require_once "getzones.php";
require_once "auto_reply_config.php";

function deal($weObj)
{
	$keyword = $weObj->getRevContent();
    if (auto_reply($weObj, $keyword))
    {
        server_logger("关键字回复成功 keyword=" . $keyword);
    }
    else if ($keyword == "文章" || $keyword == "文")
	{
		$article = array(
			"0"=>array(
				'Title'=>'程序员技术练级攻略',
				'Description'=>'summary text',
				//'PicUrl'=>'http://365jia.cn/uploads/13/0301/5130c2ff93618.jpg',
                'PicUrl'=>'https://mmbiz.qlogo.cn/mmbiz/iajorGalmQfTEEWWt4wbwVh58133IBgtpjMgHC27PekgLvtdHwdD1Mb2NfTIzLfXT1W7tW3NUXmPPfEed9vs3hg/0?wx_fmt=jpeg',
				'Url'=>'http://coolshell.cn/articles/4990.html'
            ),
            "1"=>array(
				'Title'=>'Docker基础技术：Linux CGroup',
				'Description'=>'summary text',
				'PicUrl'=>'http://coolshell.cn//wp-content/uploads/2014/06/software_development.png',
				'Url'=>'http://coolshell.cn/articles/17049.html'
            ),
            "2"=>array(
                'Title'=>'my news',
                'Description'=>'my news description',
				'PicUrl'=>'http://coolshell.cn//wp-content/uploads/2014/06/software_development.png',
                'Url'=>'http://mp.weixin.qq.com/s?__biz=MzAxMTQwODQyNg==&mid=207583625&idx=1&sn=f27e639e12f390c5dd9660bd73fcc102#rd'
                ) 
			);
		$weObj->news($article)->reply();
	}
    else if(is_numeric($keyword))
    {
        $userid = intval($keyword);
        server_logger("收到发邮件请求:" . $userid);
        $result = send_mail($userid);
        if (!$result)
            $weObj->text("发送邮件失败,可能是没连接上")->reply();
        else
            $weObj->text($result)->reply();
    }
    else if($keyword == "zone")
    {
        $ret = get_zonelist();
        if (! $ret)
        {
            server_logger("获取服务器列表失败");
            $weObj->text("获取失败")->reply();
        }
        else
        {
            $weObj->text($ret)->reply();
        }
    }
    else if($keyword == "ha")
    {
        $weObj->text("hahaha")->reply();
    }
	else
	{
		$str = "你好 \n";
		$str = $str . "暂时无法为您提供服务，请稍后再试，拜托" ;	//换行貌似不起作用 \r\n \n <br>
		$weObj->text($str)->reply();
	}
}

function  auto_reply($weObj, $keyword)
{
    global $auto_reply_rule;
    foreach($auto_reply_rule as $rule)
    {
        if (in_array($keyword, $rule['keywords'], true))
        {
            $weObj->news($rule['article'])->reply();
            return true;
        }
    }
    return false;
}
?>
