<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
	<meta name="renderer" content="webkit">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta http-equiv="Cache-Control" content="no-transform"/>
	<meta http-equiv="Cache-Control" content="no-siteapp"/>
	<title>EZ-avatar</title>
	<meta name="keywords" content="EZ-avatar,Material Design,avatar,头像" />
	<meta name="description" content="用最简单的方式快速生成Material Design风格头像" /> 
    <link href="style.css" rel="stylesheet">
    
</head>
    <body>
        <header>
            <h1>EZ-avatar</h1>
            <a href="https://github.com/Ryongyon/EZ-avatar"><img style="position: fixed; top: 0; right: 0; border: 0;" src="https://camo.githubusercontent.com/38ef81f8aca64bb9a64448d0d70f1308ef5341ab/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f6461726b626c75655f3132313632312e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_right_darkblue_121621.png"></a>
        </header>
        
        <main>
            <h1>介绍</h1>
            <p>这或许是生成Material Design风格头像的众多方法中最简单的一种的方法，它跟其它的方法不同的一点在于它并不生成任何的图片文件，所以，你不必担心网络加载的问题，他仅仅是靠<span>标签去模拟一个头像。另外，你也不必担心同一个用户的头像颜色不统一导致混淆，它能通过用户的邮箱去生成一个独一无二的颜色。最后，如果检测到用户填写的邮箱已经拥有gravatar头像，那么它将选择加载gravatar头像，而不是生成Material Design风格头像</p>
            
            <h1>PHP-代码</h1>
<pre><code class="language-php">&lt;?php
$email = 'youremail@email.com';
$author = mb_substr( 'yourname', 0, 1 ,"UTF8");
$hash = md5(strtolower($email));
$avatar = 'https://cdn.v2ex.com/gravatar/' . $hash . '?s=80&amp;r=X&amp;d=404';
$color = '#' . mb_substr( md5(strtolower($email)), 0, 6 ,"UTF8");
$headers = @get_headers($avatar);
if (!preg_match("|200|", $headers[0])) {
echo "&lt;span class='ezavatar' style='background-color: $color;display: block;width: 80px;height: 80px;border-radius: 50%;color: #fff;text-align: center;text-transform: uppercase;font-size: 36px;line-height: 80px;cursor: default;-moz-user-select: none;-webkit-user-select: none;-ms-user-select: none;-khtml-user-select: none;user-select: none;'&gt;$author&lt;/span&gt;";
} else {
echo "&lt;img class='ezavatar' src='$avatar' style='display: block;width: 80px;height: 80px;border-radius: 50%;color: #fff;text-align: center;text-transform: uppercase;font-size: 36px;line-height: 80px;cursor: default;-moz-user-select: none;-webkit-user-select: none;-ms-user-select: none;-khtml-user-select: none;user-select: none;' alt='$author' draggable='false' /&gt;";
}
?&gt;</code></pre>
            
            <h1>PHP-演示</h1>
            <div id="demo">
            <div id="avatar">
            <span class="ezavatar" style="background-color: #b1dd59;">嗨</span>
            </div>
            <div id="fields">
