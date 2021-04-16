#获取工具接口
> `get`   `api.lyhbio.com/rest/v1/tool`

| 参数        |   必选   |    类型    | 说明                  |
| :-------- | :----: | :------: | :------------------ |
| *time*    | *true* |  *int*   | *时间戳* (用于确定接口的访问时间) |
| *token*   | *true* | *string* | *确定访问者身份*           |
| *tool_id* | *true* | *string* | *工具唯一id*            |

``` javascript
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

