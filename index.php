<?php
header("Content-type: text/html; charset=utf-8");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache");
header("Pragma: no-cache");
date_default_timezone_set("PRC");
include_once("./function.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
	<meta name="renderer" content="webkit">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta http-equiv="Cache-Control" content="no-transform"/>
	<meta http-equiv="Cache-Control" content="no-siteapp"/>
	<title>EZ-avatar | 用最简单的方式快速生成Material Design风格头像</title>
	<meta name="keywords" content="EZ-avatar,Material Design,avatar,头像" />
	<meta name="description" content="用最简单的方式快速生成Material Design风格头像" /> 
    <style>
        @charset "UTF-8";*{margin:0;padding:0;border:0;outline:0;-webkit-text-size-adjust:100%;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}*,:after,:before{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}html,body{height:100%}html{overflow-x:hidden;-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%}button,input,select,textarea{font-family:Exo,'-apple-system','Open Sans',HelveticaNeue-Light,'Helvetica Neue Light','Helvetica Neue','Hiragino Sans GB','Microsoft YaHei',Helvetica,Arial,sans-serif;resize:none}body{margin:0 auto;background-color:#76b852;color:#555;font-size:14px;font-family:Exo,'-apple-system','Open Sans',HelveticaNeue-Light,'Helvetica Neue Light','Helvetica Neue','Hiragino Sans GB','Microsoft YaHei',Helvetica,Arial,sans-serif;line-height:1.8;text-rendering:geometricPrecision;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}body>:first-child{margin-top:0 !important}body>:last-child{margin-bottom:0 !important}a{background-color:transparent;-webkit-text-decoration-skip:objects;text-decoration:none}.wrapper{width:360px;padding:8% 0 0;margin: auto}.login_form{position:relative;z-index:1;background:#FFFFFF;max-width:360px;margin:0 auto;padding:45px;text-align:center;box-shadow:0 0 20px 0 rgba(0, 0, 0, 0.2),0 5px 5px 0 rgba(0, 0, 0, 0.24)}#login input{background:#f2f2f2;width:100%;margin:0 0 15px;padding:15px;font-size:14px}#login-go{background:#4CAF50;width:100%;padding:15px;color:#FFFFFF;font-size:14px;cursor:pointer;transition:.5s}#login-go:hover{background:#7ab97d}#avatar{display:inline-block;width:155px;height:155px;color:#fff;background-color:#fff;font-size:100px;text-transform:uppercase;text-align:center;line-height:130px;cursor:default;-moz-user-select:none;-webkit-user-select:none;-ms-user-select:none;user-select:none;margin-top:-120px;margin-bottom:20px;border:5px solid #fff;border-radius:50%;vertical-align:middle;transition:.5s}#avatar:hover{transform:rotate(360deg)}input,textarea{-webkit-appearance:none}::-webkit-scrollbar{width:10px;margin-right:2px}::-webkit-scrollbar-thumb{width:10px;background:#cbcbcb}::selection{color:#000;background-color:#EEE}::-moz-selection{color:#000;background-color:#EEE}
    </style>
</head>
    <body>
        <a href="https://github.com/Ryongyon/EZ-avatar"><img style="position: fixed; top: 0; right: 0; border: 0;" src="https://camo.githubusercontent.com/38ef81f8aca64bb9a64448d0d70f1308ef5341ab/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f6461726b626c75655f3132313632312e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_right_darkblue_121621.png"></a>
        <div class="wrapper">
            <div class="login_form">
            <?php Get_Avatar($_POST['name'],$_POST['email']); ?>
            <form id="login" action="#" method="post" role="form">
            <input type="text" id="name" name="name" value="<?php echo $_POST['name']?>" placeholder="Name" required="true" aria-required="true" autocomplete="off" autofocus="">
            <input type="email" id="email" name="email" value="<?php echo $_POST['email']?>" placeholder="E-mail" required="true" aria-required="true" autocomplete="off" autofocus="">
            <button type="submit" id="login-go" onclick="logisn()">Get Avatar</button>
            </form>
            </div>
        </div>
    </body>
</html>