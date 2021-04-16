# 用户注册接口
> `post`   `api.lyhbio.com/rest/v1/user/register`

| 参数          |   必选   |    类型    | 说明                  |
| :---------- | :----: | :------: | :------------------ |
| *time*      | *true* |  *int*   | *时间戳* (用于确定接口的访问时间) |
| *token*     | *true* | *string* | *确定访问者身份*           |
| *user_name* | *true* | *string* | *手机或者邮箱*            |
| *user_pwd*  | *true* | *string* | *加密用户密码*            |
| *code*      | *true* |  *int*   | *用户收到的验证码*          |

``` javascript
{
	"code": 200, 
	"msg": "注册成功！" ,
	"data": []
}
```
