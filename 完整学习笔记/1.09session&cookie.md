# 会话控制

### 一、cookie
setcookie($name, $value, $expire, $path, $domain, $secure);
设置cookie

$_COOKIE读取cookie

setcookie($name, time()-1)；  删除cookie


### 二、session
session的操作比较简单，需要注意的是使用前需要session_start();

session的一些配置:
```  
session.auto_start  //是否自动开启session
sesson.cookie_domain    // 存储session_id的cookie有效域
session.cookie_lifetime     // session_id的cookie有效的时间
session.cookie_path     // 保存的路径
session.name        // session_id 的名字
session.save_path   // session存储到服务器哪个文件
session.use_cookies // 是否使用cookie在客户端保存session_id，默认为1
session.save_handler // session存储的方式，默认是file

session.gc_probability = 1
session.gc_divisor = 100
定义在每次初始化会话时，启动垃圾回收程序的概率。计算公式如下：
session.gc_probability/session.gc_divisor，
比如1/100，表示有1%的概率启动启动垃圾回收程序，对会话页面访问越频繁，概率就应当越小。
建议值为1/1000~5000。

session.gc_maxlifetime = 1440
设定保存的session文件生存期，超过此参数设定秒数后，保存的数据将被视为’垃圾’并由垃圾回收程序清理。
```

当cookie被禁用时，传递session_id。
``` 
<a href="1.php?<?php echo session_name().'='.session_id()?>">下一页</a>

或者:

<a href="1.php?<?= SID?>">下一页</a>
SID这个常量是session_name()和session_id()的拼接，并且如果开启cookie这个SID就是空。相较于上一种方法会智能一些
```

多台服务器session同步，一般是存在redis（mysql等也可以)。
redis会自动用一种结构存储session，mysql需要建立对应的数据表