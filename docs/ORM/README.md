##基础配置Config
Orm/Config/PdoConfig.php 给出配置模板。

##PDO接口提供常规的4个接口
* 查询
* 更新
* 写入
* debug - 是否打印调试信息

##SQL 语法分析
解析出需要绑定的键值对


##PageObject 存储分页对象

* 分多少页
* 可以取出当前页面条数的偏移量
* 分页条 展示 1< min >,2,3,4,5,6< max >

##生成表模型

* 表操作类 xx
* 表字段模型 xxModel
* 一维查询 xxSelectOne
* 二维查询 xxSelectAll
* 分页查询 xxPage
* 写入 xxInsert
* 更新 xxUpdate
* 枚举类型的定义 enum文件夹/xx字段