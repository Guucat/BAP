#获取资源接口
> `get`   `api.lyhbio.com/rest/v1/source`

| 参数          |   必选   |    类型    | 说明                  |
| :---------- | :----: | :------: | :------------------ |
| *time*      | *true* |  *int*   | *时间戳* (用于确定接口的访问时间) |
| *token*     | *true* | *string* | *确定访问者身份*           |
| *source_id* | *true* | *string* | *资源唯一id*            |

``` javascript
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
