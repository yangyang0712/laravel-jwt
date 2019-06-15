本项目是用laravel制作API认证使用插件jwt
项目说明
1：composer 安装 composer require tymon/jwt-auth:1.0.0-rc.4.1

2：设置数据库、将生成的token存在数据库中、（本项目中默认迁移了一个数据，密钥使用的是laravel bcrypthan函数生成的）

3：修改配置文件、将config下的app.php文件加入jwt认证，及auth.php文件设置api接口jwt认证

4：api.php文件路由，使用提交的用户名（本项目使用的对应数据库中邮箱）和密码认证通过由jwt生成token于用户名使用md5加密存入数据库并返回

5，登陆退出jwt会自动删除token

6，生成中间件由jwt认证

7，将生成的token放入头部传送至后端，在中间件先认证token是否传送、token值加用户名MD5加密后于存储token是否相等，token是否过期

8，将认证的中间件写成路由组

以上将是本项目制作jwt认证的大致过程，本文的核心重点是由jwt生成的token在由自定义加密与接受值之后相同加密算法是否相同
