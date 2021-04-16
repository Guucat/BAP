## 表格文档及创建命令
1. user

   | Name        | Type     | Settings | References | Default Value & Note |
   | ----------- | -------- | -------- | ---------- | -------------------- |
   | user_id     | char(10) | PK       |            |                      |
   | user_name   |          |          |            |                      |
   | user_role   |          |          |            |                      |
   | password    |          |          |            |                      |
   | email       |          |          |            |                      |
   | phone_num   |          |          |            |                      |
   | create_time |          |          |            |                      |
   | update_time |          |          |            |                      |

   创建表格命令：
   ```
   CREATE TABLE iip_user(
   user_id VARCHAR(10) PRIMARY KEY,
   user_name VARCHAR(10),
   user_role VARCHAR(10),
   password VARCHAR(20),
   email VARCHAR(50),
   phone_num CHAR(11),
   create_time VARCHAR(20),
   update_time VARCHAR(20)
   );
   ``` 

2. source

   | Name        | Type     | Settings | References | Default Value & Note |
   | ----------- | -------- | -------- | ---------- | -------------------- |
   | source_id   | char(10) | PK       |            |                      |
   | source_name |          |          |            |                      |
   | source_url  |          |          |            |                      |
   | create_time |          |          |            |                      |
   | update_time |          |          |            |                      |

   创建表格命令：

   ```
   CREATE TABLE iip_source(
   source_id VARCHAR(10) PRIMARY KEY,
   source_name VARCHAR(50),
   source_url VARCHAR(2038),
   create_time VARCHAR(20),
   update_time VARCHAR(20)
   );
   ```

   

3. tool

   | Name        | Type     | Settings | References | Default Value & Note |
   | ----------- | -------- | -------- | ---------- | -------------------- |
   | tool_id     | char(10) | PK       |            |                      |
   | tool_name   |          |          |            |                      |
   | tool_url    |          |          |            |                      |
   | create_time |          |          |            |                      |
   | update_time |          |          |            |                      |

   创建表格命令：

   ```
   CREATE TABLE iip_tool(
   tool_id VARCHAR(10) PRIMARY KEY,
   tool_name VARCHAR(50),
   tool_url VARCHAR(2038),
   create_time VARCHAR(20),
   update_time VARCHAR(20)
   );
   ```

   

4. a

