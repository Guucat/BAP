# 获取验证码接口
> `get`   `api.lyhbio.com/rest/v1/code`

| 参数         |   必选   |    类型    | 说明                  |
| :--------- | :----: | :------: | :------------------ |
| *time*     | *true* |  *int*   | *时间戳* (用于确定接口的访问时间) |
| *token*    | *true* | *string* | *确定访问者身份*           |
| *username* | *true* | *string* | *手机或者邮箱*            |
| *is_exist* | *true* | *string* | *用户是否应该存储*（1：是；0：否） |

``` javascript
{
	"code": 200, 
	"msg": "手机验证码已经成功发送，每天可以发送5次，请在一分钟内验证" ,
	"data": []
}
```



