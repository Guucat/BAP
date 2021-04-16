# 获取参考文献信息接口
> `get`   `api.lyhbio.com/rest/v1/reference_info`

| 参数       |   必选   |    类型    | 说明                  |
| :------- | :----: | :------: | :------------------ |
| *time*   | *true* |  *int*   | *时间戳* (用于确定接口的访问时间) |
| *token*  | *true* | *string* | *确定访问者身份*           |
| *ref_id* | *true* | *string* | *微生物唯一id*           |

``` javascript
{
    "code": 200,
    "msg": "查询成功",
    "data": [
        {
            "reference__ref_id": "1",
            "reference__title": "蝙蝠wa",
            "reference__pubmed_id": 1,
            "reference__doi": "nadh",
            "reference__url": "www.bianfu.com"
        }
    ]
}
```

