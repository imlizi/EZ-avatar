<?php
function Get_Avatar($name,$email)
{
    if(!$name == '' && !$email == '')
    {
        $hash = md5(strtolower($email)); // 将email转成md5值(用于获取Gravatar头像 或者 生成固定颜色)
        $avatar = 'https://cdn.v2ex.com/gravatar/' . $hash . '?s=155&r=X' . '&d=404'; // 定义获取Gravatar头像地址(这里用的是V2EX的CDN源，可自行改动，唯一不能改动的地方是后面的d=404参数，这个参数用于下面判断是否存在头像)
        $color = '#' . mb_substr($hash, 0, 6 ,"UTF8"); // 根据邮箱转换出来的MD5值取前6位作为唯一颜色代码
        $author = mb_substr($name, 0, 1 ,"UTF8"); // 提取名称的第一个字
        
        /* 使用Curl的方法判断头像是否存在，返回状态码200则意味存在
        $curl = curl_init();
        $url = $avatar; // 将上面解析好的头像地址赋值到$url
        curl_setopt($curl, CURLOPT_URL, $url); //设置URL
        curl_setopt($curl, CURLOPT_HEADER, 1); //获取Header
        curl_setopt($curl,CURLOPT_NOBODY,true); //Body就不要了吧，我们只是需要Head
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); //数据存到成字符串吧，别给我直接输出到屏幕了
        curl_exec($curl); //开始执行啦～
        $httpstat = curl_getinfo($curl,CURLINFO_HTTP_CODE); //我知道HTTPSTAT码哦～
        curl_close($curl); //用完记得关掉它
        if (!preg_match("|200|", $httpstat)) //开始判断结果，如果有头像则输出头像，没有则生成Material Design风格头像
        {
            echo "<span id='avatar' style='background-color:$color'>$author</span>";
        }else {
            echo "<img id='avatar' src='$avatar' alt='$name' />";
        }
        */

        /* 使用get_headers方法判断头像是否存在，返回状态码200则意味存在 */
        $headers = @get_headers($avatar);
        if (!preg_match("|200|", $headers[0]))
        {
            echo "<span id='avatar' style='background-color:$color'>$author</span>";
        }else {
            echo "<img id='avatar' src='$avatar' alt='$name' />";
        }
    }else {
        echo "<span id='avatar' style='background-color:#555'>叁</span>";
    }
}
