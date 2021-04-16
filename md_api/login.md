#登录接口

>`post`   `api.lyhbio.com/rest/v1/user/login`

| **参数**      | **必选** |  **类型**  | **描述**             |
| ----------- | :----: | :------: | :----------------- |
| *user_name* | *true* | *string* | *用户名(手机号或者邮箱)*     |
| *user_pwd*  | *true* | *string* | *用户密码（已经加密)*       |
| *time*      | *true* |  *int*   | *时间戳（用于确定接口的访问时间）* |
| *token*     | *true* | *string* | *确定访问者身份*          |
```  javascript
   {
       "code":200,  
       "msg":"登录成功",  
       "data":{
               "user_id":"100",  
               "user_name":"小王",  
               "user_role":"游客",  
               "user_pwd":"123456",    
               "user_email":"1773852344@qq.com",  
               "user_phone":"13423442442",
               "create_time": "2020/10/13 20:51:41",
        	   "update_time": "2020/10/15 23:21:14"
             }  
   }  
```