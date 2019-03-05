# Nginx用法介绍

### 1.常见操作
`nginx -s signal`

signal的值可以是：
- stop 快速关机
- quit 正常关机
- reload 重新加载配置文件
- reopen 重新打开日志文件

### 2.配置文件
nginx是由模块组成的，这些模块在配置文件中又有指定的指令。 指令被分成简单指令和块指令。简单指令包括名称和用空格分割的参数以及用来结尾的分号(;)。 一个块指令和简单指令有相同的结构，但是它使用大括号({and})来包围一系列说明来替代使用分号作为结尾。

放在配置文件最外面的指令的称之为主文，`event`,`http`指令在主文中；`server`在`http`中， `location`在`server`中。

### 3.静态服务
Web服务器一个重要的任务就是提供文件（如图像或者静态html页面）。 根据需求，你将实现一个例子，文件被本地不同的目录服务着，如`/data/www` 包含html文件，`/data/images` 包含图片。这需要编辑配置文件，在`http`块中设置`server`块。

首先，创建`/data/www` 目录并放置index.html文件（文件中可以是任意内容）。 然后创建`/data/images`目录并放置一些图片。

接下来，打开配置文件。默认的配置文件已经包含了几个server块的例子，大多数都被注释掉了。 现在注释掉所有的块，并开始一个新的server块。
```
http {
    server {
    }
}
```
一般情况下，配置文件中包含多个server块，它们之间以监听的端口号和server name来区分。 一旦nginx决定了哪个server处理请求，它测试在请求的对server块内定义的位置指令的参数头中指定的URI。

添加location到server中
```$xslt
location / {
    root /data/www;
}
```
与请求的URI相比，location块指定了“/”前缀。为了匹配请求，该URI会被添加到root指令指定的路径中， 即，到/data/www，在本地文件系统中组成请求文件的路径。如果有多个匹配的location块，nginx会选择前缀最长的。 上面的location块提供了最短的前缀，如果其他的location块匹配失败，这个location块就会被使用。

现在来添加第二个location:
```$xslt
location /images/ {
    root /data;
}
```
它与带/images/的请求请求匹配。（location / ，当然也匹配，除非有更短的前缀。）

现在server中是这样的：
```$xslt
server {
    location / {
        root /data/www;
    }
    location /images/ {
        root /data;
    }
}
```
重启配置文件，让配置生效 `nginx -s reload`

这已经是一个可以工作的服务器配置文件，它监听的是80端口，可在本地通过`http://localhost/`访问。 响应带`/images/`的URI路由请求时，服务器将会从`/data/images`目录发送文件。 例如，响应 `http://localhost/images/example.png` 路由请求，nginx将会发送`/data/images/example.png` 文件。如果这个文件不存在，nginx将会发出404错误的响应。不带`/images/`的URIs请求将会映射到`/data/www`目录。 例如，为了响应`http://localhost/some/example.html`请求，nginx将会发送`/data/www/some/example.html`文件。

### 3.代理服务器
服务器A接受到请求后，将请求转发给其他的服务器B，从服务器B处获得响应，并将取得的相应返回给客户端，服务器B则是服务器A的代理服务器

首先，我们新增一个server
```$xslt
server {
    listen 8080;
    root /data/up1;
    location / {
    }
}
```
这是一个简单的server块，监听8080端口（此前，listen指令没有被提起是由于已经使用了标准的80端口），并将所有的请求 映射到本地文件系统的/data/up1目录。创建这个目录，并将index.html文件放置其中。注意root指令已经被放置在server环境中。 当location块被选中服务请求时，root指令就会被使用，当然不包括自己的root指令。

修改第一个location块，放置`proxy_pass`指令与协议、名称和参数中指定的代理服务器端口
```
server {
    location / {
        proxy_pass http://localhost:8080;
    }
    location /images/ {
        root /data;
    }
}
```
修改第二个location块，它目前映射所有带/images/前缀的请求到/data/images 目录下的文件，是为了使其符合典型的文件扩展的图像请求
``` 
location ~ \.(gif|jpg|png)$ {
    root /data/images;
}
```
该参数是一个正则表达式，匹配所有.gif,.jpg,.png 结尾的路由。正则表达式应该优于～。相应的请求都会被映射到 /data/images目录。

当nginx选择一个location块服务一个请求时，它首先检查location指令的指定前缀，记住location最长的前缀， 然后检查正则表达式。如果有一个匹配的正则表达式，nginx会挑选location块，否则它会选择之前的。
因此代理服务器的配置文件应该是这样的:
```
server {
    location / {
        proxy_pass http://localhost:8080/;
    }
    location ~ \.(gif|jpg|png)$ {
        root /data/images;
    }
}
```
此服务器会筛选出以.gif,.jpg,.png 结尾的请求，并将他们映射到/data/images目录下(通过添加URI到root指令的参数上)， 然后通过所有其它请求到代理服务器配置上

`nginx -s reload` 重启配置使更改生效

### 4. FastCGI代理
nginx可用于路由请求FastCGI服务器，FastCGI服务器运行各种不同的框架和编程语言，如PHP，建立的应用。

最常用与 FastCGI server工作的nginx配置，用fastcgi_pass指令替代了proxy_pass指令，并设置fastcgi_param 参数传递给FastCGI server。假设FastCGI server通过localhost:9000可以访问。 以上一节代理配置作为基础，用fastcgi_pass指令替换proxy_pass指令，并修改参数为localhost:9000。在PHP中， SCRIPT_FILENAME参数用来确定脚本名，QUERY_STRING参数用来传递请求参数。
```
server {
    location / {
        fastcgi_pass  localhost:9000;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_param QUERY_STRING    $query_string;
    }
    location ~ \.(gif|jpg|png)$ {
        root /data/images;
    }
}
```