<input type="text" id="author" name="author" maxlength="12" value="" size="30" aria-required="true" required="required" placeholder="嗨" oninput="fun()">
<input type="email" id="email" name="email" value="" size="30" aria-describedby="email-notes" aria-required="true" required="required" placeholder="admin@ryongyon.com" oninput="fun()">
<button type="button" class="btn" id="btn1" onclick="happy()" value="btn1">提交评论</button> 
            </div>
            </div>
            
            
    <div id="comments">
        <ol class='comment-list'>
    <?php  
    require 'lib/conn.inc.php';//引入配置文件
    ///*Connect to the local server,可以在函数名前加上 @ 来抑制失败时产生的错误信息。   
    $link = mysql_connect(HOST,NAME,VALUE) or die(mysql_error());  
    mysql_select_db(DATA) or die(mysql_error());  
    $rowsPerPage = 10;   //定义每页的行数  
    $row = mysql_fetch_assoc(mysql_query("SELECT count(*) AS c FROM comments")); //查询表中的总记录数  
    $rows = $row['c'];  //得到表中总记录数  
    $pages = ceil($rows / $rowsPerPage);    //计算出页数   
    $curPage = 1;                       //当前要显示第几页，默认显示第1页  
    //$_REQUEST变量比较大，一般不用。常用的是$_POST,$_GET，二者与form表单method保持一致。$_GET还支持url传值  
    if(isset($_GET['curPage'])) //假如用户提交了指定的页数  
        $curPage = $_GET['curPage'];    // 就将欲显示的页数设定为用户指定的值  
    //倒序查询  
    //echo $curPage;  
    $sql = "SELECT * FROM comments ORDER BY id DESC"." LIMIT ".($curPage -1)*$rowsPerPage.", $rowsPerPage";//修改sql语句，使得可以查询出指定的结果集  
    //echo $sql;  
    $result = mysql_query($sql) or die(mysql_error());  
    //列表显示----------显示部分内容不变  
    while($row = mysql_fetch_assoc($result)){

    //生成头像
    $hash = md5(strtolower($row['email']));
    $avatar = 'https://cdn.v2ex.com/gravatar/' . $hash . '?s=80&r=X&d=404';
    $color = '#' . mb_substr( md5(strtolower($row['email'])), 0, 6 ,"UTF8");
    $author = mb_substr( $row['author'], 0, 1 ,"UTF8");
    $headers = @get_headers($avatar);
    if (!preg_match("|200|", $headers[0])) {
    echo "<li><div><span class='avatar' style='background-color: $color;'>$author</span><div class='comment-main'><p>".$row['text']."</p><div class='comment-meta'><span class='comment-author'>".$row['author']."</span><span class='comment-time'><time>".$row['time']."</time></span></div></div></div></li>";
    } else {
    
    echo "<li><div><img class='avatar' src='$avatar' alt=".$row['author']." draggable='false' /><div class='comment-main'><p>".$row['text']."</p><div class='comment-meta'><span class='comment-author'>".$row['author']."</span><span class='comment-time'><time>".$row['time']."</time></span></div></div></div></li>";
}
    }  

    //显示全部分页的链接  
    echo "<div class='page-navigator' align = 'center'>";  
    for($i=1;$i<=$pages;$i++){   //循环显示，每个链接指定curPage属性为其指向的页数就可以了  
         
      if($i == $curPage){
            echo "<li class='current'><a href='/index.php?curPage=$i'>$i</a></li>";  }
        else  {
            echo "<li><a href='/index.php?curPage=$i'>$i</a></li>"; }
    }  
 
    echo "</div>";  
    //列表显示完毕

    mysql_free_result($result);  
    mysql_close($link);  
?>  
</ol>
</div>
        </main>

        <footer>
        </footer>
        
        <script type="text/javascript" language="javascript">
        var xmlHttp;    
   
        function fun(){    
            xmlHttp = new XMLHttpRequest();
            var url="/ajax/server.php";
            var author=document.getElementById("author").value;
            var email=document.getElementById("email").value;
            if(author == ''){author = '嗨'}
            xmlHttp.open("POST",url,true);   
            xmlHttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');  
            xmlHttp.onreadystatechange = callback;    
            xmlHttp.send("email=" + email + "&author=" + author);
        }    
        function callback(){    
            if(xmlHttp.readyState == 4 && xmlHttp.status == 200){
                    document.getElementById("avatar"). innerHTML = xmlHttp.responseText;
            }
        }
        
        //提交评论-AJAX
        function happy(){
            var url="/ajax/comments.php";
            var email=document.getElementById("email").value;
            var author=document.getElementById("author").value;
            var text='Hello, world!';
            if(email && author !== ''){
            xmlHttp = new XMLHttpRequest();
            //if(author == ''){author = '嗨'}
            xmlHttp.open("POST",url,true);   
            xmlHttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');  
            xmlHttp.onreadystatechange = ctcallback;    
            xmlHttp.send("email=" + email + "&author=" + author + "&text=" + text);
        }else{
            alert('表单不允许为空');
        } }  
        function ctcallback(){    
            if(xmlHttp.readyState == 4 && xmlHttp.status == 200){    
                    window.location.reload(); 
            }
        }
        </script>
        

      
