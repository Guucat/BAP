## 任务及完成测试的接口
---
1. 登陆（李中秋）

   接口测试url: `post` `http://api.lyhbio.com/rest/v1/user/login`

   测试成功返回结果:
   ``` javascript
   {
    "code": 200,
    "msg": "登录成功",
    "data": {
        "user_id": 5,
        "user_name": "李华",
        "user_role": "老师",
        "user_pwd": "123456",
        "user_email": "2416413348@qq.com",
        "user_phone": "16846838475",
        "create_time": "2020/10/25 09:41:57",
        "update_time": "2020/11/11 21:35:07"
        }
   }
   ```

2. 注册（黄恒）
   接口测试url: `post` `http://api.lyhbio.com/rest/v1/user/register`

   测试成功返回结果:
   ``` javascript
   {
       "code": 200,
       "msg": "用户注册成功",
       "data": []
   }
   ```

3. 资源（卢洪）
   接口测试url: `get` `http://api.lyhbio.com/rest/v1/source/11/1/1`

   测试成功返回结果:
   ``` javascript
   {
       "code": 200,
       "msg": "返回资源链接",
       "data": {
           "source_id": "1",
           "source_name": "国际免疫遗传学系统（IMGT）",
           "source_url": "http://www.imgt.org",
           "create_time": "2020/9/23 12:28:31",
           "update_time": "2020/9/24 22:38:55"
       }
   }
   ```

4. 工具（邓强）
    接口测试url: `get` `http://api.lyhbio.com/rest/v1/tool/11/1/1`

   测试成功返回结果:
   ``` javascript
   {
       "code": 200,
       "msg": "返回工具链接",
       "data": {
           "tool_id": "1",
           "tool_name": "抗体序列与结构分析（abYsis）",
           "tool_url": "http://www.abysis.org/abysis/index.html",
           "create_time": "2020/11/4 13:10:21",
           "update_time": "2020/11/14 12:21:05"
       }
   }
   ```

