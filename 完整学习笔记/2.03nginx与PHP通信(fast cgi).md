## nginx与PHP通信
首先我们先简单的看一份nginx server
```
server {
    listen 80 default_server;
    index index.php;
    root /home/work/
    
    location ~[^/]\.php(/l$)
    {
        fastcgi_pass unix:/tmp/php-cgi.sock;
        fastcgi_index index.php;
        include fastcgi.conf;
    }
    access_log /home/work/logs/default.log;
}
```

CGI是通用网关协议，FastCGI则是一种常住进程的CGI模式程序。我们所熟知的PHP-FPM会通过用户配置来管理一批FastCGI进程，例如在PHP-FPM管理下的某个FastCGI进程挂了，PHP-FPM会根据用户配置来看是否要重启补全，PHP-FPM更像是管理器，而真正衔接Nginx与PHP的则是FastCGI进程。

我们可以看到server中包含了`fastcgi.conf`，里面是一些fastcgi_param的配置项，如下：
```
fastcgi_param  QUERY_STRING       $query_string;
fastcgi_param  REQUEST_METHOD     $request_method;
fastcgi_param  CONTENT_TYPE       $content_type;
fastcgi_param  CONTENT_LENGTH     $content_length;

fastcgi_param  SCRIPT_NAME        $fastcgi_script_name;
fastcgi_param  REQUEST_URI        $request_uri;
fastcgi_param  DOCUMENT_URI       $document_uri;
fastcgi_param  DOCUMENT_ROOT      $document_root;
fastcgi_param  SERVER_PROTOCOL    $server_protocol;
fastcgi_param  HTTPS              $https if_not_empty;

fastcgi_param  GATEWAY_INTERFACE  CGI/1.1;
fastcgi_param  SERVER_SOFTWARE    nginx/$nginx_version;

fastcgi_param  REMOTE_ADDR        $remote_addr;
fastcgi_param  REMOTE_PORT        $remote_port;
fastcgi_param  SERVER_ADDR        $server_addr;
fastcgi_param  SERVER_PORT        $server_port;
fastcgi_param  SERVER_NAME        $server_name;

# PHP only, required if PHP was built with --enable-force-cgi-redirect
fastcgi_param  REDIRECT_STATUS    200;
fastcgi_param  PHP_VALUE  "open_basedir=$document_root:/usr/share/pear:/usr/share/php:/etc/phpMyAdmin:/tmp:/proc";
```

fastcig_param中所声明的内容会传到php-fpm（或者其他fast-cgi server）所管理的fast-cgi进程。我们可以看到，fastcgi_param中都是一些服务器的信息，如remote_addr(访问用户的ip)等，他就可以把这些信息传递给后端程序，如PHP的$_SERVER
