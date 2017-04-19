<?php
require '../lib/conn.inc.php';//引入配置文件
///*Connect to the local server,可以在函数名前加上 @ 来抑制失败时产生的错误信息。   
$link = mysql_connect(HOST,NAME,VALUE) or die(mysql_error());  
mysql_select_db(DATA) or die(mysql_error());  
$time = date("Y-m-d H:i:s");
@mysql_query("INSERT INTO `comments` (`email`, `author`, `ip`, `time`, `text`) VALUES ('".$_POST['email']."', '".$_POST['author']."', '".$_SERVER["REMOTE_ADDR"]."', '".$time."' , '".$_POST['text']."');");     //执行SQL命令
mysql_free_result($result);  
mysql_close($link);  
?>