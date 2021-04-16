# 获取所有微生物信息接口
> `get`   `api.lyhbio.com/rest/v1/all_microbe_info`

| 参数           |   必选   |    类型    | 说明                  |
| :----------- | :----: | :------: | :------------------ |
| *time*       | *true* |  *int*   | *时间戳* (用于确定接口的访问时间) |
| *token*      | *true* | *string* | *确定访问者身份*           |
| *microbe_id* | *true* | *string* | *微生物唯一id*           |

``` javascript
{
    "code": 200,
    "msg": "查询成功",
    "data": [
        {
            "all_microbe__microbe_id": "1",
            "all_microbe__standard_name": "黑蝙蝠",
            "all_microbe__synonym_name": "小黑狗蝙蝠",
            "all_microbe__rank": "哺乳动物",
            "all_microbe__taxid": 1
        }
    ]
}
```

