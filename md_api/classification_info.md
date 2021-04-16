# 获取微生物分类信息接口
> `get`   `api.lyhbio.com/rest/v1/classification_info`

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
            "microbe_class__microbe_id": "1",
            "microbe_class__classify": "属于哺乳动物类呀",
            "microbe_class__figure_name": "最大的蝙蝠",
            "microbe_class__ref_id": "1"
        }
    ]
}
```

