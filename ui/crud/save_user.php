<?php

$keywords = $_REQUEST['keywords'];
$article = $_REQUEST['article'];

include 'conn.php';

#$sql = "insert into users(firstname,lastname,phone,email) values('$firstname','$lastname','$phone','$email')";
$sql = "insert into tb_kewords_article(keywords, article) values('$keywords','$article')";
@mysql_query($sql);
echo json_encode(array(
	'id' => mysql_insert_id(),
    'keywords' => $keywords,
    'article' => $article,
));

?>
