# WEB安全简介
### 一、SQL注入攻击(SQL Injection)

攻击者把sql命令插入到web表单的输入域或页面请求的字符串，欺骗服务器执行恶意的sql命令。常见的sql注入攻击类似：

1. 登录页面中输入内容直接用来构造动态的sql语句，例如：
``` 
$query = 'select * from users where login = '. $username. 'and password = '. $password;
```
攻击者如果在用户名或者密码框输入`or '1' =1`，这样我们执行的sql语句就变成了：
```
select * from users where login = '' or '1' = 1 and ...
```
这样就绕过了我们的登录验证。类似的还有很多，用户通过输入恶意的sql命令来绕过我们的验证，欺骗我们的系统。

防范的方法：
1. 检查变量数据类型和格式
2. 过滤特殊的符号
3. 绑定变量，使用预处理语句（当我们绑定变量的时候，就算有特殊字符sql也会认为是个变量而不是sql命令）

### 二、跨站脚本攻击(Cross Site Scripting, XSS；因为CSS被用了所以叫XSS)

攻击者将恶意代码注入到网页上，其他用户在加载网页时就会执行代码，攻击者可能会得到各种私密的信息，如cookie等。例如：
``` 
<?php
    echo '你好！'.$_GET['name'];
```
如果用户传入一段脚本`<script>[code]</script>`，那么脚本也会执行，如果code的内容是获取到cookie并发送到某个指定的位置，获取了敏感的信息。亦或是利用用户的身份去执行一些不正当的操作。

防范的方法：
1. 输出的时候过滤特殊的字符，转换成html编码，过滤输出的变量（PHP可以使用htmlspecialchars）

### 三、跨站请求伪造攻击(Cross Site Request Forgeries, CSRF)

攻击者伪造目标用户的HTTP请求，然后此请求发送到有CSRF漏洞的网站，网站执行此请求后，引发跨站请求伪造攻击。攻击者利用隐蔽的HTTP连接，让目标用户在不注意的情况下单击这个链接，由于是用户自己点击的，而他又是合法用户拥有合法权限，所以目标用户能够在网站内执行特定的HTTP链接，从而达到攻击者的目的。  
例如：  
用户刚刚登陆了银行A网站，建立了会话，A网站可以进行转账操作`http://www.mybank.com/Transfer.php?toBankId=11&money=1000`在没有退出的情况下去访问危险网站B网站，B网站有一个图片是这样的`　<img src=http://www.mybank.com/Transfer.php?toBankId=11&money=1000>`，不小心点了B网站，用户发现账上少了1000块。  
    可能有人会说，修改操作并不会用get请求。那么假设银行A网站的表单如下
``` 
<form action="Transfer.php" method="POST">
    <p>ToBankId: <input type="text" name="toBankId" /></p>
    <p>Money: <input type="text" name="money" /></p>
    <p><input type="submit" value="Transfer" /></p>
</form>
```
后台处理页面如下：
``` 
<?php
session_start();
if (isset($_REQUEST['toBankId'] && isset($_POST['money']))
{
    buy_stocks($_REQUEST['toBankId'],$_REQUEST['money']);
}
?>
```
B网站这时候也相应的改了代码:
```
<html>
    <head>
　　　　<script type="text/javascript">
　　　　　　function steal()
　　　　　　{
          　　　　 iframe = document.frames["steal"];
　　     　　      iframe.document.Submit("transfer");
　　　　　　}
　　　　</script>
　　</head>

　　<body onload="steal()">
　　　　<iframe name="steal" display="none">
　　　　　　<form method="POST" name="transfer"　action="http://www.myBank.com/Transfer.php">
　　　　　　　　<input type="hidden" name="toBankId" value="11">
　　　　　　　　<input type="hidden" name="money" value="1000">
　　　　　　</form>
　　　　</iframe>
　　</body>
</html>
```
用户一点到B网站，发现又少了1000块.......

防范方法：
    对表单进行cookie hash校验，将一个随机值的hash写入cookie，每次提交表单，都在服务端对这个hash进行校验（建立在用户的cookie没有被盗取）
    
### 四、Session固定攻击(Session Fixation)

攻击者预先设定session id，让合法用户使用这个session id来访问被攻击的应用程序，一旦用户的会话ID被成功固定，攻击者就可以通过此session id来冒充用户访问应用程序。例如：  
1. 攻击者先访问目标网站，获得了自己的session_id，如SID=123
2. 攻击者给目标用户发送链接，并带上了自己的session_id，如`http:///www.bank.com/?SID=123`，
3. 目标用户点击了`http:///www.bank.com/?SID=123`，输入用户名密码登录，由于session_id不会变更，那么攻击者就可以通过访问`http:///www.bank.com/?SID=123`来获取目标用户的身份。

防范方法：
1. 定期更改session_id
2. 更改session_id的名字
### 五、Session劫持(Session Hijacking)

攻击者利用各种手段来获取目标用户的session id。一旦获取到session id，那么攻击者可以利用目标用户的身份来登录网站，获取目标用户的操作权限。
攻击者获取目标用户session id的方法:  
1. 暴力破解:尝试各种session id，直到破解为止;
2. 计算:如果session id使用非随机的方式产生，那么就有可能计算出来;
3. 窃取:使用网络截获，xss攻击等方法获得  
防范方法：
1. 定期更改session id
2. 更改session的名称
3. 关闭透明化session id
4. 设置HttpOnly。通过设置Cookie的HttpOnly为true，可以防止客户端脚本访问这个Cookie，从而有效的防止XSS攻击。
### 六、文件上传漏洞(File Upload Attack)

攻击者利用程序缺陷绕过系统对文件的验证与处理策略将恶意代码上传到服务器并获得执行服务器端命令的能力。  
常用的攻击手段有：  
1. 上传Web脚本代码，Web容器解释执行上传的恶意脚本；
2. 上传Flash跨域策略文件crossdomain.xml，修改访问权限(其他策略文件利用方式类似)；
3. 上传病毒、木马文件，诱骗用户和管理员下载执行；
4. 上传包含脚本的图片，某些浏览器的低级版本会执行该脚本，用于钓鱼和欺诈。  
总的来说，利用的上传文件要么具备可执行能力(恶意代码)，要么具备影响服务器行为的能力(配置文件)。
防范方法：  
1. 文件上传的目录设置为不可执行；
2. 判断文件类型，设置白名单。对于图片的处理，可以使用压缩函数或者resize函数，在处理图片的同时破坏图片中可能包含的HTML代码；
3. 使用随机数改写文件名和文件路径：一个是上传后无法访问；再来就是像shell、.php 、.rar和crossdomain.xml这种文件，都将因为重命名而无法攻击；
4. 单独设置文件服务器的域名：由于浏览器同源策略的关系，一系列客户端攻击将失效，比如上传crossdomain.xml、上传包含Javascript的XSS利用等问题将得到解决。