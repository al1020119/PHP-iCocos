## Nginx配置文件参考
```
user  www www;
worker_processes  auto;

error_log  /var/log/nginx/error.log crit;
pid        /var/run/nginx.pid;
worker_rlimit_nofile 51200;

events {
    use epoll;
    worker_connections  51200;
}


http {
    include       /etc/nginx/mime.types;
    default_type  application/octet-stream;

    log_format  main  '$remote_addr - $remote_user [$time_local] "$request" '
                      '$status $body_bytes_sent "$http_referer" '
                      '"$http_user_agent" "$http_x_forwarded_for"';

    access_log  /var/log/nginx/access.log  main;

    server_name_in_redirect off;
    server_names_hash_max_size 2048;
    server_names_hash_bucket_size 128;

    connection_pool_size 256;
    client_header_buffer_size 128k;
    client_header_timeout 60s;
    client_max_body_size 50m;
    client_body_buffer_size 128k;
    client_body_timeout 60s;
    large_client_header_buffers 4 32k;
    request_pool_size 32k;
    output_buffers 4 32k;
    postpone_output 1460;

    sendfile on;
    tcp_nopush on;
    tcp_nodelay on;

    send_timeout 600s;
    reset_timedout_connection on;
    keepalive_timeout 60 60;

    fastcgi_connect_timeout 300;
    fastcgi_send_timeout 300;
    fastcgi_read_timeout 300;
    fastcgi_buffer_size 64k;
    fastcgi_buffers 16 16k;
    fastcgi_busy_buffers_size 128k;
    fastcgi_temp_file_write_size 128k;
    fastcgi_intercept_errors on; 

    gzip on;
    gzip_disable "MSIE [1-6].(?!.*SV1)";
    gzip_vary on;
    gzip_http_version 1.0;
    gzip_min_length  1100;
    gzip_comp_level 6;
    gzip_buffers 16 16k;
    gzip_proxied any;
    gzip_types text/plain text/css text/csv text/xml text/javascript application/x-javascript application/json application/xml application/rss+xml application/xhtml+xml application/atom_xml application/x-httpd-php image/jpeg image/pjpeg image/gif image/png image/x-png image/x-icon image/svg+xml image/webp;

    include /etc/nginx/conf.d/*.conf;

    server {
        listen 80 default;
        return 400;
    }
    
    server
    {
        listen 80;
        server_name localhost; #server_name end
        index index.html index.htm index.php; #index end
        charset utf-8;
    
        set $subdomain '';
        root  /home/wwwroot/index$subdomain;
        include rewrite/nomal.conf; #rewrite end
    
        location ~ .*\.php$
        {
            fastcgi_pass  unix:/dev/shm/php-fpm-index.sock;
            fastcgi_index index.php;
            fastcgi_param DOCUMENT_ROOT  /home/wwwroot/index$subdomain;
            fastcgi_param SCRIPT_FILENAME  /home/wwwroot/index$subdomain$fastcgi_script_name;
            include fastcgi_params;
            try_files $uri = 404;
        }
    
        location ~ .*\.(gif|jpg|jpeg|png|bmp|swf|flv|mp3|wma)$
        {
            expires      30d;
        }
    
        location ~ .*\.(js|css)$
        {
            expires      12h;
        }
    
        location ~* /templates(/.*)\.(bak|html|htm|ini|old|php|tpl)$ {
            allow 127.0.0.1;
            deny all;
        }
    
        location ~* \.(ftpquota|htaccess|htpasswd|asa|mdb)?$ {
            deny all;
        }
    
        access_log /var/log/nginx/index-access.log main; #access_log end
        error_log /var/log/nginx/index-error.log crit; #error_log end
    }
}
```