## 简介

采用Thinkphp框架开发的供学生学习使用的教程<br/>
thinkphp在nginx下面部署的时候，需要使用rewrite模式来支持pathinfo。<br/>
在配置文件中使用下面的模式：<br/>
'URL_MODEL'             =>  2,       // URL访问模式,可选参数0、1、2、3,代表以下四种模式：<br/>
    // 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式<br/>
然后在nginx的vhost下面的配置文件中，需要配置好rewrite模式的规则<br/>
location / {<br/>
    if (!-e $request_filename) {<br/>
        rewrite ^(.*)$ /index.php?s=/$1 last;<br/>
        break;<br/>
    }<br/>
}<br/>
重启nginx服务即可。
    