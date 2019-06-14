### 专送Pro项目公共包

> 依赖
  - laravel/framework : Laravel框架
  - tymon/jwt-auth : JWT用户认证
  - overtrue/laravel-filesystem-qiniu : 七牛云存储服务

> Models

- 项目模型

> Services

- QiniuService : 七牛存储服务类

> 依赖配置

```
config/database.php/redis

 'common' => [
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => env('REDIS_COMMON_DB', 10),
            'persistent' => true
        ]
        
```
