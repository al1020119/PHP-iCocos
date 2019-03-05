# 负载均衡，请求转发

### 七层负载均衡的实现
基于URL等应用层信息的负载均衡  
用Nginx的proxy实现七层负载均衡，具有如下特点：
>功能强大，运行稳定  
配置简单灵活  
能够自动剔除工作不正常的后端服务器  
上传文件使用异步模式 
支持多种分配策略(内置策略，扩展策略)，可以分配权重  
内置策略：IP Hash 、 加权轮询  
扩展策略： fair策略、通用hash、一致性hash


###### 加权轮询策略：
>首先将请求都分给权重高的机器，知道机器权重降低到了比其他机器低，在将请求分配给下一个权重高的机器。当所有机器都down掉时，Nginx会将所有机器标志位清成初始状态，以避免所有机器都处在timeout状态

###### IP Hash策略：
>与轮询很类似，只是算法做了一些修改，相当于变向的轮询策略

###### fair策略：
>根据后端的响应时间来判断负载的情况，从中选出负载最轻的机器，进行分流

###### 通用hash、一致性hash策略：
>通用hash使用Nginx内置的变量key进行hash，一致性hash采用了Nginx内置的一致性hash环，支持memcache

``` 
Nginx配置：
http {
    upstream cluster {
        # ip hash; 指定策略为ip hash
        server svr1; # 配置权重 weight = 10；
        server svr2;
        server svr3;
    }
    
    server {
        listen 80;
        location / {
            proxy_pass http://cluster;
        }
    }
}
```

### 四层负载均衡的实现
>四层负载均衡是通过报文中目标地址和端口，再加上负载均衡设备设置的服务器选择方式，决定最终选择的内部服务器。  
软件(LVS)实现，LVS有三种方式：NAT、DR、TUN  