<script type="text/javascript" language="javascript">
var _self="undefined"!=typeof window?window:"undefined"!=typeof WorkerGlobalScope&&self instanceof WorkerGlobalScope?self:{},Prism=function(){var e=/\blang(?:uage)?-(\w+)\b/i,t=0,n=_self.Prism={manual:_self.Prism&&_self.Prism.manual,util:{encode:function(e){return e instanceof a?new a(e.type,n.util.encode(e.content),e.alias):"Array"===n.util.type(e)?e.map(n.util.encode):e.replace(/&/g,"&amp;").replace(/</g,"&lt;").replace(/\u00a0/g," ")},type:function(e){return Object.prototype.toString.call(e).match(/\[object (\w+)\]/)[1]},objId:function(e){return e.__id||Object.defineProperty(e,"__id",{value:++t}),e.__id},clone:function(e){var t=n.util.type(e);switch(t){case"Object":var a={};for(var r in e)e.hasOwnProperty(r)&&(a[r]=n.util.clone(e[r]));return a;case"Array":return e.map&&e.map(function(e){return n.util.clone(e)})}return e}},languages:{extend:function(e,t){var a=n.util.clone(n.languages[e]);for(var r in t)a[r]=t[r];return a},insertBefore:function(e,t,a,r){r=r||n.languages;var l=r[e];if(2==arguments.length){a=arguments[1];for(var i in a)a.hasOwnProperty(i)&&(l[i]=a[i]);return l}var o={};for(var s in l)if(l.hasOwnProperty(s)){if(s==t)for(var i in a)a.hasOwnProperty(i)&&(o[i]=a[i]);o[s]=l[s]}return n.languages.DFS(n.languages,function(t,n){n===r[e]&&t!=e&&(this[t]=o)}),r[e]=o},DFS:function(e,t,a,r){r=r||{};for(var l in e)e.hasOwnProperty(l)&&(t.call(e,l,e[l],a||l),"Object"!==n.util.type(e[l])||r[n.util.objId(e[l])]?"Array"!==n.util.type(e[l])||r[n.util.objId(e[l])]||(r[n.util.objId(e[l])]=!0,n.languages.DFS(e[l],t,l,r)):(r[n.util.objId(e[l])]=!0,n.languages.DFS(e[l],t,null,r)))}},plugins:{},highlightAll:function(e,t){var a={callback:t,selector:'code[class*="language-"], [class*="language-"] code, code[class*="lang-"], [class*="lang-"] code'};n.hooks.run("before-highlightall",a);for(var r,l=a.elements||document.querySelectorAll(a.selector),i=0;r=l[i++];)n.highlightElement(r,e===!0,a.callback)},highlightElement:function(t,a,r){for(var l,i,o=t;o&&!e.test(o.className);)o=o.parentNode;o&&(l=(o.className.match(e)||[,""])[1].toLowerCase(),i=n.languages[l]),t.className=t.className.replace(e,"").replace(/\s+/g," ")+" language-"+l,o=t.parentNode,/pre/i.test(o.nodeName)&&(o.className=o.className.replace(e,"").replace(/\s+/g," ")+" language-"+l);var s=t.textContent,u={element:t,language:l,grammar:i,code:s};if(n.hooks.run("before-sanity-check",u),!u.code||!u.grammar)return u.code&&(u.element.textContent=u.code),n.hooks.run("complete",u),void 0;if(n.hooks.run("before-highlight",u),a&&_self.Worker){var g=new Worker(n.filename);g.onmessage=function(e){u.highlightedCode=e.data,n.hooks.run("before-insert",u),u.element.innerHTML=u.highlightedCode,r&&r.call(u.element),n.hooks.run("after-highlight",u),n.hooks.run("complete",u)},g.postMessage(JSON.stringify({language:u.language,code:u.code,immediateClose:!0}))}else u.highlightedCode=n.highlight(u.code,u.grammar,u.language),n.hooks.run("before-insert",u),u.element.innerHTML=u.highlightedCode,r&&r.call(t),n.hooks.run("after-highlight",u),n.hooks.run("complete",u)},highlight:function(e,t,r){var l=n.tokenize(e,t);return a.stringify(n.util.encode(l),r)},tokenize:function(e,t){var a=n.Token,r=[e],l=t.rest;if(l){for(var i in l)t[i]=l[i];delete t.rest}e:for(var i in t)if(t.hasOwnProperty(i)&&t[i]){var o=t[i];o="Array"===n.util.type(o)?o:[o];for(var s=0;s<o.length;++s){var u=o[s],g=u.inside,c=!!u.lookbehind,h=!!u.greedy,f=0,d=u.alias;if(h&&!u.pattern.global){var p=u.pattern.toString().match(/[imuy]*$/)[0];u.pattern=RegExp(u.pattern.source,p+"g")}u=u.pattern||u;for(var m=0,y=0;m<r.length;y+=r[m].length,++m){var v=r[m];if(r.length>e.length)break e;if(!(v instanceof a)){u.lastIndex=0;var b=u.exec(v),k=1;if(!b&&h&&m!=r.length-1){if(u.lastIndex=y,b=u.exec(e),!b)break;for(var w=b.index+(c?b[1].length:0),_=b.index+b[0].length,P=m,A=y,j=r.length;j>P&&_>A;++P)A+=r[P].length,w>=A&&(++m,y=A);if(r[m]instanceof a||r[P-1].greedy)continue;k=P-m,v=e.slice(y,A),b.index-=y}if(b){c&&(f=b[1].length);var w=b.index+f,b=b[0].slice(f),_=w+b.length,x=v.slice(0,w),O=v.slice(_),S=[m,k];x&&S.push(x);var N=new a(i,g?n.tokenize(b,g):b,d,b,h);S.push(N),O&&S.push(O),Array.prototype.splice.apply(r,S)}}}}}return r},hooks:{all:{},add:function(e,t){var a=n.hooks.all;a[e]=a[e]||[],a[e].push(t)},run:function(e,t){var a=n.hooks.all[e];if(a&&a.length)for(var r,l=0;r=a[l++];)r(t)}}},a=n.Token=function(e,t,n,a,r){this.type=e,this.content=t,this.alias=n,this.length=0|(a||"").length,this.greedy=!!r};if(a.stringify=function(e,t,r){if("string"==typeof e)return e;if("Array"===n.util.type(e))return e.map(function(n){return a.stringify(n,t,e)}).join("");var l={type:e.type,content:a.stringify(e.content,t,r),tag:"span",classes:["token",e.type],attributes:{},language:t,parent:r};if("comment"==l.type&&(l.attributes.spellcheck="true"),e.alias){var i="Array"===n.util.type(e.alias)?e.alias:[e.alias];Array.prototype.push.apply(l.classes,i)}n.hooks.run("wrap",l);var o=Object.keys(l.attributes).map(function(e){return e+'="'+(l.attributes[e]||"").replace(/"/g,"&quot;")+'"'}).join(" ");return"<"+l.tag+' class="'+l.classes.join(" ")+'"'+(o?" "+o:"")+">"+l.content+"</"+l.tag+">"},!_self.document)return _self.addEventListener?(_self.addEventListener("message",function(e){var t=JSON.parse(e.data),a=t.language,r=t.code,l=t.immediateClose;_self.postMessage(n.highlight(r,n.languages[a],a)),l&&_self.close()},!1),_self.Prism):_self.Prism;var r=document.currentScript||[].slice.call(document.getElementsByTagName("script")).pop();return r&&(n.filename=r.src,!document.addEventListener||n.manual||r.hasAttribute("data-manual")||("loading"!==document.readyState?window.requestAnimationFrame?window.requestAnimationFrame(n.highlightAll):window.setTimeout(n.highlightAll,16):document.addEventListener("DOMContentLoaded",n.highlightAll))),_self.Prism}();"undefined"!=typeof module&&module.exports&&(module.exports=Prism),"undefined"!=typeof global&&(global.Prism=Prism);
Prism.languages.markup={comment:/<!--[\w\W]*?-->/,prolog:/<\?[\w\W]+?\?>/,doctype:/<!DOCTYPE[\w\W]+?>/i,cdata:/<!\[CDATA\[[\w\W]*?]]>/i,tag:{pattern:/<\/?(?!\d)[^\s>\/=$<]+(?:\s+[^\s>\/=]+(?:=(?:("|')(?:\\\1|\\?(?!\1)[\w\W])*\1|[^\s'">=]+))?)*\s*\/?>/i,inside:{tag:{pattern:/^<\/?[^\s>\/]+/i,inside:{punctuation:/^<\/?/,namespace:/^[^\s>\/:]+:/}},"attr-value":{pattern:/=(?:('|")[\w\W]*?(\1)|[^\s>]+)/i,inside:{punctuation:/[=>"']/}},punctuation:/\/?>/,"attr-name":{pattern:/[^\s>\/]+/,inside:{namespace:/^[^\s>\/:]+:/}}}},entity:/&#?[\da-z]{1,8};/i},Prism.hooks.add("wrap",function(a){"entity"===a.type&&(a.attributes.title=a.content.replace(/&amp;/,"&"))}),Prism.languages.xml=Prism.languages.markup,Prism.languages.html=Prism.languages.markup,Prism.languages.mathml=Prism.languages.markup,Prism.languages.svg=Prism.languages.markup;
Prism.languages.css={comment:/\/\*[\w\W]*?\*\//,atrule:{pattern:/@[\w-]+?.*?(;|(?=\s*\{))/i,inside:{rule:/@[\w-]+/}},url:/url\((?:(["'])(\\(?:\r\n|[\w\W])|(?!\1)[^\\\r\n])*\1|.*?)\)/i,selector:/[^\{\}\s][^\{\};]*?(?=\s*\{)/,string:{pattern:/("|')(\\(?:\r\n|[\w\W])|(?!\1)[^\\\r\n])*\1/,greedy:!0},property:/(\b|\B)[\w-]+(?=\s*:)/i,important:/\B!important\b/i,"function":/[-a-z0-9]+(?=\()/i,punctuation:/[(){};:]/},Prism.languages.css.atrule.inside.rest=Prism.util.clone(Prism.languages.css),Prism.languages.markup&&(Prism.languages.insertBefore("markup","tag",{style:{pattern:/(<style[\w\W]*?>)[\w\W]*?(?=<\/style>)/i,lookbehind:!0,inside:Prism.languages.css,alias:"language-css"}}),Prism.languages.insertBefore("inside","attr-value",{"style-attr":{pattern:/\s*style=("|').*?\1/i,inside:{"attr-name":{pattern:/^\s*style/i,inside:Prism.languages.markup.tag.inside},punctuation:/^\s*=\s*['"]|['"]\s*$/,"attr-value":{pattern:/.+/i,inside:Prism.languages.css}},alias:"language-css"}},Prism.languages.markup.tag));
Prism.languages.clike={comment:[{pattern:/(^|[^\\])\/\*[\w\W]*?\*\//,lookbehind:!0},{pattern:/(^|[^\\:])\/\/.*/,lookbehind:!0}],string:{pattern:/(["'])(\\(?:\r\n|[\s\S])|(?!\1)[^\\\r\n])*\1/,greedy:!0},"class-name":{pattern:/((?:\b(?:class|interface|extends|implements|trait|instanceof|new)\s+)|(?:catch\s+\())[a-z0-9_\.\\]+/i,lookbehind:!0,inside:{punctuation:/(\.|\\)/}},keyword:/\b(if|else|while|do|for|return|in|instanceof|function|new|try|throw|catch|finally|null|break|continue)\b/,"boolean":/\b(true|false)\b/,"function":/[a-z0-9_]+(?=\()/i,number:/\b-?(?:0x[\da-f]+|\d*\.?\d+(?:e[+-]?\d+)?)\b/i,operator:/--?|\+\+?|!=?=?|<=?|>=?|==?=?|&&?|\|\|?|\?|\*|\/|~|\^|%/,punctuation:/[{}[\];(),.:]/};
Prism.languages.javascript=Prism.languages.extend("clike",{keyword:/\b(as|async|await|break|case|catch|class|const|continue|debugger|default|delete|do|else|enum|export|extends|finally|for|from|function|get|if|implements|import|in|instanceof|interface|let|new|null|of|package|private|protected|public|return|set|static|super|switch|this|throw|try|typeof|var|void|while|with|yield)\b/,number:/\b-?(0x[\dA-Fa-f]+|0b[01]+|0o[0-7]+|\d*\.?\d+([Ee][+-]?\d+)?|NaN|Infinity)\b/,"function":/[_$a-zA-Z\xA0-\uFFFF][_$a-zA-Z0-9\xA0-\uFFFF]*(?=\()/i,operator:/--?|\+\+?|!=?=?|<=?|>=?|==?=?|&&?|\|\|?|\?|\*\*?|\/|~|\^|%|\.{3}/}),Prism.languages.insertBefore("javascript","keyword",{regex:{pattern:/(^|[^\/])\/(?!\/)(\[.+?]|\\.|[^\/\\\r\n])+\/[gimyu]{0,5}(?=\s*($|[\r\n,.;})]))/,lookbehind:!0,greedy:!0}}),Prism.languages.insertBefore("javascript","string",{"template-string":{pattern:/`(?:\\\\|\\?[^\\])*?`/,greedy:!0,inside:{interpolation:{pattern:/\$\{[^}]+\}/,inside:{"interpolation-punctuation":{pattern:/^\$\{|\}$/,alias:"punctuation"},rest:Prism.languages.javascript}},string:/[\s\S]+/}}}),Prism.languages.markup&&Prism.languages.insertBefore("markup","tag",{script:{pattern:/(<script[\w\W]*?>)[\w\W]*?(?=<\/script>)/i,lookbehind:!0,inside:Prism.languages.javascript,alias:"language-javascript"}}),Prism.languages.js=Prism.languages.javascript;
Prism.languages.php=Prism.languages.extend("clike",{keyword:/\b(and|or|xor|array|as|break|case|cfunction|class|const|continue|declare|default|die|do|else|elseif|enddeclare|endfor|endforeach|endif|endswitch|endwhile|extends|for|foreach|function|include|include_once|global|if|new|return|static|switch|use|require|require_once|var|while|abstract|interface|public|implements|private|protected|parent|throw|null|echo|print|trait|namespace|final|yield|goto|instanceof|finally|try|catch)\b/i,constant:/\b[A-Z0-9_]{2,}\b/,comment:{pattern:/(^|[^\\])(?:\/\*[\w\W]*?\*\/|\/\/.*)/,lookbehind:!0,greedy:!0}}),Prism.languages.insertBefore("php","class-name",{"shell-comment":{pattern:/(^|[^\\])#.*/,lookbehind:!0,alias:"comment"}}),Prism.languages.insertBefore("php","keyword",{delimiter:/\?>|<\?(?:php)?/i,variable:/\$\w+\b/i,"package":{pattern:/(\\|namespace\s+|use\s+)[\w\\]+/,lookbehind:!0,inside:{punctuation:/\\/}}}),Prism.languages.insertBefore("php","operator",{property:{pattern:/(->)[\w]+/,lookbehind:!0}}),Prism.languages.markup&&(Prism.hooks.add("before-highlight",function(e){"php"===e.language&&(e.tokenStack=[],e.backupCode=e.code,e.code=e.code.replace(/(?:<\?php|<\?)[\w\W]*?(?:\?>)/gi,function(a){return e.tokenStack.push(a),"{{{PHP"+e.tokenStack.length+"}}}"}))}),Prism.hooks.add("before-insert",function(e){"php"===e.language&&(e.code=e.backupCode,delete e.backupCode)}),Prism.hooks.add("after-highlight",function(e){if("php"===e.language){for(var a,n=0;a=e.tokenStack[n];n++)e.highlightedCode=e.highlightedCode.replace("{{{PHP"+(n+1)+"}}}",Prism.highlight(a,e.grammar,"php").replace(/\$/g,"$$$$"));e.element.innerHTML=e.highlightedCode}}),Prism.hooks.add("wrap",function(e){"php"===e.language&&"markup"===e.type&&(e.content=e.content.replace(/(\{\{\{PHP[0-9]+\}\}\})/g,'<span class="token php">$1</span>'))}),Prism.languages.insertBefore("php","comment",{markup:{pattern:/<[^?]\/?(.*?)>/,inside:Prism.languages.markup},php:/\{\{\{PHP[0-9]+\}\}\}/}));
    </script>

    </body>
</html>