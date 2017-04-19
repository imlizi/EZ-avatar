<?php
    $hash = md5(strtolower($_POST['mail']));
    $avatar = 'https://cdn.v2ex.com/gravatar/' . $hash . '?s=80&r=X&d=404';
    $color = '#' . mb_substr( md5(strtolower($_POST['mail'])), 0, 6 ,"UTF8");
    $author = mb_substr( $_POST['author'], 0, 1 ,"UTF8");
    $headers = @get_headers($avatar);
    if (!preg_match("|200|", $headers[0])) {
    echo "<span class='ezavatar' style='background-color: $color;'>$author</span>";
    } else {
    echo "<img class='ezavatar' src='$avatar' alt=".$_POST['author']." draggable='false' />";
}
?>