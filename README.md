# orm
实现数据库的面向对象编程

##起因
目前市面上找不到正确的面向对象操作数据库类

所以制造了一个

##目标

配合IDE提示,实现无障碍操作数据库.


## 如何学习

打开test案例阅读以及执行,里面有完整的demo和注释<br>
test目录下有另外一份指引文档

###约定的一些规矩

* 会使用compose
* php 7 以上版本
* 开启PDO模块
* 所有数据库,默认都必须开启事务
* phpunit作为单元测试 bootstrap file 为 vendor\autoload.php
* 编辑器为 phpstrom 2016.2 以上版本,配置好 php,phpunit,PHP Code Sniffer

### 支持数据库

* mysql - 必须是 utf8 编码
* postgresql (准备中)
