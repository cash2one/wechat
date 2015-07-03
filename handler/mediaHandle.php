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





//必须要提供绝对路径
/*
$dir = dirname(__FILE__) . '/../image/image2.jpg';
$media_data = array("media" => "@" . $dir);
//$result = $weObj->uploadMedia($media_data, "image");
$result = $weObj->uploadForeverMedia($media_data, 'image');
if (!$result)
{
  	var_dump($result);
 	exit;
}
else
{
	var_dump($result);
	var_dump($weObj->errCode);
  	exit;
}*/


//上传用于群发的图文素材 测试通过
$tmp_media_id = 'kKOGVVRM83GIBySbCC-_GPq-ccFdRurTq4N3xDLTzcU';
$article = array(
	'articles' => array(
		0 => array(
			'thumb_media_id' => $tmp_media_id,
			'author' => 'iamshok',
			'title' => 'shanghai is coming',
			'content_source_url' => 'http://movie.douban.com/subject/10562987/',
			'content' => 'my content',
			'digest' => 'my digest',
			), 
		),
	);
//$result = $weObj->uploadForeverMedia();   //上传永久thumb_media_id
$result = $weObj->uploadForeverArticles($article);  //上传永久图文
if ($result)
{
    server_logger("[uploadArticles]," . $result);
	var_dump($result);
	exit;
}
else
{
    $err = $weObj->errCode .  " - " . $weObj->errMsg;

    server_logger("[uploadArticles]," . $err);
    var_dump($err);
}

?>